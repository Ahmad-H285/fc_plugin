<?php
/*
Plugin Name: Cape East Form Builder
Plugin URI: http://www.facebook.com
Description: This plugin builds forms
Author: H/N
Version: 1.0
Author URI: http://www.youtube.com
*/


require_once(plugin_dir_path(__FILE__).'fcp_functions.php');

wp_enqueue_script('jquery');
wp_register_style('fcp_bootstrap_styles','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css');
wp_register_script('fcp_bootstrap_scripts','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js',array('jquery'));
wp_enqueue_style('fcp_bootstrap_styles');
wp_enqueue_script('fcp_bootstrap_scripts');
wp_enqueue_style('fcp_style.css',plugin_dir_url(__FILE__).'style/fcp_style.css');


if (is_admin()){
	wp_dequeue_script('fcp_bootstrap_scripts');
	wp_dequeue_style('fcp_bootstrap_styles');
}
/*
 * Some constant to denote the application type
 */
define("APPLICATION_FORM_FCP","Application Form");
define("CONTACT_FORM_FCP","Contact Form");
define("Survey_FORM_FCP","Survey Form");
define("CONTENT_SUBMISSION_FORM_FCP","Content Submission Form");
define("REGISTRATION_FORM_FCP","Registration Form");
define("BOOKING_FORM_FCP","Booking Form");
define("NEWSLETTER_FORM_FCP","Newsletter Form");
define("EVENT_FORM_FCP","Event Form");
define("CUSTOM_FORM_FCP","Custom Form");

function fcp_plugin_activation()
{
    Global $wpdb;
    /** @var wpdb $wpdb */
	$fcp_form_table = $wpdb->prefix."fcp_formbuilder";
	$fcp_submission_table = $wpdb->prefix."fcp_submissions";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$charset_collate = $wpdb->get_charset_collate();

	 if($wpdb->get_var('SHOW TABLES LIKE '.$fcp_form_table) != $fcp_form_table)
	 {
	 	$fcp_sql_form =

	 		'CREATE TABLE '.$fcp_form_table.'(form_id INTEGER(10) UNSIGNED AUTO_INCREMENT,
	 		form_body TEXT NOT NULL,
	 		form_type VARCHAR(30) NOT NULL,
	 		form_settings TEXT,
	 		PRIMARY KEY (form_id)) '.$charset_collate;

	 	dbDelta($fcp_sql_form);
	 }

	if($wpdb->get_var('SHOW TABLES LIKE '.$fcp_submission_table) != $fcp_submission_table)
	{
		$fcp_sql_submission =

			'CREATE TABLE '.$fcp_submission_table.'(submission_id INTEGER(10) UNSIGNED AUTO_INCREMENT,
		 	submission TEXT NOT NULL,
		 	sub_date DATE NOT NULL,
		 	form_id INTEGER(10) UNSIGNED,
		 	form_type VARCHAR(30) NOT NULL,
            attachment_path TEXT,
            password VARCHAR(64),
		 	FOREIGN KEY (form_id) REFERENCES '.$fcp_form_table.'(form_id) ON DELETE CASCADE ON UPDATE NO ACTION,
		 	PRIMARY KEY (submission_id)) '.$charset_collate;

		dbDelta($fcp_sql_submission);

	}
}

register_activation_hook(__FILE__,'fcp_plugin_activation');

/**
 * @param $atts
 * @return string represents the form itself when found or NULL if save form was terminated
 */
function form_builder_shortcode($atts){

    /** @var wpdb $wpdb */
    Global $wpdb;
    $attributes = shortcode_atts(array('form' => null), $atts,'form-builder');

    // include the js file
    wp_enqueue_script('fcp_js',plugin_dir_url(__FILE__).'js/fcp_front_end.js',
        array('jquery','jquery-ui-core','jquery-ui-datepicker','jquery-ui-dialog'));
    wp_enqueue_style('jquery-ui-css','http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');

    $form_id = explode("fcp_",$attributes['form']); // this hold the id of the form to be loaded
	$form_id = $form_id[1];

	/**
	 * @var $passed_form_name : will hold the name of the form that the user passed in the hsortcode
	 * to be checked later on against the stored name
	 */
	$passed_form_name = trim (str_replace("fcp_" . $form_id, "", $attributes['form']));


	$forms_table = $wpdb->prefix."fcp_formbuilder";
    $query =  "SELECT `form_body` FROM `".$forms_table."` WHERE `form_id`=".$form_id;
    $form = $wpdb->get_col($query); // getting the form

	$query = "SELECT `form_settings` FROM `".$forms_table."` WHERE `form_id`=".$form_id;
	$settings = $wpdb->get_col($query); // getting the form settings

	$query = "SELECT `form_type` FROM `".$forms_table."` WHERE `form_id`=".$form_id;
	$form_type = $wpdb->get_col($query);
	$form_type =  $form_type[0];

	$submissions_table = $wpdb->prefix."fcp_submissions";

	// now check for event form settings and set appropriate flags
	$deadline_flag = false;
	$attendees_max_flag = false;

	if ($form_type == EVENT_FORM_FCP){

		$query = "SELECT COUNT(*) FROM `".$submissions_table."` WHERE form_id=".$form_id;
		$number_of_submitted_attendees = $wpdb->get_var($query);

		$current_date = date('m/d/Y');
		$event_deadline = unserialize($settings[0])['event_form_deadline'];
		$deadline = date_diff(date_create($current_date),date_create($event_deadline));
		$deadline = $deadline->format("%R%a"); // deadline with -/+ depending on the difference between the two dates

		$event_attendess = unserialize($settings[0])['event_form_max_attendees'];

		if ($number_of_submitted_attendees == $event_attendess){
			$attendees_max_flag = true;
		}

		if ($deadline < 0){
			$deadline_flag = true;
		}
	}

	$form_name = trim (unserialize($settings[0])['form-name']);

	if ( !empty($form) ){

		if ( !strcasecmp($form_name,$passed_form_name) ){
            $nonce = wp_create_nonce($form_name.$form_id);
            if (wp_verify_nonce($nonce,$form_name.$form_id)){

                if ( isset( $_POST['fcp_submission_state'] ) && $_POST['fcp_submission_state'] == "True" ){
                    $condition = fcp_save_submission($form_id);
					if ($condition == NULL){
						return "Form is currently unavailable";
					}
                }

            }
			if (!$attendees_max_flag && !$deadline_flag) {
				return "<form method='POST' action='' class='form-horizontal fcp_form' id='" . $form_name . $form_id . "' enctype='multipart/form-data'>"
				. html_entity_decode($form[0]) .
				"<div class ='col-sm-12 hidden' id='fcp-form-messages'>
                <div class='col-sm-3'>
                </div>
                <div class='col-sm-6 bg-warning' id='fcp_message' style='border-radius: 10px;font-weight: bold;'>
                </div>
                <div class='col-sm-3'>
                </div>
            </div>" .
				"<input type='hidden' name='fcp_submission_state'><input type='hidden' name='fcp_submission'></form>";
			}
			else {
				$capacity_message = "";
				$deadline_message = "";
				if ($attendees_max_flag){
					$capacity_message = "Event capacity reached!<br>Better luck next time.";
					$message = unserialize($settings[0])['capacity_message'];
					$capacity_message = !empty($message) ? $message : $capacity_message  ;
				}
				if ( $deadline_flag ){
					$deadline_message = "Event deadline reached!<br>Better luck next time";
					$message = unserialize($settings[0])['deadline_message'];
					$deadline_message = !empty($message) ? $message : $deadline_message;
				}

				echo $capacity_message."<br>".$deadline_message;
			}

		}
		else {
			return "The form name you passed is incorrect";
		}

	}
	else {
		return "No Form Found";
	}

}

	add_shortcode('form-builder', 'form_builder_shortcode');

function fcp_admin_menu()
{
	require_once(plugin_dir_path(__FILE__).'fcp_application.php');
  require_once(plugin_dir_path(__FILE__).'fcp_contact.php');
  require_once(plugin_dir_path(__FILE__).'fcp_registration.php');
  require_once(plugin_dir_path(__FILE__).'fcp_booking.php');
  require_once(plugin_dir_path(__FILE__).'fcp_newsletter.php');
  require_once(plugin_dir_path(__FILE__).'fcp_event.php');
  require_once(plugin_dir_path(__FILE__).'fcp_survey.php');
  require_once(plugin_dir_path(__FILE__).'fcp_custom.php');

	add_menu_page('Form Builder','Form Builder','manage_options','fcp-general','fcp_general_page');
	add_submenu_page('fcp-general','Add New Form','Add New Form','manage_options','fcp-general','fcp_general_page');
	add_submenu_page('fcp-general','Submissions','Submissions','manage_options','fcp-submissions','fcp_submissions_page');
	add_submenu_page('fcp-general','Contact Form','Contact Form','manage_options','fcp-contact-form','fcp_contact_page');
	add_submenu_page('fcp-general','Survey Form','Survey Form','manage_options','fcp-servey-form','fcp_survey_page');
	add_submenu_page('fcp-general','Application Form','Application Form','manage_options','fcp-application-form','fcp_application_page');
	add_submenu_page('fcp-general','Registration Form','Registration Form','manage_options','fcp-registration-from','fcp_registration_page');
	add_submenu_page('fcp-general','Booking Form','Booking Form','manage_options','fcp-booking-form','fcp_booking_page');
	add_submenu_page('fcp-general','Content Submission Form','Content Submission Form','manage_options','fcp-content-form','fcp_contsub_page');
	add_submenu_page('fcp-general','Newsletter Form','Newsletter Form','manage_options','fcp-newsletter-form','fcp_newsletter_page');
	add_submenu_page('fcp-general','Event Form','Event Form','manage_options','fcp-event-form','fcp_event_page');
	add_submenu_page('fcp-general','Custom Form','Custom Form','manage_options','fcp-custom-form','fcp_custom_page');


}

add_action('admin_menu','fcp_admin_menu');

function fcp_edit_redirect()
{
	require_once(plugin_dir_path(__FILE__).'forms_UI.php');
	add_submenu_page('Form Builder',"Edit Application Fomr","Edit Application Form","manage_options","fcp-edit","fcp_contact_page");
}
//add_action('admin_menu','fcp_edit_redirect');

function fcp_general_page()
{
	fcp_get_bootstrap();
	?>

	<h1>Add New Form</h1>

	<!-- Accordion -->
	<div class="panel-group container col-sm-12" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Add New Form
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
      	<div class="text-center">
        	<button type="button" class="btn btn-default" style="margin: 20px" onclick="location.href='<?php echo admin_url('admin.php?page=fcp-contact-form');?>'">Contact Form</button>
        	<button type="button" class="btn btn-default" style="margin: 20px" onclick="location.href='<?php echo admin_url('admin.php?page=fcp-servey-form');?>'">Survey Form</button>
        	<button type="button" class="btn btn-default" style="margin: 20px" onclick="location.href='<?php echo admin_url('admin.php?page=fcp-content-form');?>'">Content Submission Form</button>
        	<button type="button" class="btn btn-default" style="margin: 20px" onclick="location.href='<?php echo admin_url('admin.php?page=fcp-registration-from');?>'">Registration Form</button>
        	<button type="button" class="btn btn-default" style="margin: 20px" onclick="location.href='<?php echo admin_url('admin.php?page=fcp-booking-form');?>'">Booking Form</button>
        </div>

        <div class="text-center">
        	<button type="button" class="btn btn-default" style="margin: 20px" onclick="location.href='<?php echo admin_url('admin.php?page=fcp-newsletter-form');?>'">Newsletter Form</button>
        	<button type="button" class="btn btn-default" style="margin: 20px" onclick="location.href='<?php echo admin_url('admin.php?page=fcp-event-form');?>'">Event Form</button>
        	<button type="button" class="btn btn-default" style="margin: 20px" onclick="location.href='<?php echo admin_url('admin.php?page=fcp-custom-form');?>'">Custom Form</button>
        	<button type="button" class="btn btn-default" style="margin: 20px" onclick="location.href='<?php echo admin_url('admin.php?page=fcp-application-form');?>'">Application Form</button>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          How To Use Form Creator
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>
	<?php

}

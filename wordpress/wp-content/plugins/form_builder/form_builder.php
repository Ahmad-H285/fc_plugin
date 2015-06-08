<?php
/*
Plugin Name: Cape East Form Builder
Plugin URI: http://www.facebook.com
Description: This plugin builds forms
Author: Watashi 
Version: 1.0
Author URI: http://www.youtube.com
*/

function fcp_plugin_activation()
{
	Global $wpdb;
	$fcp_form_table = $wpdb->prefix."fcp_formbuilder";
	$fcp_submission_table = $wpdb->prefix."fcp_submissions";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$charset_collate = $wpdb->get_charset_collate();
	
	 if($wpdb->get_var('SHOW TABLES LIKE '.$fcp_form_table) != $fcp_form_table)
	 {
	 	$fcp_sql_form = 
	 	
	 		'CREATE TABLE '.$fcp_form_table.'(form_id INTEGER(10) UNSIGNED AUTO_INCREMENT, 
	 		form_body VARCHAR(255) NOT NULL, 
	 		form_type VARCHAR(30) NOT NULL, 
	 		form_settings VARCHAR(255), 
	 		PRIMARY KEY (form_id)) '.$charset_collate;

	 	dbDelta($fcp_sql_form);
	 }

	if($wpdb->get_var('SHOW TABLES LIKE '.$fcp_submission_table) != $fcp_submission_table)
	{
		$fcp_sql_submission = 
		
			'CREATE TABLE '.$fcp_submission_table.'(submission_id INTEGER(10) UNSIGNED AUTO_INCREMENT,
		 	submission VARCHAR(255) NOT NULL, 
		 	sub_date DATE NOT NULL, 
		 	form_id INTEGER(10) UNSIGNED,
		 	FOREIGN KEY (form_id) REFERENCES '.$fcp_form_table.'(form_id) ON DELETE CASCADE ON UPDATE NO ACTION,
		 	PRIMARY KEY (submission_id)) '.$charset_collate;

		dbDelta($fcp_sql_submission);

	}
}

register_activation_hook(__FILE__,'fcp_plugin_activation');
	

function fcp_admin_menu()
{
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


function fcp_general_page()
{
	?>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	</head>
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
    <div id="collapseOne" class="panel-collapse " role="tabpanel" aria-labelledby="headingOne">
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
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<?php
}

function fcp_submissions_page()
{

}

function fcp_contact_page()
{
	?>

	<h1>Contact Form</h1>

	<?php
}

function fcp_survey_page()
{

}

function fcp_application_page()
{

}

function fcp_registration_page()
{

}

function fcp_booking_page()
{

}

function fcp_contsub_page()
{

}

function fcp_newsletter_page()
{

}

function fcp_event_page()
{

}

function fcp_custom_page()
{

}

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

	 if($wpdb->get_var('SHOW TABLES LIKE '.$fcp_form_table) != $fcp_form_table)
	 {
	 	$fcp_sql_form = 'CREATE TABLE '.$fcp_form_table.'(form_id INTEGER(10) UNSIGNED AUTO_INCREMENT, form_body VARCHAR(255) NOT NULL, form_type VARCHAR(30) NOT NULL, form_settings VARCHAR(255), PRIMARY KEY (form_id))';

	 	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	 	dbDelta($fcp_sql_form);
	 }

	if($wpdb->get_var('SHOW TABLES LIKE '.$fcp_submission_table) != $fcp_submission_table)
	{
		$fcp_sql_submission = 'CREATE TABLE '.$fcp_submission_table.'(submission_id INTEGER(10) UNSIGNED AUTO_INCREMENT, submission VARCHAR(255) NOT NULL, sub_date DATE NOT NULL, form_id INTEGER(10) UNSIGNED, FOREIGN KEY (form_id) REFERENCES '.$fcp_form_table.'(form_id), PRIMARY KEY (submission_id))';

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($fcp_sql_submission);

	}
}

register_activation_hook(__FILE__,'fcp_plugin_activation');
	

function fcp_admin_menu()
{
	add_menu_page('Form Builder','Form Builder','manage_options','fcb-general');
	add_submenu_page('fcb-general','General','General','manage_options','fcb-general');
	add_submenu_page('fcb-general','Submissions','Submissions','manage_options','fcb-submissions');
	add_submenu_page('fcb-general','Contact Form','Contact Form','manage_options','fcb-contact-form');
	add_submenu_page('fcb-general','Survey Form','Survey Form','manage_options','fcb-servey-form');
	add_submenu_page('fcb-general','Application Form','Application Form','manage_options','fcb-application-form');
	add_submenu_page('fcb-general','Registration Form','Registration Form','manage_options','fcb-registration-from');
	add_submenu_page('fcb-general','Survey Form','Survey Form','manage_options','fcb-servey-form');
	add_submenu_page('fcb-general','Booking Form','Booking Form','manage_options','fcb-booking-form');
	add_submenu_page('fcb-general','Content Submission Form','Content Submission Form','manage_options','fcb-content-form');
	add_submenu_page('fcb-general','Newsletter Form','Newsletter Form','manage_options','fcb-newsletter-form');
	add_submenu_page('fcb-general','Event Form','Event Form','manage_options','fcb-event-form');
	add_submenu_page('fcb-general','Custom Form','Custom Form','manage_options','fcb-custom-form');
}

add_action('admin_menu','fcp_admin_menu');
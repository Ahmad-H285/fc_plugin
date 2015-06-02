<?php
/*
Plugin Name: Cape East Form Builder
Plugin URI: http://www.facebook.com
Description: This plugin builds forms
Author: Watashi 
Version: 1.0
Author URI: http://www.youtube.com
*/
	

function form_builder_activator()
{
	global $wpdb;
	$table_name = $wpdb->prefix."formBuilder";
	if ($wpdb->get_var('SHOW TABLES LIKE '.$table_name) != $table_name)
	{
		$sql = 'CREATE TABLE '.$table_name . '(id INTEGER(10) UNSIGNED AUTO_INCREMENT, form_body VARCHAR(255), PRIMARY KEY (id) )';
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}	
}	

register_activation_hook(__FILE__, 'form_builder_activator');
function form_builder_UI(){
	?>
	<h1>Form Builder</h1>
	<form action="" method="post">
		<table>
			<tr>
				<td><label>User Name</label></td>
				<td><input type="text" name="username" /></td>
			</tr>
			
			<tr>
				<td><label>First Name</label></td>
				<td><input type="text" name="first-name" /></td>
			</tr>
			
			<tr>
				<td><label>Last Name</label></td>
				<td><input type="text" name="last-name" /></td>
			</tr>
			
			<tr>
				<td><label>Email</label></td>
				<td><input type="email" name="email" /></td>
			</tr>
			
			<tr>
				<td><button type="submit" name="add-form">Add Form</button></td>
			</tr>
		</table>
	</form>
	
	<?php
}	

function print_form()
{
	global $wpdb;
	$textField = "<input type= \"text\" value=\"Fill in this field\" />";
	$str = '<input type="text" name="first-name" />';
	$str1 = '<input type="hidden" name="action" value="form_action250" />';
	$str2 = '<input type="hidden" name="data" value="foobarid"/>';
	$withAddSlasshesh = addslashes($str);
	$label = "<label>Name: </label>" ;
	//$sub_but = '<a href="http://localhost:8888/fc_plugin/wordpress/wp-admin/admin-post.php?action=form_action250&data=first-name">Submit</a>';
	$sub_but = '<input type="submit" value="Submit ya 5ara">';
	$form = "<form method='POST' action='http://localhost:8888/fc_plugin/wordpress/wp-admin/admin-post.php'>".$label.$textField.$withAddSlasshesh.$sub_but."</form>";
	$form = htmlentities($form);
	$wpdb->insert($wpdb->prefix."formBuilder", array('form_body' => $form));
	$form = html_entity_decode($form);
	echo $form;

	// $form =  $label.$textField.$withAddSlasshesh.'<div id="eshta"><h1>ESHTA</h1></div>';
	// echo $form;
	// $wpdb->update($wpdb->prefix."formBuilder", array('form_body' => $form),array('id' => 2));
}

add_action('admin_post_form_action250','form_echo');

add_shortcode('form-builder', 'print_form');
function register_frmBuilder()
{
		add_menu_page("Form Builder", "Form Builder",'manage_options' ,"form-builder",'form_builder_UI');	
		//add_options_page("form-builder", "Add new form", 'manage_options', 'form-builder-plugin','form_builder_UI');
		//add_menu_page("Form Builder", "Form Builder",'manage_options' ,"form-builder");
}
	
	

add_action('admin_menu','register_frmBuilder');

function form_echo()
{
	echo "success";
	echo $_REQUEST['data'];
}



?>
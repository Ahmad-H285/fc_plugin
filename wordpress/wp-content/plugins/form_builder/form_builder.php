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

function print_form($atts)
{
	 global $wpdb;

	$atts = shortcode_atts(array('id' => null), $atts,'form-builder');
	

	 //$nonce = wp_create_nonce('form-builder-sub');
/*
	 $textField = '<input type="text" name="first-name" />';
	 $withAddSlasshesh = addslashes($str);
	 $label = "<label>Name: </label>" ;
	 $sub_but = '<button type="submit" name="submit">Submit</button>';
	 $form_start = "<form method='POST' action=''>".$label.$textField.$withAddSlasshesh.$sub_but.wp_nonce_field('form-builder-field');
	 $form_end = "</form>";
	 $form = htmlentities($form);
	 $wpdb->insert($wpdb->prefix."formBuilder", array('form_body' => $form));
	 $form = html_entity_decode($form);
	 

	 echo $form_start;
	 $nonce = wp_create_nonce('form-builder-sub');
	 echo $form_end;

	 if (wp_verify_nonce($nonce,'form-builder-sub')) {
		 	if (isset($_POST['first-name'])) {
		 		echo $_POST['first-name'];

		 	$wpdb->insert($wpdb -> prefix."formBuilder", array('form_body' => $_POST['first-name']));

		 	}
			
		 }

	 */	
		 $array_250 = array(htmlentities('<input type="text" name="first-name">'),htmlentities('<Label>First Name</Label>'),'a7mos','to7otmos');
		 $ser_array = serialize($array_250);
		 //echo $ser_array;
		 $unserializedarray = (unserialize($ser_array));
		 //echo $unserializedarray[0];
	$wpdb->insert($wpdb -> prefix."formBuilder", array('form_body' => $ser_array ));
	$query =  "SELECT `form_body` FROM `wp_formbuilder` WHERE `id`=".$atts['id'];//$wpdb->prepare("SELECT 'form_body' FROM 'wp_formBuilder' WHERE 'id'= 16");	 
	$text_field2 = $wpdb->get_col($query); //
	$text_field ='<input type="text" name="first-name">'; 
	$label_field = '<Label>First Name</Label>';
	$text_field = (unserialize($text_field2[0]));
// $form =  $label.$textField.$withAddSlasshesh.'<div id="eshta"><h1>ESHTA</h1></div>';
	// echo $form;
	// $wpdb->update($wpdb->prefix."formBuilder", array('form_body' => $form),array('id' => 2));
	
	?>
	<form action="" method="POST">
		<table>
			<tr>
				<!--<td><?php echo $label_field;?></td>
				<td><?php echo $text_field;?></td> -->
				<?php
					for ($i = 0; $i <sizeof($text_field)-2; $i++)
					{
					
						echo "<td>".html_entity_decode($text_field[$i])."</td>";
					}
				?>
			</tr>
			<tr>
				<td><button type="submit" name="submit">Submit</button></td>
			</tr>
		</table>

		<?php $nonce = wp_create_nonce('form-builder-sub'); ?>
	</form>

	<?php

		if (wp_verify_nonce($nonce,'form-builder-sub')) {
		 	if ($_POST['first-name']) {
		 		echo $_POST['first-name'];

		 	$wpdb->insert($wpdb -> prefix."formBuilder", array('form_body' => $_POST['first-name']));

		 	}
			
		 }

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
<?php

function fcp_stylesheets()
{
	?>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<?php
}

function fcp_scripts()
{
	?>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<?php
}

function fcp_fields_panel()
{
	?>
	<div class="fcp_panel col-md-3 text-center col-md-push-4" style="margin-left: 350px; padding: 5px; border-top: 1px solid grey; border-right: 1px solid grey; border-left: 1px solid grey; margin-top: 360px; position: absolute">
		<h4><strong>Available Fields</strong></h4>
	</div>
	<div class="col-md-3 col-md-push-4" id="fields-panel" style="margin-left: 350px; padding: 5px; border: 1px solid grey; background-color: #D2D2D2; margin-top: 410px; position: absolute">
		<button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Text</button>
		<button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Numeric</button>
		<button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Date Picker</button>
		<button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Time Picker</button>
		<button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Select Menu</button>
		<button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Checkbox</button>
		<button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Radio Button</button>
		<button type="button" class="btn btn-primary" style="margin: 3px" onclick="">File</button>
		<button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Email</button>
		<button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Password</button>
		<button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Text Area</button>

	</div>
	<?php
}

function fcp_fields_options()
{
	?>
	<div class="col-md-4 text-center col-md-push-4 hidden" id="edit_field_title">
	</div>
	<div class="col-md-4 col-md-push-4 hidden" id="edit_field_content">
		<div id="fieldOptions" class="form-horizontal"></div><div><button type="button" class="btn btn-primary" id="saveButton" style="margin: 15px" onclick="">Save</button><button type="button" class="btn btn-danger" id="discardButton" style="margin: 15px" onclick="">Discard</button></div>
	</div>
	<?php
}

function fcp_display_created_forms($form_type){

	Global $wpdb;
	$app_created_forms = $wpdb -> get_results("SELECT `form_id`, `form_settings` FROM `wp_fcp_formbuilder` WHERE `form_type`= '".$form_type."'",ARRAY_A);
	$form_count = 1;
	foreach ($app_created_forms as $form) {
		$form_name = unserialize($form['form_settings'])['form-name'];
		$form_id = $form['form_id'];
		echo "<tr>
			    <td>".$form_count."</td><td>".$form_name."</td>"
			    ."<td>[form id=\"".$form_name."_fcp_".$form_id."\"]</td>
				<td><a href='".$_SERVER['REQUEST_URI'].'&id='.$form_id."' class='fcp-edit-selected-form' id='fcp_form_".$form_id."'>Edit</a></td>
				<td><a href='javascript:void(0);' class='fcp-delete-selected-form' id='fcp_form_id_".$form_id."'>Delete</a></td>
			</tr>" ;
		$form_count++;
	}
}

function fcp_update_form()
{
	if (wp_verify_nonce($nonce_edit,'form-builder-sub')) {
				if ($_POST['form-name']){

				}


				if ($_POST['fcp_edit']){

					$form_settings = array('form-name' => $_POST['form-name']);

					if($_POST['send-to-backend']) // if the user enabled backend notification
					{
                        if ($_POST['backend_users_list'] == "Other ...") // to check if the user wanted to email a non WordPress user
                        {
                            $backend_notification_settings = array('To' => $_POST['other_backend_email'], 'From' => $_POST['backend-from'], 'Subject' => $_POST['backend-subject'], 'Body' => $_POST['backend-body']);
                        }
                        else
                        {
                            $backend_notification_settings = array('To' => $_POST['backend_users_list'], 'From' => $_POST['backend-from'], 'Subject' => $_POST['backend-subject'], 'Body' => $_POST['backend-body']);
                        }
						$form_settings["backend-notification"] = $backend_notification_settings;
					}

					else
					{
						$form_settings["backend-notification"] = NULL;
					}

					if($_POST['send-to-user'])
					{
						$user_notification_settings = array('From' => $_POST['user-from'], 'Subject' => $_POST['user-subject'], 'Body' => $_POST['user-body']);
						$form_settings["user-notification"] = $user_notification_settings;
					}

					else
					{
						$form_settings["user-notification"] = NULL;
					}

					$form_settings = serialize($form_settings); // serialize the array to be able to insert it into the database

					Global $wpdb;
					
					$wpdb->update($wpdb -> prefix."fcp_formbuilder", array('form_body' => $_POST['fcp_edit'], 'form_type'=> "application_form" ,'form_settings' => $form_settings), array('form_id' => $_GET['id']));
				}
			}

}

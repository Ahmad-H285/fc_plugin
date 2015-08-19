<?php

require_once(plugin_dir_path(__FILE__).'fcp_functions.php');

function fcp_submissions_page()
{

}

function fcp_contact_page()
{
	fcp_stylesheets();
	?>

	<h1>Contact Form</h1>

	<?php

}

function fcp_survey_page()
{

}

function fcp_application_page()
{

	wp_enqueue_script('fcp_js',plugin_dir_url(__FILE__).'js/fcp_js.js', array('jquery','jquery-ui-core','jquery-ui-datepicker'));
	wp_enqueue_style('jquery-ui-css','http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
	wp_enqueue_style('fcp_style.css',plugin_dir_url(__FILE__).'style/fcp_style.css');

	//$fcp_default_app_form= '
	if($_GET['id'])
	{
		Global $wpdb;
		$edit_form = $wpdb -> get_results("SELECT `form_body`, `form_settings` FROM `wp_fcp_formbuilder` WHERE `form_id`= '".$_GET['id']."'",ARRAY_A);
		$fcp_edit_settings = unserialize($edit_form[0]['form_settings']);
		var_dump(unserialize($edit_form[0]['form_settings']));
		$fcp_settings_backend = $fcp_edit_settings['backend-notification'];
		$fcp_settings_user = $fcp_edit_settings['user-notification'];
		var_dump($fcp_settings_backend);
		$form_body_wrap = '	<h2 class="col-sm-12" id="top_of_form">Edit Form</h2>
							<div class="col-sm-7">
								<form action="" method="POST" class="form-horizontal" id="fcp_application_preview">
									<div class="form-group">
										<label for="fcp-form-name" class="col-sm-10"><h3>Form Name</h3></label>
										<div class="col-sm-10">
											<input name="form-name" class="form-control col-sm-3" id="fcp-form-name" placeholder="Form Name" type="text" value="'.$fcp_edit_settings['form-name'].'">
										</div>
									</div>
									<div class="form-group">
										<label for="submit-button-text" class="col-sm-10"><h3>Submit Button Text</h3></label>
										<div class="col-sm-4">
											<input name="submit-button-text" class="form-control col-sm-3" id="submit-button-text" placeholder="Submit Button Text" type="text">
										</div>
									</div>
									<div class="form-sketch">';
		if($fcp_settings_backend != NULL)
		{?>
			<script>jQuery(document).ready(function(){
				jQuery("div#headingOne").one('click',function(){
					jQuery("input.fcp_notification[name='send-to-backend']").prop("checked","true");
					jQuery("div#back-not").css("display","block");	
				});
				});
			</script>
			<?php
			$back_to = $fcp_settings_backend['To'];
			$back_from = $fcp_settings_backend['From'];
			$back_sub = $fcp_settings_backend['Subject'];
			$back_body = $fcp_settings_backend['Body'];
		}

		if($fcp_settings_user != NULL)
		{?>
			<script>jQuery(document).ready(function(){
				jQuery("div#headingTwo").one('click',function(){
					jQuery("input.fcp_notification[name='send-to-user']").prop("checked","true");
					jQuery("div#user-not").css("display","block");	
					//jQuery("div.form-sketch div.fcp_select").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;select&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;select&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>');

					//jQuery("select#backend_users_list option[value='2']").prop("selected","true");
					//jQuery("select#backend_users_list option[value='<?php echo $back_to;?>']").prop("selected","true");
				});
					
				});
			</script>
			<?php
			$user_from = $fcp_settings_user['From'];
			$user_sub = $fcp_settings_user['Subject'];
			$user_body = $fcp_settings_user['Body'];
		}							

		$return_form_body = html_entity_decode($edit_form[0]['form_body']);
		fcp_fields_panel();
		fcp_fields_options();

		//$form_settings_wrap = 

?>
<h2 class="col-sm-12" id="top_of_form">Edit Form</h2>
							<div class="col-sm-7">
								<form action="" method="POST" class="form-horizontal" id="fcp_application_preview">
									<div class="form-group">
										<label for="fcp-form-name" class="col-sm-10"><h3>Form Name</h3></label>
										<div class="col-sm-10">
											<input name="form-name" class="form-control col-sm-3" id="fcp-form-name" placeholder="Form Name" type="text" value="<?php echo $fcp_edit_settings['form-name'];?>">
										</div>
									</div>
									<div class="form-group">
										<label for="submit-button-text" class="col-sm-10"><h3>Submit Button Text</h3></label>
										<div class="col-sm-4">
											<input name="submit-button-text" class="form-control col-sm-3" id="submit-button-text" placeholder="Submit Button Text" type="text">
										</div>
									</div>
									<div class="form-sketch">
									<?php echo html_entity_decode($edit_form[0]['form_body']);?>

									</div>




		<div class="panel-group container col-sm-12" id="accordion" role="tablist" aria-multiselectable="true" style="padding: 0">
  							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
		     			 			<h4 class="panel-title">
		        						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Backend Email Notification</a>
		      						</h4>
		    					</div>

								<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      								<div class="panel-body">
      									<div class="text-center">
      										<!-- Send to email checkbox -->
											<div class="check_field" id="email_options">
												<div class="form-group">
													<div class="checkbox col-sm-5" style="padding-top:0">
														<label><input class="col-sm-4 fcp_notification" name="send-to-backend" type="checkbox">Enable Backend Notification</label>
													</div>
												</div>
											</div>
											<div style="display: none;" class="fcp_email_not_opt" id="back-not">
												<div class="form-group">
													<label for="backend_users_list" class="col-sm-3 control-label">Backend Users</label>
													<div class="col-sm-6">
														<?php wp_dropdown_users( array("name" => "backend_users_list")); ?>												</div>
												</div>

												<div style="display: none;" class="form-group" id="send_to_non_wordpress_user">
													<label for="fcp_custon_from_email" class="col-sm-3 control-label">To</label>
													<div class="col-sm-6">
														<input name="other_backend_email" class="form-control" id="fcp_custon_from_email" placeholder="From" type="email">
													</div>
												</div>

												<div class="form-group">
													<label for="fcp_email_from" class="col-sm-3 control-label">From</label>
													<div class="col-sm-6">
														<input name="backend-from" class="form-control" id="fcp_email_from" placeholder="From" type="Text" value="<?php echo$back_from; ?>">
													</div>
												</div>

												<div class="form-group">
													<label for="fcp_email_subject" class="col-sm-3 control-label">Subject</label>
													<div class="col-sm-6">
														<input name="backend-subject" class="form-control" id="fcp_email_subject" placeholder="Subject" type="text" value="<?php echo $back_sub;?>">
													</div>
												</div>

												<div class="form-group">
													<label for="fcp_email_body" class="col-sm-3 control-label">Body</label>
													<div class="col-sm-6">
														<textarea name="backend-body" rows="10" cols="50" class="form-control" style="resize: none" id="fcp_email_body" placeholder="Body"><?php echo $back_body;?></textarea>
													</div>
												</div>
											</div>
											<!-- End Send to email checkbox -->
      									</div>
      								</div>
      							</div>


      						</div>

      						<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingTwo">
		     			 			<h4 class="panel-title">
		        						<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">User Email Notification</a>
		      						</h4>
		    					</div>

								<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      								<div class="panel-body">
      									<div class="text-center">
      										<!-- Send to email checkbox -->
											<div class="check_field" id="email_options">
												<div class="form-group">
													<div class="checkbox col-sm-5" style="padding-top:0">
														<label><input class="col-sm-4 fcp_notification" name="send-to-user" type="checkbox">Enable User Notification</label>
													</div>
												</div>
											</div>

											<div style="display: none;" class="fcp_email_not_opt" id="user-not">
												<div class="form-group">
													<label for="fcp_user_email_from" class="col-sm-3 control-label">From</label>
													<div class="col-sm-6">
														<input name="user-from" class="form-control" id="fcp_user_email_from" placeholder="From" type="Text" value="<?php echo $user_from; ?>">
													</div>
												</div>

												<div class="form-group">
													<label for="fcp_user_email_subject" class="col-sm-3 control-label">Subject</label>
													<div class="col-sm-6">
														<input name="user-subject" class="form-control" id="fcp_user_email_subject" placeholder="Subject" type="text" value="<?php echo $user_sub; ?>">
													</div>
												</div>

												<div class="form-group">
													<label for="fcp_user_email_body" class="col-sm-3 control-label">Body</label>
													<div class="col-sm-6">
														<textarea rows="10" cols="50" name="user-body" class="form-control" style="resize: none" id="fcp_user_email_body" placeholder="Body"><?php echo $user_body; ?></textarea>
													</div>
												</div>
											</div>
											<!-- End Send to email checkbox -->
      									</div>
      								</div>
      							</div>
								

      						</div>
      					</div>
      					<div class="row" style="padding: 20px"><button id="save_fcp_form_edit" type="submit" class="btn btn-danger">Save Form</button></div></div><?php $nonce_edit = wp_create_nonce('form-builder-sub'); ?>
						<input type="hidden" name="fcp_edit" value="">							
		<!-- $return_form_body = html_entity_decode($edit_form[0]['form_body']);
		fcp_fields_panel();
		fcp_fields_options();
		echo $form_body_wrap.$return_form_body.'</div>'.$form_settings_wrap.'<div class="row" style="padding: 20px"><button id="save_fcp_form" type="submit" class="btn btn-danger">Save Form</button></div></div>';
		//var_dump((string)unserialize($edit_form['form_settings'])['form-name']);
		?> -->
		<script>
		var select_option_value = <?php echo $back_to;?>;

		jQuery("select#backend_users_list option[value='"+select_option_value+"'").prop("selected","true");
		</script>
		<script>
			jQuery(document).ready(function(){
				
				  jQuery('<a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;radio&quot;,jQuery(this).parent(),jQuery(this).parent().attr(&quot;id&quot;));" class="col-sm-1" style="margin-left: 10px;">Edit</a><button type="button" class="close radio_close" arial-label="Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button>').insertAfter("div.radio_field label.radio_label");
				  jQuery('<a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;checkbox&quot;,jQuery(this).parent(),jQuery(this).parent().attr(&quot;id&quot;));" class="col-sm-1" style="margin-left: 10px;">Edit</a><button type="button" class="close check_close" arial-label=“Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button>').insertAfter("div.check_field label.check_label");
				  jQuery('<button type="button" class="pass_close close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;password&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>').insertAfter("div.fcp_pass div.input-container")
				  jQuery("div.form-sketch div.fcp_select").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;select&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;select&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>');
				  jQuery("div.form-sketch div.fcp_text").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;text&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>');
				  jQuery("div.form-sketch div.fcp_numeric").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;number&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>');
				  jQuery("div.form-sketch div.fcp_date").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;date&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>');
				  jQuery("div.form-sketch div.fcp_time").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;time&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>');	
				  jQuery("div.form-sketch div.fcp_email").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;email;&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>');
				  jQuery("div.form-sketch div.fcp_textarea").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;file&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>');
				  jQuery("div.form-sketch div.fcp_file").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;file&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>');
			});
		</script>
		
		<?php


	}



	else
	{

	?>
<div>
    <h1 class="col-sm-12">Application Form</h1>
	<ul class="nav nav-tabs" role="tablist">
    	<li role="presentation" class="active"><a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">Forms</a></li>
    	<li role="presentation"><a href="#AddNewForm" aria-controls="Add" role="tab" data-toggle="tab">Add New Form</a></li>
    	<li role="presentation"><a href="#submissions" aria-controls="Submission" role="tab" data-toggle="tab">Submissions</a></li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane" id="AddNewForm">
	<?php
	fcp_fields_panel();
	fcp_fields_options();


	?>
			<div class="container-fluid">
			<div class="row">
			<h2 class="col-sm-12">New Form</h2>


			<div class="col-sm-7">

				<form action="" method="POST" class="form-horizontal" id="fcp_application_preview">

					<div class="form-group">
						<label for="fcp-form-name" class="col-sm-10"><h3>Form Name</h3></label>
						<div class="col-sm-10">
							<input name="form-name" type="text" class="form-control col-sm-3" id="fcp-form-name" placeholder="Form Name">
						</div>
					</div>
					<div class="form-group">
						<label for="submit-button-text" class="col-sm-10"><h3>Submit Button Text</h3></label>
						<div class="col-sm-4">
							<input name="submit-button-text" type="text" class="form-control col-sm-3" id="submit-button-text" placeholder="Submit Button Text">
						</div>
					</div>
					<br>
					<br>
					<div class="form-sketch"> <!--The begining of the form fields -->
					  <div class="form-group fcp_text">
					     <label for="app_first_name" class="col-sm-3 control-label ">First Name</label>
					     <div class="col-sm-6 input-container">
					      <input type="text" class="form-control" id="app_first_name" placeholder="First Name">
						 </div>
						 <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
						 <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;text&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>
					  </div>

					  <div class="form-group fcp_text">
					    <label for="app_last_name" class="col-sm-3 control-label">Last Name</label>
					    <div class="col-sm-6 input-container">
					      <input type="text" class="form-control" id="app_last_name" placeholder="Last Name">
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					    <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;text&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>
					  </div>

					  <div class="form-group fcp_email">
					    <label for="app_email" class="col-sm-3 control-label text-left">Email</label>
					    <div class="col-sm-6 input-container">
					      <input type="email" class="form-control" id="app_email" placeholder="Email">
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					    <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;email;&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>
					  </div>

					  <div class="form-group fcp_select">
					    <label for="app_opt" class="col-sm-4 control-label">Application Options</label>
					    <div class="col-sm-5  input-container">
					      <select class="form-control" id="app_opt"><option>List Item 1</option></select>
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					    <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;select&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;select&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>
					  </div>


						<div class="radio_field" id="radio_button">
							<label class="radio_label col-sm-9" for="radio_button">Gender</label>
							<a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;radio&quot;,jQuery(this).parent(),jQuery(this).parent().attr(&quot;id&quot;));" class="col-sm-1" style="margin-left: 10px;">Edit</a>
							<button type="button" class="close radio_close" arial-label="Close" style="margin-right: -14px;"><span aria-hidden="true">×</span></button>
							<div class="form-group">
								<div class="radio col-sm-10 input-container" style="padding-top:0">
									<label><input class="col-sm-4" name="radio_but_1_radio" type="radio">Male</label>
								</div>
								<div class="radio col-sm-10 input-container" style="padding-top:0">
									<label><input class="col-sm-4" name="radio_but_1_radio" type="radio">Female</label>
								</div>
							</div>
						</div>

					  <div class="form-group fcp_file">
					    <label for="app_attachment" class="col-sm-3 control-label">Attachment</label>
					    <div class="col-sm-6 input-container">
					      <input type="file" id="app_attachment">
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					    <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;file&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>
					  </div>

					  <div class="form-group">
					    <div class="col-sm-offset-3 col-sm-3">
					      <button type="" class="btn btn-default fcp_submitButton" disabled>Submit</button>
					    </div>
					  </div>
						</div>

						<!-- Form Options Panel -->
						<div class="panel-group container col-sm-12" id="accordion" role="tablist" aria-multiselectable="true" style="padding: 0">
  							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
		     			 			<h4 class="panel-title">
		        						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Backend Email Notification</a>
		      						</h4>
		    					</div>

								<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      								<div class="panel-body">
      									<div class="text-center">
      										<!-- Send to email checkbox -->
											<div class="check_field" id="email_options">
												<div class="form-group">
													<div class = "checkbox col-sm-5" style="padding-top:0">
														<label><input type="checkbox" class="col-sm-4 fcp_notification" name="send-to-backend">Enable Backend Notification</label>
													</div>
												</div>
											</div>
											<div class = "fcp_email_not_opt">
												<div class="form-group">
													<label for="backend_users_list" class="col-sm-3 control-label">Backend Users</label>
													<div class="col-sm-6">
														<?php wp_dropdown_users( array('name' => 'backend_users_list') ); ?>
													</div>
												</div>

												<div class="form-group" id="send_to_non_wordpress_user">
													<label for="fcp_custon_from_email" class="col-sm-3 control-label">To</label>
													<div class="col-sm-6">
														<input name="other_backend_email" type="email" class="form-control" id="fcp_custon_from_email" placeholder="From">
													</div>
												</div>

												<div class="form-group">
													<label for="fcp_email_from" class="col-sm-3 control-label">From</label>
													<div class="col-sm-6">
														<input type="Text" name="backend-from" class="form-control" id="fcp_email_from" placeholder="From">
													</div>
												</div>

												<div class="form-group">
													<label for="fcp_email_subject" class="col-sm-3 control-label">Subject</label>
													<div class="col-sm-6">
														<input type="text" name="backend-subject" class="form-control" id="fcp_email_subject" placeholder="Subject">
													</div>
												</div>

												<div class="form-group">
													<label for="fcp_email_body" class="col-sm-3 control-label">Body</label>
													<div class="col-sm-6">
														<textarea name="backend-body" rows="10" cols="50" class="form-control" style="resize: none" id="fcp_email_body" placeholder="Body"></textarea>
													</div>
												</div>
											</div>
											<!-- End Send to email checkbox -->
      									</div>
      								</div>
      							</div>


      						</div>

      						<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingTwo">
		     			 			<h4 class="panel-title">
		        						<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">User Email Notification</a>
		      						</h4>
		    					</div>

								<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      								<div class="panel-body">
      									<div class="text-center">
      										<!-- Send to email checkbox -->
											<div class="check_field" id="email_options">
												<div class="form-group">
													<div class = "checkbox col-sm-5" style="padding-top:0">
														<label><input type="checkbox" class="col-sm-4 fcp_notification" name="send-to-user">Enable User Notification</label>
													</div>
												</div>
											</div>

											<div class = "fcp_email_not_opt">
												<div class="form-group">
													<label for="fcp_user_email_from" class="col-sm-3 control-label">From</label>
													<div class="col-sm-6">
														<input type="Text" name="user-from" class="form-control" id="fcp_user_email_from" placeholder="From">
													</div>
												</div>

												<div class="form-group">
													<label for="fcp_user_email_subject" class="col-sm-3 control-label">Subject</label>
													<div class="col-sm-6">
														<input type="text" name="user-subject" class="form-control" id="fcp_user_email_subject" placeholder="Subject">
													</div>
												</div>

												<div class="form-group">
													<label for="fcp_user_email_body" class="col-sm-3 control-label">Body</label>
													<div class="col-sm-6">
														<textarea rows="10" cols="50" name="user-body" class="form-control" style="resize: none" id="fcp_user_email_body" placeholder="Body"></textarea>
													</div>
												</div>
											</div>
											<!-- End Send to email checkbox -->
      									</div>
      								</div>
      							</div>


      						</div>
      					</div>
						<!-- End of Form Options panel -->
						<div class="row" style="padding: 20px">
							<button id="save_fcp_form" type="submit" class="btn btn-danger">Save Form</button>
						</div>
						<?php $nonce = wp_create_nonce('form-builder-sub'); ?>
						<input type="hidden" name="fcp" value="">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane active" id="edit">
			<div class="col-sm-8">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Form Name</th>
						<th>Shortcode</th>
						<th></th>
						<td></td>
					</tr>
				</thead>
				<tbody>
				<?php
                    fcp_display_created_forms("application_form");
				?>
				</tbody>
			</table>
			</div>

		</div>
		<div role="tabpanel" class="tab-pane" id="submissions">
			<p>There are no submissions available yet</p>
		</div>
	</div>	
</div>	
			<?php
}
		if($_GET['id'])
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

		else
		{
			if (wp_verify_nonce($nonce,'form-builder-sub')) {
				if ($_POST['form-name']){

				}


				if ($_POST['fcp']){

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
					//var_dump( $_POST['fcp']);
					$wpdb->insert($wpdb -> prefix."fcp_formbuilder", array('form_body' => $_POST['fcp'], 'form_type'=> "application_form" ,'form_settings' => $form_settings));
					//$wpdb->update($wpdb -> prefix."fcp_formbuilder", array('form_body' => $_POST['fcp'], 'form_type'=> "application_form" ,'form_settings' => $form_settings), array('form_id' => $_GET['id']));
				}
			}

		}
			
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

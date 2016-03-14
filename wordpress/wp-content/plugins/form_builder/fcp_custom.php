<?php

function fcp_custom_page()
{
	fcp_get_bootstrap();
	wp_enqueue_script('fcp_js',plugin_dir_url(__FILE__).'js/fcp_js.js',
		array('jquery','jquery-ui-core','jquery-ui-datepicker','jquery-ui-dialog','jquery-ui-draggable','jquery-ui-sortable'));
	wp_enqueue_style('jquery-ui-css','http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
	wp_enqueue_style('fcp_style.css',plugin_dir_url(__FILE__).'style/fcp_style.css');
    wp_enqueue_script('jquery-effects-clip');
    wp_enqueue_script('jquery-effects-bounce');
    wp_enqueue_script('jquery-effects-blind');
    $nonce = wp_create_nonce('form-builder-sub');

    if (wp_verify_nonce($nonce,'form-builder-sub')) {

        // check if there are forms to delete
        if (isset($_POST['selected_forms_ids'])){
            fcp_delete_forms($_POST['selected_forms_ids']);
        }
        else if (isset($_POST['selected_submissions_ids'])){
            fcp_delete_submissions($_POST['selected_submissions_ids']);
        }


        if (isset($_POST['fcp'])){
        	

           fcp_save_form(CUSTOM_FORM_FCP);

        }
    }



	if(isset($_GET['id']))
	{
		fcp_update_form(CUSTOM_FORM_FCP);
		
		Global $wpdb;
		$table_name = $wpdb->prefix."fcp_formbuilder";
		$edit_form = $wpdb -> get_results("SELECT `form_body`, `form_settings` FROM `{$table_name}` WHERE `form_id`= '".$_GET['id']."'",ARRAY_A);
		$fcp_edit_settings = unserialize($edit_form[0]['form_settings']);
		$fcp_settings_backend = $fcp_edit_settings['backend-notification'];
		$fcp_settings_user = $fcp_edit_settings['user-notification'];

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
					var email_field_id = jQuery("input[name='fcp_user_email']").attr("id");
					jQuery("#fcp_user_email_to_notification").mouseover().attr("value",email_field_id);
					});

				});
			</script>
			<?php
			$user_from = $fcp_settings_user['From'];
			$user_sub = $fcp_settings_user['Subject'];
			$user_body = $fcp_settings_user['Body'];
		}

		fcp_fields_panel();
		fcp_fields_options();


	//$nonce_edit = wp_create_nonce('form-builder-sub');
	?><input type="hidden" name="fcp_edit" value="">


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
															<input name="backend-from" class="form-control" id="fcp_email_from" placeholder="From" type="Text" value="<?php if(isset($back_from)){ echo$back_from; } ?>">
														</div>
													</div>

													<div class="form-group">
														<label for="fcp_email_subject" class="col-sm-3 control-label">Subject</label>
														<div class="col-sm-6">
															<input name="backend-subject" class="form-control" id="fcp_email_subject" placeholder="Subject" type="text" value="<?php if(isset($back_sub)){ echo $back_sub; } ?>">
														</div>
													</div>

													<div class="form-group">
														<label for="fcp_email_body" class="col-sm-3 control-label">Body</label>
														<div class="col-sm-6">
															<textarea name="backend-body" rows="10" cols="50" class="form-control" style="resize: none" id="fcp_email_body" placeholder="Body"><?php if(isset($back_body)){ echo $back_body; } ?></textarea>
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
														<label for="fcp_user_email_to" class="col-sm-3 control-label">To</label>
														<div class="col-sm-6">
															<select class="form-control fcp-select-menu-field" id="fcp_user_email_to_notification">
																<option value="0">Select an email field to use</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="fcp_user_email_from" class="col-sm-3 control-label">From</label>
														<div class="col-sm-6">
															<input name="user-from" class="form-control" id="fcp_user_email_from" placeholder="From" type="Text" value="<?php if(isset($user_from)){ echo $user_from; } ?>">
														</div>
													</div>

													<div class="form-group">
														<label for="fcp_user_email_subject" class="col-sm-3 control-label">Subject</label>
														<div class="col-sm-6">
															<input name="user-subject" class="form-control" id="fcp_user_email_subject" placeholder="Subject" type="text" value="<?php if(isset($user_sub)){ echo $user_sub; } ?>">
														</div>
													</div>

													<div class="form-group">
														<label for="fcp_user_email_body" class="col-sm-3 control-label">Body</label>
														<div class="col-sm-6">
															<textarea rows="10" cols="50" name="user-body" class="form-control" style="resize: none" id="fcp_user_email_body" placeholder="Body"><?php if(isset($user_body)){ echo $user_body; } ?></textarea>
														</div>
													</div>
												</div>
												<!-- End Send to email checkbox -->
	      									</div>
	      								</div>
	      							</div>


	      						</div>
	      					</div>
	      					<div class="row" style="padding: 20px"><button id="save_fcp_form_edit" type="submit" class="btn btn-success">Save Form</button></div></div><?php $nonce_edit = wp_create_nonce('form-builder-sub'); ?>
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

					  jQuery('<a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;radio&quot;,jQuery(this).parent(),jQuery(this).parent().attr(&quot;id&quot;));" class="col-sm-1" style="margin-left: 26px;">Edit</a><button type="button" class="close radio_close" arial-label="Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button>').insertAfter("div.radio_field label.radio_label");
					  jQuery('<a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;checkbox&quot;,jQuery(this).parent(),jQuery(this).parent().attr(&quot;id&quot;));" class="col-sm-1" style="margin-left: 26px;">Edit</a><button type="button" class="close check_close" arial-label=“Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button>').insertAfter("div.check_field label.check_label");
					  jQuery('<button type="button" class="pass_close close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;password&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>').insertAfter("div.fcp_pass div.input-container")
					  jQuery("div.form-sketch div.fcp_select").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;select&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;select&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>');
					  jQuery("div.form-sketch div.fcp_text").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;text&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>');
					  jQuery("div.form-sketch div.fcp_numeric").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;number&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>');
					  jQuery("div.form-sketch div.fcp_date").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;date&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>');
					  jQuery("div.form-sketch div.fcp_time").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;time&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>');
					jQuery("div.form-sketch div.fcp_email").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;email&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>');
					  jQuery("div.form-sketch div.fcp_textarea").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;textarea&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;textarea&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>');
					  jQuery("div.form-sketch div.fcp_file").append('<button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;file&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>');
					var drag_icon = '<span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span>';
					jQuery(".fcp-drag-sort").prepend(drag_icon);

					jQuery("div.radio_field, div.check_field").find("span.fcp_drag_icon").css("margin-left","-15px");
				});
			</script>

		<?php


	}
    /*
     * Now display the contents of the submission
     */
    else if (isset($_GET['submission_content_id'])){
        fcp_display_submission_content($_GET['submission_content_id']);
    }



	else
	{

	?>
<div>
    <h1 class="col-sm-12">Custom Form</h1>
	<ul class="nav nav-tabs" role="tablist">
    	<li role="presentation" class="active"><a href="#forms" aria-controls="edit" role="tab" data-toggle="tab">
				<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Forms
			</a>
		</li>
    	<li role="presentation"><a href="#AddNewForm" aria-controls="Add" role="tab" data-toggle="tab">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Form
			</a>
		</li>
    	<li role="presentation"><a href="#submissions" aria-controls="Submission" role="tab" data-toggle="tab">
				<span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Submissions
			</a>
		</li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane" id="AddNewForm">
	<?php
	fcp_fields_panel();
	fcp_fields_options();


	?>
			<div class="container-fluid">
			<div class="row">
			<h2 class="col-sm-12" id="top_of_form">New Form</h2>


			<div class="col-sm-7">

				<form action="" method="POST" class="form-horizontal" id="fcp_application_preview" enctype="multipart/form-data">

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

					  <div class="form-group fcp-drag-sort">
						  <span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span>
					    <div class="col-sm-offset-4 col-sm-5">
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
													<label for="fcp_user_email_to" class="col-sm-3 control-label">To</label>
													<div class="col-sm-6">
														<select class="form-control fcp-select-menu-field" id="fcp_user_email_to_notification">
															<option value="0">Select an email field to use</option>
														</select>
													</div>
												</div>

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
							<button id="save_fcp_form" type="submit" class="btn btn-success">Save Form</button>
						</div>
						<?php //$nonce = wp_create_nonce('form-builder-sub'); ?>
						<input type="hidden" name="fcp" value="">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane active" id="forms">
            <form action="" method="POST" class="form-horizontal col-sm-9" id="stored_forms">
                <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr class="fcp-table-head">
							<th>
								<input type="checkbox" id="fcp_select_all_forms"> #
							</th>
                            <th>Name</th>
                            <th>Form Shortcode</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        fcp_display_created_forms(CUSTOM_FORM_FCP);
                    ?>
                    </tbody>
                </table>
                </div>
                <div class="col-sm-5">
                    <button class="btn btn-danger" type="submit" id="delete_selected_forms" disabled>
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						Delete Selected Forms
					</button>
                </div>
                <input type="hidden" name="selected_forms_ids" id="selected_forms_ids">

            </form>

		</div>
		<div role="tabpanel" class="tab-pane" id="submissions">
			<form action="" method="POST" class="form-horizontal col-sm-9" id="stored_submission">
				<div class="col-sm-12">
					<table class="table table-hover">
						<thead>
						<tr class="fcp-table-head">
							<th>
								<input type="checkbox" id="fcp_select_all_submissions"> #
							</th>
							<th>Form Name</th>
							<th>Submission Date</th>
                            <th>Submission ID</th>
							<th>Content</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php
					
						fcp_display_submissions(CUSTOM_FORM_FCP);

						?>
						</tbody>
					</table>
				</div>
				<div class="col-sm-5">
					<button class="btn btn-danger" type="submit" id="delete_selected_submissions" disabled>
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						Delete Selected Submissions
					</button>
				</div>
				<input type="hidden" name="selected_submissions_ids" id="selected_submissions_ids">

			</form>
		</div>
	</div>
</div>
			<?php
}
		if(isset($_GET['id']))
		{
			fcp_update_form(CUSTOM_FORM_FCP);
		}


}

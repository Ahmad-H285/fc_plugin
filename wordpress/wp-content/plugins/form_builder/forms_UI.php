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

	wp_enqueue_script('fcp_js',plugin_dir_url(__FILE__).'js/fcp_js.js', array('jquery','jquery-ui-core','jquery-ui-datepicker','jquery-ui-dialog'));
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


        if (isset($_POST['fcp'])){

            fcp_save_form("application_form"); // passing the name of the form type

        }
    }

	?>
<div>
    <h1 class="col-sm-12">Application Form</h1>
	<ul class="nav nav-tabs" role="tablist">
    	<li role="presentation" class="active"><a href="#forms" aria-controls="edit" role="tab" data-toggle="tab">Forms</a></li>
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
			<h2 class="col-sm-12" id="top_of_form">New Form</h2>


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
					  <div class="form-group">
					     <label for="app_first_name" class="col-sm-3 control-label ">First Name</label>
					     <div class="col-sm-6 input-container">
					      <input name="first_name" type="text" class="form-control fcp-no-special" id="app_first_name" placeholder="First Name">
						 </div>
						 <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
						 <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;text&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>
					  </div>

					  <div class="form-group">
					    <label for="app_last_name" class="col-sm-3 control-label">Last Name</label>
					    <div class="col-sm-6 input-container">
					      <input type="text" class="form-control fcp-no-special" id="app_last_name" placeholder="Last Name">
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					    <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;text&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>
					  </div>

					  <div class="form-group">
					    <label for="app_email" class="col-sm-3 control-label text-left">Email</label>
					    <div class="col-sm-6 input-container">
					      <input type="email" class="form-control fcp-no-special" id="app_email" placeholder="Email">
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					    <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;email;&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>
					  </div>

					  <div class="form-group">
					    <label for="app_opt" class="col-sm-4 control-label">Application Options</label>
					    <div class="col-sm-5  input-container">
					      <select class="form-control fcp-select-menu-field" id="app_opt"><option>List Item 1</option></select>
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					    <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;select&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;select&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a>
					  </div>


						<div class="radio_field" id="radio_button">
							<label class="radio_label col-sm-10" for="radio_button">Gender</label>
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

					  <div class="form-group">
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
						<?php //$nonce = wp_create_nonce('form-builder-sub'); ?>
						<input type="hidden" name="fcp" value="">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane active" id="forms">
            <form action="" method="POST" class="form-horizontal col-sm-9" id="stored_forms">
                <div class="col-sm-8">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Form Shortcode</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        fcp_display_created_forms("application_form");
                    ?>
                    </tbody>
                </table>
                </div>
                <div class="col-sm-5">
                    <button class="btn btn-default" type="submit" id="delete_selected_forms" disabled>Delete Selected Forms</button>
                </div>
                <input type="hidden" name="selected_forms_ids" id="selected_forms_ids">

            </form>

		</div>
		<div role="tabpanel" class="tab-pane" id="submissions">
			<form action="" method="POST" class="form-horizontal col-sm-9" id="stored_submission">
				<div class="col-sm-8">
					<table class="table table-hover">
						<thead>
						<tr>
							<th>#</th>
							<th>Form Name</th>
							<th>Submission Date</th>
							<th>Submission Content</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php
						fcp_display_submissions("application_form");
						?>
						</tbody>
					</table>
				</div>
				<div class="col-sm-5">
					<button class="btn btn-default" type="submit" id="delete_selected_submissions" disabled>Delete Selected Submissions</button>
				</div>
				<input type="hidden" name="selected_submissions_ids" id="selected_submissions_ids">

			</form>
		</div>
	</div>	
</div>
			<?php



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

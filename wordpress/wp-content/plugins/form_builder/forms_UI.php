<?php

require_once(plugin_dir_path(__FILE__).'fcp_functions.php');

// function fcp_js_caller()
// {
// 	wp_register_script('fcp_j',plugins_url('/js/fcp_js.js',__FILE__), array('jquery'));

// 	wp_enqueue_script( 'fcp_j',plugins_url('/js/fcp_js.js',__FILE__), array('jquery'));
// }

// add_action( 'wp_enqueue_scripts', 'fcp_js_caller');

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
	fcp_stylesheets();


	$fcp_default_app_form= '
			<h1 class="col-sm-12">Application Form</h1>
			
			
			<div class="col-md-5">
				<form action="" method="POST" class="form-horizontal">
					
					<div class="form-group">
						<label for="app_form_name" class="col-sm-10"><h3>Form Name</h3></label>
						<div class="col-sm-10">
							<input type="text" class="form-control col-sm-3" id="app_form_name" placeholder="Form Name">
						</div>
					</div>
					<br>
					<br>
					  <div class="form-group">  
					     <label for="app_first_name" class="col-sm-3 control-label">First Name</label>
					     <div class="col-sm-8">
					      <input type="text" class="form-control" id="app_first_name" placeholder="First Name">
						 </div>
						 <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					  </div>

					  <div class="form-group">
					    <label for="app_last_name" class="col-sm-3 control-label">Last Name</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="app_last_name" placeholder="Last Name">
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					  </div>

					  <div class="form-group">
					    <label for="app_email" class="col-sm-3 control-label">Email</label>
					    <div class="col-sm-8">
					      <input type="email" class="form-control" id="app_email" placeholder="Email">
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					  </div>
					  
					  <div class="form-group">
					    <label for="app_opt" class="col-sm-5 control-label">Application Options</label>
					    <div class="col-sm-6">
					      <select class="form-control" id="app_opt"></select>
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					  </div>

					  <div class="form-group">
					    <div class="col-sm-10">
					      <button type="submit" name="app_attachement" class="btn btn-default">Attachment</button>
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					  </div>

					   <div class="form-group">
					    <div class="col-sm-offset-3 col-sm-3">
					      <button type="submit" class="btn btn-default">Submit</button>
					    </div>
					  </div>
					  ';
				$fcp_app_form_close='</form>
			</div>';
			$app_form = $fcp_default_app_form . $fcp_app_form_close;

			echo $app_form;			

				?>	 
	<?php
	fcp_fields_panel();
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

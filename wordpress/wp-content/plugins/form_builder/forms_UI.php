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
	fcp_stylesheets();

	wp_enqueue_script('fcp_js',plugin_dir_url(__FILE__).'js/fcp_js.js', array('jquery','jquery-ui-core','jquery-ui-datepicker'));
	wp_enqueue_style('jquery-ui-css','http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
	wp_enqueue_style('fcp_style.css',plugin_dir_url(__FILE__).'style/fcp_style.css');

	$fcp_default_app_form= '
			<div class="container-fluid">
			<div class="row">
			<h1 class="col-sm-12">Application Form</h1>


			<div class="col-sm-7">
				<form action="" method="POST" class="form-horizontal" id="fcp_application_preview" style="padding: 30px; border: 1px solid #888; box-shadow: 10px 10px 5px #888;">

					<div class="form-group">
						<label for="app_form_name" class="col-sm-10"><h3>Form Name</h3></label>
						<div class="col-sm-10">
							<input type="text" class="form-control col-sm-3" id="app_form_name" placeholder="Form Name">
						</div>
					</div>
					<br>
					<br>
					  <div class="form-group">
					     <label for="app_first_name" class="col-sm-3 control-label ">First Name</label>
					     <div class="col-sm-6 input-container">
					      <input type="text" class="form-control" id="app_first_name" placeholder="First Name">
						 </div>
						 <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
						 <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a>
					  </div>

					  <div class="form-group">
					    <label for="app_last_name" class="col-sm-3 control-label">Last Name</label>
					    <div class="col-sm-6 input-container">
					      <input type="text" class="form-control" id="app_last_name" placeholder="Last Name">
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					    <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a>
					  </div>

					  <div class="form-group">
					    <label for="app_email" class="col-sm-3 control-label text-left">Email</label>
					    <div class="col-sm-6 input-container">
					      <input type="email" class="form-control" id="app_email" placeholder="Email">
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					    <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a>
					  </div>

					  <div class="form-group">
					    <label for="app_opt" class="col-sm-4 control-label">Application Options</label>
					    <div class="col-sm-5  input-container">
					      <select class="form-control" id="app_opt"></select>
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					    <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),&quot;select&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;select&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a>
					  </div>

					  <div class="radio_field">
					  <label class="radio_label col-sm-9">Gender</label>
					  <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text(),&quot;radio&quot;,jQuery(this).parent())" class="col-sm-1" style="margin-left: 10px;">Edit</a>
					  <button type="button" class="close radio_close" arial-label="Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button>
					  <div class="form-group">

					  	<div class = "radio col-sm-10 input-container" style="padding-top:0">
							<label><input name="gender" type="radio" class="col-sm-4">Male</label>
						</div>
						<div class = "radio col-sm-10 input-container" style="padding-top:0">
							<label><input name="gender" type="radio" class="col-sm-4">Female</label>
						</div>

					  </div>
					  </div>

					  <div class="form-group">
					      <label for="app_attachment" class="col-sm-3 control-label">Attachment</label>
					    <div class="col-sm-6 input-container">
					      <input type="file" id="app_attachment">
					    </div>
					    <button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button>
					    <a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent())" class="col-sm-1">Edit</a>
					  </div>

					   <div class="form-group">
					    <div class="col-sm-offset-3 col-sm-3">
					      <button type="submit" class="btn btn-default">Submit</button>
					    </div>
					  </div>
					  ';
				$fcp_app_form_close='</form>
			</div></div><div class="row" style="padding: 20px"><button type="button" class="btn btn-danger">Save Form</button></div></div>';
			$app_form = $fcp_default_app_form . $fcp_app_form_close;

			echo $app_form;

			fcp_fields_panel();
			fcp_fields_options();

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

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

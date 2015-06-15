jQuery(document).ready(function(){
	fcp_deleteField(); // to invoke the click event handler function below
});

function fcp_deleteField(){
	jQuery("button.close").click(function(){ // deletes a field when it's 'x' icon is clicked
		jQuery(this).parent(".form-group").remove();

	});

}


/*
	The following code allows the field buttons to add the fields in the preview form
*/
//TEXT FIELD
var fcp_text_field = '<div class="form-group"><label for="app_first_name" class="col-sm-3 control-label">Text</label><div class="col-sm-8"><input type="text" class="form-control" id="app_first_name" placeholder="Text"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>';

//NUMERIC FIELD
var fcp_numeric_field = '<div class="form-group"><label for="app_first_name" class="col-sm-3 control-label">Numeric Field </label><div class="col-sm-8"><input type="number" class="form-control" id="app_first_name" placeholder=""></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>';

//DATE PICKER

//TIME PICKER

//SELECT MENU
var fcp_select_field = '<div class="form-group"><label for="app_first_name" class="col-sm-3 control-label">Text 1</label><div class="col-sm-8"><select class="form-control"><option>Option 1</option><option>Option 2</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>';

//CHECKBOX
var fcp_checkbox_field = '<div class = "checkbox"><label><input type="checkbox">Checkbox</label></div>';

//RADIO BUTTON
var fcp_radiobutton_field = '<div class = "radio"><label><input type="radio" value="value1">Radio</label></div>';

//EMAIL
var fcp_email_field = '<div class="form-group"><label for="app_first_name" class="col-sm-3 control-label">Email</label><div class="col-sm-8"><input type="email" class="form-control" id="app_first_name" placeholder="Email"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>';

//PASSWORD
var fcp_password_field = '<div class="form-group"><label for="app_first_name" class="col-sm-3 control-label">Password</label><div class="col-sm-8"><input type="password" class="form-control" id="app_first_name" placeholder="Password"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>';

//TEXT AREA
var fcp_textArea_field = '<div class="form-group"><label for="app_first_name" class="col-sm-3 control-label">Text</label><div class="col-sm-8"><textarea rows="4" cols="50" class="form-control"></textarea></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>'


jQuery("button.btn-primary").click(function(){
	if(jQuery(this).text() == 'Text'){
		
		jQuery("div.form-group:last").before(fcp_text_field);
	}

	else if(jQuery(this).text()== 'Numeric'){
		jQuery("div.form-group:last").before(fcp_numeric_field);
	}

	else if(jQuery(this).text()== 'Date Picker'){
		//jQuery("div.form-group:last").before(fcp_numeric_field);
	}

	else if(jQuery(this).text()== 'Time Picker'){
		//jQuery("div.form-group:last").before(fcp_numeric_field);
	}

	else if(jQuery(this).text()== 'Select Menu'){
		jQuery("div.form-group:last").before(fcp_select_field);
	}

	else if(jQuery(this).text()== 'Checkbox'){
		jQuery("div.form-group:last").before(fcp_checkbox_field);
	}

	else if(jQuery(this).text()== 'Radio Button'){
		jQuery("div.form-group:last").before(fcp_radiobutton_field);
	}

	else if(jQuery(this).text()== 'Email'){
		jQuery("div.form-group:last").before(fcp_email_field);
	}

	else if(jQuery(this).text()== 'Password'){
		jQuery("div.form-group:last").before(fcp_password_field);
	}

	else if(jQuery(this).text()== 'Text Area'){
		jQuery("div.form-group:last").before(fcp_textArea_field);
	}

	fcp_deleteField(); // to update the 'x' that has been added to respond to the click event
});
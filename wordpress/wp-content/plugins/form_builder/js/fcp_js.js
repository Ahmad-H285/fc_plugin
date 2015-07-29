/*********************** Global Variables ***********************/
// counters to be used for field multiple instances
var date_picker_instance = 0;
var text_field_instance = 0;
var numeric_field_instance = 0;
var time_field_instance = 0;
var select_field_instance = 0;
var checkbox_field_instance = 0;
var radio_field_instance = 0;
var email_field_instance = 0;
var password_field_instance = 0;
var textarea_field_instance = 0;
var file_field_instance = 0;

//List item counter
var list_item_count = 1;
// object to contain the options that are changed live and can be returned to what they were
var options = {};
// required field mark
var required_mark = '<span class="required-field-mark">*</span>';
/*********************** Global Variables End ***********************/

jQuery(document).ready(function(){
	jQuery("div#wpcontent").css("background-color","white");
	fcp_radio_deleteField();
	fcp_check_deleteField();
	fcp_deleteField(); // to invoke the click event handler function below
	//jQuery("button.fcp_submitButton").click(fcp_formSubmitHandler); testing to make sure it works

});

function fcp_deleteField(){

	jQuery("form button.close").click(function(){ // deletes a field when it's 'x' icon is clicked
		jQuery(this).parent().remove();
		jQuery("div#edit_field_content").removeClass("show").addClass("hidden");
		jQuery("div#edit_field_title").removeClass("show").addClass("hidden");
	});
	jQuery("button.radio_close").click(function(){ // deletes a field when it's 'x' icon is clicked
		jQuery(this).parent().remove();
		jQuery("div#edit_field_content").removeClass("show").addClass("hidden");
		jQuery("div#edit_field_title").removeClass("show").addClass("hidden");
	});

	jQuery("button.field_options close").click(function(){ // deletes a field when it's 'x' icon is clicked
		jQuery(this).parent().remove();
	});

	jQuery("div#edit_field_content button.close").click(function(){ // deletes a field when it's 'x' icon is clicked
		jQuery(this).parent().remove();
	});
}

function fcp_check_deleteField(){
	jQuery("button.check_close").click(function(){ // deletes a field when it's 'x' icon is clicked
		//jQuery(this).parent().prev("label.check_label").remove();
		jQuery(this).parent().remove();
		//jQuery("div#edit_field_content").removeClass("show").addClass("hidden");
		//jQuery("div#edit_field_title").removeClass("show").addClass("hidden");
	});

}

function fcp_radio_deleteField(){
	jQuery("button.radio_close").click(function(){ // deletes a field when it's 'x' icon is clicked
		jQuery(this).parent().prev("label.radio_label").remove();
		jQuery(this).parent().remove();
		jQuery("div#edit_field_content").removeClass("show").addClass("hidden");
		jQuery("div#edit_field_title").removeClass("show").addClass("hidden");
	});

}

 // function fcp_numeric_range_activator(event){

 // 		var max_length_field = jQuery("input#num-max").val();
 // 		event.data.attr("max", max_length_field);

 // }

// the following function handles making a field required or not
function requiredFieldHandler(event){

	var fieldLabel = jQuery(event.data.label); // will hold the label object
	var field = jQuery("#"+event.data.input); // will hold the input itself
	if ( jQuery("input#required-option").prop("checked") ) { //required checkbox is checked
		fieldLabel.append(required_mark);
		field.addClass("fcp-required-input");
	}

	else { // required checkbox is not checked
		if ( fieldLabel.children("span.required-field-mark").length > 0 ) {
			fieldLabel.children("span.required-field-mark").remove();
			field.removeClass("fcp-required-input");
		}
	}
}


/*
	The following code allows the field buttons to add the fields in the preview form
*/
//TEXT FIELD
var fcp_text_field = '<div class="form-group"><label for="Text-field'+text_field_instance+'" class="col-sm-3 control-label">Text</label><div class="col-sm-6 input-container"><input type="text" class="form-control" id="Text-field'+text_field_instance+'" placeholder="Text"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;text&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//NUMERIC FIELD
var fcp_numeric_field = '<div class="form-group"><label for="Number-field'+numeric_field_instance+'" class="col-sm-3 control-label">Numeric Field </label><div class="col-sm-6 input-container"><input type="number" class="form-control" id="Number-field'+numeric_field_instance+'" placeholder=""></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;number&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//DATE PICKER
var fcp_date_field = '<div class="form-group"><label for="Date-field'+date_picker_instance+'" class="col-sm-3 control-label">Date</label><div class="col-sm-6 input-container"><input type="text" class="form-control" id="Date-field'+date_picker_instance+'" placeholder="DD/MM/YY"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;date&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//TIME PICKER
var fcp_time_field = '<div class="form-group"><label for="Time-field'+time_field_instance+'" class="col-sm-3 control-label">Time Picker</label><div class="col-sm-6 input-container"><input type="number" class="form-control col-sm-3" id="Time-field'+time_field_instance+'" placeholder="hrs" max="12" style="width: 70px"><label class="col-sm-1 control-label"> : </label><input type="number" class="form-control col-sm-3" id="Time-field'+time_field_instance+'" placeholder="mins" max="59" style="width: 70px"><select class="form-control col-sm-2" style="width:50px; margin-left:15px"><option>AM</option><option>PM</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;time&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//SELECT MENU
var fcp_select_field = '<div class="form-group"><label for="Select-field'+select_field_instance+'" class="col-sm-3 control-label">Select Menu</label><div class="col-sm-6 input-container"><select class="form-control" id="Select-field'+select_field_instance+'"><option>Option 1</option><option>Option 2</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;select&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;select&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//CHECKBOX
var fcp_checkbox_field = '<div class="check_field" id="check_box_'+checkbox_field_instance+'"><label class="check_label col-sm-10" for="check_box_'+checkbox_field_instance+'">Chackbox options</label><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;checkbox&quot;,jQuery(this).parent(),jQuery(this).parent().attr(&quot;id&quot;));" class="col-sm-1" style="margin-left: 10px;">Edit</a><button type="button" class="close check_close" arial-label=“Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button><div class="form-group"><div class = "checkbox col-sm-10 input-container" style="padding-top:0"><label><input type="checkbox" class="col-sm-4” name=“check"">Checkbox</label></div></div></div>';

//RADIO BUTTON
var fcp_radiobutton_field = '<div class="radio_field" id="radio_but_'+radio_field_instance+'"><label class="radio_label col-sm-10" for="radio_but_'+radio_field_instance+'">Radio Button</label><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;radio&quot;,jQuery(this).parent(),jQuery(this).parent().attr(&quot;id&quot;));" class="col-sm-1" style="margin-left: 10px;">Edit</a><button type="button" class="close radio_close" arial-label="Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button><div class="form-group"><div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input name="radio" type="radio" class="col-sm-4">Radio</label></div></div></div>';

//EMAIL
var fcp_email_field = '<div class="form-group"><label for="Email-field'+email_field_instance+'" class="col-sm-3 control-label">Email</label><div class="col-sm-6 input-container"><input type="email" class="form-control" id="Email-field'+email_field_instance+'" placeholder="Email"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;email;&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//PASSWORD
var fcp_password_field = '<div class="form-group"><label for="Password-field'+password_field_instance+'" class="col-sm-3 control-label">Password</label><div class="col-sm-6 input-container"><input type="password" class="form-control" id="Password-field'+password_field_instance+'" placeholder="Password"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;password&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//TEXT AREA
var fcp_textArea_field = '<div class="form-group"><label for="Textarea-field'+textarea_field_instance+'" class="col-sm-3 control-label">Text Area</label><div class="col-sm-6 input-container"><textarea rows="4" cols="50" class="form-control" style="resize: none" id="Textarea-field'+textarea_field_instance+'"></textarea></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;textarea&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;textarea&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//file upload
var fcp_fileSelect_field = '<div class="form-group"><label for="File-field'+file_field_instance+'" class="col-sm-3 control-label">Attachment</label><div class="col-sm-6 input-container"><input type="file" id="File-field'+file_field_instance+'"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;file&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

/******************End of Fields buttons******************/

/*
	The following variables hold the editable fields of each input type
	In the form of an object containing options for each field and field name as a key
*/

//Slug Field
var fcp_slug_field = '<div class="form-group" id="custom-slug"><label class="col-sm-6 control-label" for="slug_option">Custom Class: </label><input id="slug_option" type="text" maxlength="25" placeholder="Custom Class" class="col-sm-5"></div>';
//FIELD NAME ( FOR ALL FIELDS)
var name_field_options = '<div class="form-group"><label class="col-sm-5 control-label" for="field-name-option">Field Name: </label><input id="field-name-option" type="text" maxlength="25" placeholder="Field Name" class="col-sm-6"></div>';

//REQUIRED FIELD
var required_field_options = '<div class="form-group" id="required_option_opt"><div class= "checkbox col-sm-10"><label><input type="checkbox" class="col-sm-4" name="required-option" id="required-option"><span id="required-option">Required Field</span></label></div></div>';

var field_options = {}; // The object which will hold all of the options for different inputs
//TEXT FIELD
var text_field_options = '<label>Field Name: </label><input id="field-name-option" type="text" maxlength="25" placeholder="Field Name">';
field_options.text = '';//'<div class="form-group"><label class="col-sm-5 control-label" for="field-name-option">Field Name: </label><input id="field-name-option" type="text" maxlength="25" placeholder="Field Name" class="col-sm-6"></div>';

//NUMBER FIELD
var number_field_options = '<label>Field Name: </label><input id="field-name-option" type="text" maxlength="25" placeholder="Field Name">';
field_options.number = '<div class="form-group"><label class="col-sm-3 control-label">Max</label><input type="number" id="num-max" class="col-sm-3"></div>';

//RADIO OPTION
var radio_add_options = '<div class = "radiobutton col-sm-12 input-container" id="radiobut_add"><input type="text" class="col-sm-8 field-option-add" name="radio"><div class = "radio col-sm-3 input-container" style="padding-top:0"><label><input name="radio_default" type="radio" class="col-sm-2">Default</label></div><button type="button" class="field_options close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>';

var radio_add_button = '<button type="button" name="radio" class="radio_add">Add option</button>';
field_options.radio = '<button type="button" name="radio" class="radio_add">Add option</button>';

//CHECKBOX OPTIONS
var check_add_options = '<div class = "checkbox col-sm-10 input-container" id="checkbox_add"><input type="text" class="col-sm-8 field-option-add" name="check"><button type="button" class="field_options close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>';

//var check_add_field = '<div class = "checkbox col-sm-10 input-container" style="padding-top:0"><label><input type="checkbox" class="col-sm-4" name="check">Checkbox</label><button type="button" class="field_options close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>';

//var check_add_field = '<div class = "checkbox col-sm-10 input-container" style="padding-top:0"><label><input type="checkbox" class="col-sm-4" name="check">Checkbox</label><button type="button" class="field_options close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>';

var check_add_button = '<button type="button" name="check" class="check_add">Add option</button>';
field_options.checkbox = '<button type="button" name="check" class="check_add">Add option</button>';

//NUMERIC OPTIONS
var range_activ_field_options = '<div class="form-group"><div class = "checkbox col-sm-10 num-range" style="padding-top:0"><label><input type="checkbox" class="col-sm-4" name="range" id="range_active">Character Length</label></div></div>';


var max_range_field_options = '<div class="form-group"><label class="col-sm-3" control-label>Max</label><input type="number" id="num-max" class="col-sm-3"></div>';

// TIME PICKER
field_options.time = '<div class="radio_field"><label class="radio_label col-sm-9">Time Format</label><div class="form-group" id="time_format_option"><div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input name="time-format" value="12-hour" type="radio" class="col-sm-4" checked>12 hour format</label></div><div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input name="time-format" value="24-hour" type="radio" class="col-sm-4">24 hour format</label></div></div></div>';

//TEXT AREA
field_options.textarea = '<div class="form-group"><label class="col-sm-5 control-label">Character Length</label><input type="number" min="0" id="text_area_max" class="col-sm-3"></div><div class="form-group"><label class="col-sm-5 control-label">Height</label><input type="number" min="0" id="text_area_height" class="col-sm-3"></div>';

// SELECT MENU
field_options.select = '<button type="button" id="select_menu_option_addButton" name="select-option" class="">Add Item</button><div id="select_list_options" class="col-sm-12"><p id="list_options_title">List Items: </p></div>';
/******************End of Editable Fields of Inputs ******************/

/*
 *	The following variables will hold the field options (label, min...etc)
 *	To be saved and used again if the discard button is clicked
 */

 var before_edit_label;

 /************ End of field options values variables ************/

// The following function allows the additon of new fields using their created above variables when their respective button is clicked

jQuery("div#fields-panel button.btn-primary").click(function(){

	var inputType;
	var addedField;
	var fieldID;

	if(jQuery(this).text() == 'Text'){

		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_text_field);
		inputType = "text";
		text_field_instance +=1; // increment counter and then re define the variable with new counter value
		fcp_text_field = '<div class="form-group"><label for="Text-field'+text_field_instance+'" class="col-sm-3 control-label">Text</label><div class="col-sm-6 input-container"><input type="text" class="form-control" id="Text-field'+text_field_instance+'" placeholder="Text"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;text&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';
	}

	else if(jQuery(this).text()== 'Numeric'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_numeric_field);
		inputType = "number";
		numeric_field_instance +=1;
		fcp_numeric_field = '<div class="form-group"><label for="Number-field'+numeric_field_instance+'" class="col-sm-3 control-label">Numeric Field </label><div class="col-sm-6 input-container"><input type="number" class="form-control" id="Number-field'+numeric_field_instance+'" placeholder=""></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;number&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';
	}

	else if(jQuery(this).text()== 'Date Picker'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_date_field);
		jQuery("#Date-field"+date_picker_instance).datepicker();
		inputType = "date";
		date_picker_instance += 1;
		fcp_date_field = '<div class="form-group"><label for="Date-field'+date_picker_instance+'" class="col-sm-3 control-label">Date</label><div class="col-sm-6 input-container"><input type="text" class="form-control" id="Date-field'+date_picker_instance+'" placeholder="DD/MM/YY"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;date&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

	}

	else if(jQuery(this).text()== 'Time Picker'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_time_field);
		inputType = "time";
		time_field_instance += 1;
		fcp_time_field = '<div class="form-group"><label for="Time-field'+time_field_instance+'" class="col-sm-3 control-label">Time Picker</label><div class="col-sm-6 input-container"><input type="number" class="form-control col-sm-3" id="Time-field'+time_field_instance+'" placeholder="hrs" max="12" style="width: 70px"><label class="col-sm-1 control-label"> : </label><input type="number" class="form-control col-sm-3" id="Time-field'+time_field_instance+'" placeholder="mins" max="59" style="width: 70px"><select class="form-control col-sm-2" style="width:50px; margin-left:15px"><option>AM</option><option>PM</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;time&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';
	}

	else if(jQuery(this).text()== 'Select Menu'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_select_field);
		inputType = "select";

		select_field_instance +=1;
		fcp_select_field = '<div class="form-group"><label for="Select-field'+select_field_instance+'" class="col-sm-3 control-label">Select Menu</label><div class="col-sm-6 input-container"><select class="form-control" id="Select-field'+select_field_instance+'"><option>Option 1</option><option>Option 2</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;select&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;select&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

	}

	else if(jQuery(this).text()== 'Checkbox'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_checkbox_field);
		inputType = "checkbox";

		checkbox_field_instance += 1;
		fcp_checkbox_field = '<div class="check_field" id="check_box_'+checkbox_field_instance+'"><label class="check_label col-sm-10" for="check_box_'+checkbox_field_instance+'">Chackbox options</label><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;checkbox&quot;,jQuery(this).parent(),jQuery(this).parent().attr(&quot;id&quot;));" class="col-sm-1" style="margin-left: 10px;">Edit</a><button type="button" class="close check_close" arial-label=“Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button><div class="form-group"><div class = "checkbox col-sm-10 input-container" style="padding-top:0"><label><input type="checkbox" class="col-sm-4” name=“check"">Checkbox</label></div></div></div>';
	}

	else if(jQuery(this).text()== 'Radio Button'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_radiobutton_field);
		inputType = "radio";

		radio_field_instance += 1;
		fcp_radiobutton_field = '<div class="radio_field" id="radio_but_'+radio_field_instance+'"><label class="radio_label col-sm-10" for="radio_but_'+radio_field_instance+'">Radio Button</label><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;radio&quot;,jQuery(this).parent(),jQuery(this).parent().attr(&quot;id&quot;));" class="col-sm-1" style="margin-left: 10px;">Edit</a><button type="button" class="close radio_close" arial-label="Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button><div class="form-group"><div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input name="radio" type="radio" class="col-sm-4">Radio</label></div></div></div>';
	}

	else if(jQuery(this).text()== 'Email'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_email_field);
		inputType = "email";
		email_field_instance +=1;
		fcp_email_field = '<div class="form-group"><label for="Email-field'+email_field_instance+'" class="col-sm-3 control-label">Email</label><div class="col-sm-6 input-container"><input type="email" class="form-control" id="Email-field'+email_field_instance+'" placeholder="Email"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;email;&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';
	}

	else if(jQuery(this).text()== 'Password'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_password_field);
		inputType = "password";
		password_field_instance +=1;
		fcp_password_field = '<div class="form-group"><label for="Password-field'+password_field_instance+'" class="col-sm-3 control-label">Password</label><div class="col-sm-6 input-container"><input type="password" class="form-control" id="Password-field'+password_field_instance+'" placeholder="Password"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;password&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';
	}

	else if(jQuery(this).text()== 'Text Area'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_textArea_field);
		inputType = "textarea";
		textarea_field_instance +=1;
		fcp_textArea_field = '<div class="form-group"><label for="Textarea-field'+textarea_field_instance+'" class="col-sm-3 control-label">Text Area</label><div class="col-sm-6 input-container"><textarea rows="4" cols="50" class="form-control" style="resize: none" id="Textarea-field'+textarea_field_instance+'"></textarea></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;textarea&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;textarea&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';
	}
	else if(jQuery(this).text()== 'File'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_fileSelect_field);
		inputType = "file";

		file_field_instance +=1;
		fcp_fileSelect_field = '<div class="form-group"><label for="File-field'+file_field_instance+'" class="col-sm-3 control-label">Attachment</label><div class="col-sm-6 input-container"><input type="file" id="File-field'+file_field_instance+'"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;file&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

	}

	if ( jQuery(this).text() == 'Radio Button' ){ // special case for radio button
		addedField = jQuery("div.radio_field:last");

		fieldID = addedField.attr("id");
	}

	else if( jQuery(this).text() == 'Checkbox' ){ // special case for checkbox
		addedField = jQuery("div.check_field:last");

		fieldID = addedField.attr("id");
	}

	// else { // for every other type

	// }

	else if(jQuery(this).text()== 'Select Menu')
	{
		addedField = jQuery("form#fcp_application_preview div.form-group:last").prev();
		fieldID = jQuery(addedField).children(".input-container").children("select").attr("id");
	}

	else if(jQuery(this).text()== 'Text Area')
	{
		addedField = jQuery("form#fcp_application_preview div.form-group:last").prev();
		fieldID = jQuery(addedField).children(".input-container").children("textarea").attr("id");
	}

	else
	{
		addedField = jQuery("form#fcp_application_preview div.form-group:last").prev();
		fieldID = jQuery(addedField).children(".input-container").children("input").attr("id");
	}

	editFieldOptions(jQuery(this).text(),inputType,addedField,fieldID);
	fcp_check_deleteField();
	fcp_radio_deleteField();
	fcp_deleteField();// to update the 'x' that has been added to respond to the click event

});

// the following handles the discard button

// jQuery("button#discardButton").click(function(){
// 	jQuery("div#edit_field_title").toggleClass("show").addClass("hidden");
// 	jQuery("div#edit_field_content").toggleClass("show").addClass("hidden");
// });
/*
	// Build the discard button handler function and include the above two lines of code
	the function should accept the data passed by the edit field handler function bellow
*/

function discardChanges(event){
	//jQuery(event.data.element).children("label").text(event.data.field_values.label).append(event.data.field_values.required); // returns the label as it was

/*
	return the other options as they once were
	event.data object contains the input field ID, then an object options containing objects of each option target and data
	The function will take back any changes made that do not depend on clicking the save button
	****************Start****************
*/
var input_field_object_parent = event.data.element; // This is the parent (div.form-group) of the main input ( an input field type number or text for example)
var options_object = event.data.options;
var target; // this will hold the target to be changed back
var target_data; // this will hold the data of the target
var target_field_id = "#"+event.data.options.id;
jQuery.each(options_object,function(key,value){

	if ( key == "label" ) {
		target = jQuery("label[for='" + value[0] + "']");
		target_data = value[1];
		target.text(target_data);
	}
	else if ( key == "required" ) {
		target = jQuery("label[for='"+ options_object.label[0] +"']"); // getting the id of the label
		if (value == true) { // was marked required required: true
			target.append(required_mark);
			jQuery(target_field_id).addClass("fcp-required-input");
		}
		else { // was not required required : false
			target.children("span").remove();
			jQuery(target_field_id).removeClass("fcp-required-input");
		}

	}

	else if (key == "time") {
		var timeOptions = options_object.time;
		var selectAm_Pm_html = timeOptions.am_pm.clone(); // to get a deep copy of the select menu
		if ( timeOptions.format == 12 ) {
			timeOptions.hours.attr("max","12");
			if ( timeOptions.minutes.next("select").length < 1 ){ // if it does not exist already
				timeOptions.minutes.after(selectAm_Pm_html);
			}
		}
		else if ( timeOptions.format == 23 ) {
			timeOptions.hours.attr("max","23");
			timeOptions.minutes.next("select").remove();
		}

	}


});

/*
	return the other options as they once were
	****************END****************
*/

	jQuery("div#edit_field_title").toggleClass("show").addClass("hidden");
	jQuery("div#edit_field_content").toggleClass("show").addClass("hidden");
	jQuery("button#discardButton").off("click");
	jQuery("input#range_active").off("click");
	jQuery("input#required-option").off("click");
	jQuery("div.form-group#time_format_option div.radio label input[name='time-format']").off("change",timeFormatHandler);
	jQuery("button#select_menu_option_addButton").off("click",select_menu_option_handler);
}


/************** END of DISCARD Button **************/


// The following handles the save button

jQuery("button#saveButton").on("click",saveButtonHandler);

function saveButtonHandler (){

	jQuery("div#edit_field_title").toggleClass("show").addClass("hidden");
	jQuery("div#edit_field_content").toggleClass("show").addClass("hidden");
	alert("Saved !!");
	jQuery("button#discardButton").off("click");
	jQuery("input#range_active").off("click");
	//fcp_numeric_range_activator();
	jQuery("input#required-option").off("click");
	jQuery("div.form-group#time_format_option div.radio label input[name='time-format']").off("change",timeFormatHandler);
	jQuery("button#select_menu_option_addButton").off("click",select_menu_option_handler);
}


/************** END of Save Button handler**************/


// The following function updates the label of the field

function updateFieldLabel(event){ // field label is in the event.data.label object which is the label tag (<label></label>) of the field to be edited

	//console.log(jQuery(event.data.label).text());

	if ( jQuery(event.data.label).children("span.required-field-mark").length > 0 ){
		jQuery(event.data.label).text(jQuery(this).val()).append(required_mark);
	}

	else{
		jQuery(event.data.label).text(jQuery(this).val());
	}


}

/******************* updateFieldLabel End *******************/

// The following code handles the options of the field

/*
 *	The editFieldOptions function shows the options panel on the right hand side and displays the options and control them for the select field
 *	The function takes three paramaters:
 *	(1) the title of the select field (label tag if present)
 *	(2) the value of the "type" attribute of the input or simply text containing the type of the input for special case inputs (select tag)
 *	(3) the jQuery object of the entire parent "div" tag which has "form-group" as a class
 * 	For example:
 *
 *  	editFieldOptions('First Name','text',jQuery("div.form-group:first"));
 */

function editFieldOptions(title,type,field,inputID){
	//console.log(inputID);
	options.id = inputID; // store the id of the input in the options variable to be passed to the discard button handler
// The next two lines were added in case the user clicked twice on the addition of a field or edit
// to unhook the previously attached click events
	jQuery("button#saveButton").off("click");
	jQuery("button#saveButton").on("click",saveButtonHandler);

	jQuery("div#edit_field_content").removeClass("hidden").addClass("show");
	jQuery("div#edit_field_title").removeClass("hidden").addClass("show").html('<h4> Edit '+title+' Field</h4>');
	jQuery("div#fieldOptions").empty(); // to remove other fields options before displaying other fields options
	var field_values = {label: title.replace('*','')}; // used the replace function to remove the required mark if it exists
	var field_id_num = 1;
	var max_value = jQuery("input#"+inputID).attr("max");

	//console.log(field_values);
	//before_edit_label = title;
	var field_name_trim = jQuery.trim(jQuery("div#edit_field_title").text().split('Edit')[1].split('Field')[0]);
	// next add the options to the div according to their type

	jQuery(name_field_options).prependTo("div#fieldOptions");


	options.label = [inputID,title]; // Specifying the label target and data to be passed to discardButton handler

	if (type == "text" || type == "number" || type === "date" || type == "password" || type == "email" || type == "file" || type == "time")
	{

		options.label = [inputID,title]; // Specifying the label target and data to be passed to discardButton handler

		jQuery(field_options[type]).appendTo("div#fieldOptions"); // get options from field_options object using type varialbe

		jQuery(fcp_slug_field).appendTo("div#fieldOptions"); // to add the slug field

		jQuery("input#field-name-option").val(field_name_trim);

		jQuery("input#num-max").val(max_value);

		jQuery("button#saveButton").one("click",function(){

			 var slug_val = jQuery("input#slug_option").val().replace(/\s+/g, '_');

				if(slug_val)
				{
					jQuery("input#"+inputID).addClass(slug_val);
				}

			var field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_')+"_app_"+field_id_num;
			//field_id = field_id.replace(/\s+/g, '');
			//field_Id_NoSpaces = field_id.replace(/\s+/g, ''); // to remove spaces before checking on the id (case issue time/datepicker)

			if(field_id.split('_app')[0] != jQuery("input#"+inputID).attr("id").split('_app')[0])
			{
				while(jQuery("input[id='"+field_id+"']").length>0)
				{
					field_id_num++;
					field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_')+"_app_"+field_id_num;
					//field_Id_NoSpaces = field_Id_NoSpaces.replace(/\s+/g, ''); // removing the spaces from the id
					//field_Id_NoSpaces = field_Id_NoSpaces.replace(/\s+/g, ''); // removing the spaces from the id
					// removed the spaces after reading the spaces again since each time reading the valu means we get spaces all over again
				}
				jQuery("input#"+inputID).attr("id",field_id);
				inputID = field_id;
				// The following query was limited to last element just in case he added two elements at the same time
				jQuery("input#"+field_id+":last").parent(".input-container").prev("label").attr("for",field_id);

			}

			if ( type == "date" ){ // to remove datepicker and re-add it to make it work again after changing the id
				jQuery("#"+field_id).datepicker("destroy").removeClass(".hasDatepicker").datepicker();

			}

			else if (type == "text")
			{
			 // do specific stuff for text fields after setting their IDs
			}

			else if ( type == "number" )
			{

				var max_num_field = jQuery("input#num-max").val();
				if(jQuery("input#num-max").val().length>0)
				{
					jQuery("input#"+inputID).attr("max", max_num_field);
				}

			}
		});
	}
	else if (type == "select"){
//		jQuery(name_field_options).prependTo("div#fieldOptions");

// The next line to be activated again once the fieldOptions are set
		jQuery(field_options[type]).appendTo("div#fieldOptions"); // display the options of the select menu
		options.label = [inputID,title]; // Specifying the label target and data to be passed to discardButton handler
		jQuery(fcp_slug_field).appendTo("div#fieldOptions"); // to add the slug field
		list_item_count = 1; // return it to zero to start over again

		// Find all of the added options and list them all
		jQuery("select#" + inputID + " option").each(function(index,value){
			var opt_input = '<div class="list-item-parent parent-number'+list_item_count+'"><label for="list_item'+list_item_count+'" class="col-sm-4">Item '+list_item_count+'</label><input maxlength="50" placeholder="List Item" id="list_item'+list_item_count+'" class="col-sm-6 select-opt-input" type="text"><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			jQuery("div#select_list_options").append(opt_input);
			jQuery("input.select-opt-input:last").val(jQuery(this).text());
			jQuery(" div.parent-number"+list_item_count+" button.close").off("click").click(removeListItem);
			list_item_count++;
		});

		// attach click event to the "Add Item" button

		jQuery("button#select_menu_option_addButton").click(select_menu_option_handler);

		jQuery("input#field-name-option").val(field_name_trim);

		jQuery("button#saveButton").one("click",function(){

			var slug_val = jQuery("input#slug_option").val().replace(/\s+/g, '_');

				if(slug_val)
				{
					jQuery("select#"+inputID).addClass(slug_val);
				}

			var field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_')+"_app_"+field_id_num;
			//field_Id_NoSpaces = field_id.replace(/\s+/g, ''); // to remove spaces before checking on the id (case issue time/datepicker)


			if(field_id.split('_app')[0] != jQuery("select#"+inputID).attr("id").split('_app')[0])
			{
				while(jQuery("select[id='"+field_id+"']").length>0)
				{
					field_id_num++;
					field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_')+"_app_"+field_id_num;
					//field_Id_NoSpaces = field_id.replace(/\s+/g, ''); // removing the spaces from the id
					// removed the spaces after reading the spaces again since each time reading the valu means we get spaces all over again
				}

				jQuery("select#"+inputID).attr("id",field_id);
				inputID = field_id;
				jQuery("select#"+inputID).parent(".input-container").prev("label").attr("for",inputID);

			}

			// Save the list items to the list

			// first, remove all existing options
			jQuery("select#"+inputID).children("option").remove();

			jQuery("input.select-opt-input").each(function(index,value){
				var item_value = jQuery("input.select-opt-input")[index];
				//var existing_list_item = jQuery(jQuery("select#" + inputID + " option")[index]);
				var list_opt;
			//	var existing_list_item_text;

				item_value = jQuery(item_value).val();
				list_opt = '<option value="'+item_value+'">'+item_value+'</option>';

				jQuery("select#" + inputID).append(list_opt);
			});

		});
	}

	else if (type == "radio"){

		// jQuery(radio_add_button).appendTo("div#fieldOptions");
		// jQuery(".radio_add").click(function() {
		// 	jQuery("div.radio:last").after(radio_add_options);
		// });
	jQuery(radio_add_button).appendTo("div#fieldOptions");

		jQuery(fcp_slug_field).appendTo("div#fieldOptions"); // to add the slug field

		jQuery("input#field-name-option").val(field_name_trim);

		jQuery(".radio_add").click(function() {
			jQuery("div#custom-slug").before(radio_add_options);
			fcp_deleteField();
		});

		var radio_n = 0;
		var radio_form_prev = jQuery("div#"+inputID+" div.form-group div.radio").get(radio_n);
		var radio_label_prev = jQuery(jQuery("div#"+inputID+" div.form-group div.radio").get(radio_n)).text();
		while(radio_form_prev)
		{
			if(jQuery(jQuery("div#"+inputID+" div.form-group div.radio label input").get(radio_n)).attr("checked") == "checked")
			{
				jQuery('<div class = "radio col-sm-12 input-container" id="radiobut_add"><input type="text" class="col-sm-8 field-option-add" name="radio"><div class = "radio col-sm-3 input-container" style="padding-top:0"><label><input name="radio_default" type="radio" class="col-sm-2" checked>Default</label></div><button type="button" class="field_options close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore("div#custom-slug");				
			}
			//console.log(radio_label_prev);
			else
			{
				jQuery('<div class = "radio col-sm-12 input-container" id="radiobut_add"><input type="text" class="col-sm-8 field-option-add" name="radio"><div class = "radio col-sm-3 input-container" style="padding-top:0"><label><input name="radio_default" type="radio" class="col-sm-2">Default</label></div><button type="button" class="field_options close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore("div#custom-slug");				
			}

			jQuery(jQuery("div#fieldOptions div.input-container input.field-option-add").get(radio_n)).val(radio_label_prev);

			radio_n++;
			radio_form_prev = jQuery("div#"+inputID+" div.form-group div.radio").get(radio_n);
			radio_label_prev = jQuery(jQuery("div#"+inputID+" div.form-group div.radio").get(radio_n)).text();
		}
		fcp_deleteField();

		jQuery("button#saveButton").one("click", function(){

			jQuery("div#"+inputID+" div.form-group div.radio").remove();

			var field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_')+"_app_"+field_id_num;



			var radio_i = 0;
			var radio_add_loop = jQuery("div#fieldOptions div.input-container input.field-option-add").get(radio_i);
			while(radio_add_loop)
			{	
				if(jQuery(jQuery("div#fieldOptions div.input-container div.radio label input").get(radio_i)).attr("checked") == "checked")
				{
					jQuery('<div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input type="radio" class="col-sm-4" name="'+inputID+'_radio" checked>'+jQuery(jQuery("input.field-option-add").get(radio_i)).val()+'</label></div>').appendTo("div#"+inputID+" div.form-group");
				}

				else
				{
					jQuery('<div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input type="radio" class="col-sm-4" name="'+inputID+'_radio">'+jQuery(jQuery("input.field-option-add").get(radio_i)).val()+'</label></div>').appendTo("div#"+inputID+" div.form-group");

				}

				radio_i++;
				radio_add_loop = jQuery("div#fieldOptions div.input-container input.field-option-add").get(radio_i);
			}


			var slug_val = jQuery("input#slug_option").val().replace(/\s+/g, '_');

				if(slug_val)
				{
					jQuery("div#"+inputID).addClass(slug_val);
				}


			if(field_id.split('_app')[0] != jQuery("div#"+inputID).attr("id").split('_app')[0])
			{
				while(jQuery("div[id='"+field_id+"']").length>0)
				{
					field_id_num++;
					field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_')+"_app_"+field_id_num;
				}

				jQuery("div#"+inputID).attr("id",field_id);

				jQuery("div#"+field_id).attr("id",field_id).parent(".input-container").prev("label").attr("for",field_id);

			}

		});


	}

	else if (type == "checkbox"){
	//	jQuery(name_field_options).prependTo("div#fieldOptions");

	// The next line to be activated again once the fieldOptions are set
	//jQuery(field_options[type]).appendTo("div#fieldOptions");


		jQuery(check_add_button).appendTo("div#fieldOptions");

		jQuery(fcp_slug_field).appendTo("div#fieldOptions"); // to add the slug field

		jQuery("input#field-name-option").val(field_name_trim);

		jQuery(".check_add").click(function() {
			jQuery("div#custom-slug").before(check_add_options);
			fcp_deleteField();
		});

		var check_n = 0;
		var check_form_prev = jQuery("div#"+inputID+" div.form-group div.checkbox").get(check_n);
		var check_label_prev = jQuery(jQuery("div#"+inputID+" div.form-group div.checkbox").get(check_n)).text();
		while(check_form_prev)
		{
			//console.log(check_label_prev);
			jQuery('<div class = "checkbox col-sm-10 input-container" id="checkbox_add"><input type="text" class="col-sm-8 field-option-add" name="check"><button type="button" class="field_options close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore("div#custom-slug");

			jQuery(jQuery("div#fieldOptions div.input-container input.field-option-add").get(check_n)).val(check_label_prev);

			check_n++;
			check_form_prev = jQuery("div#"+inputID+" div.form-group div.checkbox").get(check_n);
			check_label_prev = jQuery(jQuery("div#"+inputID+" div.form-group div.checkbox").get(check_n)).text();
		}
		fcp_deleteField();

		jQuery("button#saveButton").one("click", function(){

			jQuery("div#"+inputID+" div.form-group div.checkbox").remove();


			var check_i = 0;
			var check_add_loop = jQuery("div#fieldOptions div.input-container input.field-option-add").get(check_i);
			while(check_add_loop)
			{
				jQuery('<div class = "checkbox col-sm-10 input-container" style="padding-top:0"><label><input type="checkbox" class="col-sm-4" name="check">'+jQuery(jQuery("input.field-option-add").get(check_i)).val()+'</label></div>').appendTo("div#"+inputID+" div.form-group");

				check_i++;
				check_add_loop = jQuery("div#fieldOptions div.input-container input.field-option-add").get(check_i);
			}


			var slug_val = jQuery("input#slug_option").val().replace(/\s+/g, '_');

				if(slug_val)
				{
					jQuery("div#"+inputID).addClass(slug_val);
				}


			var field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_')+"_app_"+field_id_num;


			if(field_id.split('_app')[0] != jQuery("div#"+inputID).attr("id").split('_app')[0])
			{
				while(jQuery("div[id='"+field_id+"']").length>0)
				{
					field_id_num++;
					field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_')+"_app_"+field_id_num;
				}

				jQuery("div#"+inputID).attr("id",field_id);
				inputID = field_id;
				jQuery("div#"+field_id).children("label:first").attr("for",field_id);

			}

		});

	}
	else if (type == "textarea"){
		//jQuery(name_field_options).prependTo("div#fieldOptions");
		// The next line to be activated again once the fieldOptions are set
		//jQuery(field_options[type]).appendTo("div#fieldOptions");

		// TO store the height and max length for the text area
		var text_areaRow;
		var text_areaMaxLength;


		options.label = [inputID,title]; // Specifying the label target and data to be passed to discardButton handler
		jQuery(field_options[type]).appendTo("div#fieldOptions"); // add the options fields for text area
		jQuery("input#text_area_height").val(jQuery("textarea#"+inputID).attr("rows"));
		jQuery("input#text_area_max").val(jQuery("textarea#"+inputID).attr("maxlength"));

		jQuery(fcp_slug_field).appendTo("div#fieldOptions"); // to add the slug field

		jQuery("input#field-name-option").val(field_name_trim);

		jQuery("button#saveButton").one("click",function(){

			text_areaRow = jQuery("input#text_area_height").val();
			text_areaMaxLength = jQuery("input#text_area_max").val();
			var slug_val = jQuery("input#slug_option").val().replace(/\s+/g, '_');

				if(slug_val)
				{
					jQuery("textarea#"+inputID).addClass(slug_val);
				}

			var field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_')+"_app_"+field_id_num;


			if(field_id.split('_app')[0] != jQuery("textarea#"+inputID).attr("id").split('_app')[0])
			{
				while(jQuery("textarea[id='"+field_id+"']").length>0)
				{
					field_id_num++;
					field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_')+"_app_"+field_id_num;
				}

				jQuery("textarea#"+inputID).attr("id",field_id);
				inputID = field_id;
				jQuery("textarea#"+inputID).parent(".input-container").prev("label").attr("for",inputID);

			}

			// updating the row and maxlength attributes
			jQuery("textarea#"+inputID).attr("rows",text_areaRow);
			jQuery("textarea#"+inputID).attr("maxlength",text_areaMaxLength);
		});
	}

	if (type == "time") {
		// set the values in the options object so that when the discardButton is clicked it returns everything the way it was
		// for the time picker field

		var minsField = jQuery("#"+inputID+"[placeholder='mins']");
		var amPmSelect = minsField.next("select");
		var hrsField = jQuery("#"+inputID+"[placeholder='hrs']");
		options.time = { format: 12 , am_pm: amPmSelect, hours: hrsField, minutes: minsField}
		if (amPmSelect.length < 1){ // to check if the AM/PM selector is not present then check the 24 hour radio
			jQuery("div.form-group#time_format_option div.radio label input[value='24-hour']").attr("checked",true);
			options.time.format = 23;
		}
		jQuery("div.form-group#time_format_option div.radio label input[name='time-format']").on("change",{hours: hrsField, minutes: minsField},timeFormatHandler);
	}


// appending the required option at the end of the options
jQuery(required_field_options).appendTo("div#fieldOptions");



// if the field has been previously marked required, check the required checkbox when displayed
if( jQuery(field).children("label").children("span.required-field-mark").length > 0 ){
	jQuery("input#required-option").attr("checked","true");
	options.required = true; // notify the discard function that it was required
}
else {
	options.required = false;
}

// attaching the click event on the required option input
jQuery("input#required-option").click({label: field.children("label"), input: inputID},requiredFieldHandler);



// triggering the updateFieldLabel function using keyup event
	jQuery("input#field-name-option").keyup({ label: field.children("label")},updateFieldLabel);

	//the following line triggers the click event on the "discardButton"
	//it will invoke the function (discardCHanges) and passes it data in the form of three objects:
	// 1 The options which will be created in an object
	// 2 The Field parent (div.form-group) to allow traversing
	// 3 The Field Type to do special case logic

	jQuery("button#discardButton").one("click",{options, element: field},discardChanges);
	//jQuery("button#discardButton").click({field_values, element: field, fieldType: type},discardChanges);

}

/*
	fcp_formSubmit function handles the submission of the form
	used it here only for testing it should only be used on the front end.
	1- Check that all required fields are filled, if not do not submit
	2-
*/
function fcp_formSubmitHandler(event) {
	var fields =  jQuery(".fcp-required-input");
	var empty_fields = 0;
	// Check required fields
	jQuery.each(fields,function(index, field){
		if ( !jQuery(field).val() ) { // if field is empty
			empty_fields += 1;
			console.log("Empty Field Found")
		}
		if (empty_fields > 0){
			event.preventDefault();
			return empty_fields;
		}
	});

}

/*
	The following function handles altering the options of the time picker
	according to the selected time format option
*/

function timeFormatHandler(event){

		if ( jQuery(this).attr("checked") == "checked" ) { //
			if ( jQuery(this).attr("value") == "12-hour"){
				// add-AM/pm selector and limit the value of the hours input to 12
				event.data.hours.attr("max","12");
				event.data.minutes.after('<select class="form-control col-sm-2" style="width:50px; margin-left:15px"><option>AM</option><option>PM</option></select>');
			}
			else if ( jQuery(this).attr("value") == "24-hour" ) {
				// remove the AM/PM  and limit the value of the hours input to 24
				event.data.hours.attr("max","23");
				event.data.minutes.next("select").remove();
			}
		}
}

/*
	The following function handles creating options of the select menu
*/

function select_menu_option_handler(event){
	// check to see the number of items displayed matches the value of the list_item_count , if not modify its value before using it
	if ( jQuery("div.list-item-parent").length + 1 != list_item_count ){
		list_item_count = jQuery("div.list-item-parent").length + 1;
	}
	var option_input = '<div class="list-item-parent parent-number'+list_item_count+'"><label for="list_item'+list_item_count+'" class="col-sm-4">Item '+list_item_count+'</label><input maxlength="50" placeholder="List Item" id="list_item'+list_item_count+'" class="col-sm-6 select-opt-input" type="text"><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	jQuery("div#select_list_options").append(option_input);
	jQuery(" div.parent-number"+list_item_count+" button.close").click(removeListItem);
	list_item_count++;

}

function removeListItem(event){ // deletes a field when it's 'x' icon is clicked
	// update the label and classes of the following items to match their count after removal
	jQuery(this).parent("div.list-item-parent").nextAll("div.list-item-parent").each(function(index,value){
		var itemLabel = jQuery(this).children("label");
		var itemInput = jQuery(this).children("input");
		var itemNumber = itemLabel.text().replace("Item ","");
		jQuery(this).removeClass("parent-number"+itemNumber);
		itemNumber -= 1;
		jQuery(this).addClass("parent-number"+itemNumber);

		itemLabel.text("Item "+itemNumber).attr("for","list_item"+itemNumber);
		itemInput.attr("id","list_item"+itemNumber);

	});
	jQuery(this).parent().remove();

}

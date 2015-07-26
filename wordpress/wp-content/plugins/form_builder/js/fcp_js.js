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

});

function fcp_deleteField(){
	jQuery("button.close").click(function(){ // deletes a field when it's 'x' icon is clicked
		jQuery(this).parent().remove();
		jQuery("div#edit_field_content").removeClass("show").addClass("hidden");
		jQuery("div#edit_field_title").removeClass("show").addClass("hidden");
	});
	jQuery("button.radio_close").click(function(){ // deletes a field when it's 'x' icon is clicked
		jQuery(this).parent().remove();
		jQuery("div#edit_field_content").removeClass("show").addClass("hidden");
		jQuery("div#edit_field_title").removeClass("show").addClass("hidden");
	});
}

function fcp_check_deleteField(){
	jQuery("button.check_close").click(function(){ // deletes a field when it's 'x' icon is clicked
		jQuery(this).parent().prev("label.check_label").remove();
		jQuery(this).parent().remove();
		jQuery("div#edit_field_content").removeClass("show").addClass("hidden");
		jQuery("div#edit_field_title").removeClass("show").addClass("hidden");
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

	if ( jQuery("input#required-option").prop("checked") ) { // when the required checkbox is checked
		jQuery(event.data.element).append(required_mark);
	}

	else { // when it is not checked
		if ( jQuery(event.data.element).children("span.required-field-mark").length > 0 ) {
			jQuery(event.data.element).children("span.required-field-mark").remove();
		}
	}
}


/*
	The following code allows the field buttons to add the fields in the preview form
*/
//TEXT FIELD
var fcp_text_field = '<div class="form-group"><label for="Text-field'+text_field_instance+'" class="col-sm-3 control-label">Text</label><div class="col-sm-6 input-container"><input type="text" class="form-control" id="Text-field'+text_field_instance+'" placeholder="Text"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';

//NUMERIC FIELD
var fcp_numeric_field = '<div class="form-group"><label for="Number-field'+numeric_field_instance+'" class="col-sm-3 control-label">Numeric Field </label><div class="col-sm-6 input-container"><input type="number" class="form-control" id="Number-field'+numeric_field_instance+'" placeholder=""></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';

//DATE PICKER
var fcp_date_field = '<div class="form-group"><label for="Date-field'+date_picker_instance+'" class="col-sm-3 control-label">Date</label><div class="col-sm-6 input-container"><input type="text" class="form-control" id="Date-field'+date_picker_instance+'" placeholder="DD/MM/YY"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';

//TIME PICKER
var fcp_time_field = '<div class="form-group"><label for="Time-field'+time_field_instance+'" class="col-sm-3 control-label">Time</label><div class="col-sm-6 input-container"><input type="number" class="form-control col-sm-3" id="Time-field'+time_field_instance+'" placeholder="hrs" style="width: 70px"><label class="col-sm-1 control-label"> : </label><input type="number" class="form-control col-sm-3" id="Time-field'+time_field_instance+'" placeholder="mins" style="width: 70px"><select class="form-control col-sm-2" style="width:50px; margin-left:15px"><option>AM</option><option>PM</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),&quot;time&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';

//SELECT MENU
var fcp_select_field = '<div class="form-group"><label for="Select-field'+select_field_instance+'" class="col-sm-3 control-label">Select Menu</label><div class="col-sm-6 input-container"><select class="form-control" id="Select-field'+select_field_instance+'"><option>Option 1</option><option>Option 2</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),&quot;select&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;select&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';

//CHECKBOX
var fcp_checkbox_field = '<div class="check_field"><label class="check_label col-sm-10">Chackbox options</label><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text(),&quot;checkbox&quot;,jQuery(this).parent())" class="col-sm-1" style="margin-left: 10px;">Edit</a><button type="button" class="close check_close" arial-label=“Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button><div class="form-group"><div class = "checkbox col-sm-10 input-container" style="padding-top:0"><label><input type="checkbox" class="col-sm-4” name=“check"">Checkbox</label></div></div></div>';

//RADIO BUTTON
var fcp_radiobutton_field = '<div class="radio_field"><label class="radio_label col-sm-10">Radio Button</label><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text(),&quot;radio&quot;,jQuery(this).parent())" class="col-sm-1" style="margin-left: 10px;">Edit</a><button type="button" class="close radio_close" arial-label="Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button><div class="form-group"><div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input name="radio" type="radio" class="col-sm-4">Radio</label></div></div></div>';

//EMAIL
var fcp_email_field = '<div class="form-group"><label for="Email-field'+email_field_instance+'" class="col-sm-3 control-label">Email</label><div class="col-sm-6 input-container"><input type="email" class="form-control" id="Email-field'+email_field_instance+'" placeholder="Email"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';

//PASSWORD
var fcp_password_field = '<div class="form-group"><label for="Password-field'+password_field_instance+'" class="col-sm-3 control-label">Password</label><div class="col-sm-6 input-container"><input type="password" class="form-control" id="Password-field'+password_field_instance+'" placeholder="Password"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';

//TEXT AREA
var fcp_textArea_field = '<div class="form-group"><label for="Textarea-field'+textarea_field_instance+'" class="col-sm-3 control-label">Text Area</label><div class="col-sm-6 input-container"><textarea rows="4" cols="50" class="form-control" style="resize: none" id="Textarea-field'+textarea_field_instance+'"></textarea></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),&quot;text-area&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;textarea&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';

//file upload
var fcp_fileSelect_field = '<div class="form-group"><label for="File-field'+file_field_instance+'" class="col-sm-3 control-label">Attachment</label><div class="col-sm-6 input-container"><input type="file" id="File-field'+file_field_instance+'"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';

/******************End of Fields buttons******************/

/*
	The following variables hold the editable fields of each input type
	In the form of an object containing options for each field and field name as a key
*/

//Slug Field
var fcp_slug_field = '<div class="form-group"><label class="col-sm-6 control-label" for="slug_option">Custom Class: </label><input id="slug_option" type="text" maxlength="25" placeholder="Custom Class" class="col-sm-5"></div>';
//FIELD NAME ( FOR ALL FIELDS)
var name_field_options = '<div class="form-group"><label class="col-sm-5 control-label" for="field-name-option">Field Name: </label><input id="field-name-option" type="text" maxlength="25" placeholder="Field Name" class="col-sm-6"></div>';

//REQUIRED FIELD
var required_field_options = '<div class="form-group"><div class= "checkbox col-sm-10"><label><input type="checkbox" class="col-sm-4" name="required-option" id="required-option"><span id="required-option">Required Field</span></label></div></div>';

var field_options = {}; // The object which will hold all of the options for different inputs
//TEXT FIELD
var text_field_options = '<label>Field Name: </label><input id="field-name-option" type="text" maxlength="25" placeholder="Field Name">';
field_options.text = '';//'<div class="form-group"><label class="col-sm-5 control-label" for="field-name-option">Field Name: </label><input id="field-name-option" type="text" maxlength="25" placeholder="Field Name" class="col-sm-6"></div>';

//NUMBER FIELD
var number_field_options = '<label>Field Name: </label><input id="field-name-option" type="text" maxlength="25" placeholder="Field Name">';
field_options.number = '<div class="form-group"><label class="col-sm-3" control-label>Max</label><input type="number" id="num-max" class="col-sm-3"></div>';

//RADIO OPTION
var radio_add_options = '<div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input name="radio" type="radio" class="col-sm-4">Radio</label></div>';

var radio_add_button = '<button type="button" name="radio" class="radio_add">Add option</button>';
field_options.radio = '<button type="button" name="radio" class="radio_add">Add option</button>';

//CHECKBOX OPTIONS
var check_add_options = '<div class = "checkbox col-sm-10 input-container" style="padding-top:0"><label><input type="checkbox" class="col-sm-4" name="check">Checkbox</label></div>';

var check_add_button = '<button type="button" name="check" class="check_add">Add option</button>';
field_options.checkbox = '<button type="button" name="check" class="check_add">Add option</button>';

//NUMERIC OPTIONS
var range_activ_field_options = '<div class="form-group"><div class = "checkbox col-sm-10 num-range" style="padding-top:0"><label><input type="checkbox" class="col-sm-4" name="range" id="range_active">Character Length</label></div></div>';


var max_range_field_options = '<div class="form-group"><label class="col-sm-3" control-label>Max</label><input type="number" id="num-max" class="col-sm-3"></div>';

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
		fcp_text_field = '<div class="form-group"><label for="Text-field'+text_field_instance+'" class="col-sm-3 control-label">Text</label><div class="col-sm-6 input-container"><input type="text" class="form-control" id="Text-field'+text_field_instance+'" placeholder="Text"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';
	}

	else if(jQuery(this).text()== 'Numeric'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_numeric_field);
		inputType = "number";
		numeric_field_instance +=1;
		fcp_numeric_field = '<div class="form-group"><label for="Number-field'+numeric_field_instance+'" class="col-sm-3 control-label">Numeric Field </label><div class="col-sm-6 input-container"><input type="number" class="form-control" id="Number-field'+numeric_field_instance+'" placeholder=""></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';
	}

	else if(jQuery(this).text()== 'Date Picker'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_date_field);
		jQuery("#Date-field"+date_picker_instance).datepicker();
		inputType = "date";
		date_picker_instance += 1;
		fcp_date_field = '<div class="form-group"><label for="Date-field'+date_picker_instance+'" class="col-sm-3 control-label">Date</label><div class="col-sm-6 input-container"><input type="text" class="form-control" id="Date-field'+date_picker_instance+'" placeholder="DD/MM/YY"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';

	}

	else if(jQuery(this).text()== 'Time Picker'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_time_field);
		inputType = "time";
		time_field_instance += 1;
		fcp_time_field = '<div class="form-group"><label for="Time-field'+time_field_instance+'" class="col-sm-3 control-label">Time</label><div class="col-sm-6 input-container"><input type="number" class="form-control col-sm-3" id="Time-field'+time_field_instance+'" placeholder="hrs" style="width: 70px"><label class="col-sm-1 control-label"> : </label><input type="number" class="form-control col-sm-3" id="Time-field'+time_field_instance+'" placeholder="mins" style="width: 70px"><select class="form-control col-sm-2" style="width:50px; margin-left:15px"><option>AM</option><option>PM</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),&quot;time&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';
	}

	else if(jQuery(this).text()== 'Select Menu'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_select_field);
		inputType = "select";
		select_field_instace +=1;
		fcp_select_field = '<div class="form-group"><label for="Select-field'+select_field_instace+'" class="col-sm-3 control-label">Select Menu</label><div class="col-sm-6 input-container"><select class="form-control" id="Select-field'+select_field_instace+'"><option>Option 1</option><option>Option 2</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),&quot;select&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;select&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';
	}

	else if(jQuery(this).text()== 'Checkbox'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_checkbox_field);
		inputType = "checkbox";

	}

	else if(jQuery(this).text()== 'Radio Button'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_radiobutton_field);
		inputType = "radio";
	}

	else if(jQuery(this).text()== 'Email'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_email_field);
		inputType = "email";
		email_field_instance +=1;
		fcp_email_field = '<div class="form-group"><label for="Email-field'+email_field_instance+'" class="col-sm-3 control-label">Email</label><div class="col-sm-6 input-container"><input type="email" class="form-control" id="Email-field'+email_field_instance+'" placeholder="Email"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';
	}

	else if(jQuery(this).text()== 'Password'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_password_field);
		inputType = "password";
		password_field_instance +=1;
		fcp_password_field = '<div class="form-group"><label for="Password-field'+password_field_instance+'" class="col-sm-3 control-label">Password</label><div class="col-sm-6 input-container"><input type="password" class="form-control" id="Password-field'+password_field_instance+'" placeholder="Password"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';
	}

	else if(jQuery(this).text()== 'Text Area'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_textArea_field);
		inputType = "text-area";
		textarea_field_instance +=1;
		fcp_textArea_field = '<div class="form-group"><label for="Textarea-field'+textarea_field_instance+'" class="col-sm-3 control-label">Text Area</label><div class="col-sm-6 input-container"><textarea rows="4" cols="50" class="form-control" style="resize: none" id="Textarea-field'+textarea_field_instance+'"></textarea></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),&quot;text-area&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;textarea&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';
	}
	else if(jQuery(this).text()== 'File'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_fileSelect_field);
		inputType = "file";
		file_field_instace +=1;
		fcp_fileSelect_field = '<div class="form-group"><label for="File-field'+file_field_instace+'" class="col-sm-3 control-label">Attachment</label><div class="col-sm-6 input-container"><input type="file" id="File-field'+file_field_instace+'"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;))" class="col-sm-1">Edit</a></div>';
	}

	if ( jQuery(this).text() == 'Radio Button' ){ // special case for radio button
		addedField = jQuery("div.radio_field:last");
	}

	else if( jQuery(this).text() == 'Checkbox' ){ // special case for checkbox
		addedField = jQuery("div.check_field:last");
	}

	else { // for every other type
		addedField = jQuery("form#fcp_application_preview div.form-group:last").prev();
	}

	if(jQuery(this).text()== 'Select Menu')
	{
		fieldID = jQuery(addedField).children(".input-container").children("select").attr("id");
	}

	else if(jQuery(this).text()== 'Text Area')
	{
		fieldID = jQuery(addedField).children(".input-container").children("textarea").attr("id");
	}

	else
	{
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
jQuery.each(options_object,function(key,value){

	target = jQuery("label[for='" + value[0] + "']");
	target_data = value[1];

	if ( key == "label" ) {
		target.text(target_data);
	}
	else if ( key == "required" ) {

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
}


/************** END of DISCARD Button **************/


// The following handles the save button

jQuery("button#saveButton").on("click",saveButtonHandler);

function saveButtonHandler (){

	jQuery("div#edit_field_title").toggleClass("show").addClass("hidden");
	jQuery("div#edit_field_content").toggleClass("show").addClass("hidden");
	alert("Saved !!>");
	jQuery("button#discardButton").off("click");
	jQuery("input#range_active").off("click");
	//fcp_numeric_range_activator();
	jQuery("input#required-option").off("click");
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
 var testing;
function editFieldOptions(title,type,field,inputID){

// The next two lines were added in case the user clicked twice on the addition of a field or edit
// to unhook the previously attached click events
	jQuery("button#saveButton").off("click");
	jQuery("button#saveButton").on("click",saveButtonHandler);

	jQuery("div#edit_field_content").removeClass("hidden").addClass("show");
	jQuery("div#edit_field_title").removeClass("hidden").addClass("show").html('<h4> Edit '+title+' Field</h4>');
	jQuery("div#fieldOptions").empty(); // to remove other fields options before displaying other fields options
	var field_values = {label: title.replace('*','')}; // used the replace function to remove the required mark if it exists
	var field_id_num = 1;
	var slug_val = jQuery("input#slug_option").val();
	//console.log(field_values);
	//before_edit_label = title;
	var field_name_trim = jQuery.trim(jQuery("div#edit_field_title").text().split('Edit')[1].split('Field')[0]);
	// next add the options to the div according to their type

	jQuery(name_field_options).prependTo("div#fieldOptions");


	if (type == "text" || type == "number" || type === "date" || type == "password" || type == "email" || type == "file" || type == "time")
	{ 
		options.label = [inputID,title]; // Specifying the label target and data to be passed to discardButton handler

		jQuery(field_options[type]).appendTo("div#fieldOptions"); // get options from field_options object using type varialbe
		
		jQuery(fcp_slug_field).appendTo("div#fieldOptions"); // to add the slug field

		jQuery("input#field-name-option").val(field_name_trim);

		jQuery("button#saveButton").one("click",function(){

			var field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '')+"_app_"+field_id_num;
			//field_id = field_id.replace(/\s+/g, '');
			//field_Id_NoSpaces = field_id.replace(/\s+/g, ''); // to remove spaces before checking on the id (case issue time/datepicker)
			while(jQuery("input[id='"+field_id+"']").length>0)
			{
				field_id_num++;
				field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '')+"_app_"+field_id_num;
				//field_Id_NoSpaces = field_Id_NoSpaces.replace(/\s+/g, ''); // removing the spaces from the id
				//field_Id_NoSpaces = field_Id_NoSpaces.replace(/\s+/g, ''); // removing the spaces from the id
				// removed the spaces after reading the spaces again since each time reading the valu means we get spaces all over again
			}
			jQuery("input#"+inputID).attr("id",field_id.replace(/\s+/g, ''));
			inputID = field_id.replace(/\s+/g, '');
			// The following query was limited to last element just in case he added two elements at the same time
			jQuery("input#"+inputID+":last").parent(".input-container").prev("label").attr("for",inputID);

			if ( type == "date" ){ // to remove datepicker and re-add it to make it work again after changing the id
				jQuery("#"+inputID).datepicker("destroy").removeClass(".hasDatepicker").datepicker();

			}
			
			else if (type == "text")
			{
			 // do specific stuff for text fields after setting their IDs
			}
			
			else if ( type == "number" ) 
			{
				
				var slug_val = jQuery("input#slug_option").val();

				if(slug_val)
				{	
					jQuery("input#"+inputID).addClass(slug_val);
				}
			}

		});
	}
	else if (type == "select"){
//		jQuery(name_field_options).prependTo("div#fieldOptions");

// The next line to be activated again once the fieldOptions are set
		//jQuery(field_options[type]).appendTo("div#fieldOptions");
		jQuery("input#field-name-option").val(field_name_trim);

		jQuery("button#saveButton").one("click",function(){

			var field_id = jQuery("input#field-name-option").val()+"_app_"+field_id_num;
			field_Id_NoSpaces = field_id.replace(/\s+/g, ''); // to remove spaces before checking on the id (case issue time/datepicker)

			while(jQuery("select[id='"+field_Id_NoSpaces+"']").length>0)
			{
				field_id_num++;
				field_Id_NoSpaces = jQuery("input#field-name-option").val()+"_app_"+field_id_num;
				field_Id_NoSpaces = field_Id_NoSpaces.replace(/\s+/g, ''); // removing the spaces from the id
				// removed the spaces after reading the spaces again since each time reading the valu means we get spaces all over again
			}

			jQuery("select#"+inputID).attr("id",field_Id_NoSpaces).parent(".input-container").prev("label").attr("for",field_Id_NoSpaces);



		});
	}

	else if (type == "radio"){
	//	jQuery(name_field_options).prependTo("div#fieldOptions");

	// The next line to be activated again once the fieldOptions are set
	//jQuery(field_options[type]).appendTo("div#fieldOptions");
		jQuery(radio_add_button).appendTo("div#fieldOptions");
		jQuery(".radio_add").click(function() {
			jQuery("div.radio:last").after(radio_add_options);
		});

	}

	else if (type == "checkbox"){
	//	jQuery(name_field_options).prependTo("div#fieldOptions");

	// The next line to be activated again once the fieldOptions are set
	//jQuery(field_options[type]).appendTo("div#fieldOptions");
		jQuery(check_add_button).appendTo("div#fieldOptions");
		jQuery(".check_add").click(function() {
			jQuery("div.checkbox:last").after(check_add_options);
		});

	}
	else if (type == "text-area"){
		//jQuery(name_field_options).prependTo("div#fieldOptions");
		// The next line to be activated again once the fieldOptions are set
		//jQuery(field_options[type]).appendTo("div#fieldOptions");
		jQuery("input#field-name-option").val(field_name_trim);

		jQuery("button#saveButton").one("click",function(){

			var field_id = jQuery("input#field-name-option").val()+"_app_"+field_id_num;
			field_Id_NoSpaces = field_id.replace(/\s+/g, ''); // to remove spaces before checking on the id (case issue time/datepicker)

			while(jQuery("textarea[id='"+field_Id_NoSpaces+"']").length>0)
			{
				field_id_num++;
				field_Id_NoSpaces = jQuery("input#field-name-option").val()+"_app_"+field_id_num;
				field_Id_NoSpaces = field_Id_NoSpaces.replace(/\s+/g, ''); // removing the spaces from the id
				// removed the spaces after reading the spaces again since each time reading the valu means we get spaces all over again
			}

			jQuery("textarea#"+inputID).attr("id",field_Id_NoSpaces).parent(".input-container").prev("label").attr("for",field_Id_NoSpaces);



		});
	}

	

// appending the required option at the end of the options
jQuery(required_field_options).appendTo("div#fieldOptions");



// if the field has been previously marked required, check the required checkbox when displayed
if( jQuery(field).children("label").children("span.required-field-mark").length > 0 ){
	jQuery("input#required-option").attr("checked","true");
	field_values.required = required_mark; // add the required mark to object that to be passed to the discard function
}

// attaching the click event on the required option input
jQuery("input#required-option").click({element: field.children("label")},requiredFieldHandler);



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

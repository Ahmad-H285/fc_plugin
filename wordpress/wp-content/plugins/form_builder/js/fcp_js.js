/*********************** Global Variables ***********************/
// counter to be used for datepicker multiple instances
var date_picker_instance = 0;

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

function fcp_numeric_range_activator(event){
	
		var max_length_field = jQuery("input#num-max").val();
		event.data.attr("max", max_length_field);
	
}

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
var fcp_text_field = '<div class="form-group"><label for="app_first_name" class="col-sm-3 control-label">Text</label><div class="col-sm-6 input-container"><input type="text" class="form-control" id="app_first_name" placeholder="Text"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent())" class="col-sm-1">Edit</a></div>';

//NUMERIC FIELD
var fcp_numeric_field = '<div class="form-group"><label for="app_num_field" class="col-sm-3 control-label">Numeric Field </label><div class="col-sm-6 input-container"><input type="number" class="form-control" id="app_num_field" placeholder=""></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent())" class="col-sm-1">Edit</a></div>';

//DATE PICKER
var fcp_date_field = '<div class="form-group"><label for="app_date_'+date_picker_instance+'" class="col-sm-3 control-label">Date</label><div class="col-sm-6 input-container"><input type="text" class="form-control" id="app_date_'+date_picker_instance+'" placeholder="DD/MM/YY"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent())" class="col-sm-1">Edit</a></div>';

//TIME PICKER
var fcp_time_field = '<div class="form-group"><label for="app_first_name" class="col-sm-3 control-label">Time</label><div class="col-sm-6 input-container"><input type="number" class="form-control col-sm-3" id="app_first_name" placeholder="hrs" style="width: 70px"><label class="col-sm-1 control-label"> : </label><input type="number" class="form-control col-sm-3" id="app_first_name" placeholder="mins" style="width: 70px"><select class="form-control col-sm-2" style="width:50px; margin-left:15px"><option>AM</option><option>PM</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),&quot;time&quot;,jQuery(this).parent())" class="col-sm-1">Edit</a></div>';

//SELECT MENU
var fcp_select_field = '<div class="form-group"><label for="app_first_name" class="col-sm-3 control-label">Select Menu</label><div class="col-sm-6 input-container"><select class="form-control"><option>Option 1</option><option>Option 2</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),&quot;select&quot;,jQuery(this).parent())" class="col-sm-1">Edit</a></div>';

//CHECKBOX
var fcp_checkbox_field = '<div class="check_field"><label class="check_label col-sm-10">Chackbox options</label><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text(),&quot;checkbox&quot;,jQuery(this).parent())" class="col-sm-1" style="margin-left: 10px;">Edit</a><button type="button" class="close check_close" arial-label=“Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button><div class="form-group"><div class = "checkbox col-sm-10 input-container" style="padding-top:0"><label><input type="checkbox" class="col-sm-4” name=“check"">Checkbox</label></div></div></div>';

//RADIO BUTTON
var fcp_radiobutton_field = '<div class="radio_field"><label class="radio_label col-sm-10">Radio Button</label><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text(),&quot;radio&quot;,jQuery(this).parent())" class="col-sm-1" style="margin-left: 10px;">Edit</a><button type="button" class="close radio_close" arial-label="Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button><div class="form-group"><div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input name="radio" type="radio" class="col-sm-4">Radio</label></div></div></div>';

//EMAIL
var fcp_email_field = '<div class="form-group"><label for="app_first_name" class="col-sm-3 control-label">Email</label><div class="col-sm-6 input-container"><input type="email" class="form-control" id="app_first_name" placeholder="Email"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent())" class="col-sm-1">Edit</a></div>';

//PASSWORD
var fcp_password_field = '<div class="form-group"><label for="app_first_name" class="col-sm-3 control-label">Password</label><div class="col-sm-6 input-container"><input type="password" class="form-control" id="app_first_name" placeholder="Password"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent())" class="col-sm-1">Edit</a></div>';

//TEXT AREA
var fcp_textArea_field = '<div class="form-group"><label for="app_first_name" class="col-sm-3 control-label">Text Area</label><div class="col-sm-6 input-container"><textarea rows="4" cols="50" class="form-control" style="resize: none"></textarea></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),&quot;text-area&quot;,jQuery(this).parent())" class="col-sm-1">Edit</a></div>'

//file upload
var fcp_fileSelect_field = '<div class="form-group"><label for="app_attachment" class="col-sm-3 control-label">Attachment</label><div class="col-sm-6 input-container"><input type="file" id="app_attachment"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent())" class="col-sm-1">Edit</a></div>';

/******************End of Fields buttons******************/

/*
	The following variables hold the editable fields of each input type
*/

//FIELD NAME ( FOR ALL FIELDS)
var name_field_options = '<div class="form-group"><label class="col-sm-5 control-label" for="field-name-option">Field Name: </label><input id="field-name-option" type="text" maxlength="25" placeholder="Field Name" class="col-sm-6"></div>';

//REQUIRED FIELD
var required_field_options = '<div class="form-group"><div class= "checkbox col-sm-10"><label><input type="checkbox" class="col-sm-4" name="required-option" id="required-option"><span id="required-option">Required Field</span></label></div></div>';

//TEXT FIELD
var text_field_options = '<label>Field Name: </label><input id="field-name-option" type="text" maxlength="25" placeholder="Field Name">';

//NUMBER FIELD
var number_field_options = '<label>Field Name: </label><input id="field-name-option" type="text" maxlength="25" placeholder="Field Name">';

//RADIO OPTION
var radio_add_options = '<div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input name="radio" type="radio" class="col-sm-4">Radio</label></div>';

var radio_add_button = '<button type="button" name="radio" class="radio_add">Add option</button>';

//CHECKBOX OPTIONS
var check_add_options = '<div class = "checkbox col-sm-10 input-container" style="padding-top:0"><label><input type="checkbox" class="col-sm-4" name="check">Checkbox</label></div>';

var check_add_button = '<button type="button" name="check" class="check_add">Add option</button>';

//NUMERIC OPTIONS
var range_activ_field_options = '<div class="form-group"><div class = "checkbox col-sm-10 num-range" style="padding-top:0"><label><input type="checkbox" class="col-sm-4" name="range" id="range_active">Character Length</label></div></div>'

var max_range_field_options = '<div class="form-group"><label class="col-sm-3" control-label>Max</label><input type="number" id="num-max" class="col-sm-3"></div>'
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

	if(jQuery(this).text() == 'Text'){
		
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_text_field);
		inputType = "text";
	}

	else if(jQuery(this).text()== 'Numeric'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_numeric_field);
		inputType = "number";
	}

	else if(jQuery(this).text()== 'Date Picker'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_date_field);
		jQuery("#app_date_"+date_picker_instance).datepicker();
		inputType = "date";
		date_picker_instance += 1;
		fcp_date_field = '<div class="form-group"><label for="app_date_'+date_picker_instance+'" class="col-sm-3 control-label">Date</label><div class="col-sm-7 input-container"><input type="date" class="form-control" id="app_date_'+date_picker_instance+'" placeholder="DD/MM/YY"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text(),jQuery(this).siblings(&quot;div.input-container&quot;).children(&quot;input&quot;).attr(&quot;type&quot;),jQuery(this).parent())" class="col-sm-1">Edit</a></div>';

	}

	else if(jQuery(this).text()== 'Time Picker'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_time_field);
		inputType = "time";
	}

	else if(jQuery(this).text()== 'Select Menu'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_select_field);
		inputType = "select";
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
	}

	else if(jQuery(this).text()== 'Password'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_password_field);
		inputType = "password";
	}

	else if(jQuery(this).text()== 'Text Area'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_textArea_field);
		inputType = "text-area";
	}
	else if(jQuery(this).text()== 'File'){
		jQuery("form#fcp_application_preview div.form-group:last").before(fcp_fileSelect_field);
		inputType = "file";
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

	editFieldOptions(jQuery(this).text(),inputType,addedField);
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
	jQuery(event.data.element).children("label").text(event.data.field_values.label).append(event.data.field_values.required); // returns the label as it was

/*
	return the other options as they once were
*/

	jQuery("div#edit_field_title").toggleClass("show").addClass("hidden");
	jQuery("div#edit_field_content").toggleClass("show").addClass("hidden");	
	jQuery("button#discardButton").off("click");
	jQuery("input#range_active").off("click");
	jQuery("input#required-option").off("click");
}


/************** END of DISCARD Button **************/


// The following handles the save button

jQuery("button#saveButton").click(function(){

	jQuery("div#edit_field_title").toggleClass("show").addClass("hidden");
	jQuery("div#edit_field_content").toggleClass("show").addClass("hidden");
	alert("Saved !!>");
	jQuery("button#discardButton").off("click");
	jQuery("input#range_active").off("click");
	fcp_numeric_range_activator();
	jQuery("input#required-option").off("click");
});

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
function editFieldOptions(title,type,field){ 
	jQuery("div#edit_field_content").removeClass("hidden").addClass("show");
	jQuery("div#edit_field_title").removeClass("hidden").addClass("show").html('<h4> Edit '+title+' Field</h4>');
	jQuery("div#fieldOptions").empty(); // to remove other fields options before displaying other fields options
	var field_values = {label: title.replace('*','')}; // used the replace function to remove the required mark if it exists
	//console.log(field_values);
	//before_edit_label = title;
	var field_name_trim = jQuery.trim(jQuery("div#edit_field_title").text().split('Edit')[1].split('Field')[0]);
	// next add the options to the div according to their type
	if (type == "text"){
		jQuery(name_field_options).prependTo("div#fieldOptions");
	}

	else if (type == "number"){
		jQuery(name_field_options).prependTo("div#fieldOptions");
		//jQuery(range_activ_field_options).appendTo("div#fieldOptions");
		jQuery(max_range_field_options).appendTo("div#fieldOptions");

		jQuery("input#field-name-option").val(field_name_trim);
		// jQuery("input#range_active").click(function(field){
		// 	if(jQuery("input#range_active").prop("checked"))
		// 	{
		// 		jQuery("input#num-max").removeAttr("disabled");
		// 		//fcp_numeric_range_activator();
		// 	}

		// 	else
		// 	{
		// 		jQuery("input#num-max").attr("disabled","true");
		// 	}
			
		// });

		// jQuery("input#num-max").blur(function(field){
			jQuery("button#saveButton").click(function(field){
				fcp_numeric_range_activator(jQuery("div.form-group").children(".input-container").children("input#app_num_field"));
			
			});
			
		
	}

	else if (type == "date"){
		jQuery(name_field_options).prependTo("div#fieldOptions");
	}

	else if (type == "email"){
		jQuery(name_field_options).prependTo("div#fieldOptions");
	}

	else if (type == "password"){
		jQuery(name_field_options).prependTo("div#fieldOptions");
	}

	else if (type == "file"){
		jQuery(name_field_options).prependTo("div#fieldOptions");
	}

	else if (type == "select"){
		jQuery(name_field_options).prependTo("div#fieldOptions");
	}

	else if (type == "radio"){
		jQuery(name_field_options).prependTo("div#fieldOptions");
		jQuery(radio_add_button).appendTo("div#fieldOptions");
		jQuery(".radio_add").click(function() {
			jQuery("div.radio:last").after(radio_add_options);
		});

	}

	else if (type == "checkbox"){
		jQuery(name_field_options).prependTo("div#fieldOptions");
		jQuery(check_add_button).appendTo("div#fieldOptions");
		jQuery(".check_add").click(function() {
			jQuery("div.checkbox:last").after(check_add_options);
		});

	}
	else if (type == "time"){
		jQuery(name_field_options).prependTo("div#fieldOptions");
	}

	else if (type == "text-area"){
		jQuery(name_field_options).prependTo("div#fieldOptions");
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

	jQuery("button#discardButton").click({field_values, element: field, fieldType: type},discardChanges);

}


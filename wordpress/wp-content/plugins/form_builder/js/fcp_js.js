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
var required_mark = '<span class="required-field-mark glyphicon glyphicon-asterisk" aria-hidden="true"></span>';
/*********************** Global Variables End ***********************/

jQuery(document).ready(function(){
	jQuery("button#import_sub_csv").click(function(){
		jQuery("input[name='export_csv']").val("true");
		console.log(jQuery("input[name='export_csv']").val());
	});
	
	jQuery("div#wpcontent").css("background-color","white");
	fcp_radio_deleteField();
	fcp_check_deleteField();
	fcp_deleteField();
	jQuery("div#wpfooter").css("width", "50%");
	 // to invoke the click event handler function below
	//jQuery("button.fcp_submitButton").click(fcp_formSubmitHandler); testing to make sure it works

	jQuery("button#save_fcp_form").click(saveForm);
	jQuery("button#save_fcp_form_edit").click(saveForm);
	// get the text of the submit button and display it in the submit button text field input
	var submit_button_text = jQuery("button.fcp_submitButton").text();
	jQuery("input#submit-button-text").val(submit_button_text).on("keyup",updateSubmitButtonText);

	jQuery("select#backend_users_list").addClass("form-control").append("<option>Other ...</option>"); // style the wordpress users select menu and add "Other ..." option
	jQuery("input.fcp_notification").change(toggleEmail_notificationFields);
	jQuery("div.fcp_email_not_opt").hide();

	// Hiding the custom to input field in the backend notification settings
	jQuery("div.form-group#send_to_non_wordpress_user").hide();
	// Then we display it when the user select other in the backend users list

	jQuery("#backend_users_list").on("change",function(event){

		var selected_option = jQuery(this).val();//jQuery("select#backend_users_list option:selected").val();
		if (selected_option == "Other ..."){
			jQuery("div.form-group#send_to_non_wordpress_user").slideDown(300); // show the input
		}
		else {
			if ( jQuery("div.form-group#send_to_non_wordpress_user").is(':visible') ){
				jQuery("div.form-group#send_to_non_wordpress_user").slideUp(300);
			}

		}
	});
});

/*
	The following function handles updating the value of the submit button text
*/

function updateSubmitButtonText(event){
	var desiredText = jQuery(this).val();
	var button = jQuery("button.fcp_submitButton");

	button.text(desiredText);
}
/**
 * The following function can be called to animate a scroll effect in the browser window
 * @returns {*}
 */
jQuery.fn.scrollView = function () {
    return this.each(function () {
        jQuery('html, body').animate({
            scrollTop: jQuery(this).offset().top
        }, 1000);
    });
}


/*
	The following function handles preparation for the form to be saved
*/

function saveForm(event){

 	var formName = jQuery("input#fcp-form-name").val();
	var warningDialog = '<div id="empty_form_name_warning" title="Fill in form name"><p>Please fill in a form name.<br> Try to make it unique.</p></div>';

	// emptying any value for the inputs
	jQuery("div.form-sketch input, div.form-sketch textarea").val("");
	if((jQuery("form#fcp_application_preview button[type='submit']").attr("id")) == "save_fcp_form" )
	{
		if ( !formName ) { // form name is empty
			event.preventDefault();
			jQuery(warningDialog).appendTo("body").dialog({
            modal: true,
            resizable: false,
            draggable: false,
            buttons:{
                Ok: function(){
                    jQuery(this).dialog("close");
                    jQuery("#top_of_form").scrollView();
                }
            },
            open: function(event, ui) {
                jQuery(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
            }
        });
		}
		else {
			jQuery("button.close, a.col-sm-1:contains('Edit')").remove();
			jQuery("div.form-sketch").find(".fcp_drag_icon").remove();

			var form = jQuery("div.form-sketch").html().replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;'); // get the form elements and convert the each quote
			jQuery("input[name='fcp']").attr("value",form);
		}
	}

	else if((jQuery("form#fcp_application_preview button[type='submit']").attr("id")) == "save_fcp_form_edit" )
	{
		if ( !formName ) { // form name is empty
			event.preventDefault();
			jQuery(warningDialog).appendTo("body").dialog({
            modal: true,
            resizable: false,
            draggable: false,
            buttons:{
                Ok: function(){
                    jQuery(this).dialog("close");
                    jQuery("#top_of_form").scrollView();
                }
            },
            open: function(event, ui) {
                jQuery(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
            }
        });
		}
		else
		{
			jQuery("button.close, a.col-sm-1:contains('Edit')").remove();
			jQuery("div.form-sketch").find(".fcp_drag_icon").remove();
			var form = jQuery("div.form-sketch").html().replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;'); // get the form elements and convert the each quote
			jQuery("input[name='fcp_edit']").attr("value",form);
		}
	}

}

function fcp_deleteField(){


	jQuery("button.pass_close").click(function(){
		if((jQuery(this).parent().next().text()) == "Password Confirmation")
		{
			jQuery(this).parent().next().remove();
			jQuery(this).parent().remove();
		}
	});
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

	jQuery("button.field_options.close").click(function(){ // deletes a field when it's 'x' icon is clicked
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
var fcp_text_field = '<div class="form-group fcp_text fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Text-field'+text_field_instance+'" class="col-sm-4 control-label">Text</label><div class="col-sm-5 input-container"><input type="text" class="form-control fcp-no-special" id="Text-field'+text_field_instance+'" placeholder="Text"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;text&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//NUMERIC FIELD
var fcp_numeric_field = '<div class="form-group fcp_numeric fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Number-field'+numeric_field_instance+'" class="col-sm-4 control-label">Numeric Field </label><div class="col-sm-5 input-container"><input type="number" class="form-control fcp-no-special" id="Number-field'+numeric_field_instance+'" placeholder=""></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;number&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//DATE PICKER
var fcp_date_field = '<div class="form-group fcp_date fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Date-field'+date_picker_instance+'" class="col-sm-4 control-label">Date</label><div class="col-sm-5 input-container"><input type="text" class="form-control fcp-no-special" id="Date-field'+date_picker_instance+'" placeholder="DD/MM/YY"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;date&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//TIME PICKER
var fcp_time_field = '<div class="form-group fcp_time fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Time-field'+time_field_instance+'" class="col-sm-4 control-label">Time Picker</label><div class="col-sm-6 input-container"><input type="number" class="form-control col-sm-3" min="0" id="Time-field'+time_field_instance+'" placeholder="hrs" max="12" style="width: 70px"><label class="col-sm-1 control-label"> : </label><input type="number" class="form-control col-sm-3" min="0" id="Time-field'+time_field_instance+'" placeholder="mins" max="59" style="width: 70px"><select class="form-control col-sm-2" style="width:50px; margin-left:15px"><option>AM</option><option>PM</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;time&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//SELECT MENU
var fcp_select_field = '<div class="form-group fcp_select fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Select-field'+select_field_instance+'" class="col-sm-4 control-label">Select Menu</label><div class="col-sm-5 input-container"><select class="form-control fcp-select-menu-field" id="Select-field'+select_field_instance+'"><option>Option 1</option><option>Option 2</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;select&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;select&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//CHECKBOX
var fcp_checkbox_field = '<div class="check_field fcp-drag-sort" id="check_box_'+checkbox_field_instance+'"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true" style="margin-left: -15px;"></span><label class="check_label col-sm-9" for="check_box_'+checkbox_field_instance+'">Chackbox options</label><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;checkbox&quot;,jQuery(this).parent(),jQuery(this).parent().attr(&quot;id&quot;));" class="col-sm-1" style="margin-left: 26px;">Edit</a><button type="button" class="close check_close" arial-label=“Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button><div class="form-group checkbox-radio-alignment-temp"><div class = "checkbox col-sm-10 input-container" style="padding-top:0"><label><input type="checkbox" class="fcp-check-radio" name="check">Checkbox</label></div></div></div>';

//RADIO BUTTON
var fcp_radiobutton_field = '<div class="radio_field fcp-drag-sort" id="radio_but_'+radio_field_instance+'"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true" style="margin-left: -15px;"></span><label class="radio_label col-sm-9" for="radio_but_'+radio_field_instance+'">Radio Button</label><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;radio&quot;,jQuery(this).parent(),jQuery(this).parent().attr(&quot;id&quot;));" class="col-sm-1" style="margin-left: 26px;">Edit</a><button type="button" class="close radio_close" arial-label="Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button><div class="form-group checkbox-radio-alignment-temp"><div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input name="radio" type="radio" class="fcp-check-radio">Radio</label></div></div></div>';

//EMAIL
var fcp_email_field = '<div class="form-group fcp_email fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Email-field'+email_field_instance+'" class="col-sm-4 control-label">Email</label><div class="col-sm-5 input-container"><input type="email" class="form-control fcp-no-special" id="Email-field'+email_field_instance+'" placeholder="Email"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;email&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//PASSWORD
var fcp_password_field = '<div class="form-group fcp_pass fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Password-field'+password_field_instance+'" class="col-sm-4 control-label">Password</label><div class="col-sm-5 input-container"><input type="password" name="fcp_password" class="form-control" id="Password-field'+password_field_instance+'" placeholder="Password"></div><button type="button" class="pass_close close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;password&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//TEXT AREA
var fcp_textArea_field = '<div class="form-group fcp_textarea fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Textarea-field'+textarea_field_instance+'" class="col-sm-4 control-label">Text Area</label><div class="col-sm-6 input-container"><textarea rows="4" cols="50" class="form-control" style="resize: none" id="Textarea-field'+textarea_field_instance+'"></textarea></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;textarea&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;textarea&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

//file upload
var fcp_fileSelect_field = '<div class="form-group fcp_file fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="File-field'+file_field_instance+'" class="col-sm-4 control-label">Attachment</label><div class="col-sm-5 input-container"><input type="file" id="File-field'+file_field_instance+'" name="fcp-att[]"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;file&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

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

//PASSWORD OPTIONS
field_options.password = '<div id="form-pass" class="form-group"><div class="check_field" id="pass_vis_opt"><div class = "checkbox col-sm-10 input-container" style="padding-top:0"><label><input type="checkbox" class="col-sm-4" name="pass_vis">Password Visibility</label></div></div><div class="check_field" id="pass_conf_opt"><div class = "checkbox col-sm-10 input-container" style="padding-top:0"><label><input type="checkbox" class="col-sm-4" name="pass_conf">Password Confirmation</label></div></div></div>';
var pass_vis_but = '<div class="col-sm-offset-3 col-sm-5" id="fcp_show_pass"><button type="button" class="btn btn-primary btn-sm" style="margin: 5px">Show Password</button></div>';

//NUMERIC OPTIONS
var range_activ_field_options = '<div class="form-group"><div class = "checkbox col-sm-10 num-range" style="padding-top:0"><label><input type="checkbox" class="col-sm-4" name="range" id="range_active">Character Length</label></div></div>';


var max_range_field_options = '<div class="form-group"><label class="col-sm-3" control-label>Max</label><input type="number" id="num-max" class="col-sm-3"></div>';

// TIME PICKER
field_options.time = '<div class="radio_field"><label class="radio_label col-sm-9">Time Format</label><div class="form-group" id="time_format_option"><div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input name="time-format" value="12-hour" type="radio" class="col-sm-4" checked>12 hour format</label></div><div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input name="time-format" value="24-hour" type="radio" class="col-sm-4">24 hour format</label></div></div></div>';

//TEXT AREA
field_options.textarea = '<div class="form-group"><label class="col-sm-5 control-label">Character Length</label><input type="number" min="0" id="text_area_max" class="col-sm-3"></div><div class="form-group"><label class="col-sm-5 control-label">Height</label><input type="number" min="0" id="text_area_height" class="col-sm-3"></div>';

// SELECT MENU
field_options.select = '<button type="button" id="select_menu_option_addButton" name="select-option" class="">Add Item</button><div id="select_list_options" class="col-sm-12"><p id="list_options_title">List Items: </p></div>';

//FILE OPTIONS
field_options.file = '<div class="checkbox email_send col-sm-10"><label><input class="col-sm-4" name="send-email-option" id="email-option" type="checkbox"><span id="email-option">Send attachment to admin email</span></label></div>';

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

		jQuery("div.form-sketch div.form-group:last").before(fcp_text_field);
		inputType = "text";
		text_field_instance +=1; // increment counter and then re define the variable with new counter value

		fcp_text_field = '<div class="form-group fcp_text fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Text-field'+text_field_instance+'" class="col-sm-4 control-label">Text</label><div class="col-sm-5 input-container"><input type="text" class="form-control fcp-no-special" id="Text-field'+text_field_instance+'" placeholder="Text"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;text&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

	}

	else if(jQuery(this).text()== 'Numeric'){
		jQuery("div.form-sketch  div.form-group:last").before(fcp_numeric_field);
		inputType = "number";
		numeric_field_instance +=1;

		fcp_numeric_field = '<div class="form-group fcp_numeric fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Number-field'+numeric_field_instance+'" class="col-sm-4 control-label">Numeric Field </label><div class="col-sm-5 input-container"><input type="number" class="form-control fcp-no-special" id="Number-field'+numeric_field_instance+'" placeholder=""></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;number&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

	}

	else if(jQuery(this).text()== 'Date Picker'){
		jQuery("div.form-sketch  div.form-group:last").before(fcp_date_field);
		jQuery("#Date-field"+date_picker_instance).datepicker();
		inputType = "date";
		date_picker_instance += 1;

		fcp_date_field = '<div class="form-group fcp_date fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Date-field'+date_picker_instance+'" class="col-sm-4 control-label">Date</label><div class="col-sm-5 input-container"><input type="text" class="form-control fcp-no-special" id="Date-field'+date_picker_instance+'" placeholder="DD/MM/YY"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;date&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

	}

	else if(jQuery(this).text()== 'Time Picker'){
		jQuery("div.form-sketch  div.form-group:last").before(fcp_time_field);
		inputType = "time";
		time_field_instance += 1;
		fcp_time_field = '<div class="form-group fcp_time fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Time-field'+time_field_instance+'" class="col-sm-4 control-label">Time Picker</label><div class="col-sm-6 input-container"><input type="number" class="form-control col-sm-3" min="0" id="Time-field'+time_field_instance+'" placeholder="hrs" max="12" style="width: 70px"><label class="col-sm-1 control-label"> : </label><input type="number" class="form-control col-sm-3" min="0" id="Time-field'+time_field_instance+'" placeholder="mins" max="59" style="width: 70px"><select class="form-control col-sm-2" style="width:50px; margin-left:15px"><option>AM</option><option>PM</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;time&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';
	}

	else if(jQuery(this).text()== 'Select Menu'){
		jQuery("div.form-sketch  div.form-group:last").before(fcp_select_field);
		inputType = "select";

		select_field_instance +=1;

		fcp_select_field = '<div class="form-group fcp_select fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Select-field'+select_field_instance+'" class="col-sm-4 control-label">Select Menu</label><div class="col-sm-5 input-container"><select class="form-control fcp-select-menu-field" id="Select-field'+select_field_instance+'"><option>Option 1</option><option>Option 2</option></select></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;select&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;select&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

	}

	else if(jQuery(this).text()== 'Checkbox'){
		jQuery("div.form-sketch div.form-group:last").before(fcp_checkbox_field);
		inputType = "checkbox";

		checkbox_field_instance += 1;
		fcp_checkbox_field = '<div class="check_field fcp-drag-sort" id="check_box_'+checkbox_field_instance+'"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true" style="margin-left: -15px;"></span><label class="check_label col-sm-9" for="check_box_'+checkbox_field_instance+'">Chackbox options</label><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;checkbox&quot;,jQuery(this).parent(),jQuery(this).parent().attr(&quot;id&quot;));" class="col-sm-1" style="margin-left: 26px;">Edit</a><button type="button" class="close check_close" arial-label=“Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button><div class="form-group checkbox-radio-alignment-temp"><div class = "checkbox col-sm-10 input-container" style="padding-top:0"><label><input type="checkbox" class="fcp-check-radio" name="check">Checkbox</label></div></div></div>';
	}

	else if(jQuery(this).text()== 'Radio Button'){
		jQuery("div.form-sketch  div.form-group:last").before(fcp_radiobutton_field);
		inputType = "radio";

		radio_field_instance += 1;
		fcp_radiobutton_field = '<div class="radio_field fcp-drag-sort" id="radio_but_'+radio_field_instance+'"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true" style="margin-left: -15px;"></span><label class="radio_label col-sm-10" for="radio_but_'+radio_field_instance+'">Radio Button</label><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).prev(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;radio&quot;,jQuery(this).parent(),jQuery(this).parent().attr(&quot;id&quot;));" class="col-sm-1" style="margin-left: 26px;">Edit</a><button type="button" class="close radio_close" arial-label="Close" style="margin-right: -14px;"><span aria-hidden="true">&times;</span></button><div class="form-group checkbox-radio-alignment-temp"><div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input name="radio" type="radio" class="fcp-check-radio">Radio</label></div></div></div>';
	}

	else if(jQuery(this).text()== 'Email'){
		jQuery("div.form-sketch  div.form-group:last").before(fcp_email_field);
		inputType = "email";
		email_field_instance +=1;

		fcp_email_field = '<div class="form-group fcp_email fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Email-field'+email_field_instance+'" class="col-sm-4 control-label">Email</label><div class="col-sm-5 input-container"><input type="email" class="form-control fcp-no-special" id="Email-field'+email_field_instance+'" placeholder="Email"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;email&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

	}

	else if(jQuery(this).text()== 'Password'){
		jQuery("div.form-sketch  div.form-group:last").before(fcp_password_field);
		inputType = "password";
		password_field_instance +=1;

		fcp_password_field = '<div class="form-group fcp_pass fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Password-field'+password_field_instance+'" class="col-sm-4 control-label">Password</label><div class="col-sm-5 input-container"><input type="password" name="fcp_password" class="form-control fcp-no-special" id="Password-field'+password_field_instance+'" placeholder="Password"></div><button type="button" class="close pass_close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;password&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';
	}

	else if(jQuery(this).text()== 'Text Area'){
		jQuery("div.form-sketch  div.form-group:last").before(fcp_textArea_field);
		inputType = "textarea";
		textarea_field_instance +=1;
		fcp_textArea_field = '<div class="form-group fcp_textarea fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="Textarea-field'+textarea_field_instance+'" class="col-sm-4 control-label">Text Area</label><div class="col-sm-6 input-container"><textarea rows="4" cols="50" class="form-control" style="resize: none" id="Textarea-field'+textarea_field_instance+'"></textarea></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;textarea&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;textarea&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';
	}
	else if(jQuery(this).text()== 'File'){
		jQuery("div.form-sketch  div.form-group:last").before(fcp_fileSelect_field);
		inputType = "file";

		file_field_instance +=1;
		fcp_fileSelect_field = '<div class="form-group fcp_file fcp-drag-sort"><span class="col-sm-1 glyphicon glyphicon-sort fcp_drag_icon" aria-hidden="true"></span><label for="File-field'+file_field_instance+'" class="col-sm-4 control-label">Attachment</label><div class="col-sm-5 input-container"><input type="file" id="File-field'+file_field_instance+'" name="fcp-att[]"></div><button type="button" class="close" arial-label="Close"><span aria-hidden="true">&times;</span></button><a href="javascript:void(0);" onclick="editFieldOptions(jQuery(this).siblings(&quot;label&quot;).text().replace(&quot;*&quot;,&quot;&quot;),&quot;file&quot;,jQuery(this).parent(),jQuery(this).siblings(&quot;.input-container&quot;).children(&quot;input&quot;).attr(&quot;id&quot;));" class="col-sm-1">Edit</a></div>';

	}

	if ( jQuery(this).text() == 'Radio Button' ){ // special case for radio button
		addedField = jQuery("div.form-sketch div.radio_field:last");

		fieldID = addedField.attr("id");
	}

	else if( jQuery(this).text() == 'Checkbox' ){ // special case for checkbox
		addedField = jQuery("div.form-sketch div.check_field:last");

		fieldID = addedField.attr("id");
	}

	

	else if(jQuery(this).text()== 'Select Menu')
	{
		addedField = jQuery("div.form-sketch  div.form-group:last").prev();
		fieldID = jQuery(addedField).children(".input-container").children("select").attr("id");
	}

	else if(jQuery(this).text()== 'Text Area')
	{
		addedField = jQuery("div.form-sketch  div.form-group:last").prev();
		fieldID = jQuery(addedField).children(".input-container").children("textarea").attr("id");
	}

	else
	{
		addedField = jQuery("div.form-sketch  div.form-group:last").prev();
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
    var saveDialog = jQuery('<div id="field_saved_dialog" title="Field Saved"><p>Field saved successfully</p></div>');
	jQuery("div#edit_field_title").toggleClass("show").addClass("hidden");
	jQuery("div#edit_field_content").toggleClass("show").addClass("hidden");
	//alert("Saved !!");

    saveDialog.appendTo("body").dialog({
        modal: true,
        resizable: false,
        draggable: false,
        width: 300,
        hide: {
            effect: "clip",
            duration: 250
        },
        show: {
            effect: "blind",
            duration: 500
        },
        open: function(event, ui) {
            jQuery(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
            setTimeout("jQuery('#field_saved_dialog').dialog('close')",2000);
        },
        close: function(){
            jQuery("#field_saved_dialog").dialog("destroy").remove();


        }

    });

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

			 var slug_val = jQuery("input#slug_option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '');

				if(slug_val)
				{
					jQuery("input#"+inputID).addClass(slug_val);
				}

			var field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '')+"_app_"+field_id_num;
			//field_id = field_id.replace(/\s+/g, '');
			//field_Id_NoSpaces = field_id.replace(/\s+/g, ''); // to remove spaces before checking on the id (case issue time/datepicker)

			if(field_id.split('_app')[0] != jQuery("input#"+inputID).attr("id").split('_app')[0])
			{
				while(jQuery("input[id='"+field_id+"']").length>0)
				{
					field_id_num++;
					field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '')+"_app_"+field_id_num;
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

			else if ( type == "text" )
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

			else if ( type == "password" )
			{


				if((jQuery("div#fieldOptions div#pass_vis_opt div.checkbox label input").attr("checked")) == "checked")
				{
					if(!(jQuery("input#"+inputID).parent().parent().children("div#fcp_show_pass").length > 0))
					{
						jQuery("input#"+inputID).parents("div.form-group").append(pass_vis_but);
					}
				}

				else
				{
					if(jQuery("input#"+inputID).parent().parent().children("div#fcp_show_pass").length > 0)
					{
						jQuery("input#"+inputID).parent().parent().children("div#fcp_show_pass").remove();
					}
				}
				//fcp_formSubmitHandler();
				if((jQuery("div#fieldOptions div#pass_conf_opt div.checkbox label input").attr("checked")) == "checked")
				{
					if(!(jQuery("input#"+inputID).parent().parent().next().children("div.input-container").children("input.pass_conf_input").length > 0))
					{
						jQuery("input#"+inputID).parents("div.form-group").after('<div class="form-group"><label for="Password-field" class="col-sm-4 control-label">Re-type Password</label><div class="col-sm-5 input-container"><input type="password" class="form-control pass_conf_input fcp-required-input" id="Password-field" placeholder="Password"></div>');
					}
				}

				else
				{
					if(jQuery("input#"+inputID).parent().parent().next().children("div.input-container").children("input.pass_conf_input").length > 0)
					{
						jQuery("input#"+inputID).parent().parent().next().remove();
					}
				}

				fcp_formSubmitHandler();

			}

			


		});

		if ( type == "password" )
		{
			if(jQuery("input#"+inputID).parent().parent().children("div#fcp_show_pass").length > 0)
			{
				jQuery("div#fieldOptions div#form-pass div#pass_vis_opt label input").attr("checked",true);
			}

			if(jQuery("input#"+inputID).parent().parent().next().children("div.input-container").children("input.pass_conf_input").length > 0)
			{
				jQuery("div#fieldOptions div#form-pass div#pass_conf_opt label input").attr("checked",true);
			}
		}



	}

	 
	if( type == "file" )
			{
				//jQuery(field_options[type]).appendTo("div#fieldOptions");

				if((jQuery("input#"+inputID).prop("name")) == "send-email[]")
				{
					console.log("true");
					jQuery("input#email-option").attr("checked","true");
				}

				

				jQuery("button#saveButton").click(function(){

					if((jQuery("input#email-option").attr("checked")) == "checked")
					{
						//console.log("true");
						jQuery("input#"+inputID).prop("name","send-email[]");
					}

					else
					{
						jQuery("input#"+inputID).prop("name","fcp-att[]");
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

			var slug_val = jQuery("input#slug_option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '');

				if(slug_val)
				{
					jQuery("select#"+inputID).addClass(slug_val);
				}

			var field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '')+"_app_"+field_id_num;
			//field_Id_NoSpaces = field_id.replace(/\s+/g, ''); // to remove spaces before checking on the id (case issue time/datepicker)


			if(field_id.split('_app')[0] != jQuery("select#"+inputID).attr("id").split('_app')[0])
			{
				while(jQuery("select[id='"+field_id+"']").length>0)
				{
					field_id_num++;
					field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '')+"_app_"+field_id_num;
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
		var radio_label_prev = jQuery(jQuery("div#"+inputID+" div.form-group div.radio label").get(radio_n)).text();
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
			radio_label_prev = jQuery(jQuery("div#"+inputID+" div.form-group div.radio label").get(radio_n)).text();
		}
		fcp_deleteField();

		jQuery("button#saveButton").one("click", function(){

			jQuery("div#"+inputID+" div.form-group div.radio").remove();

			var field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '')+"_app_"+field_id_num;



			var radio_i = 0;
			var radio_add_loop = jQuery("div#fieldOptions div.input-container input.field-option-add").get(radio_i);
			while(radio_add_loop)
			{
				if(jQuery(jQuery("div#fieldOptions div.input-container div.radio label input").get(radio_i)).attr("checked") == "checked")
				{
					jQuery('<div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input type="radio" class="fcp-check-radio" name="'+inputID+'_radio" checked>'+jQuery(jQuery("input.field-option-add").get(radio_i)).val()+'</label></div>').appendTo("div#"+inputID+" div.form-group");
				}

				else
				{
					jQuery('<div class = "radio col-sm-10 input-container" style="padding-top:0"><label><input type="radio" class="fcp-check-radio" name="'+inputID+'_radio">'+jQuery(jQuery("input.field-option-add").get(radio_i)).val()+'</label></div>').appendTo("div#"+inputID+" div.form-group");

				}

				radio_i++;
				radio_add_loop = jQuery("div#fieldOptions div.input-container input.field-option-add").get(radio_i);
			}


			var slug_val = jQuery("input#slug_option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '');

				if(slug_val)
				{
					jQuery("div#"+inputID).addClass(slug_val);
				}


			if(field_id.split('_app')[0] != jQuery("div#"+inputID).attr("id").split('_app')[0])
			{
				while(jQuery("div[id='"+field_id+"']").length>0)
				{
					field_id_num++;
					field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '')+"_app_"+field_id_num;
				}

				jQuery("div#"+inputID).attr("id",field_id);
				inputID = field_id;
				jQuery("div#"+field_id).children("label:first").attr("for",field_id);

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
		var check_label_prev = jQuery(jQuery("div#"+inputID+" div.form-group div.checkbox label").get(check_n)).text();
		while(check_form_prev)
		{
			//console.log(check_label_prev);
			jQuery('<div class = "checkbox col-sm-10 input-container" id="checkbox_add"><input type="text" class="col-sm-8 field-option-add" name="check"><button type="button" class="field_options close" arial-label="Close"><span aria-hidden="true">&times;</span></button></div>').insertBefore("div#custom-slug");

			jQuery(jQuery("div#fieldOptions div.input-container input.field-option-add").get(check_n)).val(check_label_prev);

			check_n++;
			check_form_prev = jQuery("div#"+inputID+" div.form-group div.checkbox").get(check_n);
			check_label_prev = jQuery(jQuery("div#"+inputID+" div.form-group div.checkbox label").get(check_n)).text();
		}
		fcp_deleteField();

		jQuery("button#saveButton").one("click", function(){

			jQuery("div#"+inputID+" div.form-group div.checkbox").remove();


			var check_i = 0;
			var check_add_loop = jQuery("div#fieldOptions div.input-container input.field-option-add").get(check_i);
			while(check_add_loop)
			{
				jQuery('<div class = "checkbox col-sm-10 input-container" style="padding-top:0"><label><input type="checkbox" class="fcp-check-radio" name="check">'+jQuery(jQuery("input.field-option-add").get(check_i)).val()+'</label></div>').appendTo("div#"+inputID+" div.form-group");

				check_i++;
				check_add_loop = jQuery("div#fieldOptions div.input-container input.field-option-add").get(check_i);
			}


			var slug_val = jQuery("input#slug_option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '');

				if(slug_val)
				{
					jQuery("div#"+inputID).addClass(slug_val);
				}


			var field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '')+"_app_"+field_id_num;


			if(field_id.split('_app')[0] != jQuery("div#"+inputID).attr("id").split('_app')[0])
			{
				while(jQuery("div[id='"+field_id+"']").length>0)
				{
					field_id_num++;
					field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '')+"_app_"+field_id_num;
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
			var slug_val = jQuery("input#slug_option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '');

				if(slug_val)
				{
					jQuery("textarea#"+inputID).addClass(slug_val);
				}

			var field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '')+"_app_"+field_id_num;


			if(field_id.split('_app')[0] != jQuery("textarea#"+inputID).attr("id").split('_app')[0])
			{
				while(jQuery("textarea[id='"+field_id+"']").length>0)
				{
					field_id_num++;
					field_id = jQuery("input#field-name-option").val().replace(/\s+/g, '_').replace(/[^a-z0-9\s]/gi, '')+"_app_"+field_id_num;
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

	jQuery("button#discardButton").one("click",{options:options, element: field},discardChanges);
	//jQuery("button#discardButton").click({field_values, element: field, fieldType: type},discardChanges);

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

// This will be the functions executed for the form elements in the front end

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

	jQuery("div#fcp_show_pass button.btn").off("click").on("click",function(){
		if((jQuery(this).parent().parent().children("div.input-container").children("input").attr("type")) == "password")
		{
			jQuery(this).parent().parent().children("div.input-container").children("input").attr("type","text");
		}

		else if((jQuery(this).parent().parent().children("div.input-container").children("input").attr("type")) == "text")
		{
			jQuery(this).parent().parent().children("div.input-container").children("input").attr("type","password");
		}

	});


}

/*
	The following function manages the email notification fields when their respective checkboxes are changed
*/

function toggleEmail_notificationFields(event){
	var fcp_email_not_opt;
	if ( jQuery(this).prop("checked") == true ) {
		fcp_email_not_opt = jQuery(this).parents("div#email_options").next("div.fcp_email_not_opt");
		fcp_email_not_opt.slideDown(500);
	}
	else {
		fcp_email_not_opt = jQuery(this).parents("div#email_options").next("div.fcp_email_not_opt");
		fcp_email_not_opt.slideUp(500);
        // select the first option in the menu of email fields
        var user_notification_email_menu = jQuery("#fcp_user_email_to_notification");
        var user_event_email_menu = jQuery("#fcp_event_form_required_email");
        if (user_event_email_menu.val() != user_notification_email_menu.val()) {
            user_notification_email_menu.children("option:first").attr("selected", "true");
            user_notification_email_menu.change(); // to force update the email field
        }
        else {
            user_notification_email_menu.children("option:first").attr("selected", "true");
        }
	}
	userNotificationEmailFields();
}

/*
    The following code handles managing deleting forms
    it enables and disables the delete forms button according to how many forms are selected
    and attaches click event to the delete links next to each form
 */

jQuery(document).ready(function(){

    jQuery("#stored_forms .form-select-checkbox").change(function(event){

        var number_of_checked_boxes = 0;
        var selected_form_id = (jQuery(this).attr("id")).replace("checkbox_form_id_","");
        var previously_selected_form_ids = jQuery("#stored_forms #selected_forms_ids").val();
        var selected_ids_field = jQuery("#stored_forms #selected_forms_ids");

        // add the id of the form whose checkbox has been changed and either add it or remove it from the field
        console.log("Field value = "+jQuery("#stored_forms #selected_forms_ids").val());
        if ( jQuery(this).prop("checked")){
            selected_ids_field.val(previously_selected_form_ids + "-" +selected_form_id);
        }
        else {
            previously_selected_form_ids = previously_selected_form_ids.replace("-"+selected_form_id,"");
            selected_ids_field.val(previously_selected_form_ids);
        }
        console.log("Field value = "+jQuery("#stored_forms #selected_forms_ids").val());

        jQuery.each(jQuery("#stored_forms .form-select-checkbox"),function(index,value){

            if ( jQuery(this).prop("checked") ){
                number_of_checked_boxes++;
            }

        });

        if ( number_of_checked_boxes >= 2 ){
            jQuery("#delete_selected_forms").removeAttr("disabled");
            return;
        }
        else if ( number_of_checked_boxes < 2 ){
            jQuery("#delete_selected_forms").attr("disabled",true);
        }

    });

    jQuery("#stored_forms .fcp-delete-selected-form").click(function(event){
        var form_id =  (jQuery(this).attr("id")).replace("fcp_form_id_","");
        jQuery("#stored_forms #selected_forms_ids").val("-"+form_id);

    });
    /**
     * The following displays a dialog when the user tries to delete a form or more
     * before deleting
     */
	jQuery("#stored_forms .fcp-delete-selected-form, button#delete_selected_forms").click(function(event){
        event.preventDefault();
        var dialog_content =
			jQuery('<div id="confirm_form_delete" title="Delete Confirmation"><p><b>If you delete the form all of its <u>submissions</u> will be deleted.</b><br><br>Proceed with the deleteion process ? </p></div>');
        dialog_content.appendTo("body");
        dialog_content.dialog({
            resizable: false,
            height: 230,
            width: 350,
            modal: true,
            draggable: false,
            buttons: {
                "Yes, delete !": function(){
                    jQuery(this).dialog("close");
                    jQuery("#stored_forms").submit();
                },

                "No wait !!": function(){
                    jQuery(this).dialog("close");
                }
            },
            hide: {
                effect: "blind",
                duration: 250
            },
            show: {
                effect: "bounce",
                duration: 500
            }
        });
    });

    /*
        The following attaches change event on the checkboxes of the submission to extract
        their ids and pass them to the field to be deleted
     */

    jQuery("#stored_submission .submission-select-checkbox").change(function(event){

        var number_of_checked_boxes = 0;
        var selected_form_id = (jQuery(this).attr("id")).replace("checkbox_submission_id_","");
        var previously_selected_form_ids = jQuery("#stored_submission #selected_submissions_ids").val();
        var selected_ids_field = jQuery("#stored_submission #selected_submissions_ids");

        // add the id of the form whose checkbox has been changed and either add it or remove it from the field
        console.log("Field value = "+jQuery("#stored_submission #selected_submissions_ids").val());
        if ( jQuery(this).prop("checked")){
            selected_ids_field.val(previously_selected_form_ids + "-" +selected_form_id);
        }
        else {
            previously_selected_form_ids = previously_selected_form_ids.replace("-"+selected_form_id,"");
            selected_ids_field.val(previously_selected_form_ids);
        }
        console.log("Field value = "+jQuery("#stored_submission #selected_submissions_ids").val());

        jQuery.each(jQuery("#stored_submission .submission-select-checkbox"),function(index,value){

            if ( jQuery(this).prop("checked") ){
                number_of_checked_boxes++;
            }

        });

        if ( number_of_checked_boxes >= 2 ){
            jQuery("#delete_selected_submissions").removeAttr("disabled");
            return;
        }
        else if ( number_of_checked_boxes < 2 ){
            jQuery("#delete_selected_submissions").attr("disabled",true);
        }

    });
    /*
        The following attaches a click event on the delete link of each submission to
        extract its id and pass it to the field
     */

    jQuery("#stored_submission .fcp-delete-selected-submission").click(function(event){
        var form_id =  (jQuery(this).attr("id")).replace("fcp_submission_id_","");
        jQuery("#stored_submission #selected_submissions_ids").val("-"+form_id);

    });
    /**
     * The following displays a dialog when the user tries to delete a form or more
     * before deleting
     */
    jQuery("#stored_submission .fcp-delete-selected-submission, button#delete_selected_submissions").click(function(event){
        event.preventDefault();
        var dialog_content =
            jQuery('<div id="confirm_sub_delete" title="Delete Confirmation"><p>You are about to <b>DELETE a user filled</b> submission!</b><br><br>Proceed with the deleteion process ? </p></div>');
        dialog_content.appendTo("body");
        dialog_content.dialog({
            resizable: false,
            height: 230,
            width: 350,
            modal: true,
            draggable: false,
            buttons: {
                "Yes, delete": function(){
                    jQuery(this).dialog("close");
                    jQuery("#stored_submission").submit();
                },

                "No wait !!": function(){
                    jQuery(this).dialog("close");
                }
            },
            hide: {
                effect: "blind",
                duration: 250
            },
            show: {
                effect: "bounce",
                duration: 500
            }
        });
    });

});





/**
 * The following function retrives and returns all of the email fields inserted in a form
 * and inserts them into the select menu from which the user will select an email field
 */
function userNotificationEmailFields(){
	var email_fields = jQuery("div.form-sketch input[type='email']");
	var fields_html = "<option value='0'>Select an email field to use</option>";
	jQuery.each(email_fields,function(index,field){
		var field_label = jQuery(field).parents("div.form-group").children("label");
		field_label = field_label.text();

		var field_id = jQuery(field).attr("id");
		fields_html = fields_html +
				"<option value='"+field_id+"'>"+field_label+"</option>";
	});


	var previously_selected = jQuery("select#fcp_user_email_to_notification option:selected");
	var value_attr = previously_selected.attr("value");

	jQuery("select#fcp_user_email_to_notification").children("option").remove();
	jQuery("select#fcp_user_email_to_notification").append(fields_html);

	jQuery("select#fcp_user_email_to_notification option[value='"+value_attr+"']").attr("selected","true");
}

// This ready function checks the select menu which displays the email fields
// for the user to select one from to use with notification


jQuery(document).ready(function(){
	//userNotificationEmailFields();
	var email_fields_menu = jQuery("select#fcp_user_email_to_notification");
    var event_user_email_menu = jQuery("#fcp_event_form_required_email");
    var user_email = jQuery("div.form-sketch [name='fcp_user_email']");
	// to update the fields just before the user clicks the menu
	email_fields_menu.on("mouseover",userNotificationEmailFields);

	email_fields_menu.change(function(event){
		var selected_field_id = jQuery(this).val();
		var email_fields = jQuery("div.form-sketch input[type='email']");
		var event_user_email_menu = jQuery("#fcp_event_form_required_email");
		var user_email = jQuery("div.form-sketch [name='fcp_user_email']");
		if (selected_field_id != 0){ // email field was selected
            if (event_user_email_menu.val() != 0) {
                if (jQuery(this).val() == event_user_email_menu.val() && event_user_email_menu.length == 1) {
                    jQuery.each(email_fields, function (index, field) {
                        if (jQuery(field).attr("id") == selected_field_id) {
                            jQuery(field).attr("name", "fcp_user_email");
                        }
                        else {
                            jQuery(field).removeAttr("name");
                        }
                    });
                }
                else if (event_user_email_menu.length == 1) {
                    jQuery(this).children("option:first").attr("selected", "true");
                    var message = '<div id="fcp_settings_message" title="Attention">' +
						'You can only select the same field as the one in event option</div>';
					jQuery(message).appendTo("body").dialog({
						buttons:[{
							text: "OK",
							click: function(){
								jQuery(this).dialog("close");
							}
						}],
						draggable: false,
						resizable: false,
						close: function(){
							jQuery("#fcp_settings_message").dialog("destroy").remove();
						},
						open: function(){
							jQuery(".ui-dialog-titlebar-close").hide();
						},
						modal: true
					});
                }
				else if ( event_user_email_menu.length < 1 ){
					// the present form is not an event form
					jQuery.each(email_fields, function (index, field) {
						if (jQuery(field).attr("id") == selected_field_id) {
							jQuery(field).attr("name", "fcp_user_email");
						}
						else {
							jQuery(field).removeAttr("name");
						}
					});
				}
            }
            else { // event user email was not selected so any field can be chosen
                jQuery.each(email_fields, function (index, field) {
                    if (jQuery(field).attr("id") == selected_field_id) {
                        jQuery(field).attr("name", "fcp_user_email");
                    }
                    else {
                        jQuery(field).removeAttr("name");
                    }
                });
            }
		}
		else{ // no email field is selected
            if (event_user_email_menu.val() != jQuery(this).val() && event_user_email_menu.length == 1 && event_user_email_menu.val() != 0){
                // should not remove the name attribute
            }
            else{
                user_email.removeAttr("name");
            }
		}
	});

});


/*
	The following attaches a click event to checkbox to select all forms / submissions to be deleted
 */
jQuery("#fcp_select_all_forms, #fcp_select_all_submissions").change(function(event){
	var is_checked = jQuery(this).prop("checked");

	if (is_checked){
		jQuery(this).parents("table:first").find("input[type='checkbox']").not(jQuery(this)).prop("checked","true").change();
	}
	else {
		jQuery(this).parents("table:first").find("input[type='checkbox']").not(jQuery(this)).removeAttr("checked").change();
	}
});


jQuery(document).ready(function($){
	jQuery("div.form-sketch").sortable({
		revert: true
	});

	var draggable_elements = jQuery(" div.form-sketch div.fcp-drag-sort");

	draggable_elements.draggable({
		containment: "div.form-sketch",
		axis: "y",
		connectToSortable: "div.form-sketch",

	});
});

// Events form settings

/*
    The following function retrieves and updates the email fields menu for the event form settings
 */
function get_event_form_email_fields(){

    var email_fields = jQuery("div.form-sketch input[type='email']");
    var email_field_label;
    var event_select_email_menu = jQuery(this);
    var previously_selected_field_id = event_select_email_menu.val();

    event_select_email_menu.children("option").remove();
    var option = '<option value="0" selected="selected">Select an email field</option>';
    jQuery.each(email_fields,function(index,field){
        field = jQuery(field);
        var field_id = field.attr("id");
        email_field_label = field.parents("div.form-group").find("label").text();
        email_field_label = email_field_label.replace("*","");
        option += '<option value="'+field_id+'">'+email_field_label+'</option>';
    });
    event_select_email_menu.append(option);

    event_select_email_menu.children("option[value='"+previously_selected_field_id+"']").attr("selected","true");
}

/*
    The following function updates the name attribute of the email fields according to their selection from the menu
 */

function update_event_form_email_field_name(){

    var email_fields = jQuery("div.form-sketch input[type='email']");
    var user_notification_menu = jQuery("#fcp_user_email_to_notification");
    var selected_field = jQuery(this).val();
    var user_email_field = jQuery("div.form-sketch input[name='fcp_user_email']");
    if (jQuery(this).val() != 0){ // an email field was selected
        if (user_notification_menu.val() != 0) {
            if (jQuery(this).val() == user_notification_menu.val()) {
                // both settings require the same field
                jQuery.each(email_fields, function (index, field) {
                    var field_id = jQuery(field).attr("id");
                    if (selected_field == field_id) {
                        jQuery(field).attr("name", "fcp_user_email");
                    }
                    else {
                        jQuery(field).removeAttr("name");
                    }
                });
            }
            else {
				jQuery(this).children("option:first").attr("selected", "true");
				var message = '<div id="fcp_settings_message" title="Attention">' +
					'You can only select the same field as the one in event option</div>';
				jQuery(message).appendTo("body").dialog({
					buttons:[{
						text: "OK",
						click: function(){
							jQuery(this).dialog("close");
						}
					}],
					draggable: false,
					resizable: false,
					close: function(){
						jQuery("#fcp_settings_message").dialog("destroy").remove();
					},
					open: function(){
						jQuery(".ui-dialog-titlebar-close").hide();
					},
					modal: true
				});
            }
        }
        else {// user notification was empty so any field can be chosen
            jQuery.each(email_fields, function (index, field) {
                var field_id = jQuery(field).attr("id");
                if (selected_field == field_id) {
                    jQuery(field).attr("name", "fcp_user_email");
                }
                else {
                    jQuery(field).removeAttr("name");
                }
            });
        }

		if ( jQuery(this).val() != 0 ) {
			// inform the user that he might need to make the field required
			var message = '<div id="fcp_user_instruction" title="Attention">You might want to make the email field you selected required' +
				' to force users to fill them before submitting the form</div>';
			jQuery(message).appendTo("body").dialog({
				buttons: [{
					text: "Ok",
					click: function () {
						jQuery(this).dialog("close").dialog("destroy");
						jQuery("div#fcp_user_instruction").remove();
					}
				}],
				draggable: false,
				resizable: false,
				modal: true,
				open: function (event, ui) {
					jQuery(".ui-dialog-titlebar-close").hide();
				}
			});
		}
    }
    else{ // no email field is selected
        if (user_notification_menu.val() == user_email_field.attr("id")){
            // Notification setting is bound to the same field
            // should not remove the name
        }
        else {
            // notification setting is not requiring the same field
            user_email_field.removeAttr("name");
        }
    }

}
jQuery(document).ready(function(){
    jQuery("input#event_form_deadline").datepicker();
    jQuery("select#fcp_event_form_required_email").mouseover(get_event_form_email_fields)
        .change(update_event_form_email_field_name);
});


/*
	The following function is called in event forms
	it is used to select the email field which the user has to fill to submit the event form
 */

function select_user_email_field(field_id){
	if (field_id !== "") {
		jQuery(document).ready(function () {
			jQuery("#fcp_event_form_required_email").mouseover().children("option[value='" + field_id + "']").attr("selected", "true");
		});
	}
}

// minor adjustments to the style of the checkboxes and radio buttons

jQuery(document).ready(function(){
	jQuery("div.radio_field, div.check_field").find("div.form-group").addClass("checkbox-radio-alignment-temp");
});


/*
    Event form attendees settings handler
    This function handles enabling the fields of attendees limit according to the state of the checkbox
 */

jQuery(document).ready(function(){
    jQuery("#fcp_attendee_limit").change(function(event){
        var attendees_number_input = jQuery("#event_form_max_attendees");
        var capacity_message_input = jQuery("#event_form_capacity_message");
        if ( jQuery(this).prop("checked") == true ) { // user wants unlimited attendees
            attendees_number_input.attr("disabled","true").val("");
            capacity_message_input.attr("disabled","true").val("");
        }
        else { // user wants limited attendees
            attendees_number_input.removeAttr("disabled");
            capacity_message_input.removeAttr("disabled");
        }
    });
});

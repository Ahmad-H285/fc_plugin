/**
 * Created by NourEldin on 8/18/2015.
 * @author Nour Eldin
 * @file this file is included on the front end when displaying a form
 */




/**
 * The following will hold any function delcarations that are used in the below ready function
 */

// Global form message jQuery object to be used whenever you need to access that the object
// to make changing the selector easier
var form_message = jQuery("#fcp-form-messages");

// disable submission button function

function disableSubmissionButton(reason){
    var button = jQuery(".fcp_submitButton");
    button.attr("disabled","true");
}

function enableSubmissionButton(){
    var button = jQuery(".fcp_submitButton");
    button.removeAttr("disabled");
}


/*
 The following shall be called only when submitting the form
 */
var submission_data ={}; // JSON Object
/**
    The following function fills the json object as needed
    data represent json object in which elements are formated as arrays
 */
function submission_data_parse(data){
    jQuery.each(data,function(index,value){
        var i;

        if (jQuery(this) != 0) {
            for (i = 0; i < jQuery(this).length; i += 2) {
                submission_data[jQuery(this)[i] + "_fcp_" + i] = jQuery(this)[i + 1];
            }
        }
    });
}

/* *********Functions START********* */

function time_picker_parse(){
    var time_value_array = [];
    var time_am_pm;
    var hours = jQuery("form.fcp_form input[placeholder='hrs']");
    var minutes = jQuery("form.fcp_form input[placeholder='mins']");
    var label;
    var loop_cnt;
    var count = 0;


    for (loop_cnt = 0; loop_cnt < hours.length; loop_cnt++) {

        if (jQuery(hours[loop_cnt]).siblings("select").length == 1) {
            time_am_pm = jQuery(hours[loop_cnt]).siblings("select").val();
        }
        else {
            time_am_pm = "";
        }

        label = jQuery(hours[loop_cnt]).parents("div.form-group").children("label").text();

        if (jQuery(hours[loop_cnt]).val() != "" || jQuery(minutes[loop_cnt]).val() != "" ) {

            time_value_array[count] = label;
            time_value_array[count + 1] = jQuery(hours[loop_cnt]).val() + " : " + jQuery(minutes[loop_cnt]).val() + " " + time_am_pm;
            //console.log(jQuery(hours[loop_cnt]).val() + " : " + jQuery(minutes[loop_cnt]).val() + " " + time_am_pm);

        }
        else {
            time_value_array[count] = label;
            time_value_array[count + 1] = "";
        }

        count += 2;

    }

    return time_value_array;

}

function select_menu_parse(){
    var menus = jQuery("form.fcp_form select.fcp-select-menu-field");
    var menu_array = [];
    var menu_counter = 0;
    var menu_label;
    var menu_value;

    if ( menus.length > 0 ) {
        jQuery.each(menus,function(index,value){
            menu_label = jQuery(this).parents("div.form-group").children("label").text();
            menu_value = jQuery(this).val();
            menu_array[menu_counter] = menu_label;
            menu_array[menu_counter+1] = menu_value;
            menu_counter += 2;
        });

        return menu_array;
    }
    else {
        return 0;
    }


}

function radio_fields_parse(){
    var radio_fields = jQuery(".radio_field");
    var radio_field_label;
    var radio_selected;
    var radio_array = [];
    var radio_count = 0;

    if ( radio_fields.length > 0 ){
        jQuery.each(radio_fields,function(index,value){
            radio_field_label = jQuery(this).children("label:first").text();
            radio_selected = jQuery(this).find("input[type='radio']:checked");
            if (radio_selected.length != 1){
                radio_selected = "";
            }
            else {
                radio_selected = radio_selected.parent("label").text();
            }

            radio_array[radio_count] = radio_field_label;
            radio_array[radio_count+1] = radio_selected;

            radio_count += 2;
        });

        return radio_array;
    }
    else {
        return 0;
    }
}

function checkbox_fields_parse(){
    var checkbox_fields = jQuery(".check_field");
    var checkbox_field_label;
    var checkbox_selected;
    var checkbox_array = [];
    var checkbox_count = 0;

    if ( checkbox_fields.length > 0 ){
        jQuery.each(checkbox_fields,function(index,value){
            checkbox_field_label = jQuery(this).children("label:first").text();
            checkbox_selected = jQuery(this).find("input[type='checkbox']:checked"); // adjust to loop on all of them
            if (checkbox_selected.length == 0){
                checkbox_selected = "";
            }
            else {
                var box = [];
                jQuery.each(checkbox_selected,function(index,value){
                    box[index] = jQuery(this).parent("label").text();

                });

                checkbox_selected = box;
            }

            checkbox_array[checkbox_count] = checkbox_field_label;
            checkbox_array[checkbox_count+1] = checkbox_selected;

            checkbox_count += 2;
        });

        for (var i = 0; i < checkbox_array.length; i += 2) {
            submission_data[checkbox_array[i]+ "_fcp_box_field_" + "_fcp_" + i] = checkbox_array[i + 1];
        }


        //return checkbox_array;
    }
    else {
        return 0;
    }
}

/* *********Functions END********* */

/*
    All of the code must be placed in this ready function,
    The use of the '$' is permitted here as well
 */
jQuery(document).ready(function($){
    // first enable the button and make it type submit
    var form_button = $("form.fcp_form button").attr("disabled",false).attr("type","submit");

    //enabling the datepicker on elements
    $(".hasDatepicker").removeClass("hasDatepicker").datepicker();

    /**
     * The following takes the values of the fields and parses them into a JSON object
     */
    form_button.click(function(event){

        event.preventDefault();

        //******** Checking required fields **********

        var input_fields =  jQuery("input.fcp-required-input");
        var select_fields = jQuery("select.fcp-required-input");
        var textarea_fields = jQuery("textarea.fcp-required-input");
        var radio_fields = jQuery(".radio_field.fcp-required-input");
        var checkbox_fields = jQuery(".check_field.fcp-required-input");
        var empty_fields = 0;

        // Check required fields
        // input fields
        jQuery.each(input_fields,function(index, field){

            if ( !jQuery(field).val() ) { // if field is empty
                empty_fields += 1;

                if ( !($(field).hasClass("fcp-empty-required-field")) ) {
                    $(field).addClass("fcp-empty-required-field");
                }
            }
            else if ($(field).hasClass("fcp-empty-required-field")){
                $(field).removeClass("fcp-empty-required-field");
            }
            // special case for minutes in the time picker

            if (jQuery(field).attr("placeholder") === "hrs"){
                var minutes_field = jQuery(field).nextAll("input[placeholder='mins']");
                if ( !minutes_field.val() ) { // if field is empty
                    empty_fields += 1;

                    if ( !minutes_field.hasClass("fcp-empty-required-field")) {
                        minutes_field.addClass("fcp-empty-required-field");
                    }
                }
                else if (minutes_field.hasClass("fcp-empty-required-field")){
                    minutes_field.removeClass("fcp-empty-required-field");
                }
            }
        });

        //textarea fields
        jQuery.each(textarea_fields,function(index, field){

            if ( !jQuery(field).val() ) { // if field is empty
                empty_fields += 1;

                if ( !($(field).hasClass("fcp-empty-required-field")) ) {
                    $(field).addClass("fcp-empty-required-field");
                }
            }
            else if ($(field).hasClass("fcp-empty-required-field")){
                $(field).removeClass("fcp-empty-required-field");
            }
        });

        // select menu fields

        jQuery.each(select_fields,function(index, field){

            if ( !jQuery(field).val() ) { // if field is empty
                empty_fields += 1;

                if ( !($(field).hasClass("fcp-empty-required-field")) ) {
                    $(field).addClass("fcp-empty-required-field");
                }
            }
            else if ($(field).hasClass("fcp-empty-required-field")){
                $(field).removeClass("fcp-empty-required-field");
            }
        });


        // radio button fields
        radio_fields = radio_fields.children(".form-group");

        jQuery.each(radio_fields, function(index,form_group_field){
            var input_containers = jQuery(form_group_field).children(".input-container");
            var checked_flag = false;
            jQuery.each(input_containers,function(index,radio){

                radio = jQuery(radio).find("input");
                if ( radio.prop("checked")){
                    checked_flag = true;
                }
            });

            if ( checked_flag ){
                if (jQuery(form_group_field).hasClass("fcp-empty-required-field")){
                    jQuery(form_group_field).removeClass("fcp-empty-required-field");
                }
            }
            else {
                jQuery(form_group_field).removeClass("fcp-empty-required-field").addClass("fcp-empty-required-field");
                empty_fields+=1;
            }
        });

        // checkbox fields
        checkbox_fields = checkbox_fields.children(".form-group");

        jQuery.each(checkbox_fields, function(index,form_group_field){
            var input_containers = jQuery(form_group_field).children(".input-container");
            var checked_flag = false;
            jQuery.each(input_containers,function(index,checkbox){

                checkbox = jQuery(checkbox).find("input");
                if ( checkbox.prop("checked")){
                    checked_flag = true;
                }
            });

            if ( checked_flag ){
                if (jQuery(form_group_field).hasClass("fcp-empty-required-field")){
                    jQuery(form_group_field).removeClass("fcp-empty-required-field");
                }
            }
            else {
                jQuery(form_group_field).removeClass("fcp-empty-required-field").addClass("fcp-empty-required-field");
                empty_fields+=1;
            }
        });


        if (empty_fields > 0){

            jQuery("#fcp_message").html("<p id='fcp_required_message'>Please fill in the required fields</p>");
            jQuery("div#fcp-form-messages").removeClass("hidden");

            return; // to prevent form submission
        }
        else {
            jQuery("#fcp_message").html(" "); // removing the content
            jQuery("div#fcp-form-messages").addClass("hidden");
        }

        //*********Required fields checking end**********


        //var submission_data ={};
        var dataObject = {};
        // signaling that the form has been submitted
        $("input[name='fcp_submission_state']").val("True");

        /* **************** PARSING START **************** */

         //getting the values of the form and passing them into an object
        $.each($("form.fcp_form input.fcp-no-special"),function(index,value){
            var field_name = $(this).parents("div.form-group").children("label").text();
            //console.log(field_name);
            submission_data[field_name + "_fcp_" + index] = $(this).val();
        });

        /* ********Special Ops START******** */

        // (1) password ops

        // (2) time picker ops
        var time_array = time_picker_parse();
        dataObject.time_array = time_array;

        // (3) select ops
        var select_array = select_menu_parse();
        dataObject.select_array = select_array;

        // (4) radio ops
        var rad_array = radio_fields_parse();
        dataObject.rad_array = rad_array;

        // (5) checkbox ops
        checkbox_fields_parse();

        // (6) textarea ops
        $.each($("form.fcp_form textarea"),function(index,value){
            var field_name = $(this).parents("div.form-group").children("label").text();
            //console.log(field_name);
            submission_data[field_name + "_fcp_" + index] = $(this).val();
        });

        // (8) file ops




        submission_data_parse(dataObject);


        /* ********Special Ops END******** */
        // build JSON object and send it

        $("input[name='fcp_submission']").attr("value",JSON.stringify(submission_data));
        console.log(submission_data);
        $("form.fcp_form").submit();
    });

/*
    Adjustments to how the form is displayed on the front end

    ******* START *******
*/
//Fixing Radio styles
jQuery("div.radio label").addClass("col-sm-10");

jQuery("div.radio").removeClass("radio");

//Fixing Checkbox styles
jQuery("div.checkbox label").addClass("col-sm-10");

jQuery("div.checkbox").removeClass("checkbox");

//Fixing Time styles
jQuery("div.fcp_time select").css("width","70px");

/* ******* Adjustments END ******* */



    /*
     Email Format Verification
     */

    jQuery("input[type='email']").keyup(function(event){
        var re_email = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;

        if ($(this).val() != "" && !re_email.test($(this).val())){
            $(this).css("background-color","rgba(254, 87, 87, 0.44)");
            disableSubmissionButton("Email format is not correct");
        }
        else {
            $(this).css("background-color","");
            enableSubmissionButton();
        }
    });

    /*
        Making sure that password confrimation field has the same value as the password field itself
     */
    jQuery("form.fcp_form input.pass_conf_input").blur(function(){
        var password_field = jQuery(this).parent().parent().prev().children("div.input-container").children("input");
        if((jQuery(this).val()) != password_field.val())
        {
            form_message.removeClass("hidden").children("#fcp_message").text("Passowrds do not match");
            jQuery(this).addClass("fcp-empty-required-field");
            password_field.addClass("fcp-empty-required-field");
            disableSubmissionButton();
        }
        else {
            form_message.addClass("hidden");
            jQuery(this).removeClass("fcp-empty-required-field");
            password_field.removeClass("fcp-empty-required-field");
            enableSubmissionButton();
        }
    });
});



function confirm_submission(message){
    var notification_container = "<div class='fcp_submission_confirmation col-sm-12'>" +
        "<div class='col-sm-3'></div>" +
        "<div class='col-sm-6 bg-success' style='border-radius: 15px;margin-bottom: 25px;'>" + message+ "</div>" +
        "<div class='col-sm-3'></div>" +
        "</div>";
    jQuery("form.fcp_form").prepend(notification_container);

    setTimeout(function(){
        jQuery("div.fcp_submission_confirmation").fadeOut(1000);
    },3500);
}


// minor modification for checkbox and radio styles

jQuery(document).ready(function(){
    jQuery("div.form-group.checkbox-radio-alignment-temp").removeClass("checkbox-radio-alignment-temp");
});
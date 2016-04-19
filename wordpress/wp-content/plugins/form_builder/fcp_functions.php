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

function fcp_fields_panel($pass_button = NULL)
{
    if($pass_button != NULL)
    	{?>
    <div class="fcp_panel col-md-3 text-center col-md-push-8" style="padding: 5px; border-top: 1px solid grey; border-right: 1px solid grey; border-left: 1px solid grey; margin-top: 360px; position: absolute">
        <h4><strong>Available Fields</strong></h4>
    </div>
    <div class="col-md-3 col-md-push-8" id="fields-panel" style="padding: 5px; border: 1px solid grey; background-color: #D2D2D2; margin-top: 410px; position: absolute">
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
    <?php }
    else
    {
    	?>
    	<div class="fcp_panel col-md-3 text-center col-md-push-8" style="padding: 5px; border-top: 1px solid grey; border-right: 1px solid grey; border-left: 1px solid grey; margin-top: 360px; position: absolute">
        <h4><strong>Available Fields</strong></h4>
    	</div>
    	<div class="col-md-3 col-md-push-8" id="fields-panel" style="padding: 5px; border: 1px solid grey; background-color: #D2D2D2; margin-top: 410px; position: absolute">
        <button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Text</button>
        <button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Numeric</button>
        <button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Date Picker</button>
        <button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Time Picker</button>
        <button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Select Menu</button>
        <button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Checkbox</button>
        <button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Radio Button</button>
        <button type="button" class="btn btn-primary" style="margin: 3px" onclick="">File</button>
        <button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Email</button>
        <button type="button" class="btn btn-primary" style="margin: 3px" onclick="">Text Area</button>

        </div>

        <?php
    }
}

function fcp_fields_options()
{
    ?>
    <div class="col-md-4 text-center col-md-push-7 hidden" id="edit_field_title">
    </div>
    <div class="col-md-4 col-md-push-7 hidden" id="edit_field_content">
        <div id="fieldOptions" class="form-horizontal"></div><div><button type="button" class="btn btn-primary" id="saveButton" style="margin: 15px" onclick="">Save</button><button type="button" class="btn btn-danger" id="discardButton" style="margin: 15px" onclick="">Discard</button></div>
    </div>
    <?php
}

/**
 * @param $form_type :represents the string value of the form type
 * form type should be passed in all lower case and separated with underscores between each word
 */

function fcp_display_created_forms($form_type){

    Global $wpdb;

  $form_table = $wpdb->prefix."fcp_formbuilder";
    $app_created_forms = $wpdb -> get_results("SELECT `form_id`, `form_settings` FROM `{$form_table}` WHERE `form_type`= '".$form_type."'",ARRAY_A);

    if (!empty($app_created_forms)){
        $form_count = 1;
        foreach ($app_created_forms as $form) {
            $form_name = unserialize($form['form_settings'])['form-name'];
            $form_id = $form['form_id'];
            echo "<tr class='fcp-table-head'>
                <td class='col-sm-1'><input class='form-select-checkbox' type='checkbox' id='checkbox_form_id_".$form_id."' style='margin-right:5px;'>".$form_count."</td class='col-sm-1'><td>".$form_name."</td>"
                ."<td>[form-builder form=\"".$form_name." fcp_".$form_id."\"]</td>

				<td><a href='".$_SERVER['REQUEST_URI'].'&id='.$form_id."' class='fcp-edit-selected-form' id='fcp_form_".$form_id."' >
				<span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit</a></td>
				<td><a href='javascript:void(0);' class='fcp-delete-selected-form' id='fcp_form_id_".$form_id."'>Delete</a></td>
			</tr>" ;
            $form_count++;
        }
    }
    else {
        echo "<tr><td id='no_forms_to_display'>No forms to display. <a href='#AddNewForm'>Start creating now</a></tr>";
    }

}

function fcp_manage_created_forms($form_type){

    Global $wpdb;

  $form_table = $wpdb->prefix."fcp_formbuilder";
  $app_created_forms = $wpdb -> get_results("SELECT `form_id`, `form_settings` FROM `{$form_table}` WHERE `form_type`= '".$form_type."'",ARRAY_A);

    if($form_type == APPLICATION_FORM_FCP){

        if (!empty($app_created_forms)){
            $form_count = 1;
            foreach ($app_created_forms as $form) {
                $form_name = unserialize($form['form_settings'])['form-name'];
                $form_id = $form['form_id'];
                echo "<tr class='fcp-table-head'>
                    <td class='col-sm-1'><input class='form-select-checkbox' type='checkbox' id='checkbox_form_id_".$form_id."' style='margin-right:5px;'>".$form_count."</td class='col-sm-1'><td>".$form_name."</td>"
                    ."<td>[form-builder form=\"".$form_name." fcp_".$form_id."\"]</td>

                    <td><a href='".admin_url('admin.php?page=fcp-application-form').'&id='.$form_id."' class='fcp-edit-selected-form' id='fcp_form_".$form_id."' >
                    <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit</a></td>
                    <td><a href='javascript:void(0);' class='fcp-delete-selected-form' id='fcp_form_id_".$form_id."'>Delete</a></td>
                </tr>" ;
                $form_count++;
            }
        }
        else {
            echo "<tr><td id='no_forms_to_display'>No forms to display. <a href='".admin_url('admin.php?page=fcp-application-form')."'>Start creating now</a></td></tr>";
        }
    }

    else if($form_type == CONTACT_FORM_FCP){

        if (!empty($app_created_forms)){
            $form_count = 1;
            foreach ($app_created_forms as $form) {
                $form_name = unserialize($form['form_settings'])['form-name'];
                $form_id = $form['form_id'];
                echo "<tr class='fcp-table-head'>
                    <td class='col-sm-1'><input class='form-select-checkbox' type='checkbox' id='checkbox_form_id_".$form_id."' style='margin-right:5px;'>".$form_count."</td class='col-sm-1'><td>".$form_name."</td>"
                    ."<td>[form-builder form=\"".$form_name." fcp_".$form_id."\"]</td>

                    <td><a href='".admin_url('admin.php?page=fcp-contact-form').'&id='.$form_id."' class='fcp-edit-selected-form' id='fcp_form_".$form_id."' >
                    <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit</a></td>
                    <td><a href='javascript:void(0);' class='fcp-delete-selected-form' id='fcp_form_id_".$form_id."'>Delete</a></td>
                </tr>" ;
                $form_count++;
            }
        }
        else {
            echo "<tr><td id='no_forms_to_display'>No forms to display. <a href='".admin_url('admin.php?page=fcp-contact-form')."'>Start creating now</a></td></tr>";
        }
    }

    else if($form_type == BOOKING_FORM_FCP){

        if (!empty($app_created_forms)){
            $form_count = 1;
            foreach ($app_created_forms as $form) {
                $form_name = unserialize($form['form_settings'])['form-name'];
                $form_id = $form['form_id'];
                echo "<tr class='fcp-table-head'>
                    <td class='col-sm-1'><input class='form-select-checkbox' type='checkbox' id='checkbox_form_id_".$form_id."' style='margin-right:5px;'>".$form_count."</td class='col-sm-1'><td>".$form_name."</td>"
                    ."<td>[form-builder form=\"".$form_name." fcp_".$form_id."\"]</td>

                    <td><a href='".admin_url('admin.php?page=fcp-booking-form').'&id='.$form_id."' class='fcp-edit-selected-form' id='fcp_form_".$form_id."' >
                    <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit</a></td>
                    <td><a href='javascript:void(0);' class='fcp-delete-selected-form' id='fcp_form_id_".$form_id."'>Delete</a></td>
                </tr>" ;
                $form_count++;
            }
        }
        else {
            echo "<tr><td id='no_forms_to_display'>No forms to display. <a href='".admin_url('admin.php?page=fcp-booking-form')."'>Start creating now</a></td></tr>";
        }
    }

    else if($form_type == NEWSLETTER_FORM_FCP){

        if (!empty($app_created_forms)){
            $form_count = 1;
            foreach ($app_created_forms as $form) {
                $form_name = unserialize($form['form_settings'])['form-name'];
                $form_id = $form['form_id'];
                echo "<tr class='fcp-table-head'>
                    <td class='col-sm-1'><input class='form-select-checkbox' type='checkbox' id='checkbox_form_id_".$form_id."' style='margin-right:5px;'>".$form_count."</td class='col-sm-1'><td>".$form_name."</td>"
                    ."<td>[form-builder form=\"".$form_name." fcp_".$form_id."\"]</td>

                    <td><a href='".admin_url('admin.php?page=fcp-newsletter-form').'&id='.$form_id."' class='fcp-edit-selected-form' id='fcp_form_".$form_id."' >
                    <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit</a></td>
                    <td><a href='javascript:void(0);' class='fcp-delete-selected-form' id='fcp_form_id_".$form_id."'>Delete</a></td>
                </tr>" ;
                $form_count++;
            }
        }
        else {
            echo "<tr><td id='no_forms_to_display'>No forms to display. <a href='".admin_url('admin.php?page=fcp-newsletter-form')."'>Start creating now</a></td></tr>";
        }
    }

    else if($form_type == EVENT_FORM_FCP){

        if (!empty($app_created_forms)){
            $form_count = 1;
            foreach ($app_created_forms as $form) {
                $form_name = unserialize($form['form_settings'])['form-name'];
                $form_id = $form['form_id'];
                echo "<tr class='fcp-table-head'>
                    <td class='col-sm-1'><input class='form-select-checkbox' type='checkbox' id='checkbox_form_id_".$form_id."' style='margin-right:5px;'>".$form_count."</td class='col-sm-1'><td>".$form_name."</td>"
                    ."<td>[form-builder form=\"".$form_name." fcp_".$form_id."\"]</td>

                    <td><a href='".admin_url('admin.php?page=fcp-event-form').'&id='.$form_id."' class='fcp-edit-selected-form' id='fcp_form_".$form_id."' >
                    <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit</a></td>
                    <td><a href='javascript:void(0);' class='fcp-delete-selected-form' id='fcp_form_id_".$form_id."'>Delete</a></td>
                </tr>" ;
                $form_count++;
            }
        }
        else {
            echo "<tr><td id='no_forms_to_display'>No forms to display. <a href='".admin_url('admin.php?page=fcp-event-form')."'>Start creating now</a></td></tr>";
        }
    }

    else if($form_type == CUSTOM_FORM_FCP){

        if (!empty($app_created_forms)){
            $form_count = 1;
            foreach ($app_created_forms as $form) {
                $form_name = unserialize($form['form_settings'])['form-name'];
                $form_id = $form['form_id'];
                echo "<tr class='fcp-table-head'>
                    <td class='col-sm-1'><input class='form-select-checkbox' type='checkbox' id='checkbox_form_id_".$form_id."' style='margin-right:5px;'>".$form_count."</td class='col-sm-1'><td>".$form_name."</td>"
                    ."<td>[form-builder form=\"".$form_name." fcp_".$form_id."\"]</td>

                    <td><a href='".admin_url('admin.php?page=fcp-custom-form').'&id='.$form_id."' class='fcp-edit-selected-form' id='fcp_form_".$form_id."' >
                    <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit</a></td>
                    <td><a href='javascript:void(0);' class='fcp-delete-selected-form' id='fcp_form_id_".$form_id."'>Delete</a></td>
                </tr>" ;
                $form_count++;
            }
        }
        else {
            echo "<tr><td id='no_forms_to_display'>No forms to display. <a href='".admin_url('admin.php?page=fcp-custom-form')."'>Start creating now</a></td></tr>";
        }
    }

}

function fcp_update_form($form_type_update)
{
    //if (wp_verify_nonce($nonce_edit,'form-builder-sub')) {

                if (isset($_POST['fcp_edit'])){

                    $form_settings = array('form-name' => $_POST['form-name']);

                    if(isset($_POST['send-to-backend'])) // if the user enabled backend notification
                    {
                        if ($_POST['backend_users_list'] == "Other ...") // to check if the user wanted to email a non WordPress user
                        {
                            $backend_notification_settings = array('To' => $_POST['other_backend_email'], 'From' => $_POST['backend-from'], 'Subject' => $_POST['backend-subject'], 'Body' => $_POST['backend-body']);
                        }
                        else
                        {
                            $backend_notification_settings = array('To' => $_POST['backend_users_list'], 'From' => $_POST['backend-from'], 'Subject' => $_POST['backend-subject'], 'Body' => $_POST['backend-body']);
                        }
                        $form_settings["backend-notification"] = $backend_notification_settings;
                    }

                    else
                    {
                        $form_settings["backend-notification"] = NULL;
                    }

                    if(isset($_POST['send-to-user']))
                    {
                        $user_notification_settings = array('From' => $_POST['user-from'], 'Subject' => $_POST['user-subject'], 'Body' => $_POST['user-body']);
                        $form_settings["user-notification"] = $user_notification_settings;
                    }

                    else
                    {
                        $form_settings["user-notification"] = NULL;
                    }

                    if ( isset($_POST['fcp_event_attendee_unlimited']) && $_POST['fcp_event_attendee_unlimited'] === "on"  ) {
                        $form_settings['event_form_max_attendees'] = "unlimited";
                    }
                    else {
                        if ( isset($_POST['event_form_max_attendees']) ) {
                            $form_settings['event_form_max_attendees'] = $_POST['event_form_max_attendees'];
                            $form_settings['capacity_message'] =
                                isset($_POST['event_form_capacity_message']) ? $_POST['event_form_capacity_message'] : "";
                        }
                    }

                    if ( isset( $_POST['event_form_deadline'] ) ){
                        $form_settings['event_form_deadline'] = $_POST['event_form_deadline'];
                        $form_settings['deadline_message'] =
                            isset($_POST['event_form_deadline_message'])? $_POST['event_form_deadline_message'] : "";
                    }

                    if ( isset( $_POST['event_user_email_field_menu']) ){
                        $form_settings['event_user_email'] =
                            $_POST['event_user_email_field_menu'] !== "0" ? $_POST['event_user_email_field_menu'] : "";
                    }

                    $form_settings = serialize($form_settings); // serialize the array to be able to insert it into the database

                    Global $wpdb;

                    $wpdb->update($wpdb -> prefix."fcp_formbuilder", array('form_body' => $_POST['fcp_edit'], 'form_type'=> $form_type_update ,'form_settings' => $form_settings), array('form_id' => $_GET['id']));


                }
            //}

}

/**
 * @param $form_ids :represents the $_POST['selected_forms_ids']
 * The function takes the super global value and converts it to an array of characters, then removes the
 * array elements which hold the '-' dashes and keeps the form ids themselves
 * After that the function then deletes each form using its id
 */
function fcp_delete_forms($form_ids){

    Global $wpdb;
    $form_ids = str_split($form_ids);
    $array_of_ids = array();
    $index = 0;

    /**
     * The following loop creates array elements after scanning for dashes. It takes the elements between the
     * dashes and adds them to a new array element
     */
    for($i=0;$i<sizeof($form_ids); $i++){
        if ($form_ids[$i] == "-"){
            if ($i > 0){
                $index++;
            }
            $i++;
            $array_of_ids[$index] = $form_ids[$i];
        }
        else {
            $array_of_ids[$index] .= $form_ids[$i];
        }

    }


    foreach($array_of_ids as $id){
        $wpdb->delete($wpdb -> prefix."fcp_formbuilder",array('form_id' => $id));
    }

}

/**
 * fcp_save_form saves the html of the form to the database
 * @param $form_type
 *  $form_type the string of the form type
 */
function fcp_save_form($form_type){

    Global $wpdb;

    $form_settings = array('form-name' => stripslashes($_POST['form-name']));

    if(isset($_POST['send-to-backend'])) // if the user enabled backend notification
    {
        if ($_POST['backend_users_list'] == "Other ...") // to check if the user wanted to email a non WordPress user
        {
            $backend_notification_settings = array('To' => $_POST['other_backend_email'], 'From' => $_POST['backend-from'], 'Subject' => $_POST['backend-subject'], 'Body' => $_POST['backend-body']);
        }
        else
        {
            $backend_notification_settings = array('To' => $_POST['backend_users_list'], 'From' => $_POST['backend-from'], 'Subject' => $_POST['backend-subject'], 'Body' => $_POST['backend-body']);
        }
        $form_settings["backend-notification"] = $backend_notification_settings;
    }

    else
    {
        $form_settings["backend-notification"] = NULL;
    }

    if(isset($_POST['send-to-user']))
    {
        $user_notification_settings = array('From' => $_POST['user-from'], 'Subject' => $_POST['user-subject'], 'Body' => $_POST['user-body']);
        $form_settings["user-notification"] = $user_notification_settings;
    }

    else
    {
        $form_settings["user-notification"] = NULL;
    }

    if ( isset($_POST['fcp_event_attendee_unlimited']) && $_POST['fcp_event_attendee_unlimited'] === "on"  ) {
        $form_settings['event_form_max_attendees'] = "unlimited";
    }
    else {
        if ( isset($_POST['event_form_max_attendees']) ) {
            $form_settings['event_form_max_attendees'] = $_POST['event_form_max_attendees'];
            $form_settings['capacity_message'] =
                isset($_POST['event_form_capacity_message']) ? $_POST['event_form_capacity_message'] : "";
        }
    }

    if ( isset( $_POST['event_form_deadline'] ) ){
        $form_settings['event_form_deadline'] = $_POST['event_form_deadline'];
        $form_settings['deadline_message'] =
            isset($_POST['event_form_deadline_message'])? $_POST['event_form_deadline_message'] : "";
    }

    if ( isset( $_POST['event_user_email_field_menu']) ){
        $form_settings['event_user_email'] =
            $_POST['event_user_email_field_menu'] !== "0" ? $_POST['event_user_email_field_menu'] : "";
    }

    $form_settings = serialize($form_settings); // serialize the array to be able to insert it into the database

    //var_dump( $_POST['fcp']);
    $wpdb->insert($wpdb -> prefix."fcp_formbuilder", array('form_body' => $_POST['fcp'], 'form_type'=> $form_type ,'form_settings' => $form_settings));
}





function file_upload($file_name,$att_num)

{
    // var_dump("Hi There");
    $file_flag = 1;

    if(!file_exists("wp-content/plugins/form_builder/attachments"))
    {
        mkdir("wp-content/plugins/form_builder/attachments", 0700);
        $file_flag = 0;
    }

    else
    {
        $file_flag =1;
    }
    // var_dump("Hi There");
    // var_dump($att_num);
    $i = 0;
    while($i<=$att_num)
    {
        if($_FILES[$file_name]["name"][$i] != "")
        {
            

            $fcp_att_dir = "wp-content/plugins/form_builder/attachments/".time();
            $fcp_att_file = $fcp_att_dir.basename($_FILES[$file_name]["name"][$i]);
            $fcp_att_type = pathinfo($fcp_att_file, PATHINFO_EXTENSION);

            //$file_exist_count = 4;
            if (file_exists($fcp_att_file))
            {
                //$fcp_att_file = $fcp_att_dir."2".basename($_FILES[$file_name]["name"]);
                //rename("wp-content/plugins/form_builder/attachments/file3.rtf","wp-content/plugins/form_builder/attachments/file11.rtf");
                //$file_err_msg = "This file already exists";
                ?>
                <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#fcp_message").text("This file already exists");
                    jQuery("#fcp-form-messages").removeClass('hidden'); 
                });
                </script>
                <?php
                
                $file_flag = 0;
            }

            else if($fcp_att_type != "doc" && $fcp_att_type != "docx" && $fcp_att_type != "pdf" && $fcp_att_type != "rtf" && $fcp_att_type != "pages" && $fcp_att_type != "png" && $fcp_att_type != "jpeg" && $fcp_att_type != "jpg" && $fcp_att_type != "gif" && $fcp_att_type != "ppf" && $fcp_att_type != "pptx" && $fcp_att_type != "txt")
            {
                ?>
                <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#fcp_message").text("This file format is not supported");
                    jQuery("#fcp-form-messages").removeClass('hidden'); 
                });
                </script>
                <?php
                $file_flag = 0;
            }

            else if($_FILES[$file_name]["size"][$i] > 20000000)
            {
                ?>
                <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#fcp_message").text("The file size is too large");
                    jQuery("#fcp-form-messages").removeClass('hidden'); 
                });
                </script>
                <?php
                $file_flag = 0;
            }

            else
            {
                //var_dump("Hi There");
      
                if(move_uploaded_file($_FILES[$file_name]["tmp_name"][$i],$fcp_att_file))
                {
                     $file_flag = 1;
                }

                else
                {
                    //echo "There was a problem uploading the file ".basename($_FILES['fcp-att']["name"]);
                    ?>
                <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#fcp_message").text("There was a problem uploading the file");
                    jQuery("#fcp-form-messages").removeClass('hidden'); 
                });
                </script>
                <?php
                    $file_flag = 0;
                }
            }       
        }

        if($file_flag == 0)
        {
            break;
        }
        else
        {
            $i++;
        }
    
    }
    return $file_flag;
}

/**
 * @param $form_id : represent the id of an event form
 * @return bool : true when conditions of event form occure and false otherwise
 */

function fcp_event_form_capcity_deadline_check($form_id){

    Global $wpdb;
    $forms_table = $wpdb->prefix."fcp_formbuilder";
    $query = "SELECT `form_type` FROM `".$forms_table."` WHERE `form_id`=".$form_id;
    $form_type = $wpdb->get_col($query);
    if ($form_type[0] == EVENT_FORM_FCP || $form_type[0] == BOOKING_FORM_FCP){

        $submissions_table = $wpdb->prefix."fcp_submissions";

        $query = "SELECT COUNT(*) FROM `".$submissions_table."` WHERE form_id=".$form_id;
        $number_of_submitted_attendees = $wpdb->get_var($query);

        $query = "SELECT `form_settings` FROM `".$forms_table."` WHERE `form_id`=".$form_id;
        $settings = $wpdb->get_col($query); // getting the form settings
        $current_date = date('m/d/Y');
        $event_deadline = unserialize($settings[0])['event_form_deadline'];
        $deadline = date_diff(date_create($current_date),date_create($event_deadline));
        $deadline = $deadline->format("%R%a"); // deadline with -/+ depending on the difference between the two dates

        $event_attendess = unserialize($settings[0])['event_form_max_attendees'];

        $attendees_max_flag = false;
        $deadline_flag = false;
        if ($number_of_submitted_attendees == $event_attendess){
            $attendees_max_flag = true;
        }

        if ($deadline < 0){
            $deadline_flag = true;
        }

        $capacity_message = "";
        $deadline_message = "";
        if ($attendees_max_flag){
            $capacity_message = "Event capacity reached!<br>Better luck next time.";
            $message = unserialize($settings[0])['capacity_message'];
            $capacity_message = !empty($message) ? $message : $capacity_message  ;
        }
        if ( $deadline_flag ){
            $deadline_message = "Event deadline reached!<br>Better luck next time";
            $message = unserialize($settings[0])['deadline_message'];
            $deadline_message = !empty($message) ? $message : $deadline_message;
        }

        if ($deadline_flag || $attendees_max_flag) {
            echo $capacity_message . "<br>" . $deadline_message;
            return true;
        }
        else {
            return false;
        }
    }
}

/**
 * The function check if the user submitted the form previously using his email address.
 * @param $form_id
 * @return bool : true if the user submitted the form before using the same email, false otherwise.
 *
 */

function fcp_event_user_email_check( $form_id ){
    Global $wpdb;

    if(isset($_POST['fcp_user_email']))
    {

        $forms_table = $wpdb->prefix."fcp_formbuilder";
        $submissions_table = $wpdb->prefix."fcp_submissions";
        $query = "SELECT `form_type` FROM `".$forms_table."` WHERE `form_id`=".$form_id;
        $form_type = $wpdb->get_col($query);
        
        $form_settings_query = "SELECT `form_settings` FROM " . $forms_table . " WHERE `form_id`=".$form_id;
        $form_settings = $wpdb->get_col($form_settings_query);
        $form_settings = unserialize($form_settings[0]);

        if ($form_type[0] == EVENT_FORM_FCP || $form_type[0] == BOOKING_FORM_FCP){
            if($form_settings['event_user_email'] != ""){

                $user_email = $_POST['fcp_user_email'];
            
                $query = "SELECT `submission` FROM `{$submissions_table}` WHERE `form_id`={$form_id}";
                $results = $wpdb->get_results($query,ARRAY_A);
                foreach( $results as $result ){
                    $submission = unserialize($result['submission']);
                    foreach($submission as $sub_data){
                        if ($sub_data[0] == $user_email && !empty($sub_data[0])){
                            return true;
                        }
                    }
                }
            }

        }
    }
    
    return false;
}

function fcp_custom_fields($body_content){

    $custom_field_count = substr_count($body_content,'{');

    for ($i = 0 ; $i < $custom_field_count ; $i++) { 
                                
        $tag_start = strpos($body_content,'{');
        $tag_end = strpos($body_content,'}');
        $string_length =  $tag_end - ($tag_start+1);
        $field_name_extract = substr($body_content,$tag_start+1,$string_length);
        $field_name_extract_no_space = strtolower(str_replace(' ','',$field_name_extract));
                                
        if( isset($_POST[$field_name_extract_no_space][2]) ) {
                                       
            $field_replace = str_replace("{".$field_name_extract."}",
            $_POST[$field_name_extract_no_space][0]." : ".$_POST[$field_name_extract_no_space][1]." ".$_POST[$field_name_extract_no_space][2],
            $body_content);
            $body_content = $field_replace;

        }

        else if( isset($_POST[$field_name_extract_no_space][1]) ) {
                                       
            $field_replace = str_replace("{".$field_name_extract."}",
            $_POST[$field_name_extract_no_space][0]." : ".$_POST[$field_name_extract_no_space][1],
            $body_content);
            $body_content = $field_replace;

        }

        else if(isset($_POST[$field_name_extract_no_space])) {

            $field_replace = str_replace("{".$field_name_extract."}",$_POST[$field_name_extract_no_space][0],$body_content);
            $body_content = $field_replace;

        }

        else if (strpos($field_name_extract_no_space, 'mail') != false) {
                                    
            if( isset($_POST['fcp_user_email']) ) {
                                        
                $field_replace = str_replace("{".$field_name_extract."}",$_POST['fcp_user_email'],$body_content);
                $body_content = $field_replace;
                                    
            }
        }

                                

    }

    return $body_content;

}

/**
 * The function builds an associative array with keys representing the field names, and the values represent an array
 * of the values. This is because there is an odd case when storing checkboxes there might be more than one value.
 * @param $form_id : will hold the id of the form submitted
 * @return bool : the function returns NULL if event form conditions were true
 * @return string : the text representing a form was already submitted
 *
 */
function fcp_save_submission($form_id){

    Global $wpdb;

    $flag = 0;
    $flag_email = 0;
    $count_att = -1;
    $count_att_send = -1;

    //assistive check to determine if the max number of submissions reach or not for event form
    $event_capacity_deadline_occured = fcp_event_form_capcity_deadline_check( $form_id );
    if ( $event_capacity_deadline_occured == true ){
        return true;
    }

    $event_user_already_submitted = fcp_event_user_email_check( $form_id );
    if ( $event_user_already_submitted == true ) {

        return EVENT_ALREADY_SUBMITTED_FCP;
    }

    $count = 0;

    if(isset($_FILES['fcp-att']))
    {
        while($_FILES['fcp-att']['name'][$count] > -1)
        {

            $count_att++;
            $count++;

            if(!isset($_FILES['fcp-att']['name'][$count]))
            {
                break;
            }
        }
    
        if($_FILES['fcp-att']['name'])
        {
            $flag = file_upload("fcp-att",$count_att);
        }
    }
    else
    {
        $flag = 1;
    }

    $count = 0;
    if(isset($_FILES['send-email']))
    {
        while($_FILES['send-email']['name'][$count] > -1)
        {
            $count_att_send++;
            if(isset($_FILES['send-email']['name'][$count+1]))
            {
                $count++; 
            }
            else
            {
                break;
            }
        }
      
    
        if($_FILES['send-email']['name'])
        {
            $flag_email = file_upload("send-email",$count_att_send);
        }
    }
    else
    {
        $flag_email = 1;
    }

    //}

    if ( isset( $_POST['fcp_submission']) ){
        $form_fields = json_decode(stripslashes($_POST['fcp_submission']));


        $submission_array = array(); // associative array

        // password ops
        $hashed_password = "";
        if ( !empty($_POST['fcp_password']) ){

            $hashed_password = wp_hash_password($_POST['fcp_password']);
        }

        foreach($form_fields as $field_name => $field_value){


            $fields_val_array = array(); // holds the many values of the a field
            $field_val_counter = 0; // used to index the field_val_array


            $field_label_reg = "/_fcp_[0-9]/"; // used to replace the postfix which was used to make JSON keys unique

            //Check for special fields and deal with them separetly



            // (1) checkbox ops variables
            $checkbox_special_reg_exp = "/_fcp_box_field_/";
            $checkbox = strstr($field_name,"_fcp_box_field_"); // used to check if the string exists or not



            // ****************IMPORTANT*********** removing postifix from the field name will be done when displaying only
            $field_name = strip_tags($field_name);



            // checkbox ops
            if ($checkbox != FALSE) {
                $field_name = preg_replace($checkbox_special_reg_exp,"",$field_name,1);


                if (!empty($field_value)) { // checkboxes were ticked
                    foreach ($field_value as $val) { // loop on the checkboxes that were ticked
                        $val = strip_tags($val);


                        array_push($fields_val_array,$val);

                    }

                    $submission_array[$field_name] = $fields_val_array;
                }
                else { // no checkbox is ticked

                    array_push($fields_val_array,"");
                    $submission_array[$field_name] = $fields_val_array;
                }
            }


            // for any other field that does not require special ops
            else {

                $field_value = strip_tags($field_value);
                array_push($fields_val_array,$field_value);
                $submission_array[$field_name] = $fields_val_array;
            }
        }
        //var_dump($submission_array);

        $submission_array = serialize($submission_array); // serializing the array to be stored

        /*
         * (1) Getting the form type based on the id
         * (2) Getting the current date to represent the date of the submission
         * (3) Saving the submission in its table
         */
        $form_table = $wpdb->prefix."fcp_formbuilder";
        $submission_table = $wpdb->prefix."fcp_submissions";
        $form_type_query = "SELECT `form_type` FROM `".$form_table."` WHERE `form_id`=".$form_id;

        $form_type = $wpdb->get_col($form_type_query);
        $form_type = $form_type[0];
        $sub_date = date('Y-m-d');//, strtotime(date("H:i:s")));
        $submission_inserted = FALSE; // used to indicate whether the submission was inserted or not

        $fcp_att_dir = "wp-content/plugins/form_builder/attachments/".time();
            
            $fcp_file_found = [];

            if(isset($_FILES['fcp-att']))
            {
                if(count($_FILES['fcp-att']['name'])>0)
                {
                    $db_file = 0;

                      while($db_file <= $count_att)

                      {
                        if($_FILES['fcp-att']["name"][$db_file] != "")
                        {   
                            $fcp_file_found_att = $fcp_att_dir.basename($_FILES['fcp-att']["name"][$db_file]);
                            array_push($fcp_file_found, $fcp_file_found_att);
                        }
                        else
                        {
                            $fcp_file_found_att = NULL;
                        }
                        
                        //$fcp_file_found_att= array($db_file => $fcp_att_dir.basename($_FILES['fcp-att']["name"][$db_file]));
                        
                        //$fcp_file_found = compact('fcp_file_found_att');

                        $db_file++;
                      }
                      
                }
            }

            
            $fcp_file_email = [];

            if(isset($_FILES['send-email']))
            {

                if(count($_FILES['send-email']['name'])>0)
                {
                    $db_file = 0;

                      while($db_file <= $count_att_send)

                      {
                        if ($_FILES['send-email']["name"][$db_file] != "") 
                        {
                            $fcp_file_found_att = $fcp_att_dir.basename($_FILES['send-email']["name"][$db_file]);
                            array_push($fcp_file_found, $fcp_file_found_att);
                            array_push($fcp_file_email, $fcp_file_found_att);
                        }
                        else
                        {
                            $fcp_file_found_att = NULL;
                        }
                        

                        $db_file++;
                      }

                    //$fcp_file_found = serialize($fcp_file_found);

                }


                if( !(count($_FILES['send-email']['name'])>0) && !(count($_FILES['fcp-att']['name'])>0))
                {
                    $fcp_file_found = NULL;
                }

            }
            
            $fcp_file_found = serialize($fcp_file_found);
                
             
            //}

            if(($flag == 1) && ($flag_email == 1))
            {
                $submission_inserted = $wpdb->insert($submission_table,
                    array('submission' => $submission_array,
                          'sub_date' => $sub_date,
                          'form_id' => $form_id,
                          'form_type'=> $form_type,
                          'attachment_path'=>$fcp_file_found,
                          'password'=> $hashed_password));

                $Sub_body = fcp_submission_content_loop(unserialize($submission_array));
                //echo $Sub_body;
                

                // Now check if the submission was inserted or not
                // ( 1 ) display a confrimation message
                // ( 2 ) refer to form settings for notifications
                if ( $submission_inserted !== FALSE ){
                    echo "<script>
                            jQuery(document).ready(function(){
                                confirm_submission('Submission Successful');
                            });
                    </script>";

                    // retrieving the settings of the form
                    $form_settings_query = "SELECT `form_settings` FROM " . $form_table . " WHERE `form_id`=".$form_id;
                    $form_settings = $wpdb->get_col($form_settings_query);
                    $form_settings = unserialize($form_settings[0]);

                    // to set the content type to html
                    add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));

                    if ($form_settings['backend-notification'] != NULL){
                        $backend_settings = $form_settings['backend-notification'];
                        $backend_to = $backend_settings['To'];
                        $backend_from = $backend_settings['From'];
                        $backend_subject = $backend_settings['Subject'];
                        $backend_body = $backend_settings['Body'];

                        if ( !is_email($backend_to)){

                            // It is a wordpress user ID
                            $wordpress_user = get_user_by('id',$backend_to);
                            $backend_to =  $wordpress_user->user_email;
                        }
                        $submission_email = unserialize($submission_array);
                        //var_dump($submission_email);

                        
                        //var_dump($file_send_email);
                        //if()
                        $header = 'From: '.$backend_from.' <no-reply@info.com>' . "\r\n";

                        if($flag_email == 1)
                        {
                            $field_replace = fcp_custom_fields($backend_body);

                            wp_mail($backend_to,$backend_subject,$backend_body."<br><br>".$Sub_body, $header, $fcp_file_email);
                        }
                        
                        else
                        {
                            $backend_body = fcp_custom_fields($backend_body);

                            wp_mail($backend_to,$backend_subject,$backend_body."<br>".$Sub_body, $header);
                        }
                        
                        // now you have an email address and you should send
                    }

                    if ($form_settings['user-notification'] != NULL){
                        $user_settings = $form_settings['user-notification'];
                        $user_from = $user_settings['From'];
                        $user_subject = $user_settings['Subject'];
                        $user_body = $user_settings['Body'];
                        if(isset($_POST['fcp_user_email']))
                        {
                            $user_to = $_POST['fcp_user_email'];
                        }
                        else
                        {
                            $user_to = null;
                        }

                        if(isset($backend_to))
                        {
                            $header = 'From: '.$user_from.' <'. $backend_to .'>' . "\r\n";
                        }

                        else
                        {
                            $header = 'From: '.$user_from.' <no-reply@info.com>' . "\r\n";   
                        }

                        $field_replace = fcp_custom_fields($user_body);
                        
                        wp_mail($user_to,$user_subject,$user_body."<br>".$Sub_body, $header);
                    }

                }
            }




    }

    //Sending file attahments



}



function fcp_submission_content_loop($form_fields)
{
    // $submissions_table = $wpdb->prefix."fcp_submissions";
    // $submission_query = "SELECT * FROM `".$submissions_table."` WHERE `submission_id`=".$submission_id;
    // $submission_row = $wpdb->get_row($submission_query,ARRAY_A);

    $field_label_pattern = "/_fcp_[0-9]/";
    $password_pattern = "/(\(_fcp_pass)\)/";

    $field_counter = 1;
    $sub_temp = '';

    //$content_fields = (unserialize($submission_row['submission']));
            //var_dump($form_fields);
            //$sub_temp = '';
            foreach($form_fields as $field_label => $field_values){
                //echo "<tr>";
                $field_label = preg_replace($field_label_pattern,"",$field_label);

                $password = strstr($field_label, "(_fcp_pass)");
                if ($password !== FALSE){
                    $field_label = preg_replace($password_pattern,"",$field_label);
                    $password = TRUE;
                }
                //echo $field_counter;
                //echo $field_label;
                //echo "<td><ul>";
                //var_dump($field_values);
                $value_temp = "";

                foreach ($field_values as $key => $value){

                    if ($password) {
                        $value = "Stored Securely";
                    }
                    //echo $value;

                    $value_temp.=" ".$value;
                    //echo $key; 
                }
                //echo "</ul></td>";
                $field_counter++;
                //echo "</tr>";

                //$sub_temp.= $field_label. " : " . $value_temp."\r\n";
                $sub_temp.= "<tr style='border:1px solid black;'>"."<td style='border-right:1px solid black; border-bottom:1px solid black;'>" . $field_label . "</td>" . "<td style='border-bottom:1px solid black;'>" . $value_temp ."</td>"."<tr>";
                //$sub_temp = $value_temp; 
                //echo $field_label;
            }
            $sub_temp = "<table style='border:1px solid black;'>" . $sub_temp . "</table>";
            return $sub_temp;
}

/**
 * This function retrieves submissions and displays them
 *
 * The function queries the database and gets all of the submissions which belong to the passed form type.
 * The function then displays them all sequentially and generates view and delete links to each submission.
 * @param $form_type : represents the form type which the function should only get from the table
 *
 */

function fcp_display_submissions($form_type){
    Global $wpdb;
    $sub_table = $wpdb->prefix."fcp_submissions";
    $form_table = $wpdb->prefix."fcp_formbuilder";
    $submissions = $wpdb -> get_results("SELECT `submission_id`, `submission`, `sub_date`, `form_id`, `attachment_path` FROM `{$sub_table}` WHERE `form_type`= '".$form_type."'",ARRAY_A);

    if (!empty($submissions)){
        $submission_count = 1;
        foreach ($submissions as $key => $submission) {
            $form_id = $submission['form_id'];
            $submission_id = $submission['submission_id'];
            $submission_date = $submission['sub_date'];
            $form = $wpdb -> get_col("SELECT `form_settings` FROM `{$form_table}` WHERE `form_id`= '".$form_id."'");
            $form_name = unserialize($form[0])['form-name'];
            echo "<tr class='fcp-table-head'>
                <td class='col-sm-1'><input class='submission-select-checkbox' type='checkbox' id='checkbox_submission_id_".$submission_id."' style='margin-right:5px;'>".$submission_count."</td><td>".$form_name."</td>"
                ."<td><b>{$submission_date}</b></td>
                <td>{$submission_id}</td>
				<td><a href='".$_SERVER['REQUEST_URI'].'&submission_content_id='.$submission_id."' class='fcp-view-selected-submission' id='fcp_submission_".$submission_id."' >
				<span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> View</a></td>
				<td><a href='javascript:void(0);' class='fcp-delete-selected-submission' id='fcp_submission_id_".$submission_id."'>Delete</a></td>
			</tr>" ;

            $submission_count++;
        }
    }
    else {
        echo "<tr><td id='no_forms_to_display'>No content has been submitted yet.</td></tr>";
    }

}

/**
 * The function deletes the submissions based on their passed ids.
 *
 * The function take the ids separated by '-', it extracts the ids individually then deletes them
 * @param $submissions_ids
 */
function fcp_delete_submissions($submissions_ids){

    Global $wpdb;
    $submissions_ids = str_split($submissions_ids);
    $array_of_ids = array();
    $index = 0;

    /**
     * The following loop creates array elements after scanning for dashes. It takes the elements between the
     * dashes and adds them to a new array element
     */
    for($i=0; $i<sizeof($submissions_ids); $i++){
        if ($submissions_ids[$i] == "-"){
            if ($i > 0){
                $index++;
            }
            $i++;

            // if(isset($array_of_ids[$index]))
            // {
                $array_of_ids[$index] = $submissions_ids[$i];
            //}
        }
        else {

            if(isset($array_of_ids[$index]))
            {
                $array_of_ids[$index] .= $submissions_ids[$i];
            }
        }

    }


    foreach($array_of_ids as $id){
        $wpdb->delete($wpdb -> prefix."fcp_submissions",array('submission_id' => $id));
    }

}


/**
 * The function display the content of the submission based on the passed id.
 * The function display all of the field values except for the password fields.
 * @param $submission_id
 */
function fcp_display_submission_content($submission_id){
    Global $wpdb;
    $submissions_table = $wpdb->prefix."fcp_submissions";
    $forms_table = $wpdb->prefix."fcp_formbuilder";

    $submission_query = "SELECT * FROM `".$submissions_table."` WHERE `submission_id`=".$submission_id;
    $submission_row = $wpdb->get_row($submission_query,ARRAY_A);
    $form_id = $submission_row['form_id'];
    $form_query = "SELECT `form_settings` FROM `".$forms_table."` WHERE `form_id`=".$form_id;
    $form_settings = $wpdb->get_col($form_query);
    $form_name = unserialize($form_settings[0])['form-name'];


    $field_label_pattern = "/_fcp_[0-9]/"; // regular expression to match the postfix and remove it //NEEDED
    $password_pattern = "/(\(_fcp_pass)\)/"; // used to match if the field is a password field or not //NEEDED


    $field_counter = 1; //NEEDED




    $content_fields = (unserialize($submission_row['submission'])); //NEEDED
    ?>
    <div class="col-sm-9 fcp-submission-content">
        <h1>Submission Information</h1>

        <dl class="dl-horizontal">
            <dt>Form Name:</dt>
            <dd><?php echo $form_name; ?></dd>
            <dt>Form Type:</dt>
            <dd><?php echo $submission_row['form_type']; ?></dd>
            <dt>Submission Date:</dt>
            <dd><?php echo $submission_row['sub_date']; ?></dd>
            <dt>Submission ID: </dt>
            <dd><?php echo $submission_row['submission_id'];?></dd>
        </dl>
        <h2 class="col-sm-9">Submission Content :-</h2>
        <table class="table table-hover"  id="fcp_submission_table">
            <thead>
            <tr>
                <th>#</th>
                <th>Field</th>
                <th>Values</th>
            </tr>
            </thead>

            <tbody>
            <?php
            foreach($content_fields as $field_label => $field_values){
                echo "<tr>";
                $field_label = preg_replace($field_label_pattern,"",$field_label);

                $password = strstr($field_label, "(_fcp_pass)");
                if ($password !== FALSE){
                    $field_label = preg_replace($password_pattern,"",$field_label);
                    $password = TRUE;
                }
                echo "<td>{$field_counter}</td> ";
                echo "<td class='fcp-submission-field-label'>{$field_label}</td> ";
                echo "<td><ul>";
                foreach ($field_values as $key=> $value){

                    if ($password) {
                        $value = "Stored Securely";
                    }
                    echo "<li>{$value}</li>";
                }
                echo "</ul></td>";
                $field_counter++;
                echo "</tr>";
            }
            if(!empty($submission_row['attachment_path']))
            {
                $att_path = unserialize($submission_row['attachment_path']);
                $file_count = 1;
                foreach ($att_path as $path => $value) 
                {
                    echo "<tr>";
                    echo "<td>{$field_counter}</td> ";
                    echo "<td>Attachment ".$file_count."</td> ";

                    echo "<td>"."<a href='".get_site_url()."/".$value."' download>File ".$file_count."</a>"."</td> ";
                    echo '</tr>';
                    $field_counter++;
                    $file_count++;
                }
                
            }
            ?>
            </tbody>
        </table>
    </div>



    <?php



}

function export_csv($form_type)
{
    if(isset($_POST['export_csv']))
    {

    	if($_POST['export_csv'] == "true")
    	{
    		//echo 'success';

    		Global $wpdb;

    		$sub_table = $wpdb->prefix."fcp_submissions";
    		$form_table = $wpdb->prefix."fcp_formbuilder";
    		$submissions = $wpdb -> get_results("SELECT `submission`, `form_id` FROM `{$sub_table}` WHERE `form_type`= '".$form_type."' AND `form_id`= '".$_POST['news-form-name']."'" ,ARRAY_A);
    		$form_settings = $wpdb -> get_results("SELECT `form_settings`, `form_id` FROM `{$form_table}` WHERE `form_type`= '".$form_type."'",ARRAY_A);

    		$csv = NULL;
    		$csv_sub = NULL;
    		$field_label_pattern = "/_fcp_[0-9]/";


    		foreach ($submissions as $sub_array => $sub_num) {
    			
    			$exp_data = unserialize($sub_num['submission']);
    			$exp_id = $sub_num['form_id'];
    			//var_dump($exp_id);
    			$csv = NULL;
    			$csv_label = NULL;

    			//print_r($exp_data);

    			foreach ($exp_data as $sub_data => $label) {

    				$sub_data = preg_replace($field_label_pattern,"",$sub_data);
    				$csv_label .= "\"".$sub_data."\"".",";
    				if(sizeof($label) > 0)
    				{
    					$label_flag = 1;
    				}
    				$csv .= "\"";
    				foreach ($label as $field_label => $field_value) {
    					
                        if(isset($label_flag))
                        {
        					if($label_flag == 1)
        					{
        						$csv .= $field_value." - ";
        					}

        					else
        					{
        						$csv .= $field_value;
        					}
                        }

    				}

    				$csv =chop($csv," - ")."\"".",";
    				$label_flag = 0;

    			}
    			$csv_label = chop($csv_label, ",")."\n";

    			$csv = chop($csv, ",")."\n"; 

    			$csv_sub .= $csv;

    		}
    		
    		if(!file_exists("../wp-content/plugins/form_builder/news_csv"))
        	{
            	mkdir("../wp-content/plugins/form_builder/news_csv", 0700);

            	$csv_file = fopen("../wp-content/plugins/form_builder/news_csv/sub_csv.csv", "w");
    			fwrite($csv_file, $csv_label);
    			fwrite($csv_file, $csv_sub);
    			fclose($csv_file);

    			echo "<script>jQuery(document).ready(function(){location.href='".get_site_url()."/wp-content/plugins/form_builder/news_csv/sub_csv.csv'})</script>";
        	}

    		else
    		{
    			$csv_file = fopen("../wp-content/plugins/form_builder/news_csv/sub_csv.csv", "w");
    			fwrite($csv_file, $csv_label);
    			fwrite($csv_file, $csv_sub);
    			fclose($csv_file);

    			echo "<script>jQuery(document).ready(function(){location.href='".get_site_url()."/wp-content/plugins/form_builder/news_csv/sub_csv.csv'})</script>";
    		}

    	}
    }

}

/**
 * this function enqueues bootstrap styles and js
 */
function fcp_get_bootstrap(){
    wp_enqueue_style('fcp_bootstrap_styles');
    wp_enqueue_script('fcp_bootstrap_scripts');
}
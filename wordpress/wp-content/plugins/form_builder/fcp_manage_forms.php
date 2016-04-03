<?php 

require_once(plugin_dir_path(__FILE__).'fcp_functions.php');


function fcp_manage_forms() {
	fcp_get_bootstrap();

	wp_enqueue_script('fcp_js',plugin_dir_url(__FILE__).'js/fcp_js.js',
		array('jquery','jquery-ui-core','jquery-ui-datepicker','jquery-ui-dialog','jquery-ui-draggable','jquery-ui-sortable'));
	wp_enqueue_style('jquery-ui-css','http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
	wp_enqueue_style('fcp_style.css',plugin_dir_url(__FILE__).'style/fcp_style.css');
    wp_enqueue_script('jquery-effects-clip');
    wp_enqueue_script('jquery-effects-bounce');
    wp_enqueue_script('jquery-effects-blind');

    $nonce = wp_create_nonce('form-builder-sub');

    if (wp_verify_nonce($nonce,'form-builder-sub')) {

        // check if there are forms to delete
        if (isset($_POST['selected_forms_ids'])){
            fcp_delete_forms($_POST['selected_forms_ids']);
        }
    }

?>
	<div>
		<h1 class="col-sm-12">Manage Created Forms</h1>
	</div>

    <div class="col-sm-2" style="position: fixed; right: 2%; top: 6%;">
        <button class="btn btn-danger delete-selected-forms" type="submit" id="delete_selected_forms" disabled style="padding: 20px">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            Delete Selected Forms
        </button>
    </div>

	<div>
		<h3 class="col-sm-10">Contact Forms</h3>
	</div>	

    <form action="" method="POST" class="form-horizontal col-sm-9" id="stored_forms" style="margin-bottom: 50px;">
                <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr class="fcp-table-head">
							<th>
								<input type="checkbox" id="fcp_select_all_forms"> #
							</th>
                            <th>Name</th>
                            <th>Form Shortcode</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        fcp_manage_created_forms(CONTACT_FORM_FCP);
                    ?>
                    </tbody>
                </table>
                </div>
                
                <input type="hidden" name="selected_forms_ids" id="selected_forms_ids">

    </form>

	<div>
		<h3 class="col-sm-10">Application Forms</h3>
	</div>

	<form action="" method="POST" class="form-horizontal col-sm-9" id="stored_forms" style="margin-bottom: 50px;">
                <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr class="fcp-table-head">
							<th>
								<input type="checkbox" id="fcp_select_all_forms"> #
							</th>
                            <th>Name</th>
                            <th>Form Shortcode</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        fcp_manage_created_forms(APPLICATION_FORM_FCP);
                    ?>
                    </tbody>
                </table>
                </div>
                
                <input type="hidden" name="selected_forms_ids" id="selected_forms_ids">

            </form>


    <div>
		<h3 class="col-sm-10">Booking Forms</h3>
	</div>	

    <form action="" method="POST" class="form-horizontal col-sm-9" id="stored_forms" style="margin-bottom: 50px;">
                <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr class="fcp-table-head">
							<th>
								<input type="checkbox" id="fcp_select_all_forms"> #
							</th>
                            <th>Name</th>
                            <th>Form Shortcode</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        fcp_manage_created_forms(BOOKING_FORM_FCP);
                    ?>
                    </tbody>
                </table>
                </div>
                
                <input type="hidden" name="selected_forms_ids" id="selected_forms_ids">

    </form>


    <div>
		<h3 class="col-sm-10">Newsletter Forms</h3>
	</div>	

    <form action="" method="POST" class="form-horizontal col-sm-9" id="stored_forms" style="margin-bottom: 50px;">
                <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr class="fcp-table-head">
							<th>
								<input type="checkbox" id="fcp_select_all_forms"> #
							</th>
                            <th>Name</th>
                            <th>Form Shortcode</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        fcp_manage_created_forms(NEWSLETTER_FORM_FCP);
                    ?>
                    </tbody>
                </table>
                </div>
                
                <input type="hidden" name="selected_forms_ids" id="selected_forms_ids">

    </form>


    <div>
		<h3 class="col-sm-10">Event Forms</h3>
	</div>	

    <form action="" method="POST" class="form-horizontal col-sm-9" id="stored_forms" style="margin-bottom: 50px;">
                <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr class="fcp-table-head">
							<th>
								<input type="checkbox" id="fcp_select_all_forms"> #
							</th>
                            <th>Name</th>
                            <th>Form Shortcode</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        fcp_manage_created_forms(EVENT_FORM_FCP);
                    ?>
                    </tbody>
                </table>
                </div>
                
                <input type="hidden" name="selected_forms_ids" id="selected_forms_ids">

    </form>


    <div>
		<h3 class="col-sm-10">Custom Forms</h3>
	</div>	

    <form action="" method="POST" class="form-horizontal col-sm-9" id="stored_forms" style="margin-bottom: 50px;">
                <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr class="fcp-table-head">
							<th>
								<input type="checkbox" id="fcp_select_all_forms"> #
							</th>
                            <th>Name</th>
                            <th>Form Shortcode</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        fcp_manage_created_forms(CUSTOM_FORM_FCP);
                    ?>
                    </tbody>
                </table>
                </div>
                
                <input type="hidden" name="selected_forms_ids" id="selected_forms_ids">

    </form>            
            <?php
}
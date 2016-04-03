<?php
/*
* Add-on Name: Info Tables for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists("Ultimate_Info_Table")){
	class Ultimate_Info_Table{
		function __construct(){
			add_action("admin_init",array($this,"ultimate_it_init"));
			add_shortcode("ultimate_info_table",array($this,"ultimate_it_shortcode"));
		}
		function ultimate_it_init(){
			if(function_exists("vc_map")){
				vc_map(
				array(
				   "name" => __("Info Tables"),
				   "base" => "ultimate_info_table",
				   "class" => "vc_ultimate_info_table",
				   "icon" => "vc_ultimate_info_table",
				   "category" => __("Ultimate VC Addons",'smile'),
				   "description" => __("Create nice looking info tables.","smile"),
				   "params" => array(
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Select Design Style", "smile"),
							"param_name" => "design_style",
							"value" => array(
								"Design 01" => "design01",
								"Design 02" => "design02",
								"Design 03" => "design03",
								"Design 04" => "design04",
								"Design 05" => "design05",
								"Design 06" => "design06",
							),
							"description" => __("Select Info table design you would like to use", "smile")
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Select Color Scheme", "smile"),
							"param_name" => "color_scheme",
							"value" => array(
								"Black" => "black",
								"Red" => "red",
								"Blue" => "blue",
								"Yellow" => "yellow",
								"Green" => "green",
								"Gray" => "gray",
								"Design Your Own" => "custom",
							),
							"description" => __("Which color scheme would like to use?", "smile")
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Main background Color", "smile"),
							"param_name" => "color_bg_main",
							"value" => "",
							"description" => __("Select normal background color.", "smile"),
							"dependency" => Array("element" => "color_scheme","value" => array("custom")),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Main text Color", "smile"),
							"param_name" => "color_txt_main",
							"value" => "",
							"description" => __("Select normal background color.", "smile"),
							"dependency" => Array("element" => "color_scheme","value" => array("custom")),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Highlight background Color", "smile"),
							"param_name" => "color_bg_highlight",
							"value" => "",
							"description" => __("Select highlight background color.", "smile"),
							"dependency" => Array("element" => "color_scheme","value" => array("custom")),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Highlight text Color", "smile"),
							"param_name" => "color_txt_highlight",
							"value" => "",
							"description" => __("Select highlight background color.", "smile"),
							"dependency" => Array("element" => "color_scheme","value" => array("custom")),
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Heading", "smile"),
							"param_name" => "package_heading",
							"admin_label" => true,
							"value" => "",
							"description" => __("The title of Info Table", "smile"),
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Sub Heading", "smile"),
							"param_name" => "package_sub_heading",
							"value" => "",
							"description" => __(" Describe the info table in one line", "smile"),
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Icon to display:", "smile"),
							"param_name" => "icon_type",
							"value" => array(
								"No Icon" => "none",
								"Font Icon Manager" => "selector",
								"Custom Image Icon" => "custom",
							),
							"description" => __("Use an existing font icon</a> or upload a custom image.", "smile")
						),
						array(
							"type" => "icon_manager",
							"class" => "",
							"heading" => __("Select Icon ","smile"),
							"param_name" => "icon",
							"value" => "",
							"description" => __("Click and select icon of your choice. If you can't find the one that suits for your purpose, you can <a href='admin.php?page=font-icon-Manager' target='_blank'>add new here</a>.", "smile"),
							"dependency" => Array("element" => "icon_type","value" => array("selector")),
						),
						array(
							"type" => "attach_image",
							"class" => "",
							"heading" => __("Upload Image Icon:", "smile"),
							"param_name" => "icon_img",
							"value" => "",
							"description" => __("Upload the custom image icon.", "smile"),
							"dependency" => Array("element" => "icon_type","value" => array("custom")),
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Image Width", "smile"),
							"param_name" => "img_width",
							"value" => 48,
							"min" => 16,
							"max" => 512,
							"suffix" => "px",
							"description" => __("Provide image width", "smile"),
							"dependency" => Array("element" => "icon_type","value" => array("custom")),
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Size of Icon", "smile"),
							"param_name" => "icon_size",
							"value" => 32,
							"min" => 12,
							"max" => 72,
							"suffix" => "px",
							"description" => __("How big would you like it?", "smile"),
							"dependency" => Array("element" => "icon_type","value" => array("selector")),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Color", "smile"),
							"param_name" => "icon_color",
							"value" => "#333333",
							"description" => __("Give it a nice paint!", "smile"),
							"dependency" => Array("element" => "icon_type","value" => array("selector")),						
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Icon Style", "smile"),
							"param_name" => "icon_style",
							"value" => array(
								"Simple" => "none",
								"Circle Background" => "circle",
								"Square Background" => "square",
								"Design your own" => "advanced",
							),
							"description" => __("We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.", "smile"),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Background Color", "smile"),
							"param_name" => "icon_color_bg",
							"value" => "#ffffff",
							"description" => __("Select background color for icon.", "smile"),	
							"dependency" => Array("element" => "icon_style", "value" => array("circle","square","advanced")),
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Icon Border Style", "smile"),
							"param_name" => "icon_border_style",
							"value" => array(
								"None" => "",
								"Solid"=> "solid",
								"Dashed" => "dashed",
								"Dotted" => "dotted",
								"Double" => "double",
								"Inset" => "inset",
								"Outset" => "outset",
							),
							"description" => __("Select the border style for icon.","smile"),
							"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Border Color", "smile"),
							"param_name" => "icon_color_border",
							"value" => "#333333",
							"description" => __("Select border color for icon.", "smile"),	
							"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Border Width", "smile"),
							"param_name" => "icon_border_size",
							"value" => 1,
							"min" => 1,
							"max" => 10,
							"suffix" => "px",
							"description" => __("Thickness of the border.", "smile"),
							"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Border Radius", "smile"),
							"param_name" => "icon_border_radius",
							"value" => 500,
							"min" => 1,
							"max" => 500,
							"suffix" => "px",
							"description" => __("0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).", "smile"),
							"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Background Size", "smile"),
							"param_name" => "icon_border_spacing",
							"value" => 50,
							"min" => 30,
							"max" => 500,
							"suffix" => "px",
							"description" => __("Spacing from center of the icon till the boundary of border / background", "smile"),
							"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
						),
						array(
							"type" => "textarea_html",
							"class" => "",
							"heading" => __("Features", "smile"),
							"param_name" => "content",
							"value" => "",
							"description" => __("Describe the Info Table in brief.", "smile"),
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Add link", "smile"),
							"param_name" => "use_cta_btn",
							"value" => array(
								"No Link" => "",
								"Call to Action Button" => "true",
								"Link to Complete Box" => "box",
							),
							"description" => __("Do you want to display call to action button?","smile"),
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Call to action button text", "smile"),
							"param_name" => "package_btn_text",
							"value" => "",
							"description" => __("Enter call to action button text", "smile"),
							"dependency" => Array("element" => "use_cta_btn", "value" => array("true")),
						),
						array(
							"type" => "vc_link",
							"class" => "",
							"heading" => __("Call to action link", "smile"),
							"param_name" => "package_link",
							"value" => "",
							"description" => __("Select / enter the link for call to action button", "smile"),
							"dependency" => Array("element" => "use_cta_btn", "value" => array("true","box")),
						),
						/* typoraphy - heading */
						array(
							"type" => "ult_param_heading",
							"text" => __("Heading Settings"),
							"param_name" => "heading_typograpy",
							"group" => "Typography",
							"class" => "ult-param-heading",
							'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
						),
						array(
							"type" => "ultimate_google_fonts",
							"heading" => __("Font Family", "smile"),
							"param_name" => "heading_font_family",
							"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
							"group" => "Typography"
						),
						array(
							"type" => "ultimate_google_fonts_style",
							"heading" 		=>	__("Font Style", "smile"),
							"param_name"	=>	"heading_font_style",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "font-size",
							"heading" => __("Font Size", "smile"),
							"param_name" => "heading_font_size",
							"min" => 10,
							"suffix" => "px",
							"group" => "Typography"
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Font Color", "smile"),
							"param_name" => "heading_font_color",
							"value" => "",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Line Height", "smile"),
							"param_name" => "heading_line_height",
							"value" => "",
							"suffix" => "px",
							"group" => "Typography"
						),
						/* typoraphy - sub heading */
						array(
							"type" => "ult_param_heading",
							"text" => __("Sub-Heading Settings"),
							"param_name" => "subheading_typograpy",
							"group" => "Typography",
							"class" => "ult-param-heading",
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							"type" => "ultimate_google_fonts",
							"heading" => __("Font Family", "smile"),
							"param_name" => "subheading_font_family",
							"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
							"group" => "Typography"
						),
						array(
							"type" => "ultimate_google_fonts_style",
							"heading" 		=>	__("Font Style", "smile"),
							"param_name"	=>	"subheading_font_style",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "font-size",
							"heading" => __("Font Size", "smile"),
							"param_name" => "subheading_font_size",
							"min" => 10,
							"suffix" => "px",
							"group" => "Typography"
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Font Color", "smile"),
							"param_name" => "subheading_font_color",
							"value" => "",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Line Height", "smile"),
							"param_name" => "subheading_line_height",
							"value" => "",
							"suffix" => "px",
							"group" => "Typography"
						),
						/* typoraphy - feature*/
						array(
							"type" => "ult_param_heading",
							"text" => __("Features Settings"),
							"param_name" => "features_typograpy",
							"group" => "Typography",
							"class" => "ult-param-heading",
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							"type" => "ultimate_google_fonts",
							"heading" => __("Font Family", "smile"),
							"param_name" => "features_font_family",
							"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
							"group" => "Typography"
						),
						array(
							"type" => "ultimate_google_fonts_style",
							"heading" 		=>	__("Font Style", "smile"),
							"param_name"	=>	"features_font_style",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "font-size",
							"heading" => __("Font Size", "smile"),
							"param_name" => "features_font_size",
							"min" => 10,
							"suffix" => "px",
							"group" => "Typography"
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Font Color", "smile"),
							"param_name" => "features_font_color",
							"value" => "",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Line Height", "smile"),
							"param_name" => "features_line_height",
							"value" => "",
							"suffix" => "px",
							"group" => "Typography"
						),
						/* typoraphy - button */
						array(
							"type" => "ult_param_heading",
							"text" => __("Button Settings"),
							"param_name" => "button_typograpy",
							"group" => "Typography",
							"class" => "ult-param-heading",
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							"type" => "ultimate_google_fonts",
							"heading" => __("Font Family", "smile"),
							"param_name" => "button_font_family",
							"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
							"group" => "Typography"
						),
						array(
							"type" => "ultimate_google_fonts_style",
							"heading" 		=>	__("Font Style", "smile"),
							"param_name"	=>	"button_font_style",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "font-size",
							"heading" => __("Font Size", "smile"),
							"param_name" => "button_font_size",
							"min" => 10,
							"suffix" => "px",
							"group" => "Typography"
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Font Color", "smile"),
							"param_name" => "button_font_color",
							"value" => "",
							"group" => "Typography"
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Line Height", "smile"),
							"param_name" => "button_line_height",
							"value" => "",
							"suffix" => "px",
							"group" => "Typography"
						),
						// Customize everything
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Extra Class", "smile"),
							"param_name" => "el_class",
							"value" => "",
							"description" => __("Add extra class name that will be applied to the icon box, and you can use this class for your customizations.", "smile"),
						),
						array(
							"type" => "heading",
							"sub_heading" => "<span style='display: block;'><a href='http://bsf.io/t9vlh' target='_blank'>Watch Video Tutorial &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;'></span></a></span>",
							"param_name" => "notification",
							'edit_field_class' => 'ult-param-important-wrapper ult-dashicon ult-align-right ult-bold-font ult-blue-font vc_column vc_col-sm-12',
						),
					)// params
				));// vc_map
			}
		}
		function ultimate_it_shortcode($atts,$content = null){
			// enqueue js
			wp_enqueue_script('ultimate-appear');
			wp_enqueue_script('ultimate-custom');
			// enqueue css
			wp_enqueue_style('ultimate-animate');
			wp_enqueue_style('ultimate-style');
			wp_enqueue_style("ultimate-pricing",plugins_url("../assets/css/pricing.css",__FILE__));
			$design_style = '';
			extract(shortcode_atts(array(
				"design_style" => "",
			),$atts));
			$output = '';
			require_once(__ULTIMATE_ROOT__.'/templates/info-tables/info-table-'.$design_style.'.php');
			$design_func = 'generate_'.$design_style;
			$design_cls = 'Info_'.ucfirst($design_style);
			$class = new $design_cls;
			$output .= $class->generate_design($atts,$content);
			return $output;
		}
	} // class Ultimate_Info_Table
	new Ultimate_Info_Table;
}
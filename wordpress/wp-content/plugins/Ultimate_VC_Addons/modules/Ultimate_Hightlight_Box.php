<?php
/*
* Add-on Name: Highlight Box
*/
if(!class_exists('Ultimate_Highlight_Box')) 
{
	class Ultimate_Highlight_Box{
		function __construct(){
			add_action('admin_init',array($this,'ctaction_init'));
			add_shortcode('ultimate_ctation',array($this,'call_to_action_shortcode'));
			add_action('wp_enqueue_scripts', array($this, 'register_cta_assets'));
		}
		function register_cta_assets()
		{
			wp_register_style('utl-ctaction-style',plugins_url('../assets/css/call-to-action.css',__FILE__),array(), ULTIMATE_VERSION);
			wp_register_script('utl-ctaction-script',plugins_url('../assets/js/call-to-action.js',__FILE__),array(), ULTIMATE_VERSION);
		}
		function ctaction_init(){
			if(function_exists('vc_map'))
			{
				vc_map(
					array(
					   "name" => __("Hightlight Box","smile"),
					   "base" => "ultimate_ctation",
					   "class" => "vc_ctaction_icon",
					   "icon" => "vc_icon_ctaction",
					   "category" => __("Ultimate VC Addons","smile"),
					   //"description" => __("Displays the banner image with Information","smile"),
					   "params" => array(
							array(
								"type" => "textarea_html",
								"class" => "",
								"heading" => __("Text ","smile"),
								"param_name" => "content",
								"admin_label" => true,
								"value" => "",
								//"description" => __("Give a title to this banner","smile")
							),
							array(
								"type" => "dropdown",
								"heading" => __("Alignment", "js_composer"),
								"param_name" => "content_alignment",
								"value" => array(
									__("Center", "js_composert") => "ctaction-text-center",
									__("Left", "js_composert") => "ctaction-left-center",
									__("Right", "js_composert") => "ctaction-right-center"
								)
							),
							array(
								"type" => "colorpicker",
								"heading" => "Background",
								"param_name" => "ctaction_background",
								"value" => "#e74c3c",
								"group" => "Background"
							),
							array(
								"type" => "colorpicker",
								"heading" => "Background Hover",
								"param_name" => "ctaction_background_hover",
								"value" => "#c0392b",
								"group" => "Background"
							),
							array(
								"type" => "vc_link",
								"param_name" => "ctaction_link",
								"heading" => "Link"
							),
							array(
								"type" => "ult_switch",
								"heading" => "Enable Icon",
								"param_name" => "enable_icon",
								"value" => "",
								"options" => array(
									"enable_icon_value" => array(
										"label" => "",
										"on" => "Yes",
										"off" => "No"
									)
								),
								"group" => "Icon"
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Effect", "smile"),
								"param_name" => "effect",
								"value" => array(
									"Slide Left" => "right-push",
									"Slide Right" => "left-push",
									"Slide Top" => "bottom-push",
									"Slide Bottom" => "top-push",
								),
								"description" => __("Use an existing font icon or upload a custom image.", "smile"),
								"dependency" => Array("element" => "enable_icon", "value" => array("enable_icon_value")),
								"group" => "Icon"
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon to display:", "smile"),
								"param_name" => "icon_type",
								"value" => array(
									"Font Icon Manager" => "selector",
									"Custom Image Icon" => "custom",
								),
								"description" => __("Use an existing font icon or upload a custom image.", "smile"),
								"dependency" => Array("element" => "enable_icon", "value" => array("enable_icon_value")),
								"group" => "Icon"
							),
							array(
								"type" => "icon_manager",
								"class" => "",
								"heading" => __("Select Icon ","smile"),
								"param_name" => "icon",
								"value" => "",
								"description" => __("Click and select icon of your choice. If you can't find the one that suits for your purpose, you can <a href='admin.php?page=font-icon-Manager' target='_blank'>add new here</a>.", "smile"),
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
								"group" => "Icon"
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
								"group" => "Icon"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Color", "smile"),
								"param_name" => "icon_color",
								"value" => "",
								"description" => __("Give it a nice paint!", "smile"),
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
								"group" => "Icon"				
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
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
								"group" => "Icon"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Background Color", "smile"),
								"param_name" => "icon_color_bg",
								"value" => "",
								"description" => __("Select background color for icon.", "smile"),	
								"dependency" => Array("element" => "icon_style", "value" => array("circle","square","advanced")),
								"group" => "Icon"
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon Border Style", "smile"),
								"param_name" => "icon_border_style",
								"value" => array(
									"None" => "",
									"Solid" => "solid",
									"Dashed" => "dashed",
									"Dotted" => "dotted",
									"Double" => "double",
									"Inset" => "inset",
									"Outset" => "outset",
								),
								"description" => __("Select the border style for icon.","smile"),
								"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
								"group" => "Icon"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Border Color", "smile"),
								"param_name" => "icon_color_border",
								"value" => "#333333",
								"description" => __("Select border color for icon.", "smile"),	
								"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
								"group" => "Icon"
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
								"group" => "Icon"
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
								"group" => "Icon"
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
								"group" => "Icon"
							),
							array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("Upload Image Icon:", "smile"),
								"param_name" => "icon_img",
								"value" => "",
								"description" => __("Upload the custom image icon.", "smile"),
								"dependency" => Array("element" => "icon_type","value" => array("custom")),
								"group" => "Icon"
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
								"group" => "Icon"
							),
							
							
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("Font Family", "smile"),
								"param_name" => "text_font_family",
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("Font Style", "smile"),
								"param_name"	=>	"text_font_style",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "font-size",
								"heading" => __("Font Size", "smile"),
								"param_name" => "text_font_size",
								"value" => "32",
								"min" => 10,
								"suffix" => "px",
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Font Color", "smile"),
								"param_name" => "text_color",
								"value" => "#fff",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Line Height", "smile"),
								"param_name" => "text_line_height",
								"value" => "",
								"suffix" => "px",
								"group" => "Typography"
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Width Override", "upb_google_map"),
								"param_name" => "ctaction_override",
								"value" =>array(
									"Default Width"=>"0",
									"Apply 1st parent element's width"=>"1",
									"Apply 2nd parent element's width"=>"2",
									"Apply 3rd parent element's width"=>"3",
									"Apply 4th parent element's width"=>"4",
									"Apply 5th parent element's width"=>"5",
									"Apply 6th parent element's width"=>"6",
									"Apply 7th parent element's width"=>"7",
									"Apply 8th parent element's width"=>"8",
									"Apply 9th parent element's width"=>"9",
									"Full Width "=>"full",
									"Maximum Full Width"=>"ex-full",
								),
								"description" => __("By default, the map will be given to the Visual Composer row. However, in some cases depending on your theme's CSS - it may not fit well to the container you are wishing it would. In that case you will have to select the appropriate value here that gets you desired output..", "upb_google_map"),
							),
							array(
								"type" => "number",
								"heading" => __("Top Padding", "js_composer"),
								"param_name" => "ctaction_padding_top",
								"edit_field_class" => "vc_column vc_col-sm-4",
								"value" => "20",
								"suffix" => "px",
								"group" => "Background"
							),
							array(
								"type" => "number",
								"heading" => __("Bottom Padding", "js_composer"),
								"param_name" => "ctaction_padding_bottom",
								"edit_field_class" => "vc_column vc_col-sm-4",
								"value" => "20",
								"suffix" => "px",
								"group" => "Background"
							),
							array(
								"type" => "textfield",
								"heading" => __("Extra class name", "js_composer"),
								"param_name" => "el_class",
								"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
							)
						),
					)
				);
			}
		}
		// Shortcode handler function for stats banner
		function call_to_action_shortcode($atts, $content)
		{
			wp_enqueue_style('utl-ctaction-style');
			wp_enqueue_script('utl-ctaction-script');
			$output = $el_class = $style = $data = $text_style_inline = $ctaction_link_html = $icon_inline = $effect = '';
			
			extract(shortcode_atts( array(
				'content_alignment' 		=> 'ctaction-text-center',
				'ctaction_background' 		=> '',
				'ctaction_background_hover' => '',
				'text_font_family' 			=> '',
				'text_font_style' 			=> '',
				'text_font_size' 			=> '',
				'text_color' 				=> '',
				'text_line_height' 			=> '',
				'ctaction_link' 			=> '',
				'ctaction_override' 		=> '0',
				'ctaction_padding_top' 		=> '',
				'ctaction_padding_bottom' 	=> '',
				'enable_icon' 				=> '',
				"icon_type"					=> "",
				"icon"						=> "",
				"icon_color"				=> "",
				"icon_style"				=> "",
				"icon_color_bg"				=> "",
				"icon_border_style"			=> "",
				"icon_color_border"			=> "",
				"icon_border_size"			=> "",
				"icon_border_radius"		=> "",
				"icon_border_spacing"		=> "",
				"icon_img"					=> "",
				"img_width"					=> "60",
				"icon_size"					=> "",
				'effect' 					=> 'no-effect',
				'el_class' => '',
			),$atts));
			
			$el_class .= ' '.$content_alignment;
			
			/* typography */
			
			if($text_font_family != '')
			{
				$temp = get_ultimate_font_family($text_font_family);
				$text_style_inline .= 'font-family:'.$temp.';';
			}
			
			$text_style_inline .= get_ultimate_font_style($text_font_style);
			
			if($text_font_size != '')
				$text_style_inline .= 'font-size:'.$text_font_size.'px;';
			
			if($text_color != '')
				$text_style_inline .= 'color:'.$text_color.';';
				
			if($text_line_height != '')
				$text_style_inline .= 'line-height:'.$text_line_height.'px;';
				
			$args = array(
				$text_font_family
			);
			enquque_ultimate_google_fonts($args);
			/*end typography */
			
			if($ctaction_background != '')
			{
				$data .= ' data-background="'.$ctaction_background.'" ';
				$text_style_inline .= 'background:'.$ctaction_background.';';
			}
			if($ctaction_background_hover != '')
				$data .= ' data-background-hover="'.$ctaction_background_hover.'" ';
				
			$data .= ' data-override="'.$ctaction_override.'" ';
			
			if($ctaction_padding_top != '')
				$text_style_inline .= 'padding-top:'.$ctaction_padding_top.'px;';
			if($ctaction_padding_bottom != '')
				$text_style_inline .= 'padding-bottom:'.$ctaction_padding_bottom.'px;';			
				
			if($ctaction_link != '')
			{
				$ctaction_link = vc_build_link($ctaction_link);
				$url = $ctaction_link['url'];
				$title = $ctaction_link['title'];
				$target = $ctaction_link['target'];
				if($url != '')
					$ctaction_link_html = '<a href="'.$url.'" class="ulimate-call-to-action-link" target="'.$target.'"></a>';
			}
			
			if($enable_icon == 'enable_icon_value')
			{
				$icon_inline = do_shortcode('[just_icon icon_align="center" icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'"]');
			}
			else
				$effect = 'no-effect';
			
			$output .= '<div class="ultimate-call-to-action '.$el_class.'" style="'.$text_style_inline.'" '.$data.'>';
				if($icon_inline != '')
					$output .= '<span class="ultimate-ctaction-icon ctaction-icon-'.$effect.'">'.$icon_inline.'</span>';
				$output .= '<span class="uvc-ctaction-data uvc-ctaction-data-'.$effect.'">'.$content.'</span>';
			$output .= $ctaction_link_html.'</div>';
			
			return $output;
		}
	}
}
if(class_exists('Ultimate_Highlight_Box'))
{
	$Ultimate_Highlight_Box = new Ultimate_Highlight_Box;
}

?>
<?php
/*
* Add-on Name: Info Box
* Add-on URI: https://www.brainstormforce.com
*/
if(!class_exists('AIO_Icons_Box'))
{
	class AIO_Icons_Box
	{
		function __construct()
		{
			// Add shortcode for icon box
			add_shortcode('bsf-info-box', array(&$this, 'icon_boxes' ) );
			// Initialize the icon box component for Visual Composer
			add_action('admin_init', array( &$this, 'icon_box_init' ) );
		}
		// Add shortcode for icon-box
		function icon_boxes($atts, $content = null)
		{
			// enqueue js
			wp_enqueue_script('ultimate-appear');			
			wp_enqueue_script('ultimate-custom');
			// enqueue css
			wp_enqueue_style('ultimate-animate');
			wp_enqueue_style('ultimate-style');
			wp_enqueue_style('info-box-style',plugins_url('../assets/css/',__FILE__).'info-box.css');
			$icon_type = $icon_img = $img_width = $icon = $icon_color = $icon_color_bg = $icon_size = $icon_style = $icon_border_style = $icon_border_radius = $icon_color_border = $icon_border_size = $icon_border_spacing = $el_class = $icon_animation = $title = $link = $hover_effect = $pos = $read_more= $read_text = $box_border_style = $box_border_width =$box_border_color = $box_bg_color = $pos = $css_class = $desc_font_line_height = $title_font_line_height = '';
			$title_font = $title_font_style = $title_font_size = $title_font_color = $desc_font = $desc_font_style = $desc_font_size = $desc_font_color = '';
			extract(shortcode_atts(array(
				'icon_type' => '',
				'icon' => '',
				'icon_img' => '',
				'img_width' => '',
				'icon_size' => '',				
				'icon_color' => '',
				'icon_style' => '',
				'icon_color_bg' => '',
				'icon_color_border' => '',			
				'icon_border_style' => '',
				'icon_border_size' => '',
				'icon_border_radius' => '',
				'icon_border_spacing' => '',
				'icon_animation' => '',
				'title'	  => '',
				'link'	   => '',
				'hover_effect' => '',
				'pos'	    => '',
				'box_border_style'=>'',
				'box_border_width'=>'',
				'box_border_color'=>'',
				'box_bg_color'=>"",
				'read_more'  => '',
				'read_text'  => '',
				'title_font' => '',
				'title_font_style' => '',
				'title_font_size' => '',
				'title_font_line_height'=> '',
				'title_font_color' => '',
				'desc_font' => '',
				'desc_font_style' => '',
				'desc_font_size' => '',
				'desc_font_color' => '',
				'desc_font_line_height'=> '',
				'el_class'	  => '',
				),$atts,'bsf-info-box'));
			$html = $target = $suffix = $prefix = $title_style = $desc_style = '';
			$font_args = array();
			$box_icon = do_shortcode('[just_icon icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'" icon_animation="'.$icon_animation.'"]');
			$prefix .= '<div class="aio-icon-component '.$css_class.' '.$el_class.' '.$hover_effect.'">';
			$suffix .= '</div> <!-- aio-icon-component -->';
			$ex_class = $ic_class = '';
			if($pos != ''){
				$ex_class .= $pos.'-icon';
				$ic_class = 'aio-icon-'.$pos;
			}
			
			/* title */
			if($title_font != '')
			{
				$font_family = get_ultimate_font_family($title_font);
				$title_style .= 'font-family:'.$font_family.';';
				array_push($font_args, $title_font);
			}
			if($title_font_style != '')
				$title_style .= get_ultimate_font_style($title_font_style);
			if($title_font_size != '')
				$title_style .= 'font-size:'.$title_font_size.'px;';
			if($title_font_line_height != '')
				$title_style .= 'line-height:'.$title_font_line_height.'px;';
			if($title_font_color != '')
				$title_style .= 'color:'.$title_font_color.';';
				
			/* description */
			if($desc_font != '')
			{
				$font_family = get_ultimate_font_family($desc_font);
				$desc_style .= 'font-family:'.$font_family.';';
				array_push($font_args, $desc_font);
			}
			if($desc_font_style != '')
				$desc_style .= get_ultimate_font_style($desc_font_style);
			if($desc_font_size != '')
				$desc_style .= 'font-size:'.$desc_font_size.'px;';
			if($desc_font_line_height != '')
				$desc_style .= 'line-height:'.$desc_font_line_height.'px;';
			if($desc_font_color != '')
				$desc_style .= 'color:'.$desc_font_color.';';
			enquque_ultimate_google_fonts($font_args);
			
			$box_style='';
			if($pos=='square_box'){
				if($box_border_color!=''){
					$box_style .="border-color:".$box_border_color.";";
				}
				if($box_border_style!=''){
					$box_style .="border-style:".$box_border_style.";";
				}
				if($box_border_width!=''){
					$box_style .="border-width:".$box_border_width."px;";
				}
				if($box_bg_color!=''){
					$box_style .="background-color:".$box_bg_color.";";
				}
			}
			$html .= '<div class="aio-icon-box '.$ex_class.'" style="'.$box_style.'">';
			
			if($pos == "heading-right" || $pos == "right"){
				if($pos == "right"){
					$html .= '<div class="aio-ibd-block">';
				}
					if($title !== ''){
						$html .= '<div class="aio-icon-header">';
						$link_prefix = $link_sufix = '';
						if($link !== 'none'){
							if($read_more == 'title')
							{
								$href = vc_build_link($link);
								if(isset($href['target'])){
									$target = 'target="'.$href['target'].'"';
								}
								$link_prefix = '<a class="aio-icon-box-link" href="'.$href['url'].'" '.$target.'>';
								$link_sufix = '</a>';
							}
						}
						$html .= $link_prefix.'<h3 class="aio-icon-title" style="'.$title_style.'">'.$title.'</h3>'.$link_sufix;
						$html .= '</div> <!-- header -->';
					}
					if($pos !== "right"){
						if($icon !== 'none')
							$html .= '<div class="'.$ic_class.'">'.$box_icon.'</div>';
					}
					if($content !== ''){
						$html .= '<div class="aio-icon-description" style="'.$desc_style.'">';
						$html .= do_shortcode($content);
						if($link !== 'none'){
							if($read_more == 'more')
							{
								$href = vc_build_link($link);
								if(isset($href['target'])){
									$target = 'target="'.$href['target'].'"';
								}
								$more_link = '<a class="aio-icon-read" href="'.$href['url'].'" '.$target.'>';
								$more_link .= $read_text;
								$more_link .= '&nbsp;&raquo;';
								$more_link .= '</a>';
								$html .= $more_link;
							}
						}
						$html .= '</div> <!-- description -->';
					}
					if($pos == "right"){
						$html .= '</div> <!-- aio-ibd-block -->';
						if($icon !== 'none')
							$html .= '<div class="'.$ic_class.'">'.$box_icon.'</div>';
					}

				} else{
					if($icon !== 'none')
					$html .= '<div class="'.$ic_class.'">'.$box_icon.'</div>';
				if($pos == "left")
					$html .= '<div class="aio-ibd-block">';
					if($title !== ''){
						$html .= '<div class="aio-icon-header">';
						$link_prefix = $link_sufix = '';
						if($link !== 'none'){
							if($read_more == 'title')
							{
								$href = vc_build_link($link);
								if(isset($href['target'])){
									$target = 'target="'.$href['target'].'"';
								}
								$link_prefix = '<a class="aio-icon-box-link" href="'.$href['url'].'" '.$target.'>';
								$link_sufix = '</a>';
							}
						}
						$html .= $link_prefix.'<h3 class="aio-icon-title" style="'.$title_style.'">'.$title.'</h3>'.$link_sufix;
						$html .= '</div> <!-- header -->';
					}
					if($content !== ''){
						$html .= '<div class="aio-icon-description" style="'.$desc_style.'">';
						$html .= do_shortcode($content);
						if($link !== 'none'){
							if($read_more == 'more')
							{
								$href = vc_build_link($link);
								if(isset($href['target'])){
									$target = 'target="'.$href['target'].'"';
								}
								$more_link = '<a class="aio-icon-read" href="'.$href['url'].'" '.$target.'>';
								$more_link .= $read_text;
								$more_link .= '&nbsp;&raquo;';
								$more_link .= '</a>';
								$html .= $more_link;
							}
						}
						$html .= '</div> <!-- description -->';
					}
					if($pos == "left")
						$html .= '</div> <!-- aio-ibd-block -->';

				}
			
			
			$html .= '</div> <!-- aio-icon-box -->';
			if($link !== 'none'){
				if($read_more == 'box')
				{
					$href = vc_build_link($link);
					if(isset($href['target'])){
						$target = 'target="'.$href['target'].'"';
					}
					$output = $prefix.'<a class="aio-icon-box-link" href="'.$href['url'].'" '.$target.'>'.$html.'</a>'.$suffix;
				} else {
					$output = $prefix.$html.$suffix;
				}
			} else {
				$output = $prefix.$html.$suffix;
			}
			return $output;
		}
		// Function generate param type "number"
		function number_settings_field($settings, $value)
		{
			$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$min = isset($settings['min']) ? $settings['min'] : '';
			$max = isset($settings['max']) ? $settings['max'] : '';
			$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = '<input type="number" min="'.$min.'" max="'.$max.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" style="max-width:100px; margin-right: 10px;" />'.$suffix;
			return $output;
		}
		/* Add icon box Component*/
		function icon_box_init()
		{
			if ( function_exists('vc_map'))
			{
				vc_map( 
					array(
						"name"		=> __("Info Box", "smile"),
						"base"		=> "bsf-info-box",
						"icon"		=> "vc_info_box",
						"class"	   => "info_box",
						"category"  => __("Ultimate VC Addons", "smile"),
						"description" => "Adds icon box with custom font icon",
						"controls" => "full",
						"show_settings_on_create" => true,
						"params" => array(
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon to display:", "smile"),
								"param_name" => "icon_type",
								"value" => array(
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
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Animation","smile"),
								"param_name" => "icon_animation",
								"value" => array(
							 		__("No Animation","smile") => "",
									__("Swing","smile") => "swing",
									__("Pulse","smile") => "pulse",
									__("Fade In","smile") => "fadeIn",
									__("Fade In Up","smile") => "fadeInUp",
									__("Fade In Down","smile") => "fadeInDown",
									__("Fade In Left","smile") => "fadeInLeft",
									__("Fade In Right","smile") => "fadeInRight",
									__("Fade In Up Long","smile") => "fadeInUpBig",
									__("Fade In Down Long","smile") => "fadeInDownBig",
									__("Fade In Left Long","smile") => "fadeInLeftBig",
									__("Fade In Right Long","smile") => "fadeInRightBig",
									__("Slide In Down","smile") => "slideInDown",
									__("Slide In Left","smile") => "slideInLeft",
									__("Slide In Left","smile") => "slideInLeft",
									__("Bounce In","smile") => "bounceIn",
									__("Bounce In Up","smile") => "bounceInUp",
									__("Bounce In Down","smile") => "bounceInDown",
									__("Bounce In Left","smile") => "bounceInLeft",
									__("Bounce In Right","smile") => "bounceInRight",
									__("Rotate In","smile") => "rotateIn",
									__("Light Speed In","smile") => "lightSpeedIn",
									__("Roll In","smile") => "rollIn",
									),
								"description" => __("Like CSS3 Animations? We have several options for you!","smile")
						  	),
							// Icon Box Heading
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Title", "smile"),
								"param_name" => "title",
								"admin_label" => true,
								"value" => "",
								"description" => __("Provide the title for this icon box.", "smile"),
							),
							// Add some description
							array(
								"type" => "textarea_html",
								"class" => "",
								"heading" => __("Description", "smile"),
								"param_name" => "content",
								"value" => "",
								"description" => __("Provide the description for this icon box.", "smile")
							),
							// Select link option - to box or with read more text
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Apply link to:", "smile"),
								"param_name" => "read_more",
								"value" => array(
									"No Link" => "none",
									"Complete Box" => "box",
									"Box Title" => "title",
									"Display Read More" => "more",
								),
								"description" => __("Select whether to use color for icon or not.", "smile")
							),
							// Add link to existing content or to another resource
							array(
								"type" => "vc_link",
								"class" => "",
								"heading" => __("Add Link", "smile"),
								"param_name" => "link",
								"value" => "",
								"description" => __("Add a custom link or select existing page. You can remove existing link as well.", "smile"),
								"dependency" => Array("element" => "read_more", "value" => array("box","title","more")),
							),
							// Link to traditional read more
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Read More Text", "smile"),
								"param_name" => "read_text",
								"value" => "Read More",
								"description" => __("Customize the read more text.", "smile"),
								"dependency" => Array("element" => "read_more","value" => array("more")),
							),
							// Hover Effect type
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Select Hover Effect type", "smile"),
								"param_name" => "hover_effect",
								"value" => array(
									"No Effect" => "style_1",
									"Icon Zoom" => "style_2",
									"Icon Bounce Up" => "style_3",
								),
								"description" => __("Select the type of effct you want on hover", "smile")
							),
							// Position the icon box
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Box Style", "smile"),
								"param_name" => "pos",
								"value" => array(
									"Icon at Left with heading" => "default",
									"Icon at Right with heading" => "heading-right",
									"Icon at Left" => "left",
									"Icon at Right" => "right",
									"Icon at Top" => "top",
									"Boxed Style" => "square_box",
								),
								"description" => __("Select icon position. Icon box style will be changed according to the icon position.", "smile")
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Box Border Style", "smile"),
								"param_name" => "box_border_style",
								"value" => array(
									"None" => "",
									"Solid"=> "solid",
									"Dashed" => "dashed",
									"Dotted" => "dotted",
									"Double" => "double",
									"Inset" => "inset",
									"Outset" => "outset",
								),
								"dependency" => Array("element" => "pos","value" => array("square_box")),
								"description" => __("Select Border Style for box border.", "smile")
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Box Border Width", "smile"),
								"param_name" => "box_border_width",
								"value" => "",
								"suffix" =>"",
								"dependency" => Array("element" => "pos","value" => array("square_box")),
								"description" => __("Select Width for Box Border.", "smile")
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Box Border Color", "smile"),
								"param_name" => "box_border_color",
								"value" => "",
								"dependency" => Array("element" => "pos","value" => array("square_box")),
								"description" => __("Select Border color for border box.", "smile")
							),	
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Box Background Color", "smile"),
								"param_name" => "box_bg_color",
								"value" => "",
								"dependency" => Array("element" => "pos","value" => array("square_box")),
								"description" => __("Select Box background color.", "smile")
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
								"type" => "text",
								"param_name" => "title_text_typography",
								"heading" => __("<h2>Title settings</h2>"),
								"value" => "",
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => "Font Family",
								"param_name" => "title_font",
								"value" => "",
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" => "Font Style",
								"param_name" => "title_font_style",
								"value" => "",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"param_name" => "title_font_size",
								"heading" => "Font size",
								"value" => "",
								"suffix" => "px",
								"min" => 10,
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"param_name" => "title_font_line_height",
								"heading" => "Font Line Height",
								"value" => "",
								"suffix" => "px",
								"min" => 10,
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"param_name" => "title_font_color",
								"heading" => "Color",
								"group" => "Typography"
							),
							/*
							array(
								"type" => "textarea_html",
								"class" => "",
								"heading" => __("Description", "smile"),
								"param_name" => "content",
								"admin_label" => true,
								"value" => "",
								"description" => __("Provide some description.", "smile"),
							),
							*/
							array(
								"type" => "text",
								"param_name" => "desc_text_typography",
								"heading" => __("<h2>Description settings</h2>"),
								"value" => "",
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => "Font Family",
								"param_name" => "desc_font",
								"value" => "",
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" => "Font Style",
								"param_name" => "desc_font_style",
								"value" => "",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"param_name" => "desc_font_size",
								"heading" => "Font size",
								"value" => "",
								"suffix" => "px",
								"min" => 10,
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"param_name" => "desc_font_line_height",
								"heading" => "Font Line Height",
								"value" => "",
								"suffix" => "px",
								"min" => 10,
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"param_name" => "desc_font_color",
								"heading" => "Color",
								"group" => "Typography"
							),
							array(
								"type" => "heading",
								"sub_heading" => "<span style='display: block;'><a href='http://bsf.io/kqzzi' target='_blank'>Watch Video Tutorial &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;'></span></a></span>",
								"param_name" => "notification",
								'edit_field_class' => 'ult-param-important-wrapper ult-dashicon ult-align-right ult-bold-font ult-blue-font vc_column vc_col-sm-12',
							),
						) // end params array
					) // end vc_map array
				); // end vc_map
			} // end function check 'vc_map'
		}// end function icon_box_init
	}//Class end
}
if(class_exists('AIO_Icons_Box'))
{
	$AIO_Icons_Box = new AIO_Icons_Box;
}
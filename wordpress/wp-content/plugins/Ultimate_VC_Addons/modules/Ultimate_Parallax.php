<?php
/*
Add-on: Ultimate Parallax Background for VC
Add-on URI: https://brainstormforce.com/demos/parallax/
Description: Display interactive image and video parallax background in visual composer row
Version: 1.0
*/
if(!class_exists('VC_Ultimate_Parallax')){
	class VC_Ultimate_Parallax{
		function __construct(){
			add_action('admin_enqueue_scripts',array($this,'admin_scripts'));
			/*add_action('wp_enqueue_scripts',array($this,'front_scripts'),9999); */
			add_action('admin_init',array($this,'parallax_init'));
			add_filter('parallax_image_video',array($this,'parallax_shortcode'), 10, 2);
			if ( function_exists('add_shortcode_param'))
			{
				//add_shortcode_param('number' , array(&$this, 'number_settings_field' ) );
				add_shortcode_param('radio_image_box' , array(&$this, 'radio_image_settings_field' ) );
			}
			if ( function_exists('add_shortcode_param'))
			{
				add_shortcode_param('gradient' , array(&$this, 'gradient_picker' ) );
			}
		}/* end constructor */
		
		public static function parallax_shortcode($atts, $content){
			$bg_type = $bg_image = $bg_image_new = $bsf_img_repeat = $parallax_style = $video_opts = $video_url = $video_url_2 = $video_poster = $bg_image_size = $bg_image_posiiton = $u_video_url = $parallax_sense = $bg_cstm_size = $bg_override = $bg_img_attach = $u_start_time = $u_stop_time = $layer_image = $css = $animation_type = $horizontal_animation = $vertical_animation = $animation_speed = $animated_bg_color = $fadeout_row = $fadeout_start_effect = $parallax_content = $parallax_content_sense = $disable_on_mobile = $disable_on_mobile_img_parallax = $animation_repeat = $animation_direction = $enable_overlay = $overlay_color = $overlay_pattern = $overlay_pattern_opacity = $overlay_pattern_size = $overlay = "";
			
			$seperator_html = $seperator_bottom_html = $seperator_top_html = $seperator_css = $seperator_enable = $seperator_type = $seperator_position = $seperator_shape_size = $seperator_shape_background = $seperator_shape_border = $seperator_shape_border_color = $seperator_shape_border_width = '';
			
			$ult_hide_row = $ult_hide_row_large_screen = $ult_hide_row_desktop = $ult_hide_row_tablet = $ult_hide_row_tablet_small = $ult_hide_row_mobile = $ult_hide_row_mobile_large = '';
			
			extract( shortcode_atts( array(
			    "bg_type" 					=> "",
				"bg_image" 					=> "",
				"bg_image_new" 				=> "",
				"bg_image_repeat" 			=> "",
				'bg_image_size'				=> "",
				"parallax_style" 			=> "",
				"parallax_sense"			=>"",
				"video_opts" 				=> "",
				"bg_image_posiiton"			=> "",
				"video_url" 				=> "",
				"video_url_2" 				=> "",
				"video_poster" 				=> "",
				"u_video_url" 				=> "",
				"bg_cstm_size"				=> "",
				"bg_override"				=> "",
				"bg_img_attach" 			=> "",
				"u_start_time"				=> "",
				"u_stop_time"				=> "",
				"layer_image"				=> "",
				"bg_grad"					=> "",
				"bg_color_value" 			=> "",		
				"bg_fade"					=> "",
				"css" 						=> "",
				"viewport_vdo" 				=> "",
				"enable_controls" 			=> "",
				"controls_color" 			=> "",
				"animation_direction" 		=> "",
				"animation_type" 			=> "false",
				"horizontal_animation" 		=> "",
				"vertical_animation" 		=> "",
				"animation_speed" 			=> "",
				"animation_repeat" 			=> "",
				"animated_bg_color" 		=> "",
				"fadeout_row" 				=> "",
				"fadeout_start_effect" 		=> "50",
				"parallax_content" => "",
				"parallax_content_sense"	=> "30",
				"disable_on_mobile"			=> "",
				"disable_on_mobile_img_parallax" => "",
				"enable_overlay" 			=> "",
				"overlay_color"				=> "",
				"overlay_pattern" 			=> "",
				"overlay_pattern_opacity" 	=> "",
				"overlay_pattern_size" 		=> "",
				"seperator_enable" 			=> "",
				"seperator_type" 			=> "",
				"seperator_position"		=> "",
				"seperator_shape_size" 		=> "",
				"seperator_shape_background" => "",
				"seperator_shape_border" 	=> "",
				"seperator_shape_border_color" => "",
				"seperator_shape_border_width" => "",
				"seperator_svg_height" 		=> "",
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
				"ult_hide_row"				=> "",
				"ult_hide_row_large_screen" => "",
				"ult_hide_row_desktop"		=> "",
				"ult_hide_row_tablet"		=> "",
				"ult_hide_row_tablet_small" => "",
				"ult_hide_row_mobile"		=> "",
				"ult_hide_row_mobile_large"	=> "",
				"video_fixer" 				=> "true"
			), $atts ) );
			
			/* enqueue scripts */
			if((get_option('ultimate_row') == "enable" && $bg_type !== "") || $parallax_content != '' || $fadeout_row != ''){
				
				if($bg_type == 'no_bg' && ($parallax_content != '' || $fadeout_row != ''))
				{
					wp_enqueue_script('ultimate-row-bg',plugins_url('../assets/js/',__FILE__).'ultimate_bg.js?'.$bg_type);
					wp_enqueue_script('ultimate-custom');
				}
				else if($bg_type != 'no_bg' && ($parallax_content != '' || $fadeout_row != ''))
				{
					wp_enqueue_script('ultimate-appear');
					wp_enqueue_script('ultimate-row-bg',plugins_url('../assets/js/',__FILE__).'ultimate_bg.js?'.$bg_type);
					wp_enqueue_script('ultimate-custom');
				}
				else if($bg_type != 'no_bg' && ($parallax_content == '' || $fadeout_row == ''))
				{
					wp_enqueue_script('ultimate-appear');
					wp_enqueue_script('ultimate-row-bg',plugins_url('../assets/js/',__FILE__).'ultimate_bg.js?'.$bg_type);
					wp_enqueue_script('ultimate-custom');
				}
				/* enqueue css */
				//wp_enqueue_style('ultimate-animate');
				//wp_enqueue_style('ultimate-style');			
				
				$html = $autoplay = $muted = $loop = $pos_suffix = $bg_img = $bg_img_id = $icon_inline = '';
				
				//if($disable_on_mobile != '')
				//{
				//	if($disable_on_mobile == 'enable_on_mobile_value')
				//		$disable_on_mobile = 'false';
				//	else
				//		$disable_on_mobile = 'true';
				//}
				//else
					$disable_on_mobile = 'true';
				
				if($disable_on_mobile_img_parallax == 'off')
					$disable_on_mobile_img_parallax = 'true';
				else
					$disable_on_mobile_img_parallax = 'false';
					
				// for overlay	
				if($enable_overlay == 'enable_overlay_value')
				{
					if($overlay_pattern != 'transperant')
						$pattern_url = plugins_url('../assets/images/patterns/',__FILE__).$overlay_pattern;
					else
						$pattern_url = '';
					if(preg_match('/^#[a-f0-9]{6}$/i', $overlay_color)) //hex color is valid
					{
						$overlay_color = hex2rgbUltParallax($overlay_color, $opacity = 0.2);
					}
					
					if(strpos( $overlay_pattern_opacity, '.' ) === false)
						$overlay_pattern_opacity = $overlay_pattern_opacity/100;
					$overlay = ' data-overlay="true" data-overlay-color="'.$overlay_color.'" data-overlay-pattern="'.$pattern_url.'" data-overlay-pattern-opacity="'.$overlay_pattern_opacity.'" data-overlay-pattern-size="'.$overlay_pattern_size.'" ';
				}
				else
				{
					$overlay = ' data-overlay="false" data-overlay-color="" data-overlay-pattern="" data-overlay-pattern-opacity="" data-overlay-pattern-size="" ';
				}
				
				// for seperator 
				if($seperator_enable == 'seperator_enable_value')
				{
					$seperator_bottom_html = ' data-seperator="true" ';
					$seperator_bottom_html .= ' data-seperator-type="'.$seperator_type.'" ';
					$seperator_bottom_html .= ' data-seperator-shape-size="'.$seperator_shape_size.'" ';
					$seperator_bottom_html .= ' data-seperator-svg-height="'.$seperator_svg_height.'" ';
					$seperator_bottom_html .= ' data-seperator-full-width="true"';
					$seperator_bottom_html .= ' data-seperator-position="'.$seperator_position.'" ';
					
					if($seperator_shape_background != '')
						$seperator_bottom_html .= ' data-seperator-background-color="'.$seperator_shape_background.'" ';
					if($seperator_shape_border != 'none')
					{
						$seperator_bottom_html .= ' data-seperator-border="'.$seperator_shape_border.'" ';
						$bwidth = ($seperator_shape_border_width == '') ? '1' : $seperator_shape_border_width;
						$seperator_bottom_html .= ' data-seperator-border-width="'.$bwidth.'" ';
						$seperator_bottom_html .= ' data-seperator-border-color="'.$seperator_shape_border_color.'" ';
					}
					
					if($icon_type != 'no_icon')
					{
						$icon_animation = '';
						$alignment = 'center';
						$icon_inline = do_shortcode('[just_icon icon_align="'.$alignment.'" icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'" icon_animation="'.$icon_animation.'"]');
					}
					$seperator_bottom_html .= ' data-icon="'.htmlentities($icon_inline).'" ';
				}
				
				$seperator_html = $seperator_top_html.' '.$seperator_bottom_html;
				
				// for hide row
				$device_message = $ult_hide_row_data = '';
				if($ult_hide_row == 'ult_hide_row_value')
				{
					if($ult_hide_row_large_screen == 'large_screen')
						$ult_hide_row_data .= ' uvc_hidden-lg ';
					if($ult_hide_row_desktop == 'desktop')
						$ult_hide_row_data .= ' uvc_hidden-ml ';
					if($ult_hide_row_tablet == 'tablet')
						$ult_hide_row_data .= ' uvc_hidden-md ';
					if($ult_hide_row_tablet_small == 'xs_tablet')
						$ult_hide_row_data .= ' uvc_hidden-sm ';
					if($ult_hide_row_mobile == 'mobile')
						$ult_hide_row_data .= ' uvc_hidden-xs ';
					if($ult_hide_row_mobile_large == 'xl_mobile')
						$ult_hide_row_data .= ' uvc_hidden-xsl ';
						
					if($ult_hide_row_data != '')
						$ult_hide_row_data = ' data-hide-row="'.$ult_hide_row_data.'" ';
				}
				
				// RTL 
				$rtl = 'false';
				if(is_rtl())
					$rtl = 'true';
				
				$output = '<!-- Row Backgrounds {'.$device_message.'} -->';
				if($bg_image_new != ""){
					$bg_img_id = $bg_image_new;
				} elseif( $bg_image != ""){
					$bg_img_id = $bg_image;
				} else {
					if($css !== ""){
						$arr = explode('?id=', $css);
						if(isset($arr[1])){
							$arr = explode(')', $arr[1]);
							$bg_img_id = $arr[0];
						}
					}
				}
				if($bg_image_posiiton!=''){
					if(strpos($bg_image_posiiton, 'px')){
						$pos_suffix ='px';
					}
					elseif(strpos($bg_image_posiiton, 'em')){
						$pos_suffix ='em';
					}
					else{
						$pos_suffix='%';
					}
				}			
				if($bg_type== "no_bg"){
					$html .= '<div class="upb_no_bg" data-fadeout="'.$fadeout_row.'" data-fadeout-percentage="'.$fadeout_start_effect.'" data-parallax-content="'.$parallax_content.'" data-parallax-content-sense="'.$parallax_content_sense.'" data-row-effect-mobile-disable="'.$disable_on_mobile.'" data-img-parallax-mobile-disable="'.$disable_on_mobile_img_parallax.'" data-rtl="'.$rtl.'" '.$seperator_html.' '.$ult_hide_row_data.'></div>';
				}	
				elseif($bg_type == "image"){
					if($bg_image_size=='cstm'){
						if($bg_cstm_size!=''){
							$bg_image_size = $bg_cstm_size;
						}
					}
					if($parallax_style == 'vcpb-fs-jquery' || $parallax_style=="vcpb-mlvp-jquery"){
						 $imgs = explode(',',$layer_image);
						 $layer_image = array();
						foreach ($imgs as $value) {
							$layer_image[] = wp_get_attachment_image_src($value,'full');
						}
						foreach ($layer_image as $key=>$value) {
							$bg_imgs[]=$layer_image[$key][0];
						}
						$html .= '<div class="upb_bg_img" data-ultimate-bg="'.implode(',', $bg_imgs).'" data-ultimate-bg-style="'.$parallax_style.'" data-bg-img-repeat="'.$bg_image_repeat.'" data-bg-img-size="'.$bg_image_size.'" data-bg-img-position="'.$bg_image_posiiton.'" data-parallx_sense="'.$parallax_sense.'" data-bg-override="'.$bg_override.'" data-bg_img_attach="'.$bg_img_attach.'" data-upb-overlay-color="'.$overlay_color.'" data-upb-bg-animation="'.$bg_fade.'" data-fadeout="'.$fadeout_row.'" data-fadeout-percentage="'.$fadeout_start_effect.'" data-parallax-content="'.$parallax_content.'" data-parallax-content-sense="'.$parallax_content_sense.'" data-row-effect-mobile-disable="'.$disable_on_mobile.'" data-img-parallax-mobile-disable="'.$disable_on_mobile_img_parallax.'" data-rtl="'.$rtl.'" '.$overlay.' '.$seperator_html.' '.$ult_hide_row_data.'></div>';
					}
					else{
						if($bg_img_id){
							if($animation_direction == '' && $animation_type != 'false')
							{
								if($animation_type == 'h')
									$animation = $horizontal_animation;
								else
									$animation = $vertical_animation;
							}
							else
							{
								if($animation_direction == 'top-animation' || $animation_direction == 'bottom-animation')
									$animation_type = 'v';
								else
									$animation_type = 'h';
									$animation = $animation_direction;
								if($animation == '')
									$animation = 'left-animation';
							}
							
							$bg_img = wp_get_attachment_image_src($bg_img_id,'full');
							$html .= '<div class="upb_bg_img" data-ultimate-bg="url('.$bg_img[0].')" data-image-id="'.$bg_img_id.'" data-ultimate-bg-style="'.$parallax_style.'" data-bg-img-repeat="'.$bg_image_repeat.'" data-bg-img-size="'.$bg_image_size.'" data-bg-img-position="'.$bg_image_posiiton.'" data-parallx_sense="'.$parallax_sense.'" data-bg-override="'.$bg_override.'" data-bg_img_attach="'.$bg_img_attach.'" data-upb-overlay-color="'.$overlay_color.'" data-upb-bg-animation="'.$bg_fade.'" data-fadeout="'.$fadeout_row.'" data-bg-animation="'.$animation.'" data-bg-animation-type="'.$animation_type.'" data-animation-repeat="'.$animation_repeat.'" data-fadeout-percentage="'.$fadeout_start_effect.'" data-parallax-content="'.$parallax_content.'" data-parallax-content-sense="'.$parallax_content_sense.'" data-row-effect-mobile-disable="'.$disable_on_mobile.'" data-img-parallax-mobile-disable="'.$disable_on_mobile_img_parallax.'" data-rtl="'.$rtl.'" '.$overlay.' '.$seperator_html.' '.$ult_hide_row_data.'></div>';
						}
					}
				} elseif($bg_type == "video"){
					$v_opts = explode(",",$video_opts);
					if(is_array($v_opts)){
						foreach($v_opts as $opt){
							if($opt == "muted") $muted .= $opt;
							if($opt == "autoplay") $autoplay .= $opt;
							if($opt == "loop") $loop .= $opt;
						}
					}
					if($viewport_vdo != '')
						$enable_viewport_vdo = 'true';
					else
						$enable_viewport_vdo = 'false';
						
						
					$u_stop_time = ($u_stop_time!='')?$u_stop_time:0;
					$u_start_time = ($u_stop_time!='')?$u_start_time:0;
					$v_img = wp_get_attachment_image_src($video_poster,'full');				
					$html .= '<div class="upb_content_video" data-controls-color="'.$controls_color.'" data-controls="'.$enable_controls.'" data-viewport-video="'.$enable_viewport_vdo.'" data-ultimate-video="'.$video_url.'" data-ultimate-video2="'.$video_url_2.'" data-ultimate-video-muted="'.$muted.'" data-ultimate-video-loop="'.$loop.'" data-ultimate-video-poster="'.$v_img[0].'" data-ultimate-video-autoplay="autoplay" data-bg-override="'.$bg_override.'" data-upb-overlay-color="'.$overlay_color.'" data-upb-bg-animation="'.$bg_fade.'" data-fadeout="'.$fadeout_row.'" data-fadeout-percentage="'.$fadeout_start_effect.'" data-parallax-content="'.$parallax_content.'" data-parallax-content-sense="'.$parallax_content_sense.'" data-row-effect-mobile-disable="'.$disable_on_mobile.'" data-rtl="'.$rtl.'" data-img-parallax-mobile-disable="'.$disable_on_mobile_img_parallax.'" '.$overlay.' '.$seperator_html.' '.$ult_hide_row_data.' data-video_fixer="'.$video_fixer.'"></div>';
					
					if($enable_controls == 'display_control')
						wp_enqueue_style('ultimate-vidcons',plugins_url('../assets/fonts/vidcons.css',__FILE__));
				}
				elseif ($bg_type=='u_iframe') {
					//wp_enqueue_script('jquery.tublar',plugins_url('../assets/js/tubular.js',__FILE__));
					wp_enqueue_script('jquery.ytplayer',plugins_url('../assets/js/jquery.mb.YTPlayer.js',__FILE__));
					$v_opts = explode(",",$video_opts);
					$v_img = wp_get_attachment_image_src($video_poster,'full');
					if(is_array($v_opts)){
						foreach($v_opts as $opt){
							if($opt == "muted") $muted .= $opt;
							if($opt == "autoplay") $autoplay .= $opt;
							if($opt == "loop") $loop .= $opt;
						}
					}
					if($viewport_vdo != '')
						$enable_viewport_vdo = 'true';
					else
						$enable_viewport_vdo = 'false';
					
					$html .= '<div class="upb_content_iframe" data-controls="'.$enable_controls.'" data-viewport-video="'.$enable_viewport_vdo.'" data-ultimate-video="'.$u_video_url.'" data-bg-override="'.$bg_override.'" data-start-time="'.$u_start_time.'" data-stop-time="'.$u_stop_time.'" data-ultimate-video-muted="'.$muted.'" data-ultimate-video-loop="'.$loop.'" data-ultimate-video-poster="'.$v_img[0].'" data-upb-overlay-color="'.$overlay_color.'" data-upb-bg-animation="'.$bg_fade.'" data-fadeout="'.$fadeout_row.'" data-fadeout-percentage="'.$fadeout_start_effect.'"  data-parallax-content="'.$parallax_content.'" data-parallax-content-sense="'.$parallax_content_sense.'" data-row-effect-mobile-disable="'.$disable_on_mobile.'" data-img-parallax-mobile-disable="'.$disable_on_mobile_img_parallax.'" data-rtl="'.$rtl.'" '.$overlay.' '.$seperator_html.' '.$ult_hide_row_data.' data-video_fixer="'.$video_fixer.'"></div>';
				}
				elseif ($bg_type == 'grad') {
					$html .= '<div class="upb_grad" data-grad="'.$bg_grad.'" data-bg-override="'.$bg_override.'" data-upb-overlay-color="'.$overlay_color.'" data-upb-bg-animation="'.$bg_fade.'" data-fadeout="'.$fadeout_row.'" data-fadeout-percentage="'.$fadeout_start_effect.'" data-parallax-content="'.$parallax_content.'" data-parallax-content-sense="'.$parallax_content_sense.'" data-row-effect-mobile-disable="'.$disable_on_mobile.'" data-img-parallax-mobile-disable="'.$disable_on_mobile_img_parallax.'" data-rtl="'.$rtl.'" '.$overlay.' '.$seperator_html.' '.$ult_hide_row_data.'></div>';
				}
				elseif($bg_type == 'bg_color'){
					$html .= '<div class="upb_color" data-bg-override="'.$bg_override.'" data-bg-color="'.$bg_color_value.'" data-fadeout="'.$fadeout_row.'" data-fadeout-percentage="'.$fadeout_start_effect.'" data-parallax-content="'.$parallax_content.'" data-parallax-content-sense="'.$parallax_content_sense.'" data-row-effect-mobile-disable="'.$disable_on_mobile.'" data-img-parallax-mobile-disable="'.$disable_on_mobile_img_parallax.'" data-rtl="'.$rtl.'" '.$overlay.' '.$seperator_html.' '.$ult_hide_row_data.'></div>';
				}
				$output .= $html;
				if($bg_type=='no_bg'){
					return $output;
				}
				else{
					self::front_scripts();
					return $output;
				}
				
			}
		} /* end parallax_shortcode */
		function parallax_init(){
			$group_name = 'Background';
			$group_effects = 'Effect';
			if(function_exists('vc_remove_param')){
				//vc_remove_param('vc_row','bg_image');
				vc_remove_param('vc_row','bg_image_repeat');
			}
			
			$pluginname = dirname(dirname(plugin_basename( __FILE__ )));
			
			$patterns_path = realpath(dirname(plugin_dir_path(__FILE__)).'/assets/images/patterns');
			$patterns_list = glob($patterns_path.'/*.*');
			$patterns = array();
			
			foreach($patterns_list as $pattern)
				$patterns[basename($pattern)] = plugins_url().'/'.$pluginname.'/assets/images/patterns/'.basename($pattern);
				
			/*	
			$separator_path = realpath(dirname(plugin_dir_path(__FILE__)).'/assets/images/separator');
			$separator_list = glob($separator_path.'/*.*');
			$separator_imgs = array();
			
			foreach($separator_list as $separator)
				$separator_imgs[basename($separator)] = plugins_url().'/'.$pluginname.'/assets/images/separator/'.basename($separator);*/
			if(function_exists('vc_add_param')){
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"admin_label" => true,
						"heading" => __("Background Style", "upb_parallax"),
						"param_name" => "bg_type",
						"value" => array(
							__("Default","upb_parallax") => "no_bg",
							__("Single Color","upb_parallax") => "bg_color",
							__("Gradient Color","upb_parallax") => "grad",
							__("Image / Parallax","upb_parallax") => "image",
							__("YouTube Video","upb_parallax") => "u_iframe",
							__("Hosted Video","upb_parallax") => "video",
							//__("Animated Background","upb_parallax") => "animated",
							//__("No","upb_parallax") => "no_bg",
							),
						"description" => __("Select the kind of background would you like to set for this row. Not sure? See Narrated <a href='https://www.youtube.com/watch?v=Qxs8R-uaMWk&list=PL1kzJGWGPrW981u5caHy6Kc9I1bG1POOx' target='_blank'>Video Tutorials</a>", "upb_parallax"),
						"group" => $group_name,
					)
				);				
				vc_add_param('vc_row',array(
						"type" => "gradient",
						"class" => "",
						"heading" => __("Gradient Type", "upb_parallax"),						
						"param_name" => "bg_grad",
						"description" => __('At least two color points should be selected. <a href="https://www.youtube.com/watch?v=yE1M4AKwS44" target="_blank">Video Tutorial</a>', "upb_parallax"),
						"dependency" => array("element" => "bg_type","value" => array("grad")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Background Color", "upb_parallax"),						
						"param_name" => "bg_color_value",
						//"description" => __('At least two color points should be selected. <a href="https://www.youtube.com/watch?v=yE1M4AKwS44" target="_blank">Video Tutorial</a>', "upb_parallax"),
						"dependency" => array("element" => "bg_type","value" => array("bg_color")),
						"group" => $group_name,
					)
				);
				vc_add_param("vc_row", array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Parallax Style","upb_parallax"),
					"param_name" => "parallax_style",
					"value" => array(
						__("Simple Background Image","upb_parallax") => "vcpb-default",
						__("Auto Moving Background","upb_parallax") => "vcpb-animated",
						__("Vertical Parallax On Scroll","upb_parallax") => "vcpb-vz-jquery",
						__("Horizontal Parallax On Scroll","upb_parallax") => "vcpb-hz-jquery",
						__("Interactive Parallax On Mouse Hover","upb_parallax") => "vcpb-fs-jquery",
						__("Multilayer Vertical Parallax","upb_parallax") => "vcpb-mlvp-jquery",
					), 
					"description" => __("Select the kind of style you like for the background.","upb_parallax"),
					"dependency" => array("element" => "bg_type","value" => array("image")),
					"group" => $group_name,
				));	
				vc_add_param('vc_row',array(
						"type" => "attach_image",
						"class" => "",
						"heading" => __("Background Image", "upb_parallax"),
						"param_name" => "bg_image_new",
						"value" => "",
						"description" => __("Upload or select background image from media gallery.", "upb_parallax"),
						"dependency" => array("element" => "parallax_style","value" => array("vcpb-default","vcpb-animated","vcpb-vz-jquery","vcpb-hz-jquery",)),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "attach_images",
						"class" => "",
						"heading" => __("Layer Images", "upb_parallax"),
						"param_name" => "layer_image",
						"value" => "",
						"description" => __("Upload or select background images from media gallery.", "upb_parallax"),
						"dependency" => array("element" => "parallax_style","value" => array("vcpb-fs-jquery","vcpb-mlvp-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Background Image Repeat", "upb_parallax"),
						"param_name" => "bg_image_repeat",
						"value" => array(
								__("Repeat", "upb_parallax") => "repeat",
								__("Repeat X", "upb_parallax") => "repeat-x",
								__("Repeat Y", "upb_parallax") => "repeat-y",
								__("No Repeat", "upb_parallax") => "no-repeat",
							),
						"description" => __("Options to control repeatation of the background image. Learn on <a href='http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-repeat' target='_blank'>W3School</a>", "upb_parallax"),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-default","vcpb-fix","vcpb-vz-jquery","vcpb-hz-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Background Image Size", "upb_parallax"),
						"param_name" => "bg_image_size",
						"value" => array(
								__("Cover - Image to be as large as possible", "upb_parallax") => "cover",
								__("Contain - Image will try to fit inside the container area", "upb_parallax") => "contain",
								__("Initial", "upb_parallax") => "initial",
								/*__("Automatic", "upb_parallax") => "automatic", */
							),
						"description" => __("Options to control size of the background image. Learn on <a href='http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-size&preval=50%25' target='_blank'>W3School</a>", "upb_parallax"),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-default","vcpb-animated","vcpb-fix","vcpb-vz-jquery","vcpb-hz-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Custom Background Image Size", "upb_parallax"),
						"param_name" => "bg_cstm_size",
						"value" =>"",
						"description" => __("You can use initial, inherit or any number with px, em, %, etc. Example- 100px 100px", "upb_parallax"),
						"dependency" => Array("element" => "bg_image_size","value" => array("cstm")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Scroll Effect", "upb_parallax"),
						"param_name" => "bg_img_attach",
						"value" => array(
								__("Move with the content", "upb_parallax") => "scroll",
								__("Fixed at its position", "upb_parallax") => "fixed",								
							),
						"description" => __("Options to set whether a background image is fixed or scroll with the rest of the page.", "upb_parallax"),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-default","vcpb-animated","vcpb-hz-jquery","vcpb-vz-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "number",
						"class" => "",
						"heading" => __("Parallax Speed", "upb_parallax"),
						"param_name" => "parallax_sense",
						"value" =>"30",
						"min"=>"1",
						"max"=>"100",
						"description" => __("Control speed of parallax. Enter value between 1 to 100", "upb_parallax"),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-vz-jquery","vcpb-animated","vcpb-hz-jquery","vcpb-vs-jquery","vcpb-hs-jquery","vcpb-fs-jquery","vcpb-mlvp-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Background Image Posiiton", "upb_parallax"),
						"param_name" => "bg_image_posiiton",
						"value" =>"",	
						"description" => __("You can use any number with px, em, %, etc. Example- 100px 100px.", "upb_parallax"),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-default","vcpb-fix")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Animation Direction", "upb_parallax"),
						"param_name" => "animation_direction",
						"value" => array(
								__("Left to Right", "upb_parallax") => "left-animation",
								__("Right to Left", "upb_parallax") => "right-animation",
								__("Top to Bottom", "upb_parallax") => "top-animation",
								__("Bottom to Top", "upb_parallax") => "bottom-animation",
								
							),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-animated")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Background Repeat", "upb_parallax"),
						"param_name" => "animation_repeat",
						"value" => array(
								__("Repeat", "upb_parallax") => "repeat",
								__("Repeat X", "upb_parallax") => "repeat-x",
								__("Repeat Y", "upb_parallax") => "repeat-y",
							),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-animated")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Link to the video in MP4 Format", "upb_parallax"),
						"param_name" => "video_url",
						"value" => "",
						/*"description" => __("Enter your video URL. You can upload a video through <a href='".home_url()."/wp-admin/media-new.php' target='_blank'>WordPress Media Library</a>, if not done already.", "upb_parallax"),*/
						"dependency" => Array("element" => "bg_type","value" => array("video")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Link to the video in WebM / Ogg Format", "upb_parallax"),
						"param_name" => "video_url_2",
						"value" => "",
						"description" => __("IE, Chrome & Safari <a href='http://www.w3schools.com/html/html5_video.asp' target='_blank'>support</a> MP4 format, while Firefox & Opera prefer WebM / Ogg formats. You can upload the video through <a href='".home_url()."/wp-admin/media-new.php' target='_blank'>WordPress Media Library</a>.", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("video")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Enter YouTube URL of the Video", "upb_parallax"),
						"param_name" => "u_video_url",
						"value" => "",
						"description" => __("Enter YouTube url. Example - YouTube (https://www.youtube.com/watch?v=tSqJIIcxKZM) ", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Extra Options", "upb_parallax"),
						"param_name" => "video_opts",
						"value" => array(
								__("Loop","upb_parallax") => "loop",
								__("Muted","upb_parallax") => "muted",
							),
						/*"description" => __("Select options for the video.", "upb_parallax"),*/
						"dependency" => Array("element" => "bg_type","value" => array("video","u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "attach_image",
						"class" => "",
						"heading" => __("Placeholder Image", "upb_parallax"),
						"param_name" => "video_poster",
						"value" => "",
						"description" => __("Placeholder image is displayed in case background videos are restricted (Ex - on iOS devices).", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("video","u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "number",
						"class" => "",
						"heading" => __("Start Time", "upb_parallax"),
						"param_name" => "u_start_time",
						"value" => "",
						"suffix" => "seconds",
						/*"description" => __("Enter time in seconds from where video start to play.", "upb_parallax"),*/
						"dependency" => Array("element" => "bg_type","value" => array("u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "number",
						"class" => "",
						"heading" => __("Stop Time", "upb_parallax"),
						"param_name" => "u_stop_time",
						"value" => "",
						"suffix" => "seconds",
						"description" => __("You may start / stop the video at any point you would like.", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "chk-switch",
						"class" => "",
						"heading" => __("Play video only when in viewport", "upb_parallax"),
						"param_name" => "viewport_vdo",
						//"admin_label" => true,
						"value" => "",
						"options" => array(
								"viewport_play" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"description" => __("Video will be played only when user is on the particular screen position. Once user scroll away, the video will pause.", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("video","u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "chk-switch",
						"class" => "",
						"heading" => __("Display Controls", "upb_parallax"),
						"param_name" => "enable_controls",
						//"admin_label" => true,
						"value" => "",
						"options" => array(
								"display_control" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"description" => __("Display play / pause controls for the video on bottom right position.", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("video")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Color of Controls Icon", "upb_parallax"),
						"param_name" => "controls_color",
						//"admin_label" => true,
						//"description" => __("Display play / pause controls for the video on bottom right position.", "upb_parallax"),
						"dependency" => Array("element" => "enable_controls","value" => array("display_control")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Background Override (Read Description)", "upb_parallax"),
						"param_name" => "bg_override",
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
							"Browser Full Dimension"=>"browser_size"
						),
						"description" => __("By default, the background will be given to the Visual Composer row. However, in some cases depending on your theme's CSS - it may not fit well to the container you are wishing it would. In that case you will have to select the appropriate value here that gets you desired output..", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("u_iframe","image","video","grad","bg_color","animated")),
						"group" => $group_name,
					)
				);
				
				vc_add_param('vc_row',array(
						"type" => "ult_switch",
						"class" => "",
						"heading" => __("Activate on Mobile", "upb_parallax"),
						"param_name" => "disable_on_mobile_img_parallax",
						//"admin_label" => true,
						"value" => "",
						"options" => array(
								"disable_on_mobile_img_parallax_value" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"group" => $group_name,
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-animated","vcpb-vz-jquery","vcpb-hz-jquery","vcpb-fs-jquery","vcpb-mlvp-jquery")),
					)
				);				
				
				vc_add_param('vc_row',array(
						"type" => "ult_switch",
						"class" => "",
						"heading" => __("Easy Parallax", "upb_parallax"),
						"param_name" => "parallax_content",
						//"admin_label" => true,
						"value" => "",
						"options" => array(
								"parallax_content_value" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"group" => $group_effects,
						'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
						"description" => __("If enabled, the elements inside row - will move slowly as user scrolls.", "upb_parallax")
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Parallax Speed", "upb_parallax"),
						"param_name" => "parallax_content_sense",
						//"admin_label" => true,
						"value" => "30",
						"group" => $group_effects,
						"description" => __("Enter value between 0 to 100", "upb_parallax"),
						"dependency" => Array("element" => "parallax_content", "value" => array("parallax_content_value"))
					)
				);
				vc_add_param('vc_row',array(
						"type" => "ult_switch",
						"class" => "",
						"heading" => __("Fade Effect on Scroll", "upb_parallax"),
						"param_name" => "fadeout_row",
						//"admin_label" => true,
						"value" => "",
						"options" => array(
								"fadeout_row_value" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"group" => $group_effects,
						'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
						"description" => __("If enabled, the the content inside row will fade out slowly as user scrolls down.", "upb_parallax")
					)
				);
				vc_add_param('vc_row',array(
						"type" => "number",
						"class" => "",
						"heading" => __("Viewport Position", "upb_parallax"),
						"param_name" => "fadeout_start_effect",
						"suffix" => "%",
						//"admin_label" => true,
						"value" => "30",
						"group" => $group_effects,
						"description" => __("The area of screen from top where fade out effect will take effect once the row is completely inside that area.", "upb_parallax"),
						"dependency" => Array("element" => "fadeout_row", "value" => array("fadeout_row_value"))
					)
				);
				/*vc_add_param('vc_row',array(
						"type" => "ult_switch",
						"class" => "",
						"heading" => __("Activate Parallax on Mobile", "upb_parallax"),
						"param_name" => "disable_on_mobile",
						//"admin_label" => true,
						"value" => "",
						"options" => array(
								"enable_on_mobile_value" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"group" => $group_effects,
						
					)
				);*/
				
				vc_add_param('vc_row',array(
					'type' => 'ult_switch',
					'heading' => __('Enable Overlay', 'upb_parallax'),
					'param_name' => 'enable_overlay',
					'value' => '',
					'options' => array(
						'enable_overlay_value' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No'
						)
					),
					'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
					'group' => $group_effects,
				));
				vc_add_param('vc_row',array(
					'type' => 'colorpicker',
					'heading' => __('Color', 'upb_parallax'),
					'param_name' => 'overlay_color',
					'value' => '',
					'group' => $group_effects,
					'dependency' => Array('element' => 'enable_overlay', 'value' => array('enable_overlay_value')),
					'description' => __('Select RGBA values or opacity will be set to 20% by default.','upb_parallax')
				));
					
				vc_add_param(
					'vc_row',
					array(
						'type' => 'radio_image_box',
						'heading' => __('Pattern','upb_parallax'),
						'param_name' => 'overlay_pattern',
						'value' => '',
						'options' => $patterns,
						/*'options' => array(
							'image-1' => plugins_url('../assets/images/patterns/01.png',__FILE__),
							'image-2' => plugins_url('../assets/images/patterns/12.png',__FILE__),
						),*/
						'css' => array(
							'width' => '40px',
							'height' => '35px',
							'background-repeat' => 'repeat',
							'background-size' => 'cover' 
						),
						'group' => $group_effects,
						'dependency' => Array('element' => 'enable_overlay', 'value' => array('enable_overlay_value'))
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'number',
						'heading' => __('Pattern Opacity','upb_parallax'),
						'param_name' => 'overlay_pattern_opacity',
						'value' => '80',
						'min' => '0',
						'max' => '100',
						'suffix' => '%',
						'group' => $group_effects,
						'dependency' => Array('element' => 'enable_overlay', 'value' => array('enable_overlay_value')),
						'description' => __('Enter value between 0 to 100 (0 is maximum transparency, while 100 is minimum)','upb_parallax')
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'number',
						'heading' => __('Pattern Size','upb_parallax'),
						'param_name' => 'overlay_pattern_size',
						'value' => '',
						'suffix' => 'px',
						'group' => $group_effects,
						'dependency' => Array('element' => 'enable_overlay', 'value' => array('enable_overlay_value')),
						'description' => __('This is optional; sets the size of the pattern image manually.', 'upb_parallax')
					)
				);
				
				/*vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_param_heading',
						'param_name' => 'ult_seperator_param_heading',
						'class' => 'ult-param-heading',
						'text' => __('Row Seperators','upb_parallax'),
						'group' => $group_effects,
						'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
					)
				);*/
				
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('Seperator ','upb_parallax'),
						'param_name' => 'seperator_enable',
						'value' => '',
						'options' => array(
							'seperator_enable_value' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
						'group' => $group_effects,
					)
				);
				
				/*vc_add_param(
					'vc_row',
					array(
						'type' => 'radio_image_box',
						'heading' => __('Type','upb_parallax'),
						'param_name' => 'seperator_type',
						'value' => '',
						'options' => $separator_imgs,
						/*'options' => array(
							'image-1' => plugins_url('../assets/images/patterns/01.png',__FILE__),
							'image-2' => plugins_url('../assets/images/patterns/12.png',__FILE__),
						),*/
						/*'css' => array(
							'width' => '88px',
							'height' => '48px',
							'background-repeat' => 'no-repeat',
							'background-size' => 'cover' 
						),
						'useextension' => 'false',
						'default' => 'none_seperator',
						'group' => $group_effects,
						//'dependency' => Array('element' => 'enable_overlay', 'value' => array('enable_overlay_value'))
					)
				);*/
				
				vc_add_param(
					'vc_row',
					array(
						'type' => 'dropdown',
						'heading' => __('Type','upb_parallax'),
						'param_name' => 'seperator_type',
						'value' => array(
							__('None','upb_parallax') => 'none_seperator',
							//__('Triangle','upb_parallax') => 'triangle_seperator',
							__('Triangle','upb_parallax') => 'triangle_svg_seperator',
							__('Big Triangle','upb_parallax') => 'xlarge_triangle_seperator',
							__('Big Triangle Left','upb_parallax') => 'xlarge_triangle_left_seperator',
							__('Big Triangle Right','upb_parallax') => 'xlarge_triangle_right_seperator',
							//__('Half Circle','upb_parallax') => 'circle_seperator',
							__('Half Circle','upb_parallax') => 'circle_svg_seperator',
							__('Curve Center','upb_parallax') => 'xlarge_circle_seperator',
							__('Curve Left','upb_parallax') => 'curve_up_seperator',
							__('Curve Right','upb_parallax') => 'curve_down_seperator',
							__('Tilt Left','upb_parallax') => 'tilt_left_seperator',
							__('Tilt Right','upb_parallax') => 'tilt_right_seperator',
							__('Round Split','upb_parallax') => 'round_split_seperator',
							__('Waves','upb_parallax') => 'waves_seperator',
							__('Clouds','upb_parallax') => 'clouds_seperator',
						),
						'group' => $group_effects,
						'dependency' => Array('element' => 'seperator_enable', 'value' => array('seperator_enable_value')),
						'edit_field_class' => 'uvc-divider-content-first vc_column vc_col-sm-12',
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'dropdown',
						'heading' => __('Position','upb_parallax'),
						'param_name' => 'seperator_position',
						'value' => array(
							__('Top','upb_parallax') => 'top_seperator',
							__('Bottom','upb_parallax') => 'bottom_seperator',
							__('Top & Bottom') => 'top_bottom_seperator'
						),
						'group' => $group_effects,
						'dependency' => Array('element' => 'seperator_enable', 'value' => array('seperator_enable_value')),
						'edit_field_class' => 'uvc-divider-content-first vc_column vc_col-sm-12',
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'number',
						'heading' => __('Size','upb_parallax'),
						'param_name' => 'seperator_shape_size',
						'value' => '40',
						'suffix' => 'px',
						'group' => $group_effects,
						'dependency' => Array('element' => 'seperator_type', 'value' => array('triangle_seperator','circle_seperator','round_split_seperator'))
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'number',
						'heading' => __('Height','upb_parallax'),
						'param_name' => 'seperator_svg_height',
						'value' => '60',
						'suffix' => 'px',
						'group' => $group_effects,
						'dependency' => Array('element' => 'seperator_type', 'value' => array('xlarge_triangle_seperator','curve_up_seperator','curve_down_seperator','waves_seperator','clouds_seperator','xlarge_circle_seperator','triangle_svg_seperator','circle_svg_seperator','xlarge_triangle_left_seperator','xlarge_triangle_right_seperator','tilt_left_seperator','tilt_right_seperator'))
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'colorpicker',
						'heading' => __('Background','upb_parallax'),
						'param_name' => 'seperator_shape_background',
						'value' => '#fff',
						'group' => $group_effects,
						'dependency' => Array('element' => 'seperator_type', 'value' => array('xlarge_triangle_seperator','triangle_seperator','circle_seperator','curve_up_seperator','curve_down_seperator','round_split_seperator','waves_seperator','clouds_seperator','xlarge_circle_seperator','triangle_svg_seperator','circle_svg_seperator','xlarge_triangle_left_seperator','xlarge_triangle_right_seperator','tilt_left_seperator','tilt_right_seperator')),
						'description' => __('Mostly, this should be background color of your adjacent row section.')
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'dropdown',
						'heading' => __('Border','upb_parallax'),
						'param_name' => 'seperator_shape_border',
						'value' => array(
							__('None','upb_parallax') => 'none',
							__('Solid','upb_parallax') => 'solid',
							__('Dotted','upb_parallax') => 'dotted',
							__('Dashed','upb_parallax') => 'dashed'
						),
						'group' => $group_effects,
						//'dependency' => Array('element' => 'seperator_enable', 'value' => array('seperator_enable_value')),
						'dependency' => Array('element' => 'seperator_type', 'value' => array('none_seperator','triangle_seperator','circle_seperator','round_split_seperator'))
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'colorpicker',
						'heading' => __('Border Color','upb_parallax'),
						'param_name' => 'seperator_shape_border_color',
						'value' => '',
						'group' => $group_effects,
						//'dependency' => Array('element' => 'seperator_enable', 'value' => array('seperator_enable_value')),
						'dependency' => Array('element' => 'seperator_type', 'value' => array('none_seperator','triangle_seperator','circle_seperator','round_split_seperator'))
					)
				);
				vc_add_param(
					'vc_row',
					array(
						'type' => 'number',
						'heading' => __('Border Width','upb_parallax'),
						'param_name' => 'seperator_shape_border_width',
						'value' => '1',
						'suffix' => 'px',
						'group' => $group_effects,
						//'dependency' => Array('element' => 'seperator_enable', 'value' => array('seperator_enable_value')),
						'dependency' => Array('element' => 'seperator_type', 'value' => array('none_seperator','triangle_seperator','circle_seperator','round_split_seperator')),
						'edit_field_class' => 'uvc-divider-content-last vc_column vc_col-sm-12',
					)
				);
				vc_add_param(
					'vc_row',				
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Icon to display:", "smile"),
						"param_name" => "icon_type",
						"value" => array(
							"None" => "no_icon",
							"Font Icon Manager" => "selector",
							"Custom Image Icon" => "custom",
						),
						'group' => $group_effects,
						"description" => __("Use an existing font icon or upload a custom image.", "smile"),
						'dependency' => Array('element' => 'seperator_enable', 'value' => array('seperator_enable_value')),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "icon_manager",
						"class" => "",
						"heading" => __("Select Icon ","smile"),
						"param_name" => "icon",
						"value" => "",
						'group' => $group_effects,
						"description" => __("Click and select icon of your choice. If you can't find the one that suits for your purpose, you can <a href='admin.php?page=font-icon-Manager' target='_blank'>add new here</a>.", "smile"),
						"dependency" => Array("element" => "icon_type","value" => array("selector")),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "number",
						"class" => "",
						"heading" => __("Size of Icon", "smile"),
						"param_name" => "icon_size",
						"value" => 32,
						"min" => 12,
						"max" => 72,
						"suffix" => "px",
						'group' => $group_effects,
						"description" => __("How big would you like it?", "smile"),
						"dependency" => Array("element" => "icon_type","value" => array("selector")),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Color", "smile"),
						"param_name" => "icon_color",
						"value" => "",
						'group' => $group_effects,
						"description" => __("Give it a nice paint!", "smile"),
						"dependency" => Array("element" => "icon_type","value" => array("selector")),						
					)
				);
				vc_add_param(
					'vc_row',
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
						'group' => $group_effects,
						"description" => __("We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.", "smile"),
						"dependency" => Array("element" => "icon_type","value" => array("selector")),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Background Color", "smile"),
						"param_name" => "icon_color_bg",
						"value" => "",
						'group' => $group_effects,
						"description" => __("Select background color for icon.", "smile"),	
						"dependency" => Array("element" => "icon_style", "value" => array("circle","square","advanced")),
					)
				);
				vc_add_param(
					'vc_row',
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
						'group' => $group_effects,
						"description" => __("Select the border style for icon.","smile"),
						"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Border Color", "smile"),
						"param_name" => "icon_color_border",
						"value" => "#333333",
						'group' => $group_effects,
						"description" => __("Select border color for icon.", "smile"),	
						"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "number",
						"class" => "",
						"heading" => __("Border Width", "smile"),
						"param_name" => "icon_border_size",
						"value" => 1,
						"min" => 1,
						"max" => 10,
						"suffix" => "px",
						'group' => $group_effects,
						"description" => __("Thickness of the border.", "smile"),
						"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "number",
						"class" => "",
						"heading" => __("Border Radius", "smile"),
						"param_name" => "icon_border_radius",
						"value" => 500,
						"min" => 1,
						"max" => 500,
						"suffix" => "px",
						'group' => $group_effects,
						"description" => __("0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).", "smile"),
						"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "number",
						"class" => "",
						"heading" => __("Background Size", "smile"),
						"param_name" => "icon_border_spacing",
						"value" => 50,
						"min" => 30,
						"max" => 500,
						"suffix" => "px",
						'group' => $group_effects,
						"description" => __("Spacing from center of the icon till the boundary of border / background", "smile"),
						"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "attach_image",
						"class" => "",
						"heading" => __("Upload Image Icon:", "smile"),
						"param_name" => "icon_img",
						"value" => "",
						'group' => $group_effects,
						"description" => __("Upload the custom image icon.", "smile"),
						"dependency" => Array("element" => "icon_type","value" => array("custom")),
					)
				);
				vc_add_param(
					'vc_row',
					array(
						"type" => "number",
						"class" => "",
						"heading" => __("Image Width", "smile"),
						"param_name" => "img_width",
						"value" => 48,
						"min" => 16,
						"max" => 512,
						"suffix" => "px",
						'group' => $group_effects,
						"description" => __("Provide image width", "smile"),
						"dependency" => Array("element" => "icon_type","value" => array("custom")),
					)
				);
				
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('Hide Row','upb_parallax'),
						'param_name' => 'ult_hide_row',
						'value' => '',
						'options' => array(
							'ult_hide_row_value' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
						'group' => $group_effects,
					)
				);
				
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('<i class="dashicons dashicons-welcome-view-site"></i> Large Screen','upb_parallax'),
						'param_name' => 'ult_hide_row_large_screen',
						'value' => '',
						'options' => array(
							'large_screen' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'group' => $group_effects,
						"dependency" => Array("element" => "ult_hide_row","value" => array("ult_hide_row_value")),
						'edit_field_class' => 'vc_column vc_col-sm-4',
					)
				);
				
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('<i class="dashicons dashicons-desktop"></i> Desktop','upb_parallax'),
						'param_name' => 'ult_hide_row_desktop',
						'value' => '',
						'options' => array(
							'desktop' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'group' => $group_effects,
						"dependency" => Array("element" => "ult_hide_row","value" => array("ult_hide_row_value")),
						'edit_field_class' => 'vc_column vc_col-sm-4',
					)
				);
				
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('<i class="dashicons dashicons-tablet" style="transform: rotate(90deg);"></i> Tablet','upb_parallax'),
						'param_name' => 'ult_hide_row_tablet',
						'value' => '',
						'options' => array(
							'tablet' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'group' => $group_effects,
						"dependency" => Array("element" => "ult_hide_row","value" => array("ult_hide_row_value")),
						'edit_field_class' => 'vc_column vc_col-sm-4',
					)
				);
				
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('<i class="dashicons dashicons-tablet"></i> Tablet Portrait','upb_parallax'),
						'param_name' => 'ult_hide_row_tablet_small',
						'value' => '',
						'options' => array(
							'xs_tablet' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'group' => $group_effects,
						"dependency" => Array("element" => "ult_hide_row","value" => array("ult_hide_row_value")),
						'edit_field_class' => 'vc_column vc_col-sm-4',
					)
				);
				
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('<i class="dashicons dashicons-smartphone"></i> Mobile','upb_parallax'),
						'param_name' => 'ult_hide_row_mobile',
						'value' => '',
						'options' => array(
							'mobile' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'group' => $group_effects,
						"dependency" => Array("element" => "ult_hide_row","value" => array("ult_hide_row_value")),
						'edit_field_class' => 'vc_column vc_col-sm-4',
					)
				);
				
				vc_add_param(
					'vc_row',
					array(
						'type' => 'ult_switch',
						'heading' => __('<i class="dashicons dashicons-smartphone" style="transform: rotate(90deg);"></i> Mobile Landscape','upb_parallax'),
						'param_name' => 'ult_hide_row_mobile_large',
						'value' => '',
						'options' => array(
							'xl_mobile' => array(
								'on' => 'Yes', 
								'off' => 'No'
							)
						),
						'group' => $group_effects,
						"dependency" => Array("element" => "ult_hide_row","value" => array("ult_hide_row_value")),
						'edit_field_class' => 'vc_column vc_col-sm-4',
					)
				);
				
				/*vc_add_param(
					'vc_row',
					array(
						'type' => 'dropdown',
						'heading' => __('Breakpoint', 'upb_parallax'),
						'param_name' => 'ult_hide_row_breakpoint',
						'value' => array(
							__('Desktop') => 'desktop',
							__('Tablet') => 'tablet',
							__('Tablet Small') => 'xs-tablet',
							__('Mobile') => 'mobile',
							__('Mobile Large') => 'xl-mobile',
						),
						'group' => $group_effects,
						'dependency' => Array('element' => 'ult_hide_row','value' => array('ult_hide_row_value')),
					)			
				);*/
			}
		} /* parallax_init*/
		
		function radio_image_settings_field($settings, $value)
		{
			$default_css = array(
				'width' => '25px',
				'height' => '25px',
				'background-repeat' => 'repeat',
				'background-size' => 'cover'
			);
			$dependency = vc_generate_dependencies_attributes($settings, $value);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$options = isset($settings['options']) ? $settings['options'] : '';
			$css = isset($settings['css']) ? $settings['css'] : $default_css;
			$class = isset($settings['class']) ? $settings['class'] : '';
			$useextension = (isset($settings['useextension']) && $settings['useextension'] != '' ) ? $settings['useextension'] : 'true';
			$default = isset($settings['default']) ? $settings['default'] : 'transperant';
			
			$uni = uniqid();
			
			$output = '';
			$output = '<input id="radio_image_setting_val_'.$uni.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . ' '.$value.' vc_ug_gradient" name="' . $param_name . '"  style="display:none"  value="'.$value.'" '.$dependency.'/>';
			$output .= '<div class="ult-radio-image-box" data-uniqid="'.$uni.'">';
				if($value == 'transperant')
					$checked = 'checked';
				else
					$checked = '';
				$output .= '<label>
					<input type="radio" name="radio_image_'.$uni.'" '.$checked.' class="radio_pattern_image" value="'.$default.'" />
					<span class="pattern-background no-bg" style="background:transperant;"></span>
				</label>';
				foreach($options as $key => $img_url)
				{
					if($value == $key)
						$checked = 'checked';
					else
						$checked = '';
					if($useextension != 'true')
					{
						$temp = pathinfo($key);
						$temp_filename = $temp['filename'];
						$key = $temp_filename;
					}
					$output .= '<label>
						<input type="radio" name="radio_image_'.$uni.'" '.$checked.' class="radio_pattern_image" value="'.$key.'" />
						<span class="pattern-background" style="background:url('.$img_url.')"></span>
					</label>';
				}
			$output .= '</div>';
			$output .= '<style>
				.ult-radio-image-box label > input{ /* HIDE RADIO */
					display:none;
				}
				.ult-radio-image-box label > input + img{ /* IMAGE STYLES */
					cursor:pointer;
				  	border:2px solid transparent;
				}
				.ult-radio-image-box .no-bg {
					border:2px solid #ccc;
				}
				.ult-radio-image-box label > input:checked + img, .ult-radio-image-box label > input:checked + .pattern-background{ /* (CHECKED) IMAGE STYLES */
				  	border:2px solid #f00;
				}
				.pattern-background {';
					foreach($css as $attr => $inine_style)
					{
						$output .= $attr.':'.$inine_style.';';
					}
					$output .= 'display: inline-block;
					border:2px solid transparent;
				}
			</style>';
			$output .= '<script type="text/javascript">
				jQuery(".radio_pattern_image").change(function(){
					var radio_id = jQuery(this).parent().parent().data("uniqid");
					var val = jQuery(this).val();
					jQuery("#radio_image_setting_val_"+radio_id).val(val);
				});
			</script>';
			return $output;
		}
		
		function gradient_picker($settings, $value)
		{
			$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$color1 = isset($settings['color1']) ? $settings['color1'] : ' ';
			$color2 = isset($settings['color2']) ? $settings['color2'] : ' ';			
			$class = isset($settings['class']) ? $settings['class'] : '';
			$uni = uniqid();
			$output = '<div class="vc_ug_control" data-uniqid="'.$uni.'" data-color1="'.$color1.'" data-color2="'.$color2.'">';
			//$output .= '<div class="wpb_element_label" style="margin-top: 10px;">'.__('Gradient Type','upb_parallax').'</div>
			$output .= '<select id="grad_type'.$uni.'" class="grad_type" data-uniqid="'.$uni.'">
				<option value="vertical">Vertical</option>
				<option value="horizontal">Horizontal</option>
				<option value="custom">Custom</option>
			</select>
			<div id="grad_type_custom_wrapper'.$uni.'" class="grad_type_custom_wrapper" style="display:none;"><input type="number" id="grad_type_custom'.$uni.'" placeholder="45" data-uniqid="'.$uni.'" class="grad_custom" style="width: 200px; margin-bottom: 10px;"/> deg</div>';
			$output .= '<div class="wpb_element_label" style="margin-top: 10px;">'.__('Choose Colors','upb_parallax').'</div>';
			$output .= '<div class="grad_hold" id="grad_hold'.$uni.'"></div>';
			$output .= '<div class="grad_trgt" id="grad_target'.$uni.'"></div>';
			
			$output .= '<input id="grad_val'.$uni.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . ' vc_ug_gradient" name="' . $param_name . '"  style="display:none"  value="'.$value.'" '.$dependency.'/></div>';
				
			?>
				<script type="text/javascript">
				jQuery(document).ready(function(){	
						jQuery('.grad_type').change(function(){
							var uni = jQuery(this).data('uniqid');
							var hid = "#grad_hold"+uni;
							var did = "#grad_target"+uni;
							var cid = "#grad_type_custom"+uni;
							var tid = "#grad_val"+uni;
							var cid_wrapper = "#grad_type_custom_wrapper"+uni;
							var orientation = jQuery(this).children('option:selected').val();
							
							if(orientation == 'custom')
							{
								jQuery(cid_wrapper).show();
							}
							else
							{
								jQuery(cid_wrapper).hide();
								if(orientation == 'vertical')
									var ori = 'top';
								else
									var ori = 'left';
								
								jQuery(hid).data('ClassyGradient').setOrientation(ori);
								var newCSS = jQuery(hid).data('ClassyGradient').getCSS();
								jQuery(tid).val(newCSS);
							}
							
						});
				
						jQuery('.grad_custom').on('keyup',function() {
							var uni = jQuery(this).data('uniqid');
							var hid = "#grad_hold"+uni;
							var gid = "#grad_type"+uni;
							var tid = "#grad_val"+uni;
							var orientation = jQuery(this).val()+'deg';
							jQuery(hid).data('ClassyGradient').setOrientation(orientation);
							var newCSS = jQuery(hid).data('ClassyGradient').getCSS();
							jQuery(tid).val(newCSS);
						});
								
						function gradient_pre_defined(){
							jQuery('.vc_ug_control').each(function(){
								var uni = jQuery(this).data('uniqid');
								var hid = "#grad_hold"+uni;
								var did = "#grad_target"+uni;
								var tid = "#grad_val"+uni;
								var oid = "#grad_type"+uni;
								var cid = "#grad_type_custom"+uni;
								var cid_wrapper = "#grad_type_custom_wrapper"+uni;
								var orientation = jQuery(oid).children('option:selected').val();
								var prev_col = jQuery(tid).val();
								
								var is_custom = 'false';
								
								if(prev_col!='')
								{
									if(prev_col.indexOf('-webkit-linear-gradient(top,') != -1)
									{
										var p_l = prev_col.indexOf('-webkit-linear-gradient(top,');
										prev_col = prev_col.substring(p_l+28);
										p_l = prev_col.indexOf(');');
										prev_col = prev_col.substring(0,p_l);
										orientation = 'vertical';
									}
									else if(prev_col.indexOf('-webkit-linear-gradient(left,') != -1)
									{
										var p_l = prev_col.indexOf('-webkit-linear-gradient(left,');
										prev_col = prev_col.substring(p_l+29);
										p_l = prev_col.indexOf(');');
										prev_col = prev_col.substring(0,p_l);
										orientation = 'horizontal';
									}
									else
									{
										var p_l = prev_col.indexOf('-webkit-linear-gradient(');
										
										var subStr = prev_col.match("-webkit-linear-gradient((.*));background: -o");
										
										var prev_col = subStr[1].replace(/\(|\)/g, '');
										
										var temp_col = prev_col;
										
										var t_l = temp_col.indexOf('deg');
										var deg = temp_col.substring(0,t_l);
										
										prev_col = prev_col.substring(t_l+4, prev_col.length);
										
										jQuery(cid).val(deg);
										jQuery(cid_wrapper).show();
										orientation = 'custom';
										is_custom = 'true';
									}
								}
								else
								{
									prev_col ="#e3e3e3 0%";
								}
								
								jQuery(oid).children('option').each(function(i,opt){
									if(opt.value == orientation)
										jQuery(this).attr('selected',true);
										
								});
								
								if(is_custom == 'true')
									orientation = deg+'deg';
								else
								{
									if(orientation == 'vertical')
										orientation = 'top';
									else
										orientation = 'left';
								}
								
								jQuery(hid).ClassyGradient({
									width:350,
									height:25,
									orientation : orientation,	
							        target:did,
							        gradient: prev_col,
							        onChange: function(stringGradient,cssGradient) {
							        	cssGradient = cssGradient.replace('url(data:image/svg+xml;base64,','');
							        	var e_pos = cssGradient.indexOf(';');
							        	cssGradient = cssGradient.substring(e_pos+1);							        	
							        	if(jQuery(tid).parents('.wpb_el_type_gradient').css('display')=='none'){
											//jQuery(tid).val('');	
											cssGradient='';
										}
										jQuery(tid).val(cssGradient);
							        },
							        onInit: function(cssGradient){
							        	//console.log(jQuery(tid).val())
										//check_for_orientation();
							        }
								});
								jQuery('.colorpicker').css('z-index','999999');
							})
						}	
						gradient_pre_defined();					
				})
				</script>
			<?php
			return $output;
		}
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
		function admin_scripts($hook){
			if($hook == "post.php" || $hook == "post-new.php" || $hook == "edit.php"){
				wp_enqueue_script('jquery.colorpicker',plugins_url('../admin/js/jquery.colorpicker.js',__FILE__));
				wp_enqueue_script('jquery.classygradient',plugins_url('../admin/js/jquery.classygradient.min.js',__FILE__));			
				wp_enqueue_style('classycolorpicker.style',plugins_url('../admin/css/jquery.colorpicker.css',__FILE__));
				wp_enqueue_style('classygradient.style',plugins_url('../admin/css/jquery.classygradient.min.css',__FILE__));
				wp_enqueue_style("ultimate-admin-style",plugins_url("../admin/css/style.css",__FILE__));
			}
		}/* end admin_scripts */
		static function front_scripts(){
			/* wp_enqueue_script('jquery.video_bg',plugins_url('../assets/js/ultimate_bg.js',__FILE__),'1.0',array('jQuery')); */	
			wp_enqueue_script('jquery.shake',plugins_url('../assets/js/jparallax.js',__FILE__));
			wp_enqueue_script('jquery.vhparallax',plugins_url('../assets/js/jquery.vhparallax.js',__FILE__));			
			wp_enqueue_style('background-style',plugins_url('../assets/css/background-style.css',__FILE__));
		} /* end front_scripts */
	}
	new VC_Ultimate_Parallax;
}
$ultimate_row = get_option('ultimate_row');
if($ultimate_row == "enable"){
	if ( !function_exists( 'vc_theme_after_vc_row' ) ) {
		function vc_theme_after_vc_row($atts, $content = null) {
			 return VC_Ultimate_Parallax::parallax_shortcode($atts, $content);
			 //return apply_filters( 'parallax_image_video', '', $atts, $content );
			 //return '<div><p>Append this div before shortcode</p></div>';
		}
	}
}
function hex2rgbUltParallax($hex, $opacity) {
	$hex = str_replace("#", "", $hex);
	if (preg_match("/^([a-f0-9]{3}|[a-f0-9]{6})$/i",$hex)):      // check if input string is a valid hex colour code
		if(strlen($hex) == 3) { // three letters code
		   $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		   $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		   $b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else { // six letters coode
		   $r = hexdec(substr($hex,0,2));
		   $g = hexdec(substr($hex,2,2));
		   $b = hexdec(substr($hex,4,2));
		}
		return 'rgba('.implode(",", array($r, $g, $b)).','.$opacity.')';         // returns the rgb values separated by commas, ready for usage in a rgba( rr,gg,bb,aa ) CSS rule
		// return array($r, $g, $b); // alternatively, return the code as an array
	else: return "";  // input string is not a valid hex color code - return a blank value; this can be changed to return a default colour code for example
	endif;
} // hex2rgb()
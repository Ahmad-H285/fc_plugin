<?php
/*
* Add-on Name: Ultimate Fancy Text
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists('Ultimate_FancyText')){
	class Ultimate_FancyText{
		
		function __construct(){
			add_action('admin_init',array($this,'ultimate_fancytext_init'));
			add_shortcode('ultimate_fancytext',array($this,'ultimate_fancytext_shortcode'));
			add_action('wp_enqueue_scripts', array($this, 'register_fancytext_assets'));
		}
		function register_fancytext_assets()
		{
			wp_register_style('ultimate-fancytext-style',plugins_url('../assets/css/fancytext.css',__FILE__),array(),ULTIMATE_VERSION);
			wp_register_script('ultimate-typed-js',plugins_url('../assets/js/typed.js',__FILE__),array(),ULTIMATE_VERSION);
			wp_register_script('ultimate-vticker-js',plugins_url('../assets/js/vticker.js',__FILE__),array(),ULTIMATE_VERSION);
		}

		function ultimate_fancytext_init(){
			if(function_exists("vc_map")){
				vc_map(
					array(
					   "name" => __("Fancy Text"),
					   "base" => "ultimate_fancytext",
					   "class" => "vc_ultimate_fancytext",
					   "icon" => "vc_ultimate_fancytext",
					   "category" => __("Ultimate VC Addons",'smile'),
					   "description" => __("Fancy lines with animation effects.","js_composer"),
					   "params" => array(
					   		array(
								"type" => "textfield",
								"param_name" => "fancytext_prefix",
								"heading" => "Prefix",
								"value" => "",
							),
							array(
								'type' => 'textarea',
								'heading' => __( 'Fancy Text', 'js_composer' ),
								'param_name' => 'fancytext_strings',
								'description' => __('Enter each string on a new line'),
								'admin_label' => true
							),
							array(
								"type" => "textfield",
								"param_name" => "fancytext_suffix",
								"heading" => "Suffix",
								"value" => "",
							),
							array(
								"type" => "dropdown",
								"heading" => __("Effect", "js_composer"),
								"param_name" => 'fancytext_effect',
								"value" => array(
									__("Type", "js_composer") => "typewriter",
									__("Slide Up", "js_composer") => "ticker"
								),
							),

							array(
								"type" => "dropdown",
								"heading" => __("Markup","smile"),
								"param_name" => "fancytext_tag",
								"value" => array(
									__("div","smile") => "div",
									__("p","smile") => "p",
									__("H1","smile") => "h1",
									__("H2","smile") => "h2",
									__("H3","smile") => "h3",
									__("H4","smile") => "h4",
									__("H5","smile") => "h5",
									__("H6","smile") => "h6",
								)
							),
							array(
								"type" => "dropdown",
								"heading" => __("Alignment", "js_composer"),
								"param_name" => "fancytext_align",
								"value" => array(
									__("Center","js_composer") => "center",
									__("Left","js_composer") => "left",
									__("Right","js_composer") => "right"
								)
							),
							array(
								"type" => "number",
								"heading" => __("Type Speed", "smile"),
								"param_name" => "strings_textspeed",
								"min" => 0,
								"value" => 35,
								"suffix" => "In Miliseconds",
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter")),
								"description" => __("Speed at which line progresses / Speed of typing effect.", "js_composer")
							),
							array(
								"type" => "number",
								"heading" => __("Backspeed", "smile"),
								"param_name" => "strings_backspeed",
								"min" => 0,
								"value" => 0,
								"suffix" => "In Miliseconds",
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter")),
								"description" => __("Speed of delete / backspace effect.", "js_composer")
							),

							array(
								"type" => "number",
								"heading" => __("Start Delay", "smile"),
								"param_name" => "strings_startdelay",
								"min" => 0,
								"value" => 200,
								"suffix" => "In Miliseconds",
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter")),
								"description" => __("Example - If set to 5000, the first string will appear after 5 seconds.", "js_composer")
							),
							
							array(
								"type" => "number",
								"heading" => __("Back Delay", "smile"),
								"param_name" => "strings_backdelay",
								"min" => 0,
								"value" => 1500,
								"suffix" => "In Miliseconds",
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter")),
								"description" => __("Example - If set to 5000, the string will remain visible for 5 seconds before backspace effect.","js_composer")
							),
							array(
								"type" => "ult_switch",
								"heading" => "Enable Loop",
								"param_name" => "typewriter_loop",
								"value" => "true",
								"options" => array(
									"true" => array(
										"label" => "",
										"on" => "Yes",
										"off" => "No"
									)
								),
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter"))
							),
							array(
								"type" => "ult_switch",
								"heading" => __("Show Cursor"),
								"param_name" => "typewriter_cursor",
								"value" => "true",
								"options" => array(
									"true" => array(
										"label" => "",
										"on" => "Yes",
										"off" => "No",
									)
								),
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("typewriter"))
							),
							array(
								"type" => "textfield",
								"heading" => "Cursor Text",
								"param_name" => "typewriter_cursor_text",
								"value" => "|",
								"group" => "Advanced Settings",
								"dependency" => array("element" => "typewriter_cursor", "value" => array("true"))
							),
							array(
								"type" => "number",
								"heading" => __("Animation Speed", "smile"),
								"param_name" => "strings_tickerspeed",
								"min" => 0,
								"value" => 200,
								"suffix" => "In Miliseconds",
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("ticker")),
								"description" => __("Duration of 'Slide Up' animation", "js_composer")
							),
							array(
								"type" => "number",
								"heading" => __("Pause Time", "smile"),
								"param_name" => "ticker_wait_time",
								"min" => 0,
								"value" => "3000",
								"suffix" => "In Miliseconds",
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("ticker")),
								"description" => __("How long the string should stay visible?","js_composer")
							),
							array(
								"type" => "number",
								"heading" => __("Show Items", "smile"),
								"param_name" => "ticker_show_items",
								"min" => 1,
								"value" => 1,
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("ticker")),
								"description" => __("How many items should be visible at a time?", "js_composer")
							),
							array(
								"type" => "ult_switch",
								"heading" => __("Pause on Hover"),
								"param_name" => "ticker_hover_pause",
								"value" => "",
								"options" => array(
									"true" => array(
										"label" => "",
										"on" => "Yes",
										"off" => "No",
									)
								),
								"group" => "Advanced Settings",
								"dependency" => array("element" => "fancytext_effect", "value" => array("ticker"))
							),
							array(
								"type" => "textfield",
								"heading" => __("Extra Class","smile"),
								"param_name" => "ex_class"
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("Font Family", "smile"),
								"param_name" => "strings_font_family",
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("Font Style", "smile"),
								"param_name"	=>	"strings_font_style",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "font-size",
								"heading" => __("Font Size", "smile"),
								"param_name" => "strings_font_size",
								"min" => 10,
								"suffix" => "px",
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Font Color", "smile"),
								"param_name" => "strings_color",
								"value" => "",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Line Height", "smile"),
								"param_name" => "strings_line_height",
								"value" => "",
								"suffix" => "px",
								"group" => "Typography"
							),
							array(
								"type" => "heading",
								"sub_heading" => "<span style='display: block;'><a href='http://bsf.io/t5ir4' target='_blank'>Watch Video Tutorial &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;'></span></a></span>",
								"param_name" => "notification",
								'edit_field_class' => 'ult-param-important-wrapper ult-dashicon ult-align-right ult-bold-font ult-blue-font vc_column vc_col-sm-12',
							),
						)
					)
				);
			}
		}
		function ultimate_fancytext_shortcode($atts, $content = null){
			
			wp_enqueue_script('jquery');			
			wp_enqueue_style('ultimate-fancytext-style');
			
			$output = $fancytext_strings = $fancytext_prefix = $fancytext_suffix = $fancytext_effect = $strings_textspeed = $strings_tickerspeed = $typewriter_cursor = $typewriter_cursor_text = $typewriter_loop = $fancytext_align = $strings_font_family = $strings_font_style = $strings_font_size = $strings_color = $strings_line_height = $strings_startdelay = $strings_backspeed = $strings_backdelay = $ticker_wait_time = $ticker_show_items = $ticker_hover_pause = $ex_class = '';
			
			$id = uniqid(rand());
			
			extract(shortcode_atts(array(
				'fancytext_strings' => '',
				'fancytext_prefix' => '',
				'fancytext_suffix' => '',
				'fancytext_effect' => '',
				'strings_textspeed' => '35',
				'strings_tickerspeed' => '200',
				'typewriter_loop' => 'false',
				'fancytext_tag' => 'div',
				'fancytext_align' => 'center',
				'strings_font_family' => '',
				'strings_font_style' => '',
				'strings_font_size' => '',
				'strings_color' => '',
				'strings_line_height' => '',
				'strings_startdelay' => '200',
				'strings_backspeed' => '0',
				'strings_backdelay' => '1500',
				'typewriter_cursor' => 'true',
				'typewriter_cursor_text' => '|',
				'ticker_wait_time' => '3000',
				'ticker_show_items' => '1',
				'ticker_hover_pause' => 'true',
				'ex_class' => ''
			),$atts));
			
			$string_inline_style = '';
			if($strings_font_family != '')
			{
				$font_family = get_ultimate_font_family($strings_font_family);
				$string_inline_style .= 'font-family:\''.$font_family.'\';';
			}
			
			$string_inline_style .= get_ultimate_font_style($strings_font_style);
			
			if($strings_font_size != '')
				$string_inline_style .= 'font-size:'.$strings_font_size.'px;';
			
			if($strings_color != '')
				$string_inline_style .= 'color:'.$strings_color.';';
				
			if($strings_line_height != '')
				$string_inline_style .= 'line-height:'.$strings_line_height.'px;';
				
			if($fancytext_align != '')
				$string_inline_style .= 'text-align:'.$fancytext_align.';';
			
			// Order of replacement
			$order   = array("\r\n", "\n", "\r", "<br/>", "<br>");
			$replace = ',';
			
			// Processes \r\n's first so they aren't converted twice.
			$str = str_replace($order, $replace, $fancytext_strings);
			
			$lines = explode(",", $str);
			
			$count_lines = count($lines);
			
			$ex_class .= ' uvc-type-align-'.$fancytext_align.' ';
			if($fancytext_prefix == '')
				$ex_class .= 'uvc-type-no-prefix';
			
			$output = '<'.$fancytext_tag.' class="uvc-type-wrap '.$ex_class.'" style="'.$string_inline_style.'">';
				if(trim($fancytext_prefix) != '')
				{
					$output .= '<span class="ultimate-'.$fancytext_effect.'-prefix">'.trim($fancytext_prefix).'&nbsp;</span>';
				}
				if($fancytext_effect == 'ticker')
				{
					wp_enqueue_script('ultimate-vticker-js');
					$output .= '<div id="vticker-'.$id.'" class="ultimate-vticker '.$fancytext_effect.'"><ul>';
						foreach($lines as $line)
						{
							$output .= '<li>'.strip_tags($line).'</li>';
						}
					$output .= '</ul></div>';
					
					if($ticker_hover_pause != 'true')
						$ticker_hover_pause = 'false';
					
					$output .= '<script type="text/javascript">
						jQuery(function($){
							$("#vticker-'.$id.'")
									.vTicker("init", 
									{
										speed: '.$strings_tickerspeed.',
										showItems: '.$ticker_show_items.',
										pause: '.$ticker_wait_time.',
										mousePause : '.$ticker_hover_pause.'
									}
								);
						});
					</script>';
				}
				else
				{
					wp_enqueue_script('ultimate-typed-js');
					
					$output .= '<span id="typed-'.$id.'" class="ultimate-typed-main"></span>';
					
					$strings = '['; 
						foreach($lines as $key => $line)  
						{ 
							$strings .= '"'.__(trim(strip_tags($line)),'js_composer').'"';
							if($key != ($count_lines-1))
								$strings .= ','; 
						} 
					$strings .= ']';
					
					if($typewriter_loop != 'true')
						$typewriter_loop = 'false';
						
					if($typewriter_cursor != 'true')
						$typewriter_cursor = 'false';
					
					$output .= '<script type="text/javascript">
						jQuery(function($){
							$("#typed-'.$id.'").typed({
								strings: '.$strings.',
								typeSpeed: '.$strings_textspeed.', // typing speed
								backSpeed: '.$strings_backspeed.', // backspacing speed
								startDelay: '.$strings_startdelay.', // time before typing starts
								backDelay: '.$strings_backdelay.', // pause before backspacing
								loop: '.$typewriter_loop.', // loop on or off (true or false)
								loopCount: false, // number of loops, false = infinite
								showCursor: '.$typewriter_cursor.',
								cursorChar: "'.$typewriter_cursor_text.'",
								attr: null, // attribute to type, null = text for everything except inputs, which default to placeholder
								callback: function(){ } // call function after typing is done
							});
						});
					</script>';
				}
				if(trim($fancytext_suffix) != '')
				{
					$output .= '<span class="ultimate-'.$fancytext_effect.'-suffix">&nbsp;'.trim($fancytext_suffix).'</span>';
				}
			$output .= '</'.$fancytext_tag.'>';
			
			
			
			$args = array(
				$strings_font_family
			);
			enquque_ultimate_google_fonts($args);
			
			return $output;
		}
	} // end class
	new Ultimate_FancyText;
}
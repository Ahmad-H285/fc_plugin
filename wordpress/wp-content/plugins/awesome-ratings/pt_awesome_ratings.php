<?php

class PT_Awesome_Ratings extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-star"></span>';
	public $name = 'Awesome Ratings';
	public $description = 'Add list of the top rated post types';
	public $category = 'Elements';
	public $default_options = array(
		'post_type' => '',
		'count' => '5',
		'order' => 'DESC',
		'element_name' => 'Awesome Ratings',
		'extra_class' => ''
	);	

	function __construct(){
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );
		include( AR_PATH.'/loop.php' );

	}

	public function shortcode_options( $atts ){
		global $ar;
		extract( shortcode_atts( $this->default_options, $atts ) );
		$options = array(
			array(
				'id' => 'element_name',
				'title' => __( 'Element Name', 'pt-builder' ),
				'desc' => __( 'Input custom element name for easy recognition.', 'pt-builder' ),
				'type' => 'textfield',
				'value' => $element_name
			),
			array(
				'id' => 'post_type',
				'title' => __( 'Post Type', 'awesome-ratings' ),
				'desc' => __( 'Select which post type to display.', 'awesome-ratings' ),
				'type' => 'select',
				'options' => $ar->get_allowed_post_types(),
				'value' => $post_type
			),	
			array(
				'id' => 'count',
				'title' => __( 'Count', 'awesome-ratings' ),
				'desc' => __( 'Input how many posts to display.', 'awesome-ratings' ),
				'type' => 'textfield',
				'value' => $count
			),
			array(
				'id' => 'order',
				'title' => __( 'Order', 'awesome-awesome' ),
				'desc' => __( 'Select how to order post types.', 'awesome-ratings' ),
				'type' => 'select',
				'options' => array(
					'DESC' => __( 'Descending', 'awesome-ratings' ),
					'ASC' => __( 'Ascending', 'awesome-ratings' )
				),
				'value' => $order
			),
			array(
				'id' => 'extra_class',
				'title' => __( 'Extra Class', 'pt-builder' ),
				'desc' => __( 'Input extra class for the element.', 'pt-builder' ),
				'type' => 'textfield',
				'value' => $extra_class
			),			
		);
		
		$options_html = new PT_Options( $options );
		
		return $options_html->get_options();
	}	
}

new PT_Awesome_Ratings();

?>
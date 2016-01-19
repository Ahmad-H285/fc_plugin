<?php
/**
 * Plugin Name: Awesome Ratings
 * Plugin URI: http://codecanyon.net/user/DJMiMi
 * Description: Font Awesome Ratings For All Post Types
 * Version: 1.1
 * Author: DJMiMi
 * Author URI: http://codecanyon.net/user/DJMiMi
 * License: GPL2
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;
 
if ( ! defined( 'AR_PATH') ){
	define( 'AR_PATH', str_replace( '\\', '/', dirname( __FILE__ ) ) );
}
if ( ! defined( 'AR_URL' ) ){
	define( 'AR_URL', str_replace( str_replace( '\\', '/', WP_CONTENT_DIR ), str_replace( '\\', '/', WP_CONTENT_URL ), AR_PATH ) );
}
require_once( AR_PATH."/widget.php" );

add_action( 'pt_element_extend', 'awesome_ratings_extend_elements' );
function awesome_ratings_extend_elements(){
	include_once( AR_PATH.'/pt_awesome_ratings.php' );
}


class Awesome_Ratings{
	public $defaults = array(
		'allowed_types' => array(),
		'number' => '5',
		'color' => '#e8c020',
		'color_hvr' => '#dd9e1f',
		'color_empty' => '#e5e5e5',
		'font_size' => '14px',
		'position' => 'before',
		'align' => 'left',
		'margins' => '30px 0px;',
		'info_color' => '#454545',
		'info_font_size' => '13px',
		'override' => '0'
	);
	
	public $options = array();
	
	function __construct(){
		$this->get_options();
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ));
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ));
		add_action('plugins_loaded', array( $this, 'load_text_domain' ));
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'admin_menu', array( $this, 'register_options' ) );
		add_action( 'init', array( $this, 'add_to_vc' ) );
		add_action( 'wp_head', array( $this, 'ajaxur_head' ) );
		/* save post meta */
		add_action( 'save_post', array( $this, 'save_post_meta' ), 10, 2 );
				
		$this->handle_columns();

		/* save rate */
		add_action('wp_ajax_ar_rate', array( $this, 'ar_rate' ));
		add_action('wp_ajax_nopriv_ar_rate', array( $this, 'ar_rate' ));		
		
		/* clear rate */
		add_action('wp_ajax_clear_rates', array( $this, 'clear_rates' ));
		add_action('wp_ajax_nopriv_clear_rates', array( $this, 'clear_rates' ));

		/* ad shortcode */
		add_shortcode( 'awesome_ratings', array( $this, 'awesome_ratings_shortcode' ) );
		add_shortcode( 'awesome_ratings_list', array( $this, 'awesome_ratings_list_shortcode' ) );
		
		add_filter('the_content', array( $this, 'show_rating' ));
		add_filter('get_the_excerpt', array( $this, 'show_rating' ));
	}	
	
	function ajaxur_head(){
		echo '<script type="text/javascript">var ajaxurl = \'' . admin_url('admin-ajax.php') . '\';</script>';
	}
	
	function set_options(){
		update_option( 'ar_option', $this->options );
	}

	function get_options(){
		$saved = get_option( 'ar_option' );
		if( !empty( $saved ) ){
			$this->options = $saved;
		}
		else{
			$this->options = $this->defaults;
		}
	}
	
	function register_options(){
		add_submenu_page( 'options-general.php', __('Awesome Ratings', 'awesome-ratings'), __('Awesome Ratings', 'awesome-ratings'), 'manage_options', 'awesome-options', array( $this, 'ar_options' ));
	}	
	
	function ar_options(){
		if( isset( $_POST['ar_options'] ) ){
			if( !isset( $_POST['ar_options']['allowed_types'] ) ){
				$_POST['ar_options']['allowed_types'] = array();
			}
			$this->update_options( $_POST['ar_options'] );
			$this->set_options();
			
			$this->throw_info( __( 'Settings are saved.', 'awesome-ratings' ), 'success' );
		}	
		extract( $this->options );
		$ar_options = true;
		require_once( AR_PATH."/options.php" );
	}
	
	function throw_info( $message, $type, $echo = true ){
		$class = "";
		switch( $type ){
			case 'success'  : $class = "updated"; break;
			case 'notice'	: $class = "update-nag"; break;
			case 'error'	: $class = "error"; break;
			default			: $class = "updated";
		}
		
		$message = '<div id="message" class="'.$class.'"><p>'.$message.'</p></div>';
		if( $echo === true ){
			echo $message;
		}
		else{
			return $message;
		}
	}	
	
	function create_style( $post_id = '' ){
		extract( $this->options );
		if( empty( $post_id ) ){
			$post_id = get_the_ID();
		}
		return '
			<style>
				.ar_'.$post_id.'{
					display: block;
					width: 100%;
					text-align: '.$align.';
					margin: '.$margins.';
				}
				.ar_'.$post_id.' .fa{
					font-size: '.$font_size.';
					transition:all .2s ease-in-out;
					-moz-transition:all .2s ease-in-out;
					-webkit-transition:all .2s ease-in-out;
					-o-transition: all .2s ease-in-out;
					cursor: pointer;					
				}
				
				.ar_'.$post_id.' .fa-star, .ar_'.$post_id.' .fa-star-half-o{
					color: '.$color.';
				}
				.ar_'.$post_id.' .ar-hover,
				.ar_'.$post_id.' .fa-spin{
					color: '.$color_hvr.';
				}
				.ar_'.$post_id.' .fa-star-o{
					color: '.$color_empty.';
				}
				
				.ar_'.$post_id.' span{
					color: '.$info_color.';
					font-size: '.$info_font_size.';
				}
			</style>
		';
	}
	
	function update_options( $metas ){
		if( !empty( $metas[0] ) ){
			$metas = array_shift( $metas );
		}
		if( !empty( $metas ) ){
			$this->options = array_merge( $this->defaults, $metas );
		}
		else{
			$this->get_options();
		}
	}
	
	function check_post_meta( $post_id = "" ){		
		if( empty( $post_id ) ){
			$post_id = get_the_ID();
		}
		$saved_meta = get_post_meta( $post_id, 'ar_options' );		
		$this->update_options( $saved_meta );
	}
	
	function show_rating( $content ){	
		$this->check_post_meta();
		if( in_array( get_post_type(), $this->options['allowed_types'] )){
			if( is_single() ){
				$rates = $this->calculate_average( get_the_ID() );
				$content .= '<div style="display: none;" itemscope itemtype="http://schema.org/Restaurant">
				  <span itemprop="name">'.get_the_title().'</span>
				  <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
				    <span itemprop="ratingValue">'.$rates['average'].'</span> stars -
				    based on <span itemprop="reviewCount">'.$rates['rates'].'</span> rates
				  </div>
				</div>';
			}		
			$ratings = $this->get_ratings();
			extract( $this->options );
			if( $position == 'before' ){
				$content = $ratings.$content;
			}
			else{
				$content = $content.$ratings;
			}
		}
		
		return $content;
	}
	
	function get_allowed_post_types(){
		$allowed = array();
		if( !empty( $this->options['allowed_types'] ) ){
			foreach( $this->options['allowed_types'] as $post_type ){
				$allowed[$post_type] = $post_type;
			}
		}
		return $allowed;
	}
	
	function awesome_ratings_list_shortcode( $atts ){
		extract( shortcode_atts(array(
			'post_type' => '',
			'count' => '5',
			'order' => 'DESC',
			'extra_class' => ''
		), $atts, 'awesome_ratings_list'));
		
		include( AR_PATH.'/loop.php' );
	}
	
	/* add to visual composer */
	function add_to_vc(){
		if( function_exists( 'vc_map' ) ){
			vc_map( array(
			   "name" => __( 'Awesome Ratings', 'awesome-ratings' ),
			   "base" => "awesome_ratings_list",
			   "class" => "",
			   "icon" => 'awesome-ratings_icon',
			   "category" => __( 'Content', 'awesome-ratings' ),
			   "params" => array(  	  
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __( 'Post Type', 'awesome-ratings' ),
						"param_name" => "post_type",
						"value" => $this->get_allowed_post_types(),
						"description" => __( 'Select which post type to display', 'awesome-ratings' )
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __( 'Count', 'awesome-ratings' ),
						"param_name" => "count",
						"value" => '5',
						"description" => __( 'Input how many posts to display.', 'awesome-ratings' )
					),				
					
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __( 'Order', 'awesome-ratings' ),
						"param_name" => "order",
						"value" => array(
							__( 'Descending', 'awesome-ratings' ) => 'DESC',
							__( 'Ascending', 'awesome-ratings' ) => 'ASC',
						),
						"description" => __( 'Select how to order post types.', 'awesome-ratings' )
					), 
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __( 'Extra Class', 'awesome-ratings' ),
						"param_name" => "extra_class",
						"value" => '',
						"description" => __( 'Input custom class for the list.', 'awesome-ratings' )
					),	
				)
			) );
		}
	}
	
	function handle_columns(){
		if( !empty( $this->options['allowed_types'] ) ){
			foreach( $this->options['allowed_types'] as $post_type ){
				add_filter( 'manage_edit-'.$post_type.'_columns', array( $this, 'set_rating_column' ) );
				add_action( 'manage_'.$post_type.'_posts_custom_column' , array( $this, 'rating_column' ) , 10, 2 );
				
				/* sortable */
				add_filter( 'manage_edit-'.$post_type.'_sortable_columns', array( $this, 'set_sortable_columns' ) );
				add_action( 'pre_get_posts', array( $this, 'sort_by_custom' ) );
			}
		}
	}
	
	function set_rating_column( $columns ){
		$columns = array_slice($columns, 0, count($columns) - 1, true) + array("ar_average" => __( 'Average Rate', 'awesome-ratings' ), "ar_rates" => __( 'Rates', 'awesome-ratings' )) + array_slice($columns, count($columns) - 1, count($columns) - 1, true) ;	
		return $columns;
	}
	
	function rating_column( $column, $post_id ){
		switch ( $column ) {
			case 'ar_average' :
				$post_meta = get_post_meta( $post_id, 'ar_average' );
				$post_meta = array_shift( $post_meta );
				if( !empty( $post_meta ) ){
					echo $post_meta;
				}
				else{
					echo 'N/A';
				}
				break;
				
			case 'ar_rates':
				$post_meta = get_post_meta( $post_id, 'ar_rates' );
				$post_meta = array_shift( $post_meta );
				if( !empty( $post_meta ) ){
					echo $post_meta;
				}
				else{
					echo '0';
				}			
				
				break;			
		}	
	}
	
	function set_sortable_columns( $columns ){
		$columns['ar_average'] = 'ar_average';
		$columns['ar_rates'] = 'ar_rates';
		
		return $columns;
	}
		
	function sort_by_custom( $query ) {
		if( ! is_admin() )
			return;
	 
		$orderby = $query->get( 'orderby');
	 
		if( 'ar_average' == $orderby ) {
			$query->set( 'meta_key', 'ar_average' );
			$query->set( 'orderby', 'meta_value_num' );
		}
		else if( 'ar_rates' == $orderby ){
			$query->set( 'meta_key', 'ar_rates' );
			$query->set( 'orderby', 'meta_value_num' );
		}
	}	
	
	function can_rate( $post_id = '' ){
		global $wpdb;
		if( empty( $post_id ) ){
			$post_id = get_the_ID();
		}
		$check_rate = $wpdb->get_results( "SELECT * FROM {$wpdb->postmeta} WHERE post_id='".$post_id."' AND meta_key='ar_rating_ip' AND meta_value='".$_SERVER['REMOTE_ADDR']."'" );
		$check_rate = array_shift( $check_rate );

		if( empty( $check_rate ) ){
			return true;
		}
		else{
			return false;
		}
	}
	
	function clear_rates(){
		global $wpdb;
		$post_id = isset( $_POST['pot_id'] ) ? $_POST['post_id'] : '';
		$filter = '';
		if( !empty( $post_id ) ){
			$filter = "post_id={$post_id} AND ";
		}
		
		$res = $wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE {$filter}meta_key='ar_rating' OR meta_key='ar_rating_ip' OR meta_key='ar_average'");
		
		if( $res ){
			echo __( 'Rates have been cleared.', 'awesome-ratings' );
		}
		else{
			echo __( 'Failed to clear rates, please try again.', 'awesome-ratings' );
		}
		
		die();
	}
	
	function ar_rate(){		
		$post_id = $_POST['post_id'];
		$this->check_post_meta( $post_id );
		$rate = $_POST['rate'];
		$check_rate = $this->can_rate( $post_id );
		if( $check_rate ){
			
			add_post_meta( $post_id, 'ar_rating', $rate );
			add_post_meta( $post_id, 'ar_rating_ip', $_SERVER['REMOTE_ADDR'] );	
			
			$result = $this->calculate_average( $post_id );
			
			update_post_meta( $post_id, 'ar_average', $result['average'] );	
			update_post_meta( $post_id, 'ar_rates', $result['rates'] );
		}
		
		echo $this->calculate_ratings( $post_id );
		die();
	}
	
	function calculate_average( $post_id ){
		global $wpdb;
		$average = 0;
		
		$result = $wpdb->get_results( "SELECT COUNT(*) AS count, SUM(meta_value) AS sum FROM {$wpdb->postmeta} WHERE post_id='".$post_id."' AND meta_key='ar_rating'" );
		$result = array_shift( $result );
		if( $result->count > 0 ){
			$average = $result->sum / $result->count;
		}
		
		return array(
			'average' => number_format( $average, 2 ),
			'rates' => $result->count
		);
	}
	
	function calculate_ratings( $post_id ){	
		extract( $this->options );
		$result = $this->calculate_average( $post_id );

		$stars = array();
		if( $result['average'] < 1 ){
			for( $i=1; $i<=$number; $i++ ){
				$stars[] = '<i class="fa fa-star-o"></i>';
			}
		}
		else{
			$flag = false;
			for( $i=1; $i<=$number; $i+=0.5 ){
				if( $i <= $result['average'] ){
					if( floor( $i ) == $i ){
						$stars[] = '<i class="fa fa-star"></i>';
					}
				}
				else{
					if( !$flag ){
						if( floor( $i ) == $i ){
							$stars[] = '<i class="fa fa-star-half-o"></i>';
						}
						$flag = true;
					}
					else{
						if( floor( $i ) == $i ){
							$stars[] = '<i class="fa fa-star-o"></i>';
						}
					}
				}
			}
		}

		$votes = $result['rates'].' '.( ( $result['rates'] == 1 ) ? __( 'vote', 'awesome-ratings' ) : __( 'votes', 'awesome-ratings' ) );

		return join( "", $stars).' <span>'.$result['average'].' ('.$votes.')</span>';
	}

	function get_ratings( $post_id = '' ){
	
		if( empty( $post_id ) ){
			$post_id = get_the_ID();
		}
		
		$this->check_post_meta( $post_id );
		$style = $this->create_style();			
		$rate = $this->calculate_ratings( $post_id );

		$can_rate = 'no';
		$check_rate = $this->can_rate();
		if( $check_rate ){
			$can_rate = 'yes';
		}

		return $style.'<div class="ar_'.get_the_ID().' ar-ratings" data-can_rate="'.$can_rate.'" data-post_id="'.$post_id.'">
				 	'.$rate.'
				</div>';
	}
	
	function save_post_meta( $post_id, $post ){
		global $wpdb;
		$post_type = get_post_type_object( $post->post_type );

		
		/* Check if the current user has permission to edit the post. */
		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ){
			return $post_id;
		}
		
		/* Check autosave */
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		
		/* deete the old records so there is not some lose ends */
		if( isset( $_POST['ar_options']['override'] ) ){
			$_POST['ar_options']['allowed_types'] = $this->options['allowed_types'];
			$this->update_options( $_POST['ar_options'] );
			update_post_meta( $post_id, 'ar_options', $this->options );
		}
		else{
			delete_post_meta( $post_id, 'ar_options' );
		}
		
		return $post_id;
	}
		
	function single_options( $post ){
		$post_custom = get_post_meta( $post->ID, 'ar_options' );
		
		$this->update_options( $post_custom );

		extract( $this->options );
		require_once( AR_PATH."/options.php" );
	}
		
	function add_meta_box( $post_type ){
		if( in_array( $post_type, $this->options['allowed_types'] ) ){
			add_meta_box( 'shortcode', __( 'Awesome Ratings', 'awesome-ratings' ), array( $this, 'single_options' ), $post_type, 'side' );
		}
	}
	
	
	function load_text_domain(){
		load_plugin_textdomain( 'awesome-ratings', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );	
	}	

	
	function awesome_ratings_shortcode( $attr ){
		extract( shortcode_atts(array(
			'post_id' => '',
		), $attr, 'awesome_ratings'));
		
		if( !empty( $post_id ) ){
			if( in_array( get_post_type( $post_id ), $this->options['allowed_types'] ) ){
				return $this->get_ratings( $post_id );
			}
		}
	}

	function admin_scripts(){
		wp_enqueue_style('awesome_ratings_vc_icon', trailingslashit( AR_URL ) . 'assets/css/vc_icon_style.css');
	
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );
		
		wp_enqueue_style( 'awesome-ratings-style', trailingslashit( AR_URL ) . 'assets/css/awesome-ratings.css' );
		wp_enqueue_style( 'font-awesome', trailingslashit( AR_URL ) . 'assets/css/font-awesome.min.css' );
		
		wp_enqueue_script( 'awesome-ratings', trailingslashit( AR_URL ) . 'assets/js/awesome-ratings-admin.js' );		
	}
	
	function frontend_scripts(){
		wp_enqueue_script( 'jquery' );

		wp_enqueue_style( 'font-awesome', trailingslashit( AR_URL ) . 'assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'awesome-ratings-style', trailingslashit( AR_URL ) . 'assets/css/awesome-ratings.css' );
		wp_enqueue_script( 'awesome-ratings', trailingslashit( AR_URL ) . 'assets/js/awesome-ratings.js' );
	}	
}
$ar = new Awesome_Ratings();
?>
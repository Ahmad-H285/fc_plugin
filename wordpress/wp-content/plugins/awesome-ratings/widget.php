<?php
class Awesome_Ratings_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct('awesome_ratings', __('Awesome Ratings Widget','awesome-ratings'), array('description' =>__('Awesome Ratings Widget','awesome-ratings') ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title		= !empty( $instance['title'] ) ? $instance['title'] : __( 'Awesome Ratigns', 'awesome-ratings' );
		$post_type 	= $instance['post_type'];
		$count 	= !empty( $instance['count'] ) ? $instance['count'] : 5;
		$order 	= $instance['order'];
		$extra_class 	= $instance['extra_class'];

		echo $before_widget.$before_title.$title.$after_title;
		include( AR_PATH .'/loop.php' );
		echo $after_widget;
	}
 	public function form( $instance ) {		
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'post_type' => '', 'count' => '5', 'order' => 'DESC', 'extra_class' => '' ) );
		
		$title = esc_attr( $instance['title'] );
		$post_type = esc_attr( $instance['post_type'] );
		$count = esc_attr( $instance['count'] );
		$order = esc_attr( $instance['order'] );
		$extra_class = esc_attr( $instance['extra_class'] );

		$ar = new Awesome_Ratings();
		$allowed_types = $ar->get_allowed_post_types();
		echo '<p><label for="'.($this->get_field_id('title')).'">'.__( 'Title', 'awesome-ratings' ).'</label></p>';
		echo '<p><input type="text" value=\''.esc_attr( $title ).'\' name="'.$this->get_field_name('title').'"></p>';
		
		echo '<p><label for="'.($this->get_field_id('post_type')).'">'.__( 'Post Type', 'awesome-ratings' ).'</label></p>';
		echo '<select name="'.$this->get_field_name('post_type').'">';
			if( !empty( $allowed_types ) ){
				foreach( $allowed_types as $allowed_type ){
					echo '<option value="'.$allowed_type.'" '.( $allowed_type == $post_type ? 'selected="selected"' : '' ).'>'.$allowed_type.'</option>';
				}
			}
		echo '</select>';
		
		echo '<p><label for="'.($this->get_field_id('count')).'">'.__( 'Count', 'awesome-ratings' ).'</label></p>';
		echo '<p><input type="text" value=\''.esc_attr( $count ).'\' name="'.$this->get_field_name('count').'"></p>';	

		echo '<p><label for="'.($this->get_field_id('order')).'">'.__( 'Order', 'awesome-ratings' ).'</label></p>';
		echo '<select name="'.$this->get_field_name('order').'">';
		echo '<option value="DESC" '.( $order == 'DESC' ? 'selected="selected"' : '' ).'>'.__( 'Descending', 'awesome-ratings' ) .'</option>';
		echo '<option value="ASC" '.( $order == 'ASC' ? 'selected="selected"' : '' ).'>'.__( 'Ascending', 'awesome-ratings' ).'</option>';
		echo '</select>';		
		
		echo '<p><label for="'.($this->get_field_id('extra_class')).'">'.__( 'Extra Class', 'awesome-ratings' ).'</label></p>';
		echo '<p><input type="text" value=\''.esc_attr( $extra_class ).'\' name="'.$this->get_field_name('extra_class').'"></p>';	
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['post_type'] 	= strip_tags( $new_instance['post_type'] );	
		$instance['count'] 	= strip_tags( $new_instance['count'] );	
		$instance['order'] 	= strip_tags( $new_instance['order'] );	
		$instance['extra_class'] 	= strip_tags( $new_instance['extra_class'] );	
		return $instance;	
	}
}
function awesome_ratings_widgets_load(){
	register_widget( 'Awesome_Ratings_Widget' );
}
add_action( 'widgets_init', 'awesome_ratings_widgets_load');
?>
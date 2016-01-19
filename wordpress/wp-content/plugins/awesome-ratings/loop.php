<ul class="list-unstyled ar_list <?php echo $extra_class; ?>">
<?php
	$query = new WP_Query(array(
		'post_type' => $post_type,
		'post_status' => 'publish',
		'posts_per_page' => $count,
		'meta_key' => 'ar_average',
		'orderby' => 'meta_value_num',
		'order' => $order
	));
	if( $query->have_posts() ){			
		while( $query->have_posts() ){
			$query->the_post();
			$average = get_post_meta( get_the_ID(), 'ar_average' );
			echo '<li><a href="'.get_the_permalink().'">'.get_the_title().' <span class="ar-count">('.$average[0].')</span></a></li>';
		}
	}
	
	wp_reset_query();
?>
</ul>
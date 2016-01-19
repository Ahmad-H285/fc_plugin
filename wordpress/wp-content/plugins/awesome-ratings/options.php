<div class="wrap">
<?php if( isset( $ar_options ) ): ?>
	<h2><?php _e( 'Awesome Ratings Options', 'awesome-ratings' ) ?></h2>
<?php endif; ?>
	<form method="POST" action="<?php echo $GLOBALS['PHP_SELF'] . '?page=awesome-options'; ?>">
		<?php if( isset( $ar_options ) ): ?>
			<div class="ar_option">
				<p><?php _e( 'Select on which post types should ratingbe available:', 'awesome-ratings' ); ?></p>
				<?php
				$post_types = get_post_types(array(
					'public'   => true,
					'_builtin' => false
				));
				array_unshift( $post_types, 'page', 'post' );
				if( !empty( $post_types ) ){
					foreach( $post_types as $post_type ){
						?>
						<input type="checkbox" name="ar_options[allowed_types][]" value="<?php echo $post_type ?>" <?php echo ( in_array( $post_type, $allowed_types ) ) ? 'checked="checked"' : '' ?>><?php echo $post_type ?>
						<?php
					}
				}
				?>
			</div>
		<?php endif; ?>

		<div class="ar_option">
			<p><?php _e( 'Input number of star to be used:', 'awesome-ratings' ); ?></p>
			<input type="text" name="ar_options[number]" value="<?php echo $number; ?>"/>
		</div>
		
		<div class="ar_option">
			<p><?php _e( 'Star color:', 'awesome-ratings' ); ?></p>
			<input type="text" name="ar_options[color]" value="<?php echo $color; ?>" class="ar_colorpicker"/>
		</div>

		<div class="ar_option">
			<p><?php _e( 'Star color on hover:', 'awesome-ratings' ); ?></p>
			<input type="text" name="ar_options[color_hvr]" value="<?php echo $color_hvr; ?>" class="ar_colorpicker"/>
		</div>

		<div class="ar_option">
			<p><?php _e( 'Empty star color:', 'awesome-ratings' ); ?></p>
			<input type="text" name="ar_options[color_empty]" value="<?php echo $color_empty; ?>" class="ar_colorpicker"/>
		</div>

		<div class="ar_option">
			<p><?php _e( 'Star font size:', 'awesome-ratings' ); ?></p>
			<input type="text" name="ar_options[font_size]" value="<?php echo $font_size; ?>"/>
		</div>

		<div class="ar_option">
			<p><?php _e( 'Ratings position:', 'awesome-ratings' ); ?></p>
			<select name="ar_options[position]">
				<option value="before" <?php echo $position == 'before' ? 'selected="selected"' : ''; ?>><?php _e( 'Before content', 'awesome-ratings' ) ?></option>
				<option value="after" <?php echo $position == 'after' ? 'selected="selected"' : ''; ?>><?php _e( 'After content', 'awesome-ratings' ) ?></option>
			</select>
		</div>
		
		<div class="ar_option">
			<p><?php _e( 'Ratings align:', 'awesome-ratings' ); ?></p>
			<select name="ar_options[align]">
				<option value="left" <?php echo $align == 'left' ? 'selected="selected"' : ''; ?>><?php _e( 'Left', 'awesome-ratings' ); ?></option>
				<option value="center" <?php echo $align == 'center' ? 'selected="selected"' : ''; ?>><?php _e( 'Center', 'awesome-ratings' ); ?></option>
				<option value="right" <?php echo $align == 'right' ? 'selected="selected"' : ''; ?>><?php _e( 'Right', 'awesome-ratings' ); ?></option>
			</select>
		</div>

		<div class="ar_option">
			<p><?php _e( 'Star margins:', 'awesome-ratings' ); ?></p>
			<input type="text" name="ar_options[margins]" value="<?php echo $margins; ?>"/>
		</div>
		
		<div class="ar_option">
			<p><?php _e( 'Info color:', 'awesome-ratings' ); ?></p>
			<input type="text" name="ar_options[info_color]" value="<?php echo $info_color; ?>" class="ar_colorpicker"/>
		</div>
		
		<div class="ar_option">
			<p><?php _e( 'Info font size:', 'awesome-ratings' ); ?></p>
			<input type="text" name="ar_options[info_font_size]" value="<?php echo $info_font_size; ?>" />
		</div>
		
		<div class="ar_option">
			<a href="javascript:;" class="clear-rates button" data-post_id="<?php echo !empty( $post->ID ) ? $post->ID : ''; ?>" data-working="<?php _e( 'Clearing...', 'awesome-ratings' ) ?>" data-ready="<?php _e( 'Clear Rates', 'awesome-ratings' ); ?>">
				<?php _e( 'Clear Rates', 'awesome-ratings' ); ?>
			</a>
		</div>	
		
		<?php if( isset( $ar_options ) ): ?>
			<div class="ar_option">
				<input type="submit" class="button button-primary" value="<?php _e( 'Save Options', 'awesome-ratings' ); ?>">
			</div>	
		<?php  else: ?>
			<div class="ar_option">
				<input type="checkbox" name="ar_options[override]" value="1" <?php echo $override == '1' ? 'checked="checked"' : ''; ?>><?php _e( 'Override Options', 'awesome-ratings' ); ?>
			</div>		
		<?php endif; ?>
				
	</form>
</div>
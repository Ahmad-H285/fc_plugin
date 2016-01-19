jQuery(document).ready(function($){
	$('.ar_colorpicker').wpColorPicker();
	
	$('.clear-rates').on( 'click', function(){
		var $this = $(this);
		$this.text( $this.data('working') );
		$.ajax({
			url: ajaxurl,
			method: 'post',
			data: {
				action: 'clear_rates',
				post_id: $this.data['post_id']
			},
			success: function(response){
				alert( response );
			},
			complete: function(){
				$this.text( $this.data('ready') );
			}
		})
	});
});
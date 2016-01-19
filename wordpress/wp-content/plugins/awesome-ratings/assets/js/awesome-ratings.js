jQuery(document).ready(function($){
	/* HANDLE RATINGS */
	$('.ar-ratings').each(function(){
	
		var $parent = $(this);

		if( $parent.attr('data-can_rate') == 'yes' ){
			$parent.find('i').each(function(e){			
				$(this).attr( 'backup-class', $(this).attr( 'class' ) );
			});
		}	
		
		$parent.find('i').on( 'mouseover', function(e){
			if( $parent.attr('data-can_rate') == 'yes' ){
				var count = $parent.children().index( this );
				for( var i=0; i<=count; i++ ){
					$parent.find('i:eq('+i+')').attr( 'class', 'fa fa-star ar-hover' );
				}
			}
		});

		$parent.find('i').on( 'mouseout', function(e){
			if( $parent.attr('data-can_rate') == 'yes' ){
				$parent.find('i').each(function(e){
					$(this).attr( 'class', $(this).attr('backup-class') );
				});
			}
		});

		$parent.find('i').on( 'click', function(e){
			if( $parent.attr('data-can_rate') == 'yes' ){
				var count = $parent.children().index( this );
				$parent.html('<i class="fa fa-spinner fa-spin"></i>');
				$.ajax({
					url: ajaxurl,
					method: "POST",
					data:{
						action: 'ar_rate',
						rate: count + 1,
						post_id: $parent.data('post_id')
					},
					success: function( response ){
						$parent.html( response );
						$parent.attr( 'data-can_rate', 'no' );
					},
					error: function(){

					},
					complete: function(){

					}
				});
			}
		});	
	});
});
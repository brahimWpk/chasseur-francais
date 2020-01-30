jQuery(document).ready(function(){
	$(".cofidise-class").on('load', function(){
		if( $(this).hasClass('confidis_ancre') ){
			$('html,body').animate({ scrollTop: $('#iframe-autosize').offset().top })
		}else{
			setTimeout(function(){
				$(".cofidise-class").addClass('confidis_ancre');
			}, 3000);
		}
	});

	if( $.fn.shave ){
		$('.post .items-posts-related .thumbnail-inter .crp_title').shave(65);
	}
});
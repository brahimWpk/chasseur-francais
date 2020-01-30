
(function($){
	
	$(document).ready(function(){
		$('.submit_search_btn').on('click', function(e){
			e.preventDefault();
			$('.navbar .blockSearch .submit_search_btn').stop().animate(
				{width:'100%'}, 300, function(){
					$(this).parents().find('.search_txt_input').toggleClass('show');
				});
		});
		$('.close_menu_search').on('click', function(e){
			e.preventDefault();
			var $search_txt_input = $(this).parents().find('.search_txt_input');
			if($search_txt_input.hasClass('show')){
				$search_txt_input.toggleClass('show');
				$('.navbar .blockSearch .submit_search_btn').stop().animate(
					{width:'55px'}, 300, function(){});
			}
		});

		$(".navbar-site #principal-menu > ul > li").each(function(index,obj){
			$(obj).mouseenter(function(e){
				thread_start('menu_site("'+index+'",\'enter\')',500);
			}).mouseleave(function(e){
				menu_site(index,'out');
			});
		});

		$(".navbar-toggle").click(function(){
			if(!$("body").hasClass("show-menu"))
				$("body").addClass("show-menu");
			else
				$("body").removeClass("show-menu");

			$(".show-menu .navbar-site").stop().animate({left:0},400);
		});

		$(".block_top_menu .close").click(function(){
			$(".show-menu .navbar-site").stop().animate({left:"-100%"},400,function(){
				$("body").removeClass("show-menu");
				$(".show-menu .navbar-site").css('left',0);
			});
		});
		
	});

})(jQuery);

var time_site_menu="";
function thread_start(callback,timer) {
	time_site_menu=setTimeout(callback, timer);
	return true;
}

function menu_site(index,event_site){
	var ul_children=$(".navbar-site #principal-menu > ul").children();
	var _this=ul_children[index];
	if(event_site=="enter"){
		if($(window).width()>767){
	 		var default_height=$(_this).find('.list-children-cat').innerHeight();
			$(_this).find('.list-children-cat').stop().show();
			$(".navbar-site").stop().animate({marginBottom: default_height}, 500);
		}
	}else {
		if($(window).width()>767){
			$(".navbar-site #principal-menu > ul > li .list-children-cat").hide();
 			$(_this).find('.list-children-cat').hide();
			$(".navbar-site").stop().animate({marginBottom: 0}, 500);
 			clearTimeout(time_site_menu);
 		}
	}
}
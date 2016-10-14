(function($){
	$(".rs_chosen").chosen();
	
	var product_gallery = $(".product_gallery");
	product_gallery.owlCarousel({
		autoPlay : false,
		pagination : false,
		navigation : true,
		navigationText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		items : 3,
		itemsDesktop : [1000,3],
		itemsDesktopSmall : [900,3],
		itemsTablet: [600,2],
		itemsMobile : [480,1]
	});
	/*$("#rs_zoom_img").elevateZoom({
        loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
	});*/
	$('.product_gallery a').on('click',function(e){
		e.preventDefault();
		var ez =   $('#zoom_03').data('elevateZoom');
		var smallImage = $(this).attr('data-sm-img');
		var largeImage = $(this).attr('data-lg-img');
		$('#rs_zoom_img').attr({
				'data-zoom-image':largeImage,
				'src':smallImage,
			});
		$('.big_img').attr({
				'href':largeImage,
			});
		/*$("#rs_zoom_img").elevateZoom({
	        loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
		});*/
		//ez.swaptheimage(smallImage, largeImage);
	});
	$("a[data-rel^='prettyPhoto']").prettyPhoto();
	$('.header_search_box a').on('click',function(e){
		e.preventDefault();
		$('.header_search_box form').slideToggle(function(){
			$(this).find('input').focus();
		});
	});
	set_search_center();
	function set_search_center(){
		var dataValues = {
			conWidth: $('#navbar').innerWidth(),
			logoWidth: $('.navbar-header').innerWidth(),
			menuWidth: $('.rs_main_menu').innerWidth(),
		}
		var marginClk = (dataValues.conWidth - (dataValues.logoWidth+dataValues.menuWidth))/2;
		if(marginClk>=1){
			$('.header_search_box').css({
				'margin-left': marginClk
			})
		}
		
	}
	$(window).scroll(function(){
		if($(document).scrollTop()>=10){
			$('.go_to_top').fadeIn();
		}else{
			$('.go_to_top').fadeOut();
		}
	})
	$('.go_to_top').mPageScroll2id({
							offset:0
						});


	//Share
	//
	$('.btnShare').click(function() {
		
	});
})(jQuery);
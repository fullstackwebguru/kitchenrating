(function($){
	
$( ".rs_filter" ).slider({
	step:50,
	change: function( event, ui ) {
		$(this).closest('.rs_price_filter').find('input').val(ui.value);
	}
});
$( ".rs_filter" ).each(function(){
	$(this).slider( "value", parseInt($(this).attr('data-value')) );
})
$( ".rs_filter_dec" ).on('click',function(e){
	e.preventDefault();
	var sliderSelect = $(this).closest('.rs_filter_group').find('.rs_filter');
	sliderSelect.slider('value',sliderSelect.slider("value")-50);
})
$( ".rs_filter_inc" ).on('click',function(e){
	e.preventDefault();
	var sliderSelect = $(this).closest('.rs_filter_group').find('.rs_filter');
	sliderSelect.slider('value',sliderSelect.slider("value")+50);
})

})(jQuery);
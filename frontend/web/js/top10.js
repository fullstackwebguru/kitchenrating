(function($){

var rangeObj = {
	price_level :  20,
	quality_level : 50,
	trust_level : 100
};
	
$( ".rs_filter" ).slider({
	step:20,
	change: function( event, ui ) {
		$(this).attr('data-value', ui.value);
		renderChange();
	}
});

$( ".rs_filter" ).each(function(){
	$(this).slider( "value", parseInt($(this).attr('data-value')) );
})
$( ".rs_filter_dec" ).on('click',function(e){
	e.preventDefault();
	var sliderSelect = $(this).closest('.rs_filter_group').find('.rs_filter');
	sliderSelect.slider('value',sliderSelect.slider("value")-20);
})
$( ".rs_filter_inc" ).on('click',function(e){
	e.preventDefault();
	var sliderSelect = $(this).closest('.rs_filter_group').find('.rs_filter');
	sliderSelect.slider('value',sliderSelect.slider("value")+20);
})

function renderChange() {

	var isChanged = false;
	$( ".rs_filter" ).each(function(){
		var key = $(this).attr('data-key');
		var value =  $(this).attr('data-value');

		if (rangeObj[key] != value) {
			rangeObj[key] = value;
			isChanged = true;
		}
	});

	if (isChanged) {
		var actionUrl = $(".product_list").attr("data-action");
		
		$.ajax( {
			type: "GET",
			url : actionUrl,
			data : rangeObj,
			success : function (data) {
				$(".product_list").html(data);
			},
			dataType: 'html'
		});
	}
}

})(jQuery);
(function($){

var rangeObj = {
	rank_option1 : 100,
	rank_option2 : 50,
	rank_option3 : 0
};
	
$( ".rs_filter" ).slider({
	step:50,
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
	sliderSelect.slider('value',sliderSelect.slider("value")-50);
})
$( ".rs_filter_inc" ).on('click',function(e){
	e.preventDefault();
	var sliderSelect = $(this).closest('.rs_filter_group').find('.rs_filter');
	sliderSelect.slider('value',sliderSelect.slider("value")+50);
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
			type: "POST",
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
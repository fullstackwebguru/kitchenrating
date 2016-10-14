(function($){

$('#tw_search_banner').submit(function (e) {
	e.preventDefault();
	e.stopPropagation();
	return false;
});


$('input[name^="tw_search_"]').blur(function(){
	var type = $(this).attr('name').split('_').pop();
	var result_container = "#tw_search_result_" + type;

	$(result_container).hide();
});


$('input[name^="tw_search_"]').keyup(function(){
	var type = $(this).attr('name').split('_').pop();
	var result_container = "#tw_search_result_" + type;

	$.ajax({
		type: "POST",
		url: "/widget/search",
		data:'title='+$(this).val(),
		// beforeSend: function(){
		// 	$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		// },
		success: function(data){

			$(result_container).html(data);
			$(result_container).show();
		}
	});
});
})(jQuery);
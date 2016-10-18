(function($){

if ($('#tw_search_banner').length > 0) {
	$('#tw_search_banner').submit(function (e) {
		e.preventDefault();
		e.stopPropagation();
		return false;
	});	
}

if ($('#tw_search_product').length > 0) {
	$('#tw_search_product').submit(function (e) {
		e.preventDefault();
		e.stopPropagation();
		return false;
	});	
}

if ($('#tw_search_side').length > 0) {
	$('#tw_search_side').submit(function (e) {
		e.preventDefault();
		e.stopPropagation();
		return false;
	});	
}

if ($('#tw_search_top').length > 0) {
	$('#tw_search_top').submit(function (e) {
		e.preventDefault();
		e.stopPropagation();
		return false;
	});	
}


$('input[name^="tw_search_"]').autocomplete({
  minLength: 0,
  source: function( request, response ) {
    $.ajax({
        dataType: "json",
        type : 'Get',
        url: '/widget/search',
        data: {
			title: request.term
		},
        success: function(data) {
            $('input.suggest-user').removeClass('ui-autocomplete-loading');  
            // hide loading image
            response( data);
        },
        error: function(data) {
            $('input.suggest-user').removeClass('ui-autocomplete-loading');  
        }
    });
}
}).autocomplete( "instance" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .append( "<a href='"+ item.url + "''><div>" + '<img src="'+ item.icon+'" alt="" /><span>' + item.value + "</span></div></a>" )
    .appendTo( ul );
};

})(jQuery);
(function($){

var availableTop10s = [
	"papa",
	"people",
	"penelope",
	"progress",
	"johns",
	"domino",
	"kfc",
];

$('#tw_search_banner').submit(function (e) {
	e.preventDefault();
	e.stopPropagation();
	return false;
}) 

$('input[name^="tw_search_"]').autocomplete( {
	source: availableTop10s
});

})(jQuery);
$(document).on('click', 'a.disabled', function (e) {
	e.preventDefault();
});

$(document).on('click submit', '@stop-propagation', function (e) {
	e.stopPropagation();
});

$(document).on('click submit', '@prevent-default', function (e) {
	e.preventDefault();
});
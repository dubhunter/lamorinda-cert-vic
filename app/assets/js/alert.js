var app = app || {};

app.alert = function (type, message, container, options) {
	container = $(container || '#alert-container');

	options = $.extend({}, app.alert.defaults, options);

	if (options.clear) {
		container.find('.alert').remove();
	}

	var $alert = $('<div />')
		.addClass('alert')
		.addClass('alert-' + type)
		.html(message);

	if (options.dismissible) {
		$('<button />')
			.attr('type', 'button')
			.attr('data-dismiss', 'alert')
			.addClass('close')
			.html('&times;')
			.prependTo($alert);
	}

	switch (options.method) {
		case 'append':
			container.append($alert);
			break;
		case 'prepend':
			container.prepend($alert);
			break;
	}
};

app.alert.defaults = {
	clear: false,
	method: 'append',
	dismissible: true
};

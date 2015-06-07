$(function () {
	var restRequest = function (element, method, url, data) {
		var $button = element.is('form') ? element.find('input[type="submit"], button[type="submit"]') : element;

		if ($button.attr('data-loading-text')) {
			$button.button('loading');
		}

		var xhr = $.ajax({
			'type': method,
			'url': url,
			'data': data
		});

		var alertContainer = element.parents('.modal').length || element.is('.modal') ? element.parents('.modal').andSelf().find('.modal-body').last() : null;
		var alertDismissible = alertContainer ? false : true;
		var alertMethod = alertContainer ? 'prepend' : 'append';

		if (alertContainer) {
			alertContainer.parents('.modal').one('hidden', function () {
				alertContainer.find('.alert').remove();
			});
		}

		if (element.data('done')) {
			xhr.done(eval(element.data('done')));
		} else {
			xhr.done(function (data) {
				if (data.error) {
					app.alert('error', data.error, alertContainer, {'clear': true, 'method': alertMethod, 'dismissible': alertDismissible});
					if (alertContainer) {
						alertContainer.parents('.modal').modal('refresh');
					}
				} else if (data.reload) {
					if (alertContainer) {
						alertContainer.parents('.modal').modal('hide');
					}
					window.location.reload();
				} else if (data.location) {
					if (alertContainer) {
						alertContainer.parents('.modal').modal('hide');
					}
					window.location = data.location;
				} else if (element.data('redirect')) {
					if (alertContainer) {
						alertContainer.parents('.modal').modal('hide');
					}
					window.location = element.data('redirect');
				} else {
					if (data.success) {
						app.alert('success', data.success);
					}
					if (alertContainer) {
						alertContainer.parents('.modal').modal('hide');
					}
					if (element.data('remove')) {
						var $removeTarget = $(element.data('remove'));
						$removeTarget.fadeOut(function () {
							$removeTarget.remove();
						});
					}
				}
			});
		}

		if (element.data('fail')) {
			xhr.fail(element.data('fail'));
		} else {
			xhr.fail(function () {
				app.alert('error', 'Unable to perform operation.', alertContainer, {'clear': true, 'method': alertMethod, 'dismissible': alertDismissible});
				if (alertContainer) {
					alertContainer.parents('.modal').modal('refresh');
				}
			});
		}

		if ($button.attr('data-loading-text')) {
			xhr.always(function () {
				$button.button('reset');
			});
		}

		return xhr;
	};

	$(document).on('click', '@post,@delete', function (e) {
		var $this = $(this);

		e.preventDefault();
		if ($this.is('a')) {
			e.stopPropagation();
		}

		if ($this.is('.disabled') || $this.is(':disabled') || $this.data('disabled')) {
			return true;
		}

		var url = $this.attr('href') || $this.data('action');
		var method = $this.is('@delete') ? 'DELETE' : 'POST';
		var collection = $this.data('collection');
		var data = [];

		$.each($this.data(), function (name, value) {
			data.push({
				'name': name,
				'value': value
			});
		});

		if (collection) {
			$.merge(data, $(collection).find(':input').serializeArray());
		}

		restRequest($this, method, url, data);
	});

	$(document).on('submit', 'form@ajax', function (e) {
		var $this = $(this);

		e.preventDefault();

		if ($this.find('input[type="submit"], button[type="submit"]').is('.disabled')
			|| $this.find('input[type="submit"], button[type="submit"]').is(':disabled')
			|| $this.find('input[type="submit"], button[type="submit"]').data('disabled')) {
			return true;
		}

		var url = $this.attr('action');
		var method = $this.attr('method') || 'GET';
		var collection = $this.data('collection');
		var data = $this.serializeArray();

		if (collection) {
			$.merge(data, $(collection).find(':input').serializeArray());
		}

		restRequest($this, method.toUpperCase(), url, data);
	});
});

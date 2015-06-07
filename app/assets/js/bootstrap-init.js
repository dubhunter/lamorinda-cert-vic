$(function() {
	$('@alert').alert();
	$('@button').button();
	$('@tooltip').tooltip();
	$('@modal[data-show="modal"]').modal('show'); // on page load, show modals with data-show="modal"

	$.fn.modal.defaults.errorCallback = function (jqXHR) {
		var message = 'An unexpected error has occurred.';

		try {
			var responseData = jqXHR.responseJSON;

			if (responseData.message.error) {
				message = responseData.message.error;
			}
		} catch (e) {}

		if (message) {
			var $modal = $('.modal:visible');
			var alertContainer = $modal.length ? $modal.find('.modal-body').last() : null;
			var alertDismissible = alertContainer ? false : true;
			var alertMethod = alertContainer ? 'prepend' : 'append';

			if (alertContainer) {
				alertContainer.parents('.modal').one('hidden', function () {
					alertContainer.find('.alert').remove();
				});
			}

			twilio.alert('error', message, alertContainer, {'clear': true, 'method': alertMethod, 'dismissible': alertDismissible});

			if (alertContainer) {
				$modal.modal('refresh');
			}
		}
	};

	//bind for modal plus
	$(document).on('show', '@modal', function (e) {
		$(e.target).find('@tooltip').tooltip();
	});
});

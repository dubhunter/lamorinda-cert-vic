$(function () {
	/**
	 * Disable/enable submit buttons in forms based on the values of required fields.
	 *
	 * Usage:
	 *      Add `role="ensure-required"` to the form.
	 *      Add `required` property to all inputs to be checked.
	 */
	$('form@ensure-required').each(function () {
		var $form = $(this);
		var $button = $form.find('input[type="submit"], button[type="submit"]');

		var handle = function () {
			var pass = true;
			$form.find('[required]:input').each(function () {
				if (!$(this).val()) {
					pass = false;
					return false;
				}
			});

			if (pass) {
				$button.removeProp('disabled');
			} else {
				$button.prop('disabled', true);
			}
		};

		$form.find('[required]:input').on('input', function () {
			handle();
		});

		handle();
	});

	/**
	 * Don't submit forms with disabled buttons.
	 * Trigger loading state on submit for buttons with `data-loading-text` attribute.
	 */
	$('form').not('@ajax').on('submit', function (e) {
		var $form = $(this);
		var $button = $form.find('input[type="submit"], button[type="submit"]');

		if ($button.is('.disabled') || $button.is(':disabled') || $button.data('disabled')) {
			e.preventDefault();
			return;
		}

		if ($button.attr('data-loading-text')) {
			$button.button('loading');
		}
	});

	/**
	 * Trigger loading state on forms with `data-loading-text` attribute.
	 */
	$('form[data-loading-text]').on('submit', function (e) {
		var $form = $(this);
		$form.append($($form.data('loading-text')));
	});

	/**
	 * Submit a form when one of the inputs changes
	 *
	 * Usage:
	 *      Add `role="submit-on-change"` to the form.
	 */
	$('form@submit-on-change').each(function () {
		var $form = $(this);

		$form.find(':input').on('change', function () {
			$form.submit();
		});
	});
});
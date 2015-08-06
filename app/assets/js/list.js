$(function () {
	$('@data-list').each(function () {
		var $this = $(this);
		var id = $this.attr('id');
		var source = $this.data('source');
		var loadingText = $this.data('loading-text');
		var errorText = $this.data('error-text');

		var load = function () {
			if (loadingText) {
				$this.html(loadingText);
			}

			$.get(source)
				.done(function (data) {
					$this.html(data);
				})
				.fail(function () {
					if (errorText) {
						$this.html(errorText);
					}
				});
		};

		$this.data('reload', load);

		load();
	});
});
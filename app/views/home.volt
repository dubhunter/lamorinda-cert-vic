{% extends 'layouts/core.volt' %}

{% block content %}
	<section>
		<div class="well well-large center">
			<form action="{{ url(['for': 'home']) }}" method="post" class="form-horizontal">

				<input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}">

				<fieldset>
					<legend>Lamorinda CERT VIC Login</legend>

					<div class="control-group">
						<label class="control-label" for="username">Username:</label>
						<div class="controls">
							<input type="text" id="username" name="username" value="{{ app['values']['username'] }}">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="password">Password:</label>
						<div class="controls">
							<input type="password" id="password" name="password">
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<button type="submit" class="btn btn-primary" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Processing&hellip;">Submit</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</section>
{%  endblock %}
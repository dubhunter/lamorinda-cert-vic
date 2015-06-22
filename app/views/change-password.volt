{% extends 'layouts/core.volt' %}

{% block title %}Change Password{% endblock %}

{% block content %}
	{% set token = security.getToken() %}
	{% set tokenKey = security.getTokenKey() %}

	<section>
		<h2>Change Password</h2>

		<form class="form-horizontal" method="post" action="{{ url({'for': 'change-password'}) }}">

			<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">

			<div class="control-group">
				<label class="control-label" for="password">Password</label>
				<div class="controls">
					<input type="password" id="password" name="password" placeholder="Password">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="passwordConfirm">Confirm Password</label>
				<div class="controls">
					<input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Confirm Password">
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					<button type="reset" class="btn">Cancel</button>
					<button type="submit" class="btn btn-primary" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Saving &hellip;">Save</button>
				</div>
			</div>

		</form>
	</section>
{%  endblock %}
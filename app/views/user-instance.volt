{% extends 'layouts/core.volt' %}

{% block title %}User {% if user['id'] %}Edit{% else %}Add{% endif %}{% endblock %}

{% block content %}
	{% set token = security.getToken() %}
	{% set tokenKey = security.getTokenKey() %}

	<section>
		<h2>User {% if user['id'] %}Edit{% else %}Add{% endif %}</h2>

		<form class="form-horizontal" method="post" action="{{ user['id'] ? url({'for': 'user-instance', 'id': user['id']}) : url({'for': 'user-list'}) }}">

			<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">

			<div class="control-group">
				<label class="control-label" for="username">Username</label>
				<div class="controls">
					<input type="text" id="username" name="username" placeholder="Username" value="{{ app['values']['username']|default(user['username']) }}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="password">Password</label>
				<div class="controls">
					<input type="password" id="password" name="password" placeholder="Password">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="role">Role</label>
				<div class="controls">
					<select id="role" name="role">
						<option value="">-- Role --</option>
						{% for role, roleName in roles %}
							<option value="{{ role }}"{% if role == app['values']['role']|default(user['role']) %} selected{% endif %}>{{ roleName }}</option>
						{% endfor %}
					</select>
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					<button type="reset" class="btn">Cancel</button>
					{% if user['id'] %}
						<button  data-toggle="modal" data-target="#delete-user" class="btn btn-danger"><i class="icon icon-trash-o"></i> Delete</button>
					{% endif %}
					<button type="submit" class="btn btn-primary" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Saving &hellip;"><i class="icon icon-save"></i> Save</button>
				</div>
			</div>

		</form>
	</section>

	{% if user['id'] %}
		{% include 'modals/delete-confirm.volt' %}
	{% endif %}
{%  endblock %}
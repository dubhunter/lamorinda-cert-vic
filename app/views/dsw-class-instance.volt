{% extends 'layouts/core.volt' %}

{% block title %}DSW Class {% if dswClass['id'] %}Edit{% else %}Add{% endif %}{% endblock %}

{% block content %}
	{% set token = security.getToken() %}
	{% set tokenKey = security.getTokenKey() %}

	<section>
		<h2>DSW Class {% if dswClass['id'] %}Edit{% else %}Add{% endif %}</h2>

		<form class="form-horizontal" method="post" action="{{ dswClass['id'] ? url({'for': 'dsw-class-instance', 'id': dswClass['id']}) : url({'for': 'dsw-class-list'}) }}">

			<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">

			<div class="control-group">
				<label class="control-label" for="class">Class</label>
				<div class="controls">
					<input type="text" id="class" name="class" placeholder="Class" value="{{ app['values']['class']|default(dswClass['class']) }}">
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					<button type="reset" class="btn">Cancel</button>
					{% if dswClass['id'] and app['user']['admin'] %}
						<button  data-toggle="modal" data-target="#delete-dsw-class" class="btn btn-danger"><i class="icon icon-trash-o"></i> Delete</button>
					{% endif %}
					<button type="submit" class="btn btn-primary" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Saving &hellip;"><i class="icon icon-save"></i> Save</button>
				</div>
			</div>

		</form>
	</section>

	{% if dswClass['id'] %}
		{% include 'modals/dsw-class-delete-confirm.volt' %}
	{% endif %}
{%  endblock %}
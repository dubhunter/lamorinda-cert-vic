{% extends 'layouts/core.volt' %}

{% block title %}Jurisdiction {% if jurisdiction['id'] %}Edit{% else %}Add{% endif %}{% endblock %}

{% block content %}
	{% set token = security.getToken() %}
	{% set tokenKey = security.getTokenKey() %}

	<section>
		<h2>Jurisdiction {% if jurisdiction['id'] %}Edit{% else %}Add{% endif %}</h2>

		<form class="form-horizontal" method="post" action="{{ jurisdiction['id'] ? url({'for': 'jurisdiction-instance', 'id': jurisdiction['id']}) : url({'for': 'jurisdiction-list'}) }}">

			<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">

			<div class="control-group">
				<label class="control-label" for="jurisdiction">Jurisdiction</label>
				<div class="controls">
					<input type="text" id="jurisdiction" name="jurisdiction" placeholder="Jurisdiction" value="{{ app['values']['jurisdiction']|default(jurisdiction['jurisdiction']) }}">
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					<button type="reset" class="btn">Cancel</button>
					{% if jurisdiction['id'] and app['user']['admin'] %}
						<button  data-toggle="modal" data-target="#delete-jurisdiction" class="btn btn-danger"><i class="icon icon-trash-o"></i> Delete</button>
					{% endif %}
					<button type="submit" class="btn btn-primary" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Saving &hellip;"><i class="icon icon-save"></i> Save</button>
				</div>
			</div>

		</form>
	</section>

	{% if jurisdiction['id'] %}
		{% include 'modals/jurisdiction-delete-confirm.volt' %}
	{% endif %}
{%  endblock %}
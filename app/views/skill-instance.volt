{% extends 'layouts/core.volt' %}

{% block title %}Skill {% if skill['id'] %}Edit{% else %}Add{% endif %}{% endblock %}

{% block content %}
	{% set token = security.getToken() %}
	{% set tokenKey = security.getTokenKey() %}

	<section>
		<h2>Skill {% if skill['code'] %}Edit{% else %}Add{% endif %}</h2>

		<form class="form-horizontal" method="post" action="{{ skill['code'] ? url({'for': 'skill-instance', 'code': skill['code']}) : url({'for': 'skill-list'}) }}">

			<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">

			<div class="control-group">
				<label class="control-label" for="code">Code</label>
				<div class="controls">
					<input type="text" id="code" name="code" placeholder="Code" value="{{ app['values']['code']|default(skill['code']) }}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="skill">Skill</label>
				<div class="controls">
					<input type="text" id="skill" name="skill" placeholder="Skill" value="{{ app['values']['skill']|default(skill['skill']) }}">
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					<button type="reset" class="btn">Cancel</button>
					{% if skill['code'] and app['user']['admin'] %}
						<button  data-toggle="modal" data-target="#delete-skill" class="btn btn-danger"><i class="icon icon-trash-o"></i> Delete</button>
					{% endif %}
					<button type="submit" class="btn btn-primary" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Saving &hellip;"><i class="icon icon-save"></i> Save</button>
				</div>
			</div>

		</form>
	</section>

	{% if skill['code'] %}
		{% include 'modals/skill-delete-confirm.volt' %}
	{% endif %}
{%  endblock %}
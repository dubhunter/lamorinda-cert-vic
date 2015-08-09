{% extends 'layouts/core.volt' %}

{% block title %}Agency {% if agency['id'] %}Edit{% else %}Add{% endif %}{% endblock %}

{% block content %}
	{% set token = security.getToken() %}
	{% set tokenKey = security.getTokenKey() %}

	<section>
		<h2>Agency {% if agency['id'] %}Edit{% else %}Add{% endif %}</h2>

		<form method="post" action="{{ agency['id'] ? url({'for': 'agency-instance', 'id': agency['id']}) : url({'for': 'agency-list'}) }}">

			<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">

			<fieldset>

				<legend>Details</legend>

				<div class="row-fluid">
					<div class="span3 offset1">
						<label for="id">Agency ID</label>
						<input class="span12" type="text" id="id" name="id" placeholder="Agency ID" value="{{ app['values']['id']|default(agency['id']) }}">
					</div>
					<div class="span3">
						<label for="name">Name</label>
						<input class="span12" type="text" id="name" name="name" placeholder="Name" value="{{ app['values']['name']|default(agency['name']) }}">
					</div>
					<div class="span3">
						<label for="phone">Phone</label>
						<input class="span12" type="text" id="phone" name="phone" placeholder="Phone" value="{{ app['values']['phone']|default(agency['phone']|phone) }}">
					</div>
				</div>

				<div class="row-fluid">
					<div class="span3 offset1">
						<label for="contact">Contact</label>
						<input class="span12" type="text" id="contact" name="contact" placeholder="Contact Name" value="{{ app['values']['contact']|default(agency['contact']) }}">
					</div>
					<div class="span3">
						<label for="position">Position</label>
						<input class="span12" type="text" id="position" name="position" placeholder="Position" value="{{ app['values']['position']|default(agency['position']) }}">
					</div>
					<div class="span3">
						<label for="email">Email</label>
						<input class="span12" type="text" id="email" name="email" placeholder="Email" value="{{ app['values']['email']|default(agency['email']) }}">
					</div>
				</div>

				<div class="row-fluid">
					<div class="span3 offset1">
						<label for="phoneDirect">Phone Direct</label>
						<input class="span12" type="text" id="phoneDirect" name="phoneDirect" placeholder="Phone Direct" value="{{ app['values']['phoneDirect']|default(agency['phoneDirect']|phone) }}">
					</div>
					<div class="span3">
						<label for="fax">Fax</label>
						<input class="span12" type="text" id="fax" name="fax" placeholder="Fax" value="{{ app['values']['fax']|default(agency['fax']|phone) }}">
					</div>
					<div class="span3">
						<label for="phoneCell">Phone Cell</label>
						<input class="span12" type="text" id="phoneCell" name="phoneCell" placeholder="Phone Cell" value="{{ app['values']['phoneCell']|default(agency['phoneCell']|phone) }}">
					</div>
				</div>

				<div class="row-fluid">
					<div class="span3 offset1">
						<label for="street">Street</label>
						<input class="span12" type="text" id="street" name="street" placeholder="Street" value="{{ app['values']['street']|default(agency['street']) }}">
					</div>
					<div class="span3">
						<label for="city">City</label>
						<input class="span12" type="text" id="city" name="city" placeholder="City" value="{{ app['values']['city']|default(agency['city']) }}">
					</div>
					<div class="span3">
						<label for="radio">Radio</label>
						<input class="span12" type="text" id="radio" name="radio" placeholder="Radio" value="{{ app['values']['radio']|default(agency['radio']) }}">
					</div>
				</div>

				<div class="row-fluid">
					<div class="span9 offset1">
						<label for="comment">Comments</label>
						<textarea class="span12" id="comment" name="comment" placeholder="Comments" rows="8">{{ app['values']['comment']|default(agency['comment']) }}</textarea>
					</div>
				</div>

			</fieldset>

			{% if agency['id'] %}
				<fieldset>

					<legend>Open Requests</legend>

					<div class="row-fluid">
						<div class="span9 offset1" id="request-details" role="data-list" data-source="{{ url({'for': 'agency-request-list', 'agencyId': agency['id']}) }}" data-loading-text="{{ '<i class="icon icon-spinner icon-pulse icon-3x center"></i>'|e }}"></div>
					</div>

				</fieldset>
			{% endif %}

			<div class="row-fluid margin-top-large">
				<div class="span9 offset1">
					<button type="reset" class="btn">Cancel</button>
					{% if agency['id'] and app['user']['admin'] %}
						<button  data-toggle="modal" data-target="#delete-agency" class="btn btn-danger"><i class="icon icon-trash-o"></i> Delete</button>
					{% endif %}
					<button type="submit" class="btn btn-primary" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Saving &hellip;"><i class="icon icon-save"></i> Save</button>
				</div>
			</div>

		</form>
	</section>

	{% if agency['id'] %}
		{% include 'modals/agency-delete-confirm.volt' %}
	{% endif %}
{%  endblock %}
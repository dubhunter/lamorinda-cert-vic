{% extends 'layouts/core.volt' %}

{% block title %}Request {% if request['id'] %}Edit{% else %}Add{% endif %}{% endblock %}

{% block content %}
	{% set token = security.getToken() %}
	{% set tokenKey = security.getTokenKey() %}

	<section>
		<h2>Request {% if request['id'] %}Edit - {{ request['id']|pad_left(6, '0') }}{% else %}Add{% endif %}</h2>

		<form method="post" action="{{ request['id'] ? url({'for': 'request-instance', 'id': request['id']}) : url({'for': 'request-list'}) }}">

			<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">

			<fieldset>

				<legend>Details</legend>

				<div class="row-fluid">
					<div class="span6 offset1">
						<label for="agencyId">Agency</label>
						<select class="span12" id="agencyId" name="agencyId">
							<option value="">-- Agency --</option>
							{% for agency in agencies %}
								<option value="{{ agency['id'] }}"{% if agency['id'] == app['values']['agencyId']|default(request['agencyId']) %} selected{% endif %}>{{ agency['id'] }} - {{ agency['name'] }}</option>
							{% endfor %}
						</select>
					</div>
					<div class="span3">
					</div>
				</div>

				<div class="row-fluid">
					<div class="span3 offset1">
						<label for="contact">Report to Contact</label>
						<input class="span12" type="text" id="contact" name="contact" placeholder="Contact Name" value="{{ app['values']['contact']|default(request['contact']) }}">
					</div>
					<div class="span3">
						<label for="phoneCell">Phone Cell</label>
						<input class="span12" type="text" id="phoneCell" name="phoneCell" placeholder="Phone Cell" value="{{ app['values']['phoneCell']|default(request['phoneCell']|phone) }}">
					</div>
					<div class="span3">
						<label for="phoneWork">Phone Work</label>
						<input class="span12" type="text" id="phoneWork" name="phoneWork" placeholder="Phone Work" value="{{ app['values']['phoneWork']|default(request['phoneWork']|phone) }}">
					</div>
				</div>

				<div class="row-fluid">
					<div class="span3 offset1">
						<label for="email">Email</label>
						<input class="span12" type="text" id="email" name="email" placeholder="Email" value="{{ app['values']['email']|default(request['email']) }}">
					</div>
					<div class="span3">
						<label for="fax">Fax</label>
						<input class="span12" type="text" id="fax" name="fax" placeholder="Fax" value="{{ app['values']['fax']|default(request['fax']|phone) }}">
					</div>
					<div class="span3">
						<label for="radio">Radio</label>
						<input class="span12" type="text" id="radio" name="radio" placeholder="Radio" value="{{ app['values']['radio']|default(request['radio']) }}">
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 offset1">
						<label for="street">Report to Address</label>
						<input class="span12" type="text" id="street" name="street" placeholder="Street" value="{{ app['values']['street']|default(request['street']) }}">
					</div>
					<div class="span3">
						<label for="jurisdictionId">City</label>
						<select class="span12" id="jurisdictionId" name="jurisdictionId">
							<option value="">-- City --</option>
							{% for jurisdiction in jurisdictions %}
								<option value="{{ jurisdiction['id'] }}"{% if jurisdiction['id'] == app['values']['jurisdictionId']|default(request['jurisdictionId']) %} selected{% endif %}>{{ jurisdiction['jurisdiction'] }}</option>
							{% endfor %}
						</select>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span9 offset1">
						<label for="comment">Comments</label>
						<textarea class="span12" id="comment" name="comment" placeholder="Comments" rows="8">{{ app['values']['comment']|default(request['comment']) }}</textarea>

						<label class="checkbox">
							<input type="checkbox" id="open" name="open" value="1"{% if app['values']['open']|default(request['open']) %} checked{% endif %}> Open
						</label>
					</div>
				</div>

			</fieldset>

			{% if request['id'] %}
				<fieldset>

					<legend>Skills</legend>

					<div class="row-fluid">
						<div class="span1">
							<a href="{{ url({'for': 'request-detail-create', 'requestId': request['id']}) }}" class="btn btn-small" data-toggle="modal"><i class="icon icon-plus"></i> Add</a>
						</div>
						<div class="span9" id="details" role="data-list" data-source="{{ url({'for': 'request-detail-list', 'requestId': request['id']}) }}" data-loading-text="{{ '<i class="icon icon-spinner icon-pulse icon-3x center"></i>'|e }}"></div>
					</div>

				</fieldset>
			{% endif %}

			<div class="row-fluid margin-top-large">
				<div class="span9 offset1">
					<button type="reset" class="btn">Cancel</button>
					<button type="submit" class="btn btn-primary" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Saving &hellip;"><i class="icon icon-save"></i> Save</button>
				</div>
			</div>

		</form>
	</section>
{%  endblock %}
{% extends 'layouts/core.volt' %}

{% block title %}Volunteer {% if volunteer['id'] %}Edit{% else %}Add{% endif %}{% endblock %}

{% block content %}
	{% set token = security.getToken() %}
	{% set tokenKey = security.getTokenKey() %}

	<section>
		<h2>User {% if volunteer['id'] %}Edit{% else %}Add{% endif %}</h2>

		<form class="form-horizontal" method="post" action="{{ volunteer['id'] ? url({'for': 'volunteer-instance', 'id': volunteer['id']}) : url({'for': 'volunteer-list'}) }}">

			<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">

			<div class="control-group">
				<label class="control-label" for="nameFirst">First Name</label>
				<div class="controls">
					<input type="text" id="nameFirst" name="nameFirst" placeholder="First Name" value="{{ volunteer['nameFirst'] }}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="nameLast">Last Name</label>
				<div class="controls">
					<input type="text" id="nameLast" name="nameLast" placeholder="Last Name" value="{{ volunteer['nameLast'] }}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="address">Address</label>
				<div class="controls">
					<input type="text" id="address" name="address" placeholder="Address" value="{{ volunteer['address'] }}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="city">City</label>
				<div class="controls">
					<input type="text" id="city" name="city" placeholder="City" value="{{ volunteer['city'] }}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="state">State</label>
				<div class="controls">
					<input type="text" id="state" name="state" placeholder="State" value="{{ volunteer['state'] }}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="zip">Zip</label>
				<div class="controls">
					<input type="text" id="zip" name="zip" placeholder="Zip" value="{{ volunteer['zip'] }}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="phoneDay">Phone Day</label>
				<div class="controls">
					<input type="text" id="phoneDay" name="phoneDay" placeholder="Phone Day" value="{{ volunteer['phoneDay']|phone }}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="phoneEve">Phone Eve</label>
				<div class="controls">
					<input type="text" id="phoneEve" name="phoneEve" placeholder="Phone Eve" value="{{ volunteer['phoneEve']|phone }}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="phoneCell">Phone Cell</label>
				<div class="controls">
					<input type="text" id="phoneCell" name="phoneCell" placeholder="Phone Cell" value="{{ volunteer['phoneCell']|phone }}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="email">Email</label>
				<div class="controls">
					<input type="text" id="email" name="email" placeholder="Email" value="{{ volunteer['email'] }}">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="dob">DOB</label>
				<div class="controls">
					<input type="text" id="dob" name="dob" placeholder="DOB" value="{% if volunteer['dob'] %}{{ date('Y-m-d', volunteer['dob']) }}{% endif %}">
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox" id="available" name="available" value="1"{% if volunteer['available'] %} checked{% endif %}> Available
					</label>
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					<button type="reset" class="btn">Cancel</button>
					<button type="submit" class="btn btn-primary" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Saving &hellip;"><i class="icon icon-save"></i> Save</button>
				</div>
			</div>

		</form>
	</section>

	{% if volunteer['id'] %}
		{% include 'modals/delete-confirm.volt' %}
	{% endif %}
{%  endblock %}
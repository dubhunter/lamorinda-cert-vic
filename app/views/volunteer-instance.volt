{% extends 'layouts/core.volt' %}

{% block title %}Volunteer {% if volunteer['id'] %}Edit{% else %}Add{% endif %}{% endblock %}

{% block content %}
	{% set token = security.getToken() %}
	{% set tokenKey = security.getTokenKey() %}

	<section>
		<h2>Volunteer {% if volunteer['id'] %}Edit{% else %}Add{% endif %}</h2>

		<form method="post" enctype="multipart/form-data" action="{{ volunteer['id'] ? url({'for': 'volunteer-instance', 'id': volunteer['id']}) : url({'for': 'volunteer-list'}) }}">

			<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">

			<fieldset>

				<legend>Personal Info</legend>

				<div class="row-fluid">
					<div class="span3 offset1">
						<label for="nameLast">Last Name</label>
						<input class="span12" type="text" id="nameLast" name="nameLast" placeholder="Last Name" value="{{ app['values']['nameLast']|default(volunteer['nameLast']) }}">
					</div>
					<div class="span3">
						<label for="nameFirst">First Name</label>
						<input class="span12" type="text" id="nameFirst" name="nameFirst" placeholder="First Name" value="{{ app['values']['nameFirst']|default(volunteer['nameFirst']) }}">
					</div>
					<div class="span3">
						<label for="nameLast">Middle Name</label>
						<input class="span12" type="text" id="nameMiddle" name="nameMiddle" placeholder="Middle Name" value="{{ app['values']['nameMiddle']|default(volunteer['nameMiddle']) }}">
					</div>
				</div>

				<div class="row-fluid">
					<div class="span3 offset1">
						<label for="address">Address</label>
						<input class="span12" type="text" id="address" name="address" placeholder="Address" value="{{ app['values']['address']|default(volunteer['address']) }}">
					</div>
					<div class="span3">
						<label for="city">City</label>
						<input class="span12" type="text" id="city" name="city" placeholder="City" value="{{ app['values']['city']|default(volunteer['city']) }}">
					</div>
					<div class="span1">
						<label for="state">State</label>
						<input class="span12" type="text" id="state" name="state" placeholder="State" value="{{ app['values']['state']|default(volunteer['state']) }}">
					</div>
					<div class="span2">
						<label for="zip">Zip</label>
						<input class="span12" type="text" id="zip" name="zip" placeholder="Zip" value="{{ app['values']['zip']|default(volunteer['zip']) }}">
					</div>
				</div>

				<div class="row-fluid">
					<div class="span3 offset1">
						<label for="phoneDay">Phone Day</label>
						<input class="span12" type="text" id="phoneDay" name="phoneDay" placeholder="Phone Day" value="{{ app['values']['phoneDay']|default(volunteer['phoneDay']|phone) }}">
					</div>
					<div class="span3">
						<label for="phoneEve">Phone Eve</label>
						<input class="span12" type="text" id="phoneEve" name="phoneEve" placeholder="Phone Eve" value="{{ app['values']['phoneEve']|default(volunteer['phoneEve']|phone) }}">
					</div>
					<div class="span3">
						<label for="phoneCell">Phone Cell</label>
						<input class="span12" type="text" id="phoneCell" name="phoneCell" placeholder="Phone Cell" value="{{ app['values']['phoneCell']|default(volunteer['phoneCell']|phone) }}">
					</div>
				</div>

				<div class="row-fluid">
					<div class="span3 offset1">
						<label for="email">Email</label>
						<input class="span12" type="text" id="email" name="email" placeholder="Email" value="{{ app['values']['email']|default(volunteer['email']) }}">
					</div>
					<div class="span3">
						<label for="emergencyContactName">Emergency Contact</label>
						<input class="span12" type="text" id="emergencyContactName" name="emergencyContactName" placeholder="Emergency Contact" value="{{ app['values']['emergencyContactName']|default(volunteer['emergencyContactName']) }}">
					</div>
					<div class="span3">
						<label for="emergencyContactPhone">Emergency Number</label>
						<input class="span12" type="text" id="emergencyContactPhone" name="emergencyContactPhone" placeholder="Emergency Number" value="{{ app['values']['emergencyContactPhone']|default(volunteer['emergencyContactPhone']) }}">
					</div>
				</div>

				<div class="row-fluid">
					<div class="span3 offset1">
						<label for="idType">ID Type</label>
						<select class="span12" id="idType" name="idType">
							<option value="">-- Type --</option>
							{% for type, label in idTypes %}
								<option value="{{ type }}"{% if type == app['values']['idType']|default(volunteer['idType']) %} selected{% endif %}>{{ label }}</option>
							{% endfor %}
						</select>
					</div>
					<div class="span3">
						<label for="idState">Jurisdiction</label>
						<input class="span12" type="text" id="idState" name="idState" placeholder="Jurisdiction" value="{{ app['values']['idState']|default(volunteer['idState']) }}">
					</div>
					<div class="span3">
						<label for="idNumber">Number</label>
						<input class="span12" type="text" id="idNumber" name="idNumber" placeholder="Number" value="{{ app['values']['idNumber']|default(volunteer['idNumber']) }}">
					</div>
				</div>

				<div class="row-fluid">
					<div class="span3 offset1">
						<label class="checkbox">
							<input type="checkbox" id="minor" name="minor" value="1"{% if app['values']['minor']|default(volunteer['minor']) %} checked{% endif %}> Under 18
						</label>
					</div>
					<div class="span3">
						<label for="dob">DOB</label>
						<input class="span12" type="text" id="dob" name="dob" placeholder="DOB" value="{{ app['values']['dob']|default(volunteer['dob']|date('Y-m-d')) }}">
					</div>
					<div class="span3">
						<label for="guardianName">Parent/Guardian Name</label>
						<input class="span12" type="text" id="guardianName" name="guardianName" placeholder="Parent/Guardian Name" value="{{ app['values']['guardianName']|default(volunteer['guardianName']) }}">
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 offset1">
						<label for="agency">Agency</label>
						<input class="span6" type="text" id="agency" name="agency" placeholder="Agency" value="{{ app['values']['agency']|default(volunteer['agency']) }}">

						<label for="training">Training</label>
						<textarea class="span12" id="training" name="training" placeholder="Training" rows="8">{{ app['values']['training']|default(volunteer['training']) }}</textarea>

						<label class="checkbox">
							<input type="checkbox" id="available" name="available" value="1"{% if app['values']['available']|default(volunteer['available']) %} checked{% endif %}> Available
						</label>
					</div>
					<div class="span3">
						<img src="{% if volunteer['hasImage'] %}{{ url({'for': 'volunteer-instance-image', 'id': volunteer['id']}) }}{% else %}/images/default-avatar.png{% endif %}" width="270" height="270" class="img-rounded">
						<input type="file" id="image" name="image" class="btn margin-top-mini" title="{{ '<i class="icon icon-hdd-o"></i>'|e }} Browse for Image">
					</div>
				</div>

			</fieldset>

			<fieldset>

				<legend>Skills</legend>

			</fieldset>

			<fieldset>

				<legend>Availability</legend>

			</fieldset>

			<fieldset>

				<legend>Placement</legend>

			</fieldset>

			<fieldset>

				<legend>Application Details</legend>

			</fieldset>

			<div class="row-fluid margin-top-large">
				<div class="span9 offset1">
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
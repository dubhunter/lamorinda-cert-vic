{% set token = security.getToken() %}
{% set tokenKey = security.getTokenKey() %}

<form method="post" action="{{ volunteerDsw['id'] ? url({'for': 'volunteer-dsw-instance', 'volunteerId': volunteerId, 'id': volunteerDsw['id']}) : url({'for': 'volunteer-dsw-list', 'volunteerId': volunteerId}) }}" id="volunteerDsw" data-reload="#dsw" class="modal hide fade form-horizontal" tabindex="-1" role="ajax modal" aria-labelledby="volunteerDswLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="volunteerDswLabel">Volunteer DSW {% if volunteerDsw['id'] %}Edit{% else %}Add{% endif %}</h3>
	</div>
	<div class="modal-body">
		<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">

		<div class="control-group">
			<label class="control-label" for="dswClassId">DSW Class</label>
			<div class="controls">
				<select id="dswClassId" name="dswClassId">
					<option value="">-- DSW Class --</option>
					{% for dswClass in dswClasses %}
						<option value="{{ dswClass['id'] }}"{% if dswClass['id'] == app['values']['dswClassId']|default(volunteerDsw['dswClassId']) %} selected{% endif %}>{{ dswClass['class'] }}</option>
					{% endfor %}
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="jurisdictionId">Jurisdiction</label>
			<div class="controls">
				<select id="jurisdictionId" name="jurisdictionId">
					<option value="">-- Jurisdiction --</option>
					{% for jurisdiction in jurisdictions %}
						<option value="{{ jurisdiction['id'] }}"{% if jurisdiction['id'] == app['values']['jurisdictionId']|default(volunteerDsw['jurisdictionId']) %} selected{% endif %}>{{ jurisdiction['jurisdiction'] }}</option>
					{% endfor %}
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="swornBy">Sworn By</label>
			<div class="controls">
				<input type="text" id="swornBy" name="swornBy" placeholder="Sworn By" value="{{ app['values']['swornBy']|default(volunteerDsw['swornBy']) }}">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		<button type="submit" class="btn btn-primary" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Saving &hellip;"><i class="icon icon-save"></i> Save</button>
	</div>
</form>
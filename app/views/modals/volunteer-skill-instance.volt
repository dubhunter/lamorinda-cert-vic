{% set token = security.getToken() %}
{% set tokenKey = security.getTokenKey() %}

<form method="post" action="{{ volunteerSkill['id'] ? url({'for': 'volunteer-skill-instance', 'volunteerId': volunteerId, 'id': volunteerSkill['id']}) : url({'for': 'volunteer-skill-list', 'volunteerId': volunteerId}) }}" id="volunteerSkill" data-reload="#skills" class="modal hide fade form-horizontal" tabindex="-1" role="ajax modal" aria-labelledby="volunteerSkillLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="volunteerSkillLabel">Volunteer Skill {% if volunteerSkill['id'] %}Edit{% else %}Add{% endif %}</h3>
	</div>
	<div class="modal-body">
		<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">

		<div class="control-group">
			<label class="control-label" for="skillCode">Skill</label>
			<div class="controls">
				<select id="skillCode" name="skillCode">
					<option value="">-- Skill --</option>
					{% for skill in skills %}
						<option value="{{ skill['code'] }}"{% if skill['code'] == app['values']['skillCode']|default(volunteerSkill['skillCode']) %} selected{% endif %}>{{ skill['code'] }} - {{ skill['skill'] }}</option>
					{% endfor %}
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="license">License</label>
			<div class="controls">
				<input type="text" id="license" name="license" placeholder="License" value="{{ app['values']['license']|default(volunteerSkill['license']) }}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="licenseAuth">License Auth</label>
			<div class="controls">
				<input type="text" id="licenseAuth" name="licenseAuth" placeholder="License Auth" value="{{ app['values']['licenseAuth']|default(volunteerSkill['licenseAuth']) }}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="licenseExp">License Expiration</label>
			<div class="controls">
				<input type="text" id="licenseExp" name="licenseExp" placeholder="License Expiration" value="{{ app['values']['licenseExp']|default(volunteerSkill['licenseExp']|date('Y-m-d')) }}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="specialty">Specialty</label>
			<div class="controls">
				<input type="text" id="specialty" name="specialty" placeholder="Specialty" value="{{ app['values']['specialty']|default(volunteerSkill['specialty']) }}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="comment">Comments</label>
			<div class="controls">
				<textarea id="comment" name="comment" placeholder="Comments" rows="3">{{ app['values']['comment']|default(volunteerSkill['comment']) }}</textarea>
			</div>
		</div>

		<div class="control-group">
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" id="check" name="check" value="1"{% if app['values']['check']|default(volunteerSkill['check']) %} checked{% endif %}> Checked
				</label>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		<button type="submit" class="btn btn-primary" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Saving &hellip;"><i class="icon icon-save"></i> Save</button>
	</div>
</form>
{% set token = security.getToken() %}
{% set tokenKey = security.getTokenKey() %}

<form method="post" action="{{ requestDetail['id'] ? url({'for': 'request-detail-instance', 'requestId': requestId, 'id': requestDetail['id']}) : url({'for': 'request-detail-list', 'requestId': requestId}) }}" id="requestDetail" data-reload="#details" class="modal hide fade form-horizontal" tabindex="-1" role="ajax modal" aria-labelledby="requestDetailLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="requestDetailLabel">Request Detail {% if requestDetail['id'] %}Edit{% else %}Add{% endif %}</h3>
	</div>
	<div class="modal-body">
		<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">

		<div class="control-group">
			<label class="control-label" for="skillCode">Skill</label>
			<div class="controls">
				<select id="skillCode" name="skillCode">
					<option value="">-- Skill --</option>
					{% for skill in skills %}
						<option value="{{ skill['code'] }}"{% if skill['code'] == app['values']['skillCode']|default(requestDetail['skillCode']) %} selected{% endif %}>{{ skill['code'] }} - {{ skill['skill'] }}</option>
					{% endfor %}
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="number">Number</label>
			<div class="controls">
				<input type="text" id="number" name="number" placeholder="Number" value="{{ app['values']['number']|default(requestDetail['number']) }}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="days">Days</label>
			<div class="controls">
				<input type="text" id="days" name="days" placeholder="Days" value="{{ app['values']['days']|default(requestDetail['days']) }}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="startDate">Start Date</label>
			<div class="controls">
				<input type="text" id="startDate" name="startDate" placeholder="Start Date" value="{{ app['values']['startDate']|default(requestDetail['startDate']|date('Y-m-d')) }}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="startTime">Start Time</label>
			<div class="controls">
				<input type="text" id="startTime" name="startTime" placeholder="Start Start" value="{{ app['values']['startTime']|default(requestDetail['startTime']|date('H:i:s')) }}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="hours">Hours</label>
			<div class="controls">
				<input type="text" id="hours" name="hours" placeholder="Hours" value="{{ app['values']['hours']|default(requestDetail['hours']) }}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="comment">Comments</label>
			<div class="controls">
				<textarea id="comment" name="comment" placeholder="Comments" rows="3">{{ app['values']['comment']|default(requestDetail['comment']) }}</textarea>
			</div>
		</div>

		<div class="control-group">
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" id="open" name="open" value="1"{% if app['values']['open']|default(requestDetail['open']) %} checked{% endif %}> Open
				</label>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		<button type="submit" class="btn btn-primary" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Saving &hellip;"><i class="icon icon-save"></i> Save</button>
	</div>
</form>
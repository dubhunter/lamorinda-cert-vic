{% set token = security.getToken() %}
{% set tokenKey = security.getTokenKey() %}

<form method="post" action="{{ volunteerAvailability['id'] ? url({'for': 'volunteer-availability-instance', 'volunteerId': volunteerId, 'id': volunteerAvailability['id']}) : url({'for': 'volunteer-availability-list', 'volunteerId': volunteerId}) }}" id="volunteerAvailability" data-reload="#availability" class="modal hide fade form-horizontal" tabindex="-1" role="ajax modal" aria-labelledby="volunteerAvailabilityLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="volunteerAvailabilityLabel">Volunteer Availability {% if volunteerAvailability['id'] %}Edit{% else %}Add{% endif %}</h3>
	</div>
	<div class="modal-body">
		<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">

		<div class="control-group">
			<label class="control-label" for="date">Date</label>
			<div class="controls">
				<input type="text" id="date" name="date" placeholder="Date" value="{{ app['values']['date']|default(volunteerAvailability['date']|date('Y-m-d')) }}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="start">Start</label>
			<div class="controls">
				<input type="text" id="start" name="start" placeholder="State" value="{{ app['values']['start']|default(volunteerAvailability['start']|date('H:i:s')) }}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="end">End</label>
			<div class="controls">
				<input type="text" id="end" name="end" placeholder="End" value="{{ app['values']['end']|default(volunteerAvailability['end']|date('H:i:s')) }}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="comment">Comments</label>
			<div class="controls">
				<textarea id="comment" name="comment" placeholder="Comments" rows="3">{{ app['values']['comment']|default(volunteerAvailability['comment']) }}</textarea>
			</div>
		</div>

		<div class="control-group">
			<div class="controls">
				<label class="checkbox">
					<input type="checkbox" id="open" name="open" value="1"{% if app['values']['open']|default(volunteerAvailability['open']) %} checked{% endif %}> Open
				</label>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		<button type="submit" class="btn btn-primary" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Saving &hellip;"><i class="icon icon-save"></i> Save</button>
	</div>
</form>
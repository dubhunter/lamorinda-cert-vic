{% set token = security.getToken() %}
{% set tokenKey = security.getTokenKey() %}

<form method="post" action="{{ volunteerPlacement['id'] ? url({'for': 'volunteer-placement-instance', 'volunteerId': volunteerId, 'id': volunteerPlacement['id']}) : url({'for': 'volunteer-placement-list', 'volunteerId': volunteerId}) }}" id="volunteerPlacement" data-reload="#placements" class="modal hide fade form-horizontal" tabindex="-1" role="ajax modal" aria-labelledby="volunteerPlacementLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="volunteerPlacementLabel">Volunteer Placement {% if volunteerPlacement['id'] %}Edit{% else %}Add{% endif %}</h3>
	</div>
	<div class="modal-body">
		<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">

		<div class="control-group">
			<label class="control-label" for="requestDetailId">Request Detail</label>
			<div class="controls">
				<select id="requestDetailId" name="requestDetailId">
					<option value="">-- Request Detail --</option>
					{% for request in requests %}
						<optgroup label="{{ request['id']|pad_left(6, '0') }} - {{ request['agencyId'] }} - {{ request['agencyName'] }}">
						{% for requestDetail in request['requestDetails'] %}
							<option value="{{ requestDetail['id'] }}"{% if requestDetail['id'] == app['values']['requestDetailId']|default(volunteerPlacement['requestDetailId']) %} selected{% endif %}>{{ requestDetail['code'] }} {{ requestDetail['skill'] }} {{ requestDetail['startDate']|date('Y-m-d') }} {{ requestDetail['startTime']|date('H:i:s') }}</option>
						{% endfor %}
						</optgroup>
					{% endfor %}
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="comment">Comments</label>
			<div class="controls">
				<textarea id="comment" name="comment" placeholder="Comments" rows="3">{{ app['values']['comment']|default(volunteerPlacement['comment']) }}</textarea>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		<button type="submit" class="btn btn-primary" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Saving &hellip;"><i class="icon icon-save"></i> Save</button>
	</div>
</form>
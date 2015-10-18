{% if volunteerPlacements %}
	<table class="table table-hover">
		<thead>
		<tr>
			<th>Date</th>
			<th>Request ID</th>
			<th>Agency</th>
			<th>Days</th>
			<th>Comments</th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		{% for item in volunteerPlacements %}
			<tr>
				<td>{{ item['date']|date('Y-m-d') }}</td>
				<td><a href="{{ url({'for': 'request-instance', 'id': item['requestId']}) }}">{{ item['requestId']|pad_left(6, '0') }}</a></td>
				<td>{{ item['agencyId'] }} - {{ item['agencyName'] }}</td>
				<td>{{ item['days'] }}</td>
				<td>{{ item['comment'] }}</td>
				<td class="text-right">
					<a href="{{ url({'for': 'volunteer-placement-instance-badge', 'volunteerId': volunteerId, 'id': item['id']}) }}" title="Print Badge" class="btn btn-mini" target="_blank"><i class="icon icon-print"></i></a>
					<a href="{{ url({'for': 'volunteer-placement-instance', 'volunteerId': volunteerId, 'id': item['id']}) }}" title="Edit" class="btn btn-mini" data-toggle="modal"><i class="icon icon-pencil"></i></a>
				</td>
			</tr>
		{% endfor %}
		</tbody>
	</table>
{% else %}
	<div class="well clearfix">
		<h4 class="text-center">No placements added.</h4>
	</div>
{% endif %}
{% if volunteerAvailability %}
	<table class="table table-hover">
		<thead>
		<tr>
			<th>Skill</th>
			<th>Description</th>
			<th>Expiration</th>
			<th>Comments</th>
		</tr>
		</thead>
		<tbody>
		{% for item in volunteerAvailability %}
			<tr>
				<td>{{ item['date']|date('Y-m-d') }}</td>
				<td>{{ item['start']|date('H:i:s') }}</td>
				<td>{{ item['end']|date('H:i:s') }}</td>
				<td>{{ item['comment'] }}</td>
				<td class="text-right">
					<a href="{{ url({'for': 'volunteer-availability-instance', 'volunteerId': volunteerId, 'id': item['id']}) }}" class="btn btn-mini" data-toggle="modal"><i class="icon icon-pencil"></i></a>
				</td>
			</tr>
		{% endfor %}
		</tbody>
	</table>
{% else %}
	<div class="well clearfix">
		<h4 class="text-center">No Skills Added.</h4>
	</div>
{% endif %}
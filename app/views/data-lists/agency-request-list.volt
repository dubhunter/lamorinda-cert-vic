{% if requestDetails %}
	<table class="table table-hover">
		<thead>
		<tr>
			<th>Request ID</th>
			<th>Skill</th>
			<th>Description</th>
			<th>Start Date</th>
			<th>Days</th>
			<th>Number</th>
		</tr>
		</thead>
		<tbody>
		{% for item in requestDetails %}
			<tr>
				<td><a href="{{ url({'for': 'request-instance', 'id': item['requestId']}) }}">{{ item['requestId']|pad_left(6, '0') }}</a></td>
				<td>{{ item['code'] }}</td>
				<td>{{ item['skill'] }}</td>
				<td>{{ item['startDate']|date('Y-m-d') }}</td>
				<td>{{ item['days'] }}</td>
				<td>{{ item['number'] }}</td>
			</tr>
		{% endfor %}
		</tbody>
	</table>
{% else %}
	<div class="well clearfix">
		<h4 class="text-center">No open requests added.</h4>
	</div>
{% endif %}
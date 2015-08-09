{% if requestDetails %}
	<table class="table table-hover">
		<thead>
		<tr>
			<th>Skill</th>
			<th>Description</th>
			<th>Start Date</th>
			<th>Days</th>
			<th>Number</th>
			<th>Status</th>
		</tr>
		</thead>
		<tbody>
		{% for item in requestDetails %}
			<tr>
				<td>{{ item['code'] }}</td>
				<td>{{ item['skill'] }}</td>
				<td>{{ item['startDate']|date('Y-m-d') }}</td>
				<td>{{ item['days'] }}</td>
				<td>{{ item['number'] }}</td>
				<td>{% if item['open'] %}<i class="icon icon-circle-o"></i>{% else %}<i class="icon icon-ban"></i>{% endif %}</td>
				<td class="text-right">
					<a href="{{ url({'for': 'request-detail-instance', 'requestId': requestId, 'id': item['id']}) }}" class="btn btn-mini" data-toggle="modal"><i class="icon icon-pencil"></i></a>
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
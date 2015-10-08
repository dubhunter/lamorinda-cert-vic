{% if volunteerDsw %}
	<table class="table table-hover">
		<thead>
		<tr>
			<th>Date</th>
			<th>Class</th>
			<th>Jurisdiction</th>
			<th>Sworn By</th>
		{% if app['user']['admin'] %}
			<th>&nbsp;</th>
		{% endif %}
		</tr>
		</thead>
		<tbody>
		{% for item in volunteerDsw %}
			<tr>
				<td>{{ item['date']|date('Y-m-d') }}</td>
				<td>{{ item['class'] }}</td>
				<td>{{ item['jurisdiction'] }}</td>
				<td>{{ item['swornBy'] }}</td>
			{% if app['user']['admin'] %}
				<td class="text-right">
					<a href="{{ url({'for': 'volunteer-dsw-instance', 'volunteerId': volunteerId, 'id': item['id']}) }}" title="Edit" class="btn btn-mini" data-toggle="modal"><i class="icon icon-pencil"></i></a>
				</td>
			{% endif %}
			</tr>
		{% endfor %}
		</tbody>
	</table>
{% else %}
	<div class="well clearfix">
		<h4 class="text-center">No dsw designations added.</h4>
	</div>
{% endif %}
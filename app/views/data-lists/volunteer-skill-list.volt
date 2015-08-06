{% if volunteerSkills %}
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
		{% for item in volunteerSkills %}
			<tr>
				<td>{{ item['code'] }}</td>
				<td>{{ item['skill'] }}</td>
				<td>{{ item['licenseExp']|date('Y-m-d') }}</td>
				<td>{{ item['comment'] }}</td>
				<td class="text-right">
					<a href="{{ url({'for': 'volunteer-skill-instance', 'volunteerId': volunteerId, 'id': item['id']}) }}" class="btn btn-mini" data-toggle="modal"><i class="icon icon-pencil"></i></a>
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
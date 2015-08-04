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
		{% for volunteerSkill in volunteerSkills %}
			<tr>
				<td>{{ volunteerSkill['code'] }}</td>
				<td>{{ volunteerSkill['skill'] }}</td>
				<td>{{ volunteerSkill['licenseExp']|date('Y-m-d') }}</td>
				<td>{{ volunteerSkill['comment'] }}</td>
				<td class="text-right">
					<a href="{{ url({'for': 'volunteer-skill-instance', 'volunteerId': volunteerId, 'id': volunteerSkill['id']}) }}" class="btn btn-mini" data-toggle="modal"><i class="icon icon-pencil"></i></a>
				</td>
			</tr>
		{% endfor %}
		</tbody>
	</table>
{% else %}
	<div class="well clearfix">
		<h3 class="text-center">No Skills Added.</h3>
	</div>
{% endif %}
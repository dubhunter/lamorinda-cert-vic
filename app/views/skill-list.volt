{% extends 'layouts/core.volt' %}

{% block title %}Skills{% endblock %}

{% block content %}
	<section>
		<a href="{{ url({'for': 'skill-create'}) }}" class="btn pull-right"><i class="icon icon-plus"></i> Add Skill</a>
		<h2>Skills</h2>
		<table class="table table-hover">
			<thead>
			<tr>
				<th>Id</th>
				<th>Skill</th>
				<th>&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			{% for skill in skills %}
				<tr>
					<td>{{ skill['code'] }}</td>
					<td>{{ skill['skill'] }}</td>
					<td class="text-right">
						<a href="{{ url({'for': 'skill-instance', 'code': skill['code']}) }}" class="btn btn-mini"><i class="icon icon-pencil"></i></a>
					</td>
				</tr>
			{% endfor %}
			</tbody>
		</table>
	</section>
{%  endblock %}
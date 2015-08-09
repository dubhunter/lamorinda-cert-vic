{% extends 'layouts/core.volt' %}

{% block title %}Agencies{% endblock %}

{% block content %}
	<section>
		<a href="{{ url({'for': 'agency-create'}) }}" class="btn pull-right"><i class="icon icon-plus"></i> Add Agency</a>
		<h2>Agencies</h2>
		<table class="table table-hover">
			<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>City</th>
				<th>Contact</th>
				<th>Comment</th>
				<th>&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			{% for agency in agencies %}
				<tr>
					<td>{{ agency['id'] }}</td>
					<td>{{ agency['name'] }}</td>
					<td>{{ agency['city'] }}</td>
					<td>{{ agency['contact'] }}</td>
					<td>{{ agency['comment'] }}</td>
					<td class="text-right">
						<a href="{{ url({'for': 'agency-instance', 'id': agency['id']}) }}" class="btn btn-mini{% if agency['id'] == app['agency']['id'] %} disabled{% endif %}"><i class="icon icon-pencil"></i></a>
					</td>
				</tr>
			{% endfor %}
			</tbody>
		</table>
	</section>
{%  endblock %}
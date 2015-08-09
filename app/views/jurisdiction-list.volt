{% extends 'layouts/core.volt' %}

{% block title %}Jurisdictions{% endblock %}

{% block content %}
	<section>
		<a href="{{ url({'for': 'jurisdiction-create'}) }}" class="btn pull-right"><i class="icon icon-plus"></i> Add Jurisdiction</a>
		<h2>Jurisdictions</h2>
		<table class="table table-hover">
			<thead>
			<tr>
				<th>Id</th>
				<th>Jurisdiction</th>
				<th>&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			{% for jurisdiction in jurisdictions %}
				<tr>
					<td>{{ jurisdiction['id'] }}</td>
					<td>{{ jurisdiction['jurisdiction'] }}</td>
					<td class="text-right">
						<a href="{{ url({'for': 'jurisdiction-instance', 'id': jurisdiction['id']}) }}" class="btn btn-mini"><i class="icon icon-pencil"></i></a>
					</td>
				</tr>
			{% endfor %}
			</tbody>
		</table>
	</section>
{%  endblock %}
{% extends 'layouts/core.volt' %}

{% block title %}DSW Classs{% endblock %}

{% block content %}
	<section>
		<a href="{{ url({'for': 'dsw-class-create'}) }}" class="btn pull-right"><i class="icon icon-plus"></i> Add DSW Class</a>
		<h2>DSW Classs</h2>
		<table class="table table-hover">
			<thead>
			<tr>
				<th>Id</th>
				<th>Class</th>
				<th>&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			{% for dswClass in dswClasses %}
				<tr>
					<td>{{ dswClass['id'] }}</td>
					<td>{{ dswClass['class'] }}</td>
					<td class="text-right">
						<a href="{{ url({'for': 'dsw-class-instance', 'id': dswClass['id']}) }}" title="Edit" class="btn btn-mini"><i class="icon icon-pencil"></i></a>
					</td>
				</tr>
			{% endfor %}
			</tbody>
		</table>
	</section>
{%  endblock %}
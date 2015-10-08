{% extends 'layouts/core.volt' %}

{% block title %}Users{% endblock %}

{% block content %}
	<section>
		<a href="{{ url({'for': 'user-create'}) }}" class="btn pull-right"><i class="icon icon-plus"></i> Add User</a>
		<h2>Users</h2>
		<table class="table table-hover">
			<thead>
			<tr>
				<th>Id</th>
				<th>Username</th>
				<th>Role</th>
				<th>Date Created</th>
				<th>Date Updated</th>
				<th>&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			{% for user in users %}
				<tr>
					<td>{{ user['id'] }}</td>
					<td>{{ user['username'] }}</td>
					<td>{{ user['roleName'] }}</td>
					<td>{{ user['dateCreated']|date('Y-m-d H:i:s') }}</td>
					<td>{{ user['dateUpdated']|date('Y-m-d H:i:s') }}</td>
					<td class="text-right">
						<a href="{{ url({'for': 'user-instance', 'id': user['id']}) }}" title="Edit" class="btn btn-mini{% if user['id'] == app['user']['id'] %} disabled{% endif %}"><i class="icon icon-pencil"></i></a>
					</td>
				</tr>
			{% endfor %}
			</tbody>
		</table>
	</section>
{%  endblock %}
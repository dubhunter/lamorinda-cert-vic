{% extends 'layouts/core.volt' %}

{% block title %}Users{% endblock %}

{% block content %}
	<section>
		<a href="{{ url({'for': 'user-create'}) }}" class="btn pull-right"><i class="icon icon-user-plus"></i> Add User</a>
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
					<td>{{ date('Y-m-d H:i:s', user['dateCreated']) }}</td>
					<td>{{ date('Y-m-d H:i:s', user['dateUpdated']) }}</td>
					<td class="text-right">
						<a href="{{ url({'for': 'user-instance', 'id': user['id']}) }}" class="btn btn-mini{% if user['id'] == app['user']['id'] %} disabled{% endif %}"><i class="icon icon-pencil"></i></a>
					</td>
				</tr>
			{% endfor %}
			</tbody>
		</table>
	</section>
{%  endblock %}
{% extends 'layouts/core.volt' %}

{% block title %}Volunteers{% endblock %}

{% block content %}
	<section>
		<a href="{{ url({'for': 'volunteer-create'}) }}" class="btn pull-right margin-left-xlarge"><i class="icon icon-user-plus"></i> Add Volunteer</a>
		<form class="pull-right" method="get" action="{{ url({'for': 'volunteer-list'}) }}">
			<div class="input-append">
				<input type="text" class="input-large" name="q">
				<button type="submit" class="btn"><i class="icon icon-search"></i></button>
			</div>
		</form>
		<h2>Volunteers</h2>
		{% if volunteers %}
			<table class="table table-hover">
				<thead>
				<tr>
					<th>First</th>
					<th>Last</th>
					<th>Phone</th>
					<th>Email</th>
					<th>City, ST</th>
					<th>DOB</th>
					<th>Entry</th>
					<th>Avail</th>
					<th>&nbsp;</th>
				</tr>
				</thead>
				<tbody>
				{% for volunteer in volunteers %}
					<tr>
						<td>{{ volunteer['nameFirst'] }}</td>
						<td>{{ volunteer['nameLast'] }}</td>
						<td>{{ volunteer['phoneCell']|phone }}</td>
						<td>{{ volunteer['email'] }}</td>
						<td>{{ volunteer['city'] }}, {{ volunteer['state'] }}</td>
						<td>{{ date('M d, Y', volunteer['dob']) }}</td>
						<td>{{ date('Y-m-d H:i:s', volunteer['entryTime']) }}</td>
						<td>{% if volunteer['available'] %}<i class="icon icon-check"></i>{% else %}<i class="icon icon-times"></i>{% endif %}</td>
						<td class="text-right">
							<a href="{{ url({'for': 'volunteer-instance', 'id': volunteer['id']}) }}" class="btn"><i class="icon icon-pencil"></i></a>
						</td>
					</tr>
				{% endfor %}
				</tbody>
			</table>
		{% else %}
			<div class="well clearfix">
				<h3 class="text-center">No Volunteers Found.</h3>
			</div>
		{% endif %}
	</section>
{%  endblock %}
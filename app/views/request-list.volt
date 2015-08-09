{% extends 'layouts/core.volt' %}

{% block title %}Requests{% endblock %}

{% block content %}
	<section>
		<a href="{{ url({'for': 'request-create'}) }}" class="btn pull-right margin-left-xlarge"><i class="icon icon-user-plus"></i> Add Request</a>
		<form class="pull-right" method="get" action="{{ url({'for': 'request-list'}) }}">
			<div class="input-append">
				<input type="text" class="input-large" name="q" value="{{ app['values']['q'] }}">
				<button type="submit" class="btn"><i class="icon icon-search"></i></button>
			</div>
		</form>
		<h2>Requests</h2>
		{% if requests %}
			<table class="table table-hover">
				<thead>
				<tr>
					<th>Agency</th>
					<th>Jurisdiction</th>
					<th>Contact</th>
					<th>Open</th>
					<th>&nbsp;</th>
				</tr>
				</thead>
				<tbody>
				{% for request in requests %}
					<tr>
						<td>{{ request['agency'] }}</td>
						<td>{{ request['jurisdiction'] }}</td>
						<td>{{ request['contact'] }}</td>
						<td>{% if request['open'] %}<i class="icon icon-check"></i>{% else %}<i class="icon icon-times"></i>{% endif %}</td>
						<td class="text-right">
							<a href="{{ url({'for': 'request-instance', 'id': request['id']}) }}" class="btn btn-mini"><i class="icon icon-pencil"></i></a>
						</td>
					</tr>
				{% endfor %}
				</tbody>
			</table>
		{% else %}
			<div class="well clearfix">
				<h3 class="text-center">No Requests Found.</h3>
			</div>
		{% endif %}
	</section>
{%  endblock %}
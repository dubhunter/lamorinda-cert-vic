{% extends 'layouts/core.volt' %}

{% block title %}Dashboard{% endblock %}

{% block content %}
	<section>
		<h2>Dashboard</h2>
		<ul class="thumbnails">
			<li class="span4">
				<a href="{{ url({'for': 'volunteer-list'}) }}" class="thumbnail well muted">
					<p class="lead margin-left-small">Volunteers</p>
					<dl class="dl-horizontal">
						<dt>Available</dt>
						<dd><span class="badge badge-success">{{ volunteers['available'] }}</span></dd>
						<dt>Total</dt>
						<dd><span class="badge">{{ volunteers['total'] }}</span></dd>
					</dl>
				</a>
			</li>
			<li class="span4">
				<a href="{{ url({'for': 'request-list'}) }}" class="thumbnail well muted">
					<p class="lead margin-left-small">Requests</p>
					<dl class="dl-horizontal">
						<dt>Open</dt>
						<dd><span class="badge badge-success">{{ requests['open'] }}</span></dd>
						<dt>Total</dt>
						<dd><span class="badge">{{ requests['total'] }}</span></dd>
					</dl>
				</a>
			</li>
			<li class="span4">
				<a href="{{ url({'for': 'agency-list'}) }}" class="thumbnail well muted">
					<p class="lead margin-left-small">Agencies</p>
					<dl class="dl-horizontal">
						<dt>With Open Requests</dt>
						<dd><span class="badge badge-success">{{ agencies['open'] }}</span></dd>
						<dt>Total</dt>
						<dd><span class="badge">{{ agencies['total'] }}</span></dd>
					</dl>
				</a>
			</li>
		</ul>
	</section>
{%  endblock %}
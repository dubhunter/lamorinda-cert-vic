{% extends 'layouts/core.volt' %}

{% block title %}{{ volunteer['nameFirst'] }} {{ volunteer['nameLast'] }} Badge{% endblock %}
{% block navigation %}{% endblock %}
{% block flashMessages %}{% endblock %}
{% block footer %}{% endblock %}

{% block content %}
	<div id="volunteer-placement-badge" class="row-fluid">
		<div class="span6">
			<img src="{% if volunteer['hasImage'] %}{{ url({'for': 'volunteer-instance-image', 'id': volunteer['id']}) }}{% else %}/images/default-avatar.png{% endif %}" class="img-rounded pull-right avatar">
			<h2>Volunteer</h2>
			<h3>{{ volunteer['nameFirst'] }} {{ volunteer['nameLast'] }}</h3>
			<p>
				{{ agency['name'] }}<br>
				{% if not volunteer['backgroundChecked'] %}NBC{% endif %}
				{% if volunteer['dsw'] %}DSW{% endif %}
				{% if not volunteer['backgroundChecked'] or volunteer['dsw'] %}<br>{% endif %}
				Expires: {{ requestDetail['endDate']|date('M j, Y') }}<br>
			</p>
			<p>
				{{ agency['city'] }}, California<br>
				{{ requestDetail['skill'] }}
			</p>
		</div>
		<div class="span6">
			<p>Lamorinda CERT Volunteer Reception Center</p>
			{% if volunteer['dsw'] %}
				<p>Volunteer is authorized to perform work in {{ agency['city'] }}, CA as a Disaster Service Worker.</p>
			{% endif %}

			<p class="small">
				This ID is issued by and property of <strong>Lamorinda CERT</strong>.<br>
				If found, please return to:<br><br>
				Moraga-Orinda Fire District<br>
				1280 Moraga Way<br>
				Moraga, CA 94556
			</p>
			<img src="/images/mofd-badge.png" width="60" height="60" class="logo pull-right">
		</div>
	</div>
	<script language="javascript">window.print();</script>
{%  endblock %}

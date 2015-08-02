<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Lamorinda CERT VRC | {% block title %}Volunteer Management{% endblock %}</title>

		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable = no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

		<meta name="author" content="Will Mason">
		<meta name="description" content="Lamorinda CERT volunteer management.">

		{{ assets.outputCss() }}
	</head>
	<body{% block bodyAttributes %}{% endblock %}>
		{# Declare the main navigation area #}
		{% block navigation %}
			{% include 'layouts/includes/navs/main.volt' %}
		{% endblock %}

		<div class="container">
			{% block flashMessages %}
				{% include 'layouts/includes/flash-messages.volt' %}
			{% endblock %}

			{% block content %}{% endblock %}

			{% block footer %}
				{% include 'layouts/includes/footer.volt' %}
			{% endblock %}
		</div>

		{{ assets.outputJs() }}
	</body>
</html>
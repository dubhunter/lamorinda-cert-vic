<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Lamorinda CERT VIC | {% block title %}Volunteer Management{% endblock %}</title>

		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable = no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

		<meta name="author" content="Will Mason">
		<meta name="description" content="The Twilio Owl web service and API. A directory of all Twilions.">

		<link rel="shortcut icon" href="/favicons/owl-64.png">
		<link rel="apple-touch-icon" href="/favicons/owl-57.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/favicons/owl-72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/favicons/owl-114.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/favicons/owl-144.png">

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
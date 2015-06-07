{% extends 'layouts/core.volt' %}

{% block title %}{{ code }} {{ message }}{% endblock %}

{% block content %}
	<section>
		<div class="hero-unit">
			<h1>{{ code }} {{ message }}</h1>
			<p>
				Either you are lost or something has gone terribly wrong.<br>
				Why don't you head back <a href="{{ url(['for': 'home']) }}">home</a> and try again.
			</p>
			<i class="icon icon-question-circle"></i>
		</div>
	</section>
{%  endblock %}
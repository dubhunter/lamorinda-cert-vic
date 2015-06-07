{% set menuItems = {} %}

<div id="main-navigation" class="navbar navbar-inverse navbar-top navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="{{ url(['for': 'dashboard']) }}">Lamorinda CERT VIC</a>

			{% if menuItems|length %}
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="nav-collapse collapse">
					<ul class="nav">
						{% for name, item in menuItems %}
							<li{% if name == menuSelected %} class="active"{% endif %}>
								<a href="{{ url(item) }}">{{ name }}</a>
							</li>
						{% endfor %}
					</ul>
				</div>
			{% endif %}
		</div>
	</div>
</div>
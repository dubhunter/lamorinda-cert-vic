{% set menuItems = {
	'Volunteers': {
		'for': 'volunteer-list'
	},
	'Requests': {
		'for': 'request-list'
	}
} %}

<div id="main-navigation" class="navbar navbar-top navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="{{ url(['for': 'dashboard']) }}">Lamorinda CERT VIC</a>

			{% if app['user'] and menuItems|length %}
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="nav-collapse collapse">
					<ul class="nav">
						{% for name, item in menuItems %}
							{% set url = url({'for': item['for']}) %}
							<li{% if url == app['url'] %} class="active"{% endif %}>
								<a href="{{ url }}" title="{{ name }}">{{ name }}</a>
							</li>
						{% endfor %}
					</ul>
					<ul class="nav pull-right">
						<li>
							<a href="{{ url({'for': 'logout'}) }}" title="Logout">Logout</a>
						</li>
					</ul>
				</div>
			{% endif %}
		</div>
	</div>
</div>
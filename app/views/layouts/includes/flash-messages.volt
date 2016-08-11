{% set flashMessages = flash.getMessages() %}

<div id="alert-container">
	{% if flashMessages|length %}
		{% for type, messages in flashMessages %}
			{% for message in messages %}
				<div class="alert alert-{{ type == 'notice' ? 'info' : type }}">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ message }}
				</div>
			{% endfor %}
		{% endfor %}
	{% endif %}
</div>

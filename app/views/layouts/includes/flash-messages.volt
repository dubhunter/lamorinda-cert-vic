<div id="alert-container">
	{% for type, messages in flash.getMessages() %}
		{% for message in messages %}
			<div class="alert alert-{{ type == 'notice' ? 'info' : type }}">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				{{ message }}
			</div>
		{% endfor %}
	{% endfor %}
</div>
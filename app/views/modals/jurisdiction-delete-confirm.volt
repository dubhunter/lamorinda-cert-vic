<div id="delete-jurisdiction" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="delete-jurisdiction-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="delete-jurisdiction-label">Delete Jurisdiction</h3>
	</div>
	<div class="modal-body">
		<div class="alert alert-warning">
			<strong>Careful!</strong>
			This action cannot be undone.
		</div>
		<p>Are you really sure you want to delete this jurisdiction?</p>
	</div>
	<div class="modal-footer form-horizontal">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		<button role="delete" data-action="{{ url(['for': 'jurisdiction-instance', 'id': jurisdiction['id']]) }}" data-loading-text="{{ '<i class="icon icon-spinner icon-spin"></i>'|e }} Processing &hellip;" class="btn btn-danger"><i class="icon icon-trash-o"></i> Delete</button>
	</div>
</div>
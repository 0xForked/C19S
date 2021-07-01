<div class="modal fade" id="add-explanation-references" tabindex="-1" aria-labelledby="addAccountModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?= form_open('references/explanations/create'); ?>
			<div class="modal-header">
				<h5 class="modal-title" id="addAccountModal">Tambah Referensi (Keterangan SWAB)</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<label for="title" class="col-form-label">Title</label>
					<input id="title" name="title" type="text" class="form-control" aria-label="title" required autofocus>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-danger">Save</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>
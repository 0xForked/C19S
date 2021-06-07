<div
	class="modal fade"
	id="verified-sample"
	tabindex="-1"
	aria-labelledby="verifiedSampleModalLabel"
	aria-hidden="true"
>
	<div class="modal-dialog">
		<?= form_open("samples/verified");?>
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="verifiedSampleModalLabel">Verifikasi Sample</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" id="id">
				<div class="mb-3">
					<label for="verify_status" class="col-form-label"></label>
					<select name="verify_status" id="verify_status" class="form-select">
						<option value="NONE">Pilih status verifikasi</option>
						<option value="POSITIVE">POSITIVE</option>
						<option value="NEGATIVE">NEGATIVE</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</div>
		<?= form_close(); ?>
	</div>
</div>

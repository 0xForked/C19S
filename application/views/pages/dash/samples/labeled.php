<div class="modal fade" id="labeled-sample" tabindex="-1" aria-labelledby="labeledSampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<?= form_open("samples/labeled"); ?>
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="labeledSampleModalLabel">Labelling Sample</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" id="id">
				<div class="mb-3">
					<label for="label_status" class="col-form-label"></label>
					<select name="label_status" id="label_status" class="form-select">
						<option value="NONE">Pilih jenis pelabelan</option>
						<option value="EXTRACTING">EXTRACTING</option>
						<option value="MIXING">MIXING</option>
						<option value="PCR">PCR</option>
						<option value="TIDAK_LAYAK">SAMPEL TIDAK LAYAK</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-danger">Save</button>
			</div>
		</div>
		<?= form_close(); ?>
	</div>
</div>
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
				<div id="pcr-detail"  class="row d-none">
					<div class="col-6">
						<div class="form-group mb-4">
							<label for="fam">Gen Orflab (FAM)</label>
							<div class="input-group">
								<input id="fam" type="number" name="fam" class="form-control">
							</div>
						</div>
						<div class="form-group mb-4">
							<label for="cy5">Gen N (Cy5)</label>
							<div class="input-group">
								<input id="cy5" type="number" name="cy5" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-6">
						<div class="form-group mb-4">
							<label for="rox">Gen E (ROX)</label>
							<div class="input-group">
								<input id="rox" type="number" name="rox" class="form-control">
							</div>
						</div>
						<div class="form-group mb-4">
							<label for="joe">IC Control (JOE)</label>
							<div class="input-group">
								<input id="joe" type="number" name="joe" class="form-control">
							</div>
						</div>
					</div>
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

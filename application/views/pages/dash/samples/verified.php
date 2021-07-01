<div class="modal fade" id="verified-sample" tabindex="-1" aria-labelledby="verifiedSampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<?= form_open("samples/verified"); ?>
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="verifiedSampleModalLabel">Verifikasi Sampel</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" id="id">
				<div id="verified-detail">
					<label for="verified-detail-table" class="col-form-label">CT Data</label>
					<table class="table table-bordered table-responsive" id="verified-detail-table">
						<thead class="text-center">
						<tr>
							<th>FAM</th>
							<th>ROX</th>
							<th>Cy5</th>
							<th>JOE</th>
						</tr>
						</thead>
						<tbody class="text-center"></tbody>
					</table>
				</div>
				<div class="mb-3">
					<label for="verify_status" class="col-form-label">Verifikasi</label>
					<select name="verify_status" id="verify_status" class="form-select">
						<option value="NONE">Pilih status verifikasi</option>
						<option value="POSITIVE">POSITIVE</option>
						<option value="NEGATIVE">NEGATIVE</option>
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

<div
	class="modal fade"
	id="add-patient"
	tabindex="-1"
	aria-labelledby="addPatientModal"
	aria-hidden="true"
>
	<div class="modal-dialog">
		<div class="modal-content">
			<?= form_open('patients/create');?>
			<div class="modal-header">
				<h5 class="modal-title" id="addPatientModal">Tambah pasien baru</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<label for="nik" class="col-form-label">NIK</label>
					<input id="nik" name="nik" type="text" class="form-control" aria-label="nik" required autofocus>
				</div>
				<div class="mb-3">
					<label for="name" class="col-form-label">Nama</label>
					<input id="name" name="name" type="text" class="form-control" aria-label="name" required>
				</div>
				<div class="mb-3">
					<label for="place_of_birth" class="col-form-label">Tempat Lahir</label>
					<input id="place_of_birth" name="place_of_birth" type="text" class="form-control" aria-label="name" required>
				</div>
				<div class="mb-3">
					<label for="date_of_birth" class="col-form-label">Tanggal Lahir</label>
					<input id="date_of_birth" name="date_of_birth" type="date" class="form-control" aria-label="name" required>
				</div>
				<div class="mb-3">
					<label for="phone" class="col-form-label">Nomor Ponsel</label>
					<input id="phone" name="phone" type="text" class="form-control" aria-label="phone" required>
				</div>
				<div class="mb-3">
					<label for="gender" class="col-form-label">Jenis Kelamin</label>
					<select id="gender" name="gender" class="form-select" required>
						<option value="L">LAKI-LAKI (L)</option>
						<option value="P">PEREMPUAN (P)</option>
					</select>
				</div>
				<div class="mb-3">
					<label for="address" class="col-form-label">Alamat</label>
					<textarea id="address" name="address" type="text" class="form-control" aria-label="phone" required> </textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
			<?= form_close();?>
		</div>
	</div>
</div>

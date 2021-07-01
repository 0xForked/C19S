<div class="modal fade" id="add-user-account" tabindex="-1" aria-labelledby="addAccountModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?= form_open('users/accounts/create'); ?>
			<div class="modal-header">
				<h5 class="modal-title" id="addAccountModal">Tambah akun baru</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<label for="role" class="col-form-label">Role</label>
					<select id="role" name="role_id" class="form-select" aria-label="role">
						<?php foreach ($roles as $role) : ?>
							<option value="<?= $role->id ?>"><?= $role->title ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="mb-3">
					<label for="name" class="col-form-label">Nama</label>
					<input id="name" name="name" type="text" class="form-control" aria-label="name" required autofocus>
				</div>
				<div class="mb-3">
					<label for="email" class="col-form-label">Alamat Email</label>
					<input id="email" name="email" type="email" class="form-control" aria-label="email" required autofocus>
				</div>
				<div class="mb-3">
					<label for="phone" class="col-form-label">Nomor HP</label>
					<input id="phone" name="phone" type="text" class="form-control" aria-label="phone" required autofocus>
				</div>
				<div class="mb-3">
					<label for="password" class="col-form-label">Password</label>
					<input id="password" name="password" type="password" class="form-control" aria-label="password" required autofocus>
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
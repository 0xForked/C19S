<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<title><?= $title ?? "Pages" ?> | COVID-19 Samples</title>
		<?php $this->load->view("components/styles") ?>
	</head>
	<body>
		<?php $this->load->view("components/navigation") ?>

		<?php $this->load->view("components/sidebar") ?>

		<main class="content">
			<?php $this->load->view("components/navbar") ?> <hr>

			<section>
				<div class="d-flex justify-content-between w-100 flex-wrap py-4 px-3">
					<div class="mb-3 mb-lg-0">
						<h1 class="h4">Users >> Accounts</h1>
						<p class="mb-0">
							Akun pengguna aplikasi!
						</p>
					</div>
					<div class="btn-toolbar mb-2 mb-md-0">
						<button
							data-bs-toggle="modal"
							data-bs-target="#add-user-account"
							type="button"
							class="btn btn-dark h-75"
						>Tambah akun</button>
					</div>
				</div>

				<div class="row">
					<div class="col-12 px-3 py-3">
						<div class="card card-body shadow-sm table-wrapper table-responsive">
							<table class="table">
								<thead>
								<tr>
									<th>#</th>
									<th>Role</th>
									<th>Name</th>
									<th>Phone</th>
									<th>Email</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<?php $number = 1 ?>
								<?php foreach($users as $user): ?>
									<tr>
									<td><?= $number ?></td>
									<td>
										<span class="badge bg-primary py-1 px-2">
											<?= $user->role_title ?>
										</span>
									</td>
									<td><?= $user->name ?></td>
									<td><?= $user->phone ?? "NOT_SET" ?></td>
									<td><?= $user->email ?? "NOT_SET" ?></td>
									<td>
										<div class="btn-group">
											<button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
												<span class="icon icon-sm">
													<span class="fas fa-ellipsis-h icon-dark"></span>
												</span>
												<span class="sr-only">Toggle Dropdown</span>
											</button>
											<div class="dropdown-menu" data-popper-placement="bottom-end">
												<a href="<?= base_url('users/accounts/') . $user->id ?>" class="dropdown-item">
													<span class="fas fa-edit me-2"></span>
													Edit
												</a>
												<a href="<?= base_url('users/accounts/') . $user->id ?>/delete" class="dropdown-item text-danger rounded-bottom">
													<span class="fas fa-trash-alt me-2"></span>
													Remove
												</a>
											</div>
										</div>
									</td>
								</tr>
									<?php $number++ ?>
								<?php endforeach; ?>
								</tbody>
							</table>

							<?php if (count($users) < 1): ?>
								<div class="mt-4 text-center">
									No data available
								</div>
							<?php endif; ?>
					</div>
				</div>
			</section>

			<?php if($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>
		</main>

		<?php $this->load->view("components/footer") ?>
		<?php $this->load->view("pages/dash/users/accounts/add") ?>
	</body>
</html>

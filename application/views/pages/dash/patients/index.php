<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title><?= $title ?? "Pages" ?> | Lab Biomolekuler COVID-19 </title>
	<?php $this->load->view("components/styles") ?>
</head>

<body>
	<?php $this->load->view("components/navigation") ?>

	<?php $this->load->view("components/sidebar") ?>

	<main class="content">
		<?php $this->load->view("components/navbar") ?>
		<hr>

		<section>
			<div class="d-flex justify-content-between w-100 flex-wrap py-4 px-3">
				<div class="mb-3 mb-lg-0">
					<h1 class="h4">Data Pasien</h1>
					<p class="mb-0">
						Data pasien COVID-19 Sampel !
					</p>
				</div>
				<div class="btn-toolbar mb-2 mb-md-0">
					<button data-bs-toggle="modal" data-bs-target="#add-patient" type="button" class="btn btn-danger h-75">Tambah pasien</button>
				</div>
			</div>

			<div class="row">
				<div class="col-12 px-3 py-3">
					<div class="card card-body shadow-sm table-wrapper table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>NIK</th>
									<th>Nama</th>
									<th>TTL</th>
									<th>Umur</th>
									<th>Alamat</th>
									<th>Nomor Ponsel</th>
									<th>Jenis <br> Kelamin</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $number = 1 ?>
								<?php foreach ($patients as $patient) : ?>
									<tr>
										<td><?= $number ?></td>
										<td><?= $patient->nik ?></td>
										<td><?= $patient->name ?></td>
										<td><?= $patient->place_of_birth ?>, <?= format_birth($patient->date_of_birth) ?></td>
										<td><?= calculate_age($patient->date_of_birth) ?></td>
										<td><?= $patient->address ?></td>
										<td><?= $patient->phone ?? "NOT_SET" ?></td>
										<td><?= $patient->gender ?? "NOT_SET" ?></td>
										<td>
											<div class="btn-group">
												<button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													<span class="icon icon-sm">
														<span class="fas fa-ellipsis-h icon-dark"></span>
													</span>
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												<div class="dropdown-menu" data-popper-placement="bottom-end">
													<a href="<?= base_url("patients/$patient->id") ?>" class="dropdown-item">
														<span class="fas fa-edit me-2"></span>
														Edit
													</a>
													<a href="<?= base_url("patients/$patient->id/delete") ?>" class="dropdown-item text-danger rounded-bottom">
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

						<?php if (count($patients) < 1) : ?>
							<div class="mt-4 text-center">
								No data available
							</div>
						<?php endif; ?>
					</div>
				</div>
		</section>

		<?php if ($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>
	</main>

	<?php $this->load->view("components/footer") ?>
	<?php $this->load->view("pages/dash/patients/add") ?>
</body>

</html>
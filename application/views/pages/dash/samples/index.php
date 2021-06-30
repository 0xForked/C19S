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
					<h1 class="h4">Data Sampel</h1>
					<p class="mb-0">
						Sampel data pemeriksaan pasien COVID-19!
					</p>
				</div>
				<?php if ((int)$this->session->role_id === USER_ROLE_ADMIN || (int)$this->session->role_id === USER_ROLE_INPUTOR) : ?>
					<div class="btn-toolbar mb-2 mb-md-0">
						<a href="<?= base_url('samples/create') ?>" type="button" class="btn btn-danger h-75">Sampel baru</a>
					</div>
				<?php endif; ?>
			</div>

			<div class="row">
				<div class="col-12 px-3 py-3">
					<div class="card card-body shadow-sm table-wrapper table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>ID</th>
									<th>Pasien</th>
									<th>Jenis Kelamin <br> (Umur)</th>
									<th>Tujuan <br> Pemeriksaan</th>
									<th>Keterangan <br> Swab</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $number = 1 ?>
								<?php foreach ($samples as $sample) : ?>
									<tr>
										<td><?= $number ?></td>
										<td><?= $sample->code ?></td>
										<td>
											<?php if ((int)$this->session->role_id === USER_ROLE_ADMIN || (int)$this->session->role_id === USER_ROLE_INPUTOR) : ?>
												<a href="<?= base_url("patients/$sample->patient_id") ?>">
													<span class="badge bg-danger py-1 px-2">
														<?= $sample->patient_name ?> <br> (<?= $sample->patient_nik ?>)
													</span>
												</a>
											<?php else : ?>
												<span class="badge bg-danger py-1 px-2">
													<?= $sample->patient_name ?> <br> (<?= $sample->patient_nik ?>)
												</span>
											<?php endif; ?>
										</td>
										<td><?= $sample->patient_gender ?> (<?= calculate_age($sample->patient_date_of_birth) ?>)</td>
										<td><?= $sample->checkup_title ?></td>
										<td>
											<?= $sample->explanation_title ?> <br>
											(<?= $sample->updated_at ?>)
										</td>
										<td>
											<?php if ($sample->label_status == "TIDAK_LAYAK") : ?>
												SAMPEL TIDAK LAYAK
											<?php else : ?>
												<?php if ($sample->status === 'ISSUED') : ?>
													<?php if ((int)$this->session->role_id === USER_ROLE_LABELATOR) : ?>
														<a href="#" data-bs-toggle="modal" data-bs-target="#labeled-sample" data-bs-sampleid="<?= $sample->id ?>">
															<span class="badge bg-warning py-1 px-2">
																MENUNGGU PELABELAN <br>
															</span>
														</a>
													<?php else : ?>
														MENUNGGU <br> PELABELAN
													<?php endif; ?>

												<?php elseif ($sample->status === 'LABELED') : ?>
													<?php if ((int)$this->session->role_id === USER_ROLE_VALIDATOR) : ?>
														<a href="#" data-bs-toggle="modal" data-bs-target="#verified-sample" data-bs-sampleid="<?= $sample->id ?>">
															<span class="badge bg-warning py-1 px-2">
																MENUNGGU VERIFIKASI <br>
															</span>
														</a>
													<?php else : ?>
														<span class="text-warning">
															MENUNGGU <br> VERIFIKASI <br>
															(<?= $sample->label_status ?>)
														</span>
													<?php endif; ?>
												<?php elseif ($sample->status === 'VERIFIED') : ?>
													<span class="text-<?= ($sample->verify_status === 'NEGATIVE') ? 'success' :  'danger' ?>">
														TERVERIFIKASI <br>
														(<?= $sample->verify_status ?>)
													</span>
												<?php endif; ?>
											<?php endif; ?>
										</td>
										<td>
											<div class="btn-group">
												<button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													<span class="icon icon-sm">
														<span class="fas fa-ellipsis-h icon-dark"></span>
													</span>
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												<div class="dropdown-menu" data-popper-placement="bottom-end">
													<?php if ((int)$this->session->role_id === USER_ROLE_ADMIN): ?>
														<a href="#" class="dropdown-item">
															<span class="fas fa-edit me-2"></span>
															Labeling
														</a>
													<?php endif; ?>
													<?php if ((int)$this->session->role_id === USER_ROLE_ADMIN): ?>
														<a href="#" class="dropdown-item">
															<span class="fas fa-ve me-2"></span>
															Verifikasi
														</a>
													<?php endif; ?>
													<?php if ((int)$this->session->role_id === USER_ROLE_ADMIN || (int)$this->session->role_id === USER_ROLE_INPUTOR) : ?>
														<a href="<?= base_url("samples/$sample->id") ?>" class="dropdown-item">
															<span class="fas fa-edit me-2"></span>
															Edit
														</a>
													<?php endif; ?>
													<a href="<?= base_url("samples/$sample->id/print") ?>" target="_blank" class="dropdown-item">
														<span class="fas fa-print me-2"></span>
														Print
													</a>
													<?php if ((int)$this->session->role_id === USER_ROLE_ADMIN || (int)$this->session->role_id === USER_ROLE_INPUTOR) : ?>
														<a href="<?= base_url("samples/$sample->id/delete") ?>" class="dropdown-item text-danger rounded-bottom">
															<span class="fas fa-trash-alt me-2"></span>
															Remove
														</a>
													<?php endif; ?>
												</div>
											</div>
										</td>
									</tr>
									<?php $number++ ?>
								<?php endforeach; ?>
							</tbody>
						</table>

						<?php if (count($samples) < 1) : ?>
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
	<?php $this->load->view("pages/dash/samples/labeled") ?>
	<?php $this->load->view("pages/dash/samples/verified") ?>
	<script>
		let labeledSample = document.getElementById('labeled-sample')
		labeledSample.addEventListener('show.bs.modal', function(event) {
			let button = event.relatedTarget
			let recipient = button.getAttribute('data-bs-sampleid')
			let modalBodyInput = labeledSample.querySelector('.modal-body input')
			modalBodyInput.value = recipient
		})

		let verifiedSample = document.getElementById('verified-sample')
		verifiedSample.addEventListener('show.bs.modal', function(event) {
			let button = event.relatedTarget
			let recipient = button.getAttribute('data-bs-sampleid')
			let modalBodyInput = verifiedSample.querySelector('.modal-body input')
			modalBodyInput.value = recipient
		})
	</script>
</body>

</html>

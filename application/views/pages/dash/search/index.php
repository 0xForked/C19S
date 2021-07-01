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

		<?php if ($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>

		<section class="mb-5">
			<div class="d-flex justify-content-between w-100 flex-wrap py-4 px-3">
				<div class="mb-3 mb-lg-0">
					<h1 class="h4">Data Sampel</h1>
					<p class="mb-0">
						Sampel data pemeriksaan pasien COVID-19!
					</p>
				</div>
			</div>

			<div class="row px-4">
				<?php if (count($samples) < 1): ?>
					<b>Data with query <i><u><?= $query ?></u></i> not found</b>
				<?php else: ?>
					<?php foreach ($samples as $sample): ?>
					<div class="col-12 col-md-6 p-2">
						<div class="card card-body">
							<div class="d-flex justify-content-between w-100 flex-wrap">
								<div>
									<h4>
										<?= $sample->code ?>
										</h4>
									<p>
										<span class="badge bg-dark p-1">
											<?= $sample->checkup_title ?>
										</span>
										<span class="badge bg-dark p-1">
											<?= $sample->explanation_title ?>
										</span> <br>
									</p>
								</div>
								<div>
									<div class="btn-group">
										<button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											<span class="icon icon-sm">
												<span class="fas fa-ellipsis-h icon-dark"></span>
											</span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<div class="dropdown-menu" data-popper-placement="bottom-end">
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
								</div>
							</div>

							<p><?= $sample->indications ?></p>
							<div class="row">
								<div class="col-12 col-md-6 p-1 d-flex align-items-stretch">
									<div class="card border-primary card-body">
										<b>PASIEN</b>
										<p>
											<?= $sample->patient_name ?>
											<code>(<?= $sample->patient_nik ?>)</code>
										</p>
										<p>
									<span class="badge bg-dark p-2">
										<?=
										($sample->patient_gender === 'L')
											? "LAKI-LAKI"
											: "PEREMPUAN"
										?>
									</span>
											<span class="badge bg-dark p-2">
										<?= calculate_age($sample->patient_date_of_birth) ?>
										Tahun
									</span>
										</p>
									</div>
								</div>
								<div class="col-12 col-md-6 p-1 d-flex align-items-stretch">
									<div class="card border-primary card-body">
										<b>STATUS</b>
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
													MENUNGGU PELABELAN
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
															MENUNGGU VERIFIKASI (<?= $sample->label_status ?>)
														</span>
												<?php endif; ?>
											<?php elseif ($sample->status === 'VERIFIED') : ?>
												<span class="text-<?= ($sample->verify_status === 'NEGATIVE') ? 'success' :  'danger' ?>">
														TERVERIFIKASI
														(<?= $sample->verify_status ?>)
													</span>
											<?php endif; ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

			<div class="d-flex justify-content-between w-100 flex-wrap py-4 px-3">
				<div class="mb-3 mb-lg-0">
					<h1 class="h4">Data Pasien</h1>
					<p class="mb-0">
						Data pasien COVID-19 Sampel!
					</p>
				</div>
			</div>

			<div class="row px-4">
				<?php if (count($patients) < 1): ?>
					<b>Data with query <i><u><?= $query ?></u></i> not found</b>
				<?php else: ?>
					<?php foreach ($patients as $patient): ?>
						<div class="col-12 col-md-6 p-2">
							<a href="#">
								<div class="card card-body">
									<h4>
										<?= $patient->name ?>
										(<?= $patient->nik ?>)
									</h4>
									<p>
										<?= $patient->place_of_birth ?>,
										<?= $patient->date_of_birth ?> <br>
										<?= $patient->address ?>
									</p>
									<p>
										<span class="badge bg-dark p-2">
											<?=
											($patient->gender === 'L')
												? "LAKI-LAKI"
												: "PEREMPUAN"
											?>
										</span>
										<span class="badge bg-dark p-2">
											<?= calculate_age($patient->date_of_birth) ?>
											Tahun
										</span>

									</p>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</section>
	</main>

	<?php $this->load->view("components/footer") ?>
	</body>

</html>

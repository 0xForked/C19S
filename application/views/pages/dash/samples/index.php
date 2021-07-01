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
				<div class="d-flex justify-content-between">
					<?php if ((int)$this->session->role_id === USER_ROLE_ADMIN || (int)$this->session->role_id === USER_ROLE_INPUTOR) : ?>
						<div class="btn-toolbar mb-2 mb-md-0">
							<a href="<?= base_url('samples/create') ?>" type="button" class="btn btn-danger h-75">Sampel baru</a>
						</div>
					<?php endif; ?>
					<?php if ((int)$this->session->role_id === USER_ROLE_ADMIN) : ?>
						<div class="mb-2 ms-2 btn-group  h-75">
							<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
								<span class="me-2">Export</span>
								<i class="fas fa-angle-down"></i>
							</button>
							<ul class="dropdown-menu py-0" aria-labelledby="dropdownMenuReference" style="margin: 0px;">
								<li>
									<a class="dropdown-item rounded-top" href="#" onclick="showNotification('error', 'not implemented yet')">
										<b>CSV</b>
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="#" onclick="showNotification('error', 'not implemented yet')">
										<b>EXCEL</b>
									</a>
								</li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
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
												SAMPEL TIDAK LAYAK <br>
												(<?= $sample->logs['TIDAK_LAYAK']->created_at ?>)
											<?php else : ?>
												<?php if ($sample->status === 'ISSUED') : ?>
													MENUNGGU PELABELAN <br>
													(<?= $sample->created_at ?>)
												<?php elseif ($sample->status === 'LABELED') : ?>
													<?php if($sample->label_status !== 'PCR'): ?>
														PROSES PELABELAN <br>
														(<?= $sample->label_status ?> <?= $sample->logs[$sample->label_status]->created_at ?>)
													<?php else: ?>
														MENUNGGU VERIFIKASI <br>
														(<?= $sample->label_status ?> <?= $sample->logs[$sample->label_status]->created_at ?>)
													<?php endif; ?>
												<?php elseif ($sample->status === 'VERIFIED') : ?>
													<span class="text-<?= ($sample->verify_status === 'NEGATIVE') ? 'success' :  'danger' ?>">
														TERVERIFIKASI <br>
														(<?= $sample->verify_status ?> <?= $sample->logs[$sample->verify_status]->created_at ?>)
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
													<?php if($sample->status !== 'VERIFIED' && $sample->label_status !== "PCR" && $sample->label_status !== "TIDAK_LAYAK"): ?>
														<?php if ((int)$this->session->role_id === USER_ROLE_ADMIN || (int)$this->session->role_id === USER_ROLE_LABELATOR): ?>
															<a href="#" data-bs-toggle="modal" data-bs-target="#labeled-sample" data-bs-sampleid="<?= $sample->id ?>" class="dropdown-item text-warning">
																<span class="fas fa-list me-2"></span>
																Labeling
															</a>
														<?php endif; ?>
													<?php endif; ?>

													<!--  kalau sudah terverifikasi dan belum dilabeli PCR tidak bisa di verifikasi	-->
													<?php if($sample->status !== 'VERIFIED' && $sample->label_status === "PCR"): ?>
														<!--  hanya akan terlihat pada admin dan validator	-->
														<?php if ((int)$this->session->role_id === USER_ROLE_ADMIN || (int)$this->session->role_id === USER_ROLE_VALIDATOR) : ?>
															<?php $ct_value = json_decode($sample->logs["PCR"]->description) ?>
															<a href="#"
															   data-bs-toggle="modal"
															   data-bs-target="#verified-sample"
															   data-bs-sampleid="<?= $sample->id ?>"
															   data-bs-samplefam="<?= $ct_value->FAM ?>"
															   data-bs-samplecy5="<?= $ct_value->Cy5 ?>"
															   data-bs-samplerox="<?= $ct_value->ROX ?>"
															   data-bs-samplejoe="<?= $ct_value->JOE ?>"
															   class="dropdown-item text-success"
															>
																<span class="fas fa-check-circle me-2"></span>
																Verifikasi
															</a>
														<?php endif; ?>
													<?php endif; ?>

													<?php if ((int)$this->session->role_id === USER_ROLE_ADMIN || (int)$this->session->role_id === USER_ROLE_INPUTOR) : ?>
														<a href="<?= base_url("samples/$sample->id") ?>" class="dropdown-item">
															<span class="fas fa-edit me-2"></span>
															Edit
														</a>
													<?php endif; ?>

													<a href="<?= base_url("samples/$sample->id/print") ?>" target="_blank" class="dropdown-item">
														<span class="fas fa-print me-2"></span>
														Cetak (Kode QR)
													</a>

													<?php if($sample->status === 'VERIFIED'): ?>
														<a href="#" target="_blank" class="dropdown-item">
															<span class="fas fa-print me-2"></span>
															Cetak (Hasil Akhir)
														</a>
													<?php endif; ?>

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
			let fam = button.getAttribute('data-bs-samplefam')
			let cy5 = button.getAttribute('data-bs-samplecy5')
			let rox = button.getAttribute('data-bs-samplerox')
			let joe = button.getAttribute('data-bs-samplejoe')
			let modalBodyInput = verifiedSample.querySelector('.modal-body input')
			modalBodyInput.value = recipient

			let ctData = `
				<tr>
					<td>${fam}</td>
					<td>${cy5}</td>
					<td>${rox}</td>
					<td>${joe}</td>
				</tr>
			`
			let ctTable = document.getElementById('verified-detail-table').getElementsByTagName('tbody')[0];
			// let newRow = ctTable.insertRow(ctTable.rows.length);
			ctTable.innerHTML = ctData
		})

		let labelStatus = document.getElementById('label_status')
		labelStatus.addEventListener('change', function (event) {
			let pcrData = document.getElementById('pcr-detail')
			let fam = document.getElementById('fam')
			let cy5 = document.getElementById('cy5')
			let rox = document.getElementById('rox')
			let joe = document.getElementById('joe')

			if (this.value === 'PCR') {
				pcrData.classList.remove('d-none')
				// fam.setAttribute("required", "")
				// cy5.setAttribute("required", "")
				// rox.setAttribute("required", "")
				// joe.setAttribute("required", "")
			} else {
				pcrData.classList.add('d-none')
				// fam.removeAttribute("required")
				// cy5.removeAttribute("required")
				// rox.removeAttribute("required")
				// joe.removeAttribute("required")
			}
		})
	</script>
</body>

</html>

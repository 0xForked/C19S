<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?= $title ?? "Check" ?> | COVID-19 Samples</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="author" content="c19s">
		<meta name="title" content="c19s">
		<meta name="description" content="Covid-19 Samples">
		<meta name="keywords" content="c19s, covid19, corona" />

		<link href="<?= base_url('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
		<link href="<?= base_url('assets/vendor/volt/dist/css/volt.css') ?>" rel="stylesheet">
	</head>

	<body>
		<section class="d-flex align-items-center my-5 mt-lg-6 mb-lg-5">
			<div class="container">
				<div class="row justify-content-center form-bg-image mt-5">
					<div class="col-12 <?= ($this->input->get('q') && isset($sample)) ? 'col-md-6' : '' ?> d-flex align-items-center justify-content-center align-items-stretch">
						<div class="bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
							<div class="text-center text-md-center mb-4 mt-md-0">
								<img src="<?= base_url('/assets/vendor/volt/dist/img/brand/logounsrat.png') ?>" height="80" alt="c19sample-logo" class="mb-3">
								<h1 class="mb-0 h3"> SAMPEL COVID-19</h1>
								<p>
									Lab Biomolekuler Unsrat Manado
									<br> CEK STATUS
								</p>
							</div>
							<?php
							if ($this->session->flashdata('message'))
								echo $this->session->flashdata('message');
							?>
							<div class="form-group mb-4">
								<label for="code_find">Kode USR</label>
								<div class="input-group">
									<span class="input-group-text" id="code_find_icon">
										<span class="fas fa-user"></span>
									</span>
									<input
										id="code_find"
										type="text"
										name="code"
										class="form-control"
										placeholder="e.g. USER12345"
										value="<?= $this->input->get('q') ?>"
										autofocus
										required
									>
									<?= form_error(
										'code',
										'<span class="invalid-feedback" role="alert"><strong>',
										'</strong></span>'
									) ?>
									<button
										type="button"
										onclick="findData()"
										class="btn btn-dark"
										data-bs-toggle="tooltip"
										data-bs-placement="top"
										title="Cek status via kode USR"
									>
										CEK
									</button>
									<a
										href="#"
										class="btn btn-success"
										data-bs-toggle="modal"
										data-bs-target="#scanner-modal"
										title="Cek status via kode QR"
									>
										<span class="fas fa-qrcode"></span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php if($this->input->get('q') && isset($sample)): ?>
					<div class="col-12 col-md-6 d-flex align-items-stretch">
						<div class="card card-body">
							<h2 class="fw-extrabold h5 mb-3"> Data Sample</h2>
							<table class="table table-bordered">
								<tbody>
								<tr><td>KODE: <?= $sample->code ?></td></tr>
								<tr><td>NAMA: <?= $sample->patient_name ?></td></tr>
								<tr><td>UMUR: <?= calculate_age($sample->patient_date_of_birth) ?></td></tr>
								<tr><td>JENIS KELAMIN: <?= $sample->patient_gender ?></td></tr>
								<tr><td>KETERANGAN SWAB: <?= $sample->explanation_title ?></td></tr>
								<tr><td>TUJUAN PEMERIKSAAN: <?= $sample->checkup_title ?></td></tr>
								<tr><td>LABEL STATUS: <?= $sample->label_status ?></td></tr>
								</tbody>
							</table>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<audio id="audioBeepSuccess" src="<?= base_url('assets/sounds/bep.wav') ?>"></audio>

		<?php $this->load->view("components/scanner") ?>

		<script src="<?= base_url('assets/vendor/@popperjs/core/dist/umd/popper.min.js') ?>"></script>
		<script src="<?= base_url('assets/vendor/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/qrcode-scanner.js') ?>"></script>

		<?php if($sample == null && $this->input->get('q')):  ?>
			<script>
				console.log('here')
				window.onload = () => {
					alert("data tidak ditemukan")
				}
			</script>
		<?php endif; ?>

		<script>
			let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
			let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
				return new bootstrap.Tooltip(tooltipTriggerEl)
			})

			let uri = "http://localhost:8000/check?q"

			let html5QrcodeScanner = new Html5QrcodeScanner(
				"reader", { fps: 10, qrbox: 250 }
			);

			function onScanSuccess(decodedText, decodedResult) {
				document.getElementById('audioBeepSuccess').play();

				let dataObj = JSON.parse(decodedText)

				window.location.replace(`${uri}=${dataObj.code}`)
				// console.log(decodedResult)
				// window.location.replace(`${uri}=${decodedText}`)
				// html5QrcodeScanner.clear();
				// ^ this will stop the scanner (video feed) and clear the scan area.
			}

			html5QrcodeScanner.render(onScanSuccess);

			let search = document.getElementById('code_find')
			search.onkeypress = function(e) {
				if (!e) e = window.event;
				let keyCode = e.code || e.key;
				if (keyCode === 'Enter') {
					window.location.replace(`${uri}=${search.value}`)

					return false;
				}
			}

			function findData() {
				window.location.replace(`${uri}=${search.value}`)
			}
		</script>

	</body>

</html>

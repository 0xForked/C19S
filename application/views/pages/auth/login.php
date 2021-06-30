<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title><?= $title ?? "Login" ?> | COVID-19 Samples</title>

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
				<div class="col-12 d-flex align-items-center justify-content-center">
					<div class="bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
						<div class="text-center text-md-center mb-4 mt-md-0">
							<img src="<?= base_url('/assets/vendor/volt/dist/img/brand/logounsrat.png') ?>" height="80" alt="c19sample-logo" class="mb-3">
							<h1 class="mb-0 h3"> SAMPEL COVID-19</h1>
							<p>
								Lab Biomolekuler Unsrat Manado
								<br> SILAHKAN LOGIN
							</p>
						</div>
						<?php
						if ($this->session->flashdata('message'))
							echo $this->session->flashdata('message');
						?>

						<?= form_open('login'); ?>
						<div class="form-group mb-4">
							<label for="email">Email address</label>
							<div class="input-group">
								<span class="input-group-text" id="email">
									<span class="fas fa-user"></span>
								</span>
								<input id="email" type="text" name="email" class="form-control" placeholder="e.g. hello@my-email.id" value="<?= set_value('email') ?>" autofocus required>
								<?= form_error(
									'email',
									'<span class="invalid-feedback" role="alert"><strong>',
									'</strong></span>'
								) ?>
							</div>
						</div>

						<div class="form-group mb-4">
							<label for="password">Password</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon2">
									<span class="fas fa-unlock-alt"></span>
								</span>
								<input type="password" placeholder="* * * * * *" class="form-control" id="password" name="password" required>
								<?= form_error(
									'password',
									'<span class="invalid-feedback" role="alert"><strong>',
									'</strong></span>'
								) ?>
							</div>
						</div>

						<div class="d-grid">
							<button type="submit" class="btn btn-dark">Continue</button>
						</div>
						<?= form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="<?= base_url('assets/vendor/@popperjs/core/dist/umd/popper.min.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
</body>

</html>
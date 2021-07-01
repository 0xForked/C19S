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
		<?php $this->load->view("components/navbar") ?>
		<hr>

		<section>
			<div class="d-flex justify-content-between w-100 flex-wrap py-4 px-3">
				<div class="mb-3 mb-lg-0">
					<h1 class="h4">Lab Biomolekuler Unsrat >> Update</h1>
					<p class="mb-0">
						Update data sampel pasien!
					</p>
				</div>
			</div>
		</section>

		<div class="row">
			<div class="col-12 px-3 py-3">
				<?php if ($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>

				<div class="card card-body shadow-sm table-wrapper table-responsive px-5 py-5">
					<div class="row">
						<div class="col-12 col-md-4">
							<h5>Data Sampel</h5>
							<p>Lab Biomolekuler Unsrat</p>
						</div>
						<div class="col-12 col-md-8">
							<?= form_open("samples/$sample->id"); ?>
							<div class="form-group mb-4">
								<label for="code">ID</label>
								<div class="input-group">
									<span class="input-group-text" id="code">
										<b>USR</b>
									</span>
									<input id="code" type="text" name="code" class="form-control" value="<?= substr($sample->code, 3) ?>" autofocus required>
									<?= form_error(
										'code',
										'<span class="invalid-feedback" role="alert"><strong>',
										'</strong></span>'
									) ?>
								</div>
							</div>
							<div class="form-group mb-4">
								<label for="patient_id">Pasien</label>
								<div class="input-group">
									<span class="input-group-text" id="patient_id">
										<span class="fas fa-user"></span>
									</span>
									<select id="patient_id" name="patient_id" class="form-select" required>
										<?php foreach ($patients as $patient) : ?>
											<option value="<?= $patient->id ?>" <?= ($patient->id === $sample->patient_id) ? 'selected' : '' ?>>
												<?= $patient->name ?> (<?= $patient->nik ?>)
											</option>
										<?php endforeach; ?>
									</select>
									<?= form_error(
										'patient_id',
										'<span class="invalid-feedback" role="alert"><strong>',
										'</strong></span>'
									) ?>
								</div>
								<span>
									Lihat daftar dan data detail
									<a href="<?= base_url('patients') ?>" class="text-info">
										<u>pasien</u>
									</a>
								</span>
							</div>
							<div class="form-group mb-4">
								<label for="checkup_id">Tujuan Pemeriksaan</label>
								<div class="input-group">
									<span class="input-group-text" id="checkup_id">
										<span class="fas fa-user"></span>
									</span>
									<select id="checkup_id" name="checkup_id" class="form-select" required>
										<?php foreach ($checkups as $checkup) : ?>
											<option value="<?= $checkup->id ?>" <?= ($checkup->id === $sample->checkup_id) ? 'selected' : '' ?>>
												<?= $checkup->title ?>
											</option>
										<?php endforeach; ?>
									</select>
									<?= form_error(
										'checkup_id',
										'<span class="invalid-feedback" role="alert"><strong>',
										'</strong></span>'
									) ?>
								</div>
							</div>
							<div class="form-group mb-4">
								<label for="explanation_id">Keterangan SWAB</label>
								<div class="input-group">
									<span class="input-group-text" id="explanation_id">
										<span class="fas fa-user"></span>
									</span>
									<select id="explanation_id" name="explanation_id" class="form-select" required>
										<?php foreach ($explanations as $explanation) : ?>
											<option value="<?= $explanation->id ?>" <?= ($explanation->id === $sample->explanation_id) ? 'selected' : '' ?>>
												<?= $explanation->title ?>
											</option>
										<?php endforeach; ?>
									</select>
									<?= form_error(
										'explanation_id',
										'<span class="invalid-feedback" role="alert"><strong>',
										'</strong></span>'
									) ?>
								</div>
							</div>
							<div class="form-group mb-4">
								<label for="indications">Gejala sakit</label>
								<div class="input-group">
									<textarea id="indications" name="indications" class="form-control" required><?= $sample->indications ?></textarea>
									<?= form_error(
										'indications',
										'<span class="invalid-feedback" role="alert"><strong>',
										'</strong></span>'
									) ?>
								</div>
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-danger">Save</button>
							</div>
							<?= form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?php $this->load->view("components/footer") ?>
</body>

</html>
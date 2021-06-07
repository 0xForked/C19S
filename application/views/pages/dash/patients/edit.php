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
						<h1 class="h4">Patient >> Update</h1>
						<p class="mb-0">
							Perbaharui Data Pasien!
						</p>
					</div>
				</div>
			</section>

			<div class="row">
				<div class="col-12 px-3 py-3">
					<?php if($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>

					<div class="card card-body shadow-sm table-wrapper table-responsive px-5 py-5">
						<div class="row">
							<div class="col-12 col-md-4">
								<h5>Basic</h5>
								<p>Update patient basic data</p>
							</div>
							<div class="col-12 col-md-8">
								<?= form_open('patients/'.$patient->id);?>
								<div class="form-group mb-4">
									<label for="nik">NIK</label>
									<div class="input-group">
										<span class="input-group-text" id="nik">
											<span class="fas fa-user"></span>
										</span>
										<input
											id="nik"
											type="text"
											name="nik"
											class="form-control"
											value="<?= $patient->nik ?>"
											autofocus
											required
										>
										<?= form_error(
											'nik',
											'<span class="invalid-feedback" role="alert"><strong>',
											'</strong></span>'
										) ?>
									</div>
								</div>
								<div class="form-group mb-4">
									<label for="place_of_birth">Tempat lahir</label>
									<div class="input-group">
										<span class="input-group-text" id="place_of_birth">
											<span class="fas fa-user"></span>
										</span>
										<input
											id="place_of_birth"
											type="text"
											name="place_of_birth"
											class="form-control"
											value="<?= $patient->place_of_birth ?>"
											autofocus
											required
										>
										<?= form_error(
											'place_of_birth',
											'<span class="invalid-feedback" role="alert"><strong>',
											'</strong></span>'
										) ?>
									</div>
								</div>
								<div class="form-group mb-4">
									<label for="date_of_birth">Tanggal lahir</label>
									<div class="input-group">
										<span class="input-group-text" id="date_of_birth">
											<span class="fas fa-user"></span>
										</span>
										<input
											id="date_of_birth"
											type="date"
											name="date_of_birth"
											class="form-control"
											value="<?= $patient->date_of_birth ?>"
											autofocus
											required
										>
										<?= form_error(
											'date_of_birth',
											'<span class="invalid-feedback" role="alert"><strong>',
											'</strong></span>'
										) ?>
									</div>
								</div>
								<div class="form-group mb-4">
									<label for="name">Nama lengkap</label>
									<div class="input-group">
										<span class="input-group-text" id="name">
											<span class="fas fa-user"></span>
										</span>
										<input
											id="name"
											type="text"
											name="name"
											class="form-control"
											value="<?= $patient->name ?>"
											autofocus
											required
										>
										<?= form_error(
											'name',
											'<span class="invalid-feedback" role="alert"><strong>',
											'</strong></span>'
										) ?>
									</div>
								</div>
								<div class="form-group mb-4">
									<label for="phone">Nomor ponsel</label>
									<div class="input-group">
										<span class="input-group-text" id="phone">
											<span class="fas fa-phone"></span>
										</span>
										<input
											id="phone"
											type="text"
											name="phone"
											class="form-control"
											value="<?= $patient->phone ?>"
											required
										>
										<?= form_error(
											'phone',
											'<span class="invalid-feedback" role="alert"><strong>',
											'</strong></span>'
										) ?>
									</div>
								</div>
								<div class="form-group mb-4">
									<label for="gender">Jenis Kelamin</label>
									<div class="input-group">
										<span class="input-group-text" id="gender">
											<span class="fas fa-user"></span>
										</span>
										<select id="gender" name="gender" class="form-select">
											<option
												value="L"
												<?= ($patient->gender === 'L') ? 'selected' : ''?>
											>LAKI-LAKI (L)</option>
											<option
												value="P"
												<?= ($patient->gender === 'P') ? 'selected' : ''?>
											>PEREMPUAN (P)</option>
										</select>
										<?= form_error(
											'gender',
											'<span class="invalid-feedback" role="alert"><strong>',
											'</strong></span>'
										) ?>
									</div>
								</div>
								<div class="form-group mb-4">
									<label for="address">Alamat</label>
									<div class="input-group">
										<textarea
											id="address"
											name="address"
											class="form-control"
										> <?= $patient->address ?></textarea>
										<?= form_error(
											'address',
											'<span class="invalid-feedback" role="alert"><strong>',
											'</strong></span>'
										) ?>
									</div>
								</div>
								<div class="text-right">
									<button type="submit" class="btn btn-dark">Save</button>
								</div>
								<?= form_close();?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>

		<?php $this->load->view("components/footer") ?>
	</body>
</html>

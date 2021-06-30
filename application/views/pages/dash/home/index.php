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

		<section>
			<div class="row">
				<div class="col-12 col-md-4">
					<div class="card border-0 shadow my-3">
						<div class="card-body">
							<div class="row d-block d-xl-flex align-items-center">
								<div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
									<div class="icon-shape icon-shape-dark rounded me-4 me-sm-0">
										<i class="fa fa-users fa-3x"></i>
									</div>
									<div class="d-sm-none">
										<h2 class="fw-extrabold h5"> Total Pengguna</h2>
										<h3 class="mb-1"><?= $total_users ?></h3>
									</div>
								</div>
								<div class="col-12 col-xl-7 px-xl-0">
									<div class="d-none d-sm-block">
										<h2 class="h6 text-gray-400 mb-0"> Total Pengguna</h2>
										<h3 class="fw-extrabold mb-2"><?= $total_users ?></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="card border-0 shadow my-3">
						<div class="card-body">
							<div class="row d-block d-xl-flex align-items-center">
								<div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
									<div class="icon-shape icon-shape-dark rounded me-4 me-sm-0">
										<i class="fa fa-user-injured fa-3x"></i>
									</div>
									<div class="d-sm-none">
										<h2 class="fw-extrabold h5"> Total Pasien</h2>
										<h3 class="mb-1"><?= $total_patients ?></h3>
									</div>
								</div>
								<div class="col-12 col-xl-7 px-xl-0">
									<div class="d-none d-sm-block">
										<h2 class="h6 text-gray-400 mb-0"> Total Pasien</h2>
										<h3 class="fw-extrabold mb-2"><?= $total_patients ?></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="card border-0 shadow my-3">
						<div class="card-body">
							<div class="row d-block d-xl-flex align-items-center">
								<div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
									<div class="icon-shape icon-shape-dark rounded me-4 me-sm-0">
										<i class="fa fa-vials fa-3x"></i>
									</div>
									<div class="d-sm-none">
										<h2 class="fw-extrabold h5"> Total Sampel</h2>
										<h3 class="mb-1"><?= $total_samples ?></h3>
									</div>
								</div>
								<div class="col-12 col-xl-7 px-xl-0">
									<div class="d-none d-sm-block">
										<h2 class="h6 text-gray-400 mb-0"> Total Sampel</h2>
										<h3 class="fw-extrabold mb-2"><?= $total_samples ?></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

	<?php $this->load->view("components/footer") ?>
</body>

</html>
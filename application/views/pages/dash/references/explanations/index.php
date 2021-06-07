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
						<h1 class="h4">References >> Explanations</h1>
						<p class="mb-0">
							Referensi Keterangan Swab!
						</p>
					</div>
					<div class="btn-toolbar mb-2 mb-md-0">
						<button
							data-bs-toggle="modal"
							data-bs-target="#add-explanation-references"
							type="button"
							class="btn btn-dark h-75"
						>Tambah baru</button>
					</div>
				</div>

				<div class="row">
					<div class="col-12 px-3 py-3">
						<div class="card card-body shadow-sm table-wrapper table-responsive">
							<h4 class="card-title">Daftar Keterangan SWAB</h4>
							<table class="table table-hover">
								<thead>
								<tr>
									<th>#</th>
									<th>Title</th>
									<th>Assign</th>
								</tr>
								</thead>
								<tbody>
								<?php $number = 1 ?>
								<?php foreach($explanations as $explanation): ?>
									<tr>
										<td><?= $number ?></td>
										<td><?= $explanation->title ?></td>
										<td>
											<label class="badge badge-lg bg-dark">
												0 Sample
											</label>
										</td>
									</tr>
									<?php $number++ ?>
								<?php endforeach; ?>
								</tbody>
							</table>

							<?php if (count($explanations) < 1): ?>
								<div class="mt-4 text-center">
									No data available
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>

			<?php if($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>
		</main>

		<?php $this->load->view("components/footer") ?>
		<?php $this->load->view("pages/dash/references/explanations/add") ?>
	</body>
</html>

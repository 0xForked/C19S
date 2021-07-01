<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title><?= $title ?? "Pages" ?> | SAMPEL COVID-19 </title>
	<?php $this->load->view("components/styles") ?>
</head>

<body>
	<?php $this->load->view("components/navigation") ?>

	<?php $this->load->view("components/sidebar") ?>

	<main class="content">
		<?php $this->load->view("components/navbar") ?>
		<hr>

		<section>
			<div class="py-4 px-3">
				<div class="d-flex justify-content-between w-100 flex-wrap">
					<div class="mb-3 mb-lg-0">
						<h1 class="h4">User >> Roles</h1>
						<p class="mb-0">
							Peran pengguna aplikasi!
						</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12 px-3 py-3">
					<div class="card card-body shadow-sm table-wrapper table-responsive">
						<h4 class="card-title">Daftar peran pengguna</h4>
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
								<?php foreach ($roles as $role) : ?>
									<tr>
										<td><?= $number ?></td>
										<td><?= $role->title ?></td>
										<td>
											<label class="badge badge-lg bg-danger">
												<?= $role->users_count ?>
												Account<?= ($role->users_count > 1) ? 's' : '' ?>
											</label>
										</td>
									</tr>
									<?php $number++ ?>
								<?php endforeach; ?>
							</tbody>
						</table>

						<?php if (count($roles) < 1) : ?>
							<div class="mt-4 text-center">
								No data available
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	</main>

	<?php $this->load->view("components/footer") ?>
</body>

</html>
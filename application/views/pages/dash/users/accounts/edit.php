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
						<h1 class="h4">Users >> Accounts >> Edit</h1>
						<p class="mb-0">
							Perbaharui Akun pengguna!
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
								<p>Update basic (profile) data</p>
							</div>
							<div class="col-12 col-md-8">
								<?= form_open('users/accounts/'.$user->id.'?type=basic');?>
									<div class="form-group mb-4">
										<label for="name">Name</label>
										<div class="input-group">
											<span class="input-group-text" id="name">
												<span class="fas fa-user"></span>
											</span>
											<input
												id="name"
												type="text"
												name="name"
												class="form-control"
												value="<?= $user->name ?>"
												autofocus
												required
											>
											<?= form_error(
												'email',
												'<span class="invalid-feedback" role="alert"><strong>',
												'</strong></span>'
											) ?>
										</div>
									</div>
									<div class="form-group mb-4">
										<label for="email">Email address</label>
										<div class="input-group">
											<span class="input-group-text" id="email">
												<span class="fas fa-envelope"></span>
											</span>
											<input
												id="email"
												type="text"
												name="email"
												class="form-control"
												value="<?= $user->email ?>"
												required
											>
											<?= form_error(
												'email',
												'<span class="invalid-feedback" role="alert"><strong>',
												'</strong></span>'
											) ?>
										</div>
									</div>
									<div class="form-group mb-4">
										<label for="phone">Phone number</label>
										<div class="input-group">
											<span class="input-group-text" id="phone">
												<span class="fas fa-phone"></span>
											</span>
											<input
												id="phone"
												type="text"
												name="phone"
												class="form-control"
												value="<?= $user->phone ?>"
												required
											>
											<?= form_error(
												'email',
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
						<hr class="my-6">
						<div class="row">
							<div class="col-12 col-md-4">
								<h5>Role</h5>
								<p>Update current user role</p>
							</div>
							<div class="col-12 col-md-8">
								<?= form_open('users/accounts/'.$user->id.'?type=role');?>
									<div class="form-group mb-4">
										<label for="role">Role</label>
										<select name="role_id" class="form-select" id="role" aria-label="Default select example">
											<?php foreach ($roles as $role): ?>
												<option
													value="<?= $role->id ?>"
													<?= ($role->id === $user->role_id) ? 'selected' :'' ?>
												><?= $role->title ?></option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="text-right">
										<button type="submit" class="btn btn-dark">Save</button>
									</div>
								<?= form_close();?>
							</div>
						</div>
						<hr class="my-6">
						<div class="row">
							<div class="col-12 col-md-4">
								<h5>Password</h5>
								<p>Update password periodically</p>
							</div>
							<div class="col-12 col-md-8">
								<?= form_open('users/accounts/'.$user->id.'?type=password');?>
									<div class="form-group mb-4">
										<label for="old_password">Old Password</label>
										<div class="input-group">
											<span class="input-group-text" id="basic-addon2">
												<span class="fas fa-unlock-alt"></span>
											</span>
											<input
												type="password"
												placeholder="* * * * * *"
												class="form-control"
												id="old_password"
												name="old_password"
												required
											>
											<?= form_error(
												'old_password',
												'<span class="invalid-feedback" role="alert"><strong>',
												'</strong></span>'
											) ?>
										</div>
									</div>
									<div class="form-group mb-4">
										<label for="new_password">New Password</label>
										<div class="input-group">
											<span class="input-group-text" id="basic-addon2">
												<span class="fas fa-unlock-alt"></span>
											</span>
											<input
												type="password"
												placeholder="* * * * * *"
												class="form-control"
												id="new_password"
												name="new_password"
												required
											>
											<?= form_error(
												'new_password',
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

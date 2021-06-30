<nav id="sidebarMenu" class="sidebar d-md-block bg-danger text-white collapse" data-simplebar>
	<div class="sidebar-inner px-4 pt-3">
		<div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
			<div class="d-flex align-items-center">
				<div class="user-avatar lg-avatar me-4">
					<img src="<?= base_url('assets/vendor/volt/dist/img/brand/logounsrat.png') ?>" class="card-img-top rounded-circle border-white" alt="Bonnie Green">
				</div>
				<div class="d-block">
					<h2 class="h6">Hello, <?= $this->session->full_name ?></h2>
					<a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="btn btn-secondary text-white btn-xs">
						<span class="me-2">
							<span class="fas fa-sign-out-alt"></span>
						</span>
						Keluar
					</a>
				</div>
			</div>
			<div class="collapse-close d-md-none">
				<a href="#sidebarMenu" class="fas fa-times" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation"></a>
			</div>
		</div>

		<ul class="nav flex-column pt-3 pt-md-0">
			<li class="nav-item">
				<a href="#" class="nav-link d-flex align-items-center disabled">
					<span class="sidebar-icon">
						<img src="<?= base_url('assets/vendor/volt/dist/img/brand/logounsrat.png') ?>" height="25" width="25" alt="Volt Logo">
					</span>
					<span class="mt-1 ms-1 sidebar-text"> SAMPEL COVID-19 </span>
				</a>
			</li>
			<li class="nav-item <?= ($this->uri->segment(1) === 'home') ? 'active' : '' ?> mt-3">
				<a href="<?= base_url('home') ?>" class="nav-link">
					<span class="sidebar-icon">
						<span class="fas fa-home"></span>
					</span>
					<span class="sidebar-text">Beranda</span>
				</a>
			</li>

			<?php if ((int)$this->session->role_id === USER_ROLE_ADMIN) : ?>
				<li role="separator" class="dropdown-divider mt-4 mb-3 border-white"></li>
				<li class="nav-item">
					<span class="nav-link  d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#submenu-references">
						<span>
							<span class="sidebar-icon">
								<span class="fas fa-paste"></span>
							</span>
							<span class="sidebar-text">Referensi</span>
						</span>
						<span class="link-arrow">
							<span class="fas fa-chevron-right"></span>
						</span>
					</span>
					<div class="multi-level collapse <?= ($this->uri->segment(1) === 'references') ? 'show' : '' ?>" role="list" id="submenu-references" aria-expanded="false">
						<ul class="flex-column nav">
							<li class="nav-item <?= ($this->uri->segment(2) === 'explanations') ? 'active' : '' ?>">
								<a href="<?= base_url('references/explanations') ?>" class="nav-link">
									<span class="sidebar-text">Keterangan Swab</span>
								</a>
							</li>
							<li class="nav-item <?= ($this->uri->segment(2) === 'checkups') ? 'active' : '' ?>">
								<a href="<?= base_url('references/checkups') ?>" class="nav-link">
									<span class="sidebar-text">Tujuan Pemeriksaan</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
			<?php endif; ?>

			<li role="separator" class="dropdown-divider mt-4 mb-3 border-white"></li>
			<?php if ((int)$this->session->role_id === USER_ROLE_ADMIN || (int)$this->session->role_id === USER_ROLE_INPUTOR) : ?>
				<li class="nav-item <?= ($this->uri->segment(1) === 'patients') ? 'active' : '' ?> mt-3">
					<a href="<?= base_url('patients') ?>" class="nav-link">
						<span class="sidebar-icon">
							<span class="fas fa-user-injured"></span>
						</span>
						<span class="sidebar-text">Pasien</span>
					</a>
				</li>
			<?php endif; ?>
			<li class="nav-item <?= ($this->uri->segment(1) === 'samples') ? 'active' : '' ?> mt-3">
				<a href="<?= base_url('samples') ?>" class="nav-link">
					<span class="sidebar-icon">
						<span class="fas fa-vials"></span>
					</span>
					<span class="sidebar-text">Sampel</span>
				</a>
			</li>

			<?php if ((int)$this->session->role_id === USER_ROLE_ADMIN) : ?>
				<li role="separator" class="dropdown-divider mt-4 mb-3 border-white"></li>
				<li class="nav-item">
					<span class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#submenu-users">
						<span>
							<span class="sidebar-icon">
								<span class="fas fa-users"></span>
							</span>
							<span class="sidebar-text">Pengguna</span>
						</span>
						<span class="link-arrow">
							<span class="fas fa-chevron-right"></span>
						</span>
					</span>
					<div class="multi-level collapse <?= ($this->uri->segment(1) === 'users') ? 'show' : '' ?>" role="list" id="submenu-users" aria-expanded="false">
						<ul class="flex-column nav">
							<li class="nav-item <?= ($this->uri->segment(2) === 'roles') ? 'active' : '' ?>">
								<a class="nav-link" href="<?= base_url('users/roles') ?>">
									<span class="sidebar-text">Peran</span>
								</a>
							</li>
							<li class="nav-item  <?= ($this->uri->segment(2) === 'accounts') ? 'active' : '' ?>">
								<a class="nav-link" href="<?= base_url('users/accounts') ?>">
									<span class="sidebar-text">Akun</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</nav>
<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
	<div class="container-fluid px-0">
		<div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
			<div class="d-flex align-items-center">
				<!-- Search form -->
				<form class="navbar-search form-inline" id="navbar-search-main">
					<div class="input-group input-group-merge search-bar">
						<span class="input-group-text" id="topbar-addon">
							<span class="fas fa-search"></span>
						</span>
						<input
							type="text"
							class="form-control"
							id="searchInputField"
							placeholder="Search"
							aria-label="Search"
							aria-describedby="topbar-addon"
							value="<?= $this->input->get('q') ?>"
						>
					</div>
				</form>
				<div class="ms-3">
					<a data-bs-toggle="modal" data-bs-target="#scanner-modal" href="#" class="btn btn-icon-only bg-secondary-alt">
						<i class="fas fa-qrcode"></i>
					</a>
				</div>
			</div>

			<!-- Navbar links -->
			<ul class="navbar-nav align-items-center">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle pt-1 px-0" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<div class="media d-flex align-items-center">
							<img class="user-avatar md-avatar rounded-circle" alt="Image placeholder" src="<?= default_profile_picture($this->session->full_name) ?>">
							<div class="media-body ms-3 text-dark align-items-center d-none d-lg-block">
								<span class="mb-0 font-small fw-bold">
									Hello, <?= $this->session->full_name ?>
								</span>
							</div>
						</div>
					</a>
					<div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-0">
						<a href="#" onclick="showNotification('error', 'Fitur tidak aktif')" class="dropdown-item rounded-top fw-bold">
							<span class="far fa-user-circle"></span>
							My Profile
						</a>
						<div role="separator" class="dropdown-divider my-0"></div>
						<a href="#" data-bs-toggle="modal" data-bs-target="#logout-modal" class="dropdown-item rounded-bottom fw-bold">
							<span class="fas fa-sign-out-alt text-danger"></span>
							Logout
						</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>

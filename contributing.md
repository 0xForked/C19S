	<li class="nav-item">
				<span
					class="nav-link d-flex justify-content-between align-items-center"
					data-bs-toggle="collapse"
					data-bs-target="#submenu-samples"
				>
					<span>
						<span class="sidebar-icon">
							<span class="fas fa-vials"></span>
						</span>
						<span class="sidebar-text">Sampel</span>
					</span>
					<span class="link-arrow">
						<span class="fas fa-chevron-right"></span>
					</span>
				</span>
				<div
					class="multi-level collapse <?= ($this->uri->segment(1) === 'samples') ? 'show' : ''?>"
					role="list"
					id="submenu-samples"
					aria-expanded="false"
				>
					<ul class="flex-column nav">
						<li class="nav-item <?= ($this->uri->segment(2) === 'roles') ? 'active' : ''?>">
							<a class="nav-link" href="<?= base_url('users/roles') ?>">
								<span class="sidebar-text">Labeling</span>
							</a>
						</li>
						<li class="nav-item  <?= ($this->uri->segment(2) === 'accounts') ? 'active' : ''?>">
							<a class="nav-link" href="<?= base_url('users/accounts') ?>">
								<span class="sidebar-text">Verifikasi</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<!--	menu dokumen		-->

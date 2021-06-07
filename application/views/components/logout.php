<div
	class="modal fade"
	tabindex="-1"
	role="dialog"
	id="logout-modal"
>
	<div
		class="modal-dialog modal-sm"
		role="document"
	>
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Anda yakin ingin keluar?</h5>
			</div>
			<div class="modal-footer">
				<button
					type="button"
					class="btn btn-dark"
					data-bs-dismiss="modal"
				>
					Batal
				</button>
				<a  href="#"
					onclick="document.getElementById('logout-form').submit();"
					class="btn btn-danger"
				>
					Ya, Keluarkan!
				</a>

				<form
					id="logout-form"
					action="<?= base_url('logout') ?>"
					method="POST"
					style="display: none;"
				></form>
			</div>
		</div>
	</div>
</div>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/dist/css/bootstrap.min.css') ?>">
	</head>
	<body>
		<main>
			<div class="position-relative">
				<div class="position-absolute">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>
									<table class="table table-bordered">
										<tbody>
											<tr><td>ID: <?= $sample->code ?></td></tr>
											<tr><td>NAMA: <?= $sample->patient_name ?></td></tr>
											<tr><td>UMUR: <?= calculate_age($sample->patient_date_of_birth) ?></td></tr>
											<tr><td>JENIS KELAMIN: <?= $sample->patient_gender ?></td></tr>
											<tr><td>KETERANGAN SWAB: <?= $sample->explanation_title ?></td></tr>
											<tr><td>TUJUAN PEMERIKSAAN: <?= $sample->checkup_title ?></td></tr>
										</tbody>
									</table>
								</td>
								<td>
									<div id="qrcode"></div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</main>

		<!-- core:js -->
		<script src="<?= base_url('assets/vendor/@popperjs/core/dist/umd/popper.min.js') ?>"></script>
		<script src="<?= base_url('assets/vendor/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/qrcode.js') ?>"></script>
		<script>
			let qrcode = new QRCode(document.getElementById("qrcode"), {
				width: 230,
				height: 230,
				colorDark : "#000000",
				colorLight : "#ffffff",
				correctLevel : QRCode.CorrectLevel.H
			})

			window.onload = () => {
				let data = `<?= json_encode($sample) ?>`

				qrcode.clear()
				qrcode.makeCode(data)

				window.print()
			}
		</script>
	</body>
</html>

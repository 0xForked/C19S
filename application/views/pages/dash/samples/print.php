<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title>Print Data | Sampel COVID-19 </title>
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
									<h2 class="fw-extrabold h5"> Lab Biomolekuler Unsrat</h2>
									<tbody>
										<tr>
											<td>ID: <?= $sample->code ?></td>
										</tr>
										<tr>
											<td>NAMA: <?= $sample->patient_name ?></td>
										</tr>
										<tr>
											<td>UMUR/JENIS KELAMIN: <?= calculate_age($sample->patient_date_of_birth) ?>/ <?= $sample->patient_gender ?></td>
										</tr>
										<tr>
											<td>KETERANGAN SWAB: <?= $sample->explanation_title ?></td>
										</tr>
										<tr>
											<td>TUJUAN PEMERIKSAAN: <?= $sample->checkup_title ?></td>
										</tr>
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
			colorDark: "#000000",
			colorLight: "#ffffff",
			correctLevel: QRCode.CorrectLevel.H
		})

		window.onload = () => {
			let data = `<?= json_encode([
					'id' => $sample->id,
					'patient_id' => $sample->patient_id,
					'checkup_id' => $sample->checkup_id,
					'explanation_id' => $sample->explanation_id,
					'code' => $sample->code
			]) ?>`

			qrcode.clear()
			qrcode.makeCode(data)

			window.print()
		}
	</script>
</body>

</html>

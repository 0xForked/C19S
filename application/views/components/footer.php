<?php $this->load->view("components/scanner") ?>

<?php $this->load->view("components/scripts") ?>

<?php $this->load->view("components/logout") ?>

<audio id="audioBeepSuccess" src="<?= base_url('assets/sounds/bep.wav') ?>"></audio>

<script>
	let uri = "http://localhost:8000/search?q"

	let html5QrcodeScanner = new Html5QrcodeScanner(
		"reader", { fps: 10, qrbox: 250 }
	);

	function onScanSuccess(decodedText, decodedResult) {
		document.getElementById('audioBeepSuccess').play();

		let dataObj = JSON.parse(decodedText)

		window.location.replace(`${uri}=${dataObj.code}`)

		html5QrcodeScanner.clear();
		// ^ this will stop the scanner (video feed) and clear the scan area.
	}

	html5QrcodeScanner.render(onScanSuccess);

	let search = document.getElementById('searchInputField')
	search.onkeypress = function(e) {
		if (!e) e = window.event;
		let keyCode = e.code || e.key;
		if (keyCode === 'Enter') {
			window.location.replace(`${uri}=${search.value}`)

			return false;
		}
	}
</script>

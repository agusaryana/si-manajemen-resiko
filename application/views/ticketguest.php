<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>
		<?php echo $dataorg['short_org'] . ' - ' . $title ?>
	</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="<?php echo base_url() ?>asset/spectral/assets/css/main.css" />
	<link rel="icon" href="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['favicon_org'] ?>"
		type="image/x-icon" />
	<!-- Sweet Alert -->
    <link href="<?php echo base_url() ?>asset/admininspina/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>asset/admininspina/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>asset/admininspina/css/plugins/select2/select2-bootstrap4.min.css" rel="stylesheet">
	<noscript>
		<link rel="stylesheet" href="<?php echo base_url() ?>asset/spectral/assets/css/noscript.css" />
	</noscript>
</head>

<body class="is-preload">

	<!-- Page Wrapper -->
	<div id="page-wrapper">
		<!-- Main -->
		<article id="main">
			<section class="wrapper style5">
				<div class="inner">
					<h2>Silakan isi detail ticket anda!</h2>
					<section>
						<form id="ticketform" method="post" action="<?php echo base_url() ?>ticketguest/add" enctype="multipart/form-data">
							<div class="row gtr-uniform">
								<div class="col-6 col-12-xsmall">
									<select name="id_loc" id="id_loc" required>
										<option value="">- Pilih lokasi anda -</option>
										<?php
										foreach ($tb_location as $row1) {
											echo '<option value="' . $row1->id_loc . '">' . $row1->nama_loc . '</option>';
										}
										?>
									</select>
								</div>
								<div class="col-6 col-12-xsmall">
									<select name="id_dept" id="id_dept" required>
										<option value="">- Pilih departemen anda -</option>
										<?php
										foreach ($tb_department as $row2) {
											echo '<option value="' . $row2->id_dept . '">' . $row2->nama_dept . '</option>';
										}
										?>
									</select>
								</div>
								<div class="col-12">
									<input type="text" name="nama_ticket" id="nama_ticket" value="" placeholder="Nama Lengkap Anda" required/>
									<span id="nama_ticket_error" class="error"></span>
								</div>
								<div class="col-6 col-12-xsmall">
									<input type="text" name="tlp_ticket" id="tlp_ticket" value="" placeholder="Nomor Whatsapp" required/>
									<span id="tlp_ticket_error" class="error"></span>
								</div>
								<div class="col-6 col-12-xsmall">
									<input type="email" name="email_ticket" id="email_ticket" value="" placeholder="Alamat Email" required/>
									<span id="email_ticket_error" class="error"></span>
								</div>
								<div class="col-6 col-12-xsmall">
									<select name="id_div" id="id_div" required>
										<option value="">- Divisi yang Dibutuhkan -</option>
										<?php
										foreach ($tb_division as $row2) {
											echo '<option value="' . $row2->id_div . '">' . $row2->nama_div . '</option>';
										}
										?>
									</select>
								</div>
								<div class="col-6 col-12-xsmall">
									<select name="id_cat" id="id_cat" required>
										<option value="">- Pilih Divisi terlebih dahulu -</option>
									</select>
								</div>
								<div class="col-12">
									<textarea name="desk_ticket" id="desk_ticket"
										placeholder="Deskripsikan masalah anda.." rows="6" required></textarea>
										<span id="desk_ticket_error" class="error"></span>
								</div>
								<div class="col-12">
									<div class="custom-file">
                                        <input id="inputGroupFile01" type="file" class="custom-file-input" name="lampiran_ticket">
                                        <label class="custom-file-label" for="inputGroupFile01">JPG|PNG|JPEG max 500KB (Optional)</label>
                                    </div>
								</div>
								<div class="col-12">
									<ul class="actions">
										<li><input type="submit" id="submit" value="Kirim Ticket" class="primary" /></li>
										<li><input type="reset" value="Reset" /></li>
									</ul>
								</div>
							</div>
						</form>
					</section>
				</div>
			</section>
		</article>

		<!-- Footer -->
		<footer id="footer">
			<ul class="copyright">
				<li>&copy; 2023</li>
				<li>
					<?php echo $dataorg['nama_org'] ?>
				</li>
			</ul>
		</footer>

	</div>

	<!-- Scripts -->
	<script src="<?php echo base_url() ?>asset/spectral/assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>asset/spectral/assets/js/jquery.scrollex.min.js"></script>
	<script src="<?php echo base_url() ?>asset/spectral/assets/js/jquery.scrolly.min.js"></script>
	<script src="<?php echo base_url() ?>asset/spectral/assets/js/browser.min.js"></script>
	<script src="<?php echo base_url() ?>asset/spectral/assets/js/breakpoints.min.js"></script>
	<script src="<?php echo base_url() ?>asset/spectral/assets/js/util.js"></script>
	<script src="<?php echo base_url() ?>asset/spectral/assets/js/main.js"></script>
	<!-- Sweet alert -->
    <script src="<?php echo base_url() ?>asset/admininspina/js/plugins/sweetalert/sweetalert.min.js"></script>
	<!-- BS custom file -->
    <script src="<?php echo base_url() ?>asset/admininspina/js/plugins/bs-custom-file/bs-custom-file-input.min.js"></script>
	<!-- Select2 -->
    <script src="<?php echo base_url() ?>asset/admininspina/js/plugins/select2/select2.full.min.js"></script>

	<script>
		$(document).ready(function () {
			$("#id_div").change(function () {
				var url = "<?php echo site_url('ticketguest/add_ajax_cat'); ?>/" + $(this).val();
				$('#id_cat').load(url);
				return false;
			});

			$(document).ready(function () {
				bsCustomFileInput.init()
			});

			$(document).ready(function() {
				var message = '<?php echo $this->session->flashdata('message'); ?>';
				var type = '<?php echo $this->session->flashdata('type'); ?>';
				
				if (message) {
					switch (type) {
						case 'success':
							swal("Success", message, "success");
							break;
						case 'error':
							swal("Error", message, "error");
							break;
						case 'warning':
							swal("Warning", message, "warning");
							break;
						case 'info':
							swal("Info", message, "info");
							break;
					}
				}
        	});

			$(".select2_demo_1").select2({
                theme: 'bootstrap4',
            });
            $(".select2_demo_2").select2({
                theme: 'bootstrap4',
            });
            $(".select2_demo_3").select2({
                theme: 'bootstrap4',
                placeholder: "Select a state",
                allowClear: true
            });
		});

			
	</script>

	<script>
		document.getElementById('nama_ticket').addEventListener('blur', function() {
			var namaTicketInput = this.value;
			var namaTicketError = document.getElementById('nama_ticket_error');

			// Validasi input tidak boleh kosong
			if (namaTicketInput.trim() === '') {
				namaTicketError.innerHTML = 'Nama Lengkap tidak boleh kosong';
			} else {
				namaTicketError.innerHTML = ''; // Hapus pesan kesalahan
			}

			// Validasi input tidak boleh mengandung karakter khusus
			var pattern = /[^a-zA-Z\s]/;
			if (pattern.test(namaTicketInput)) {
				namaTicketError.innerHTML = 'Nama Lengkap hanya boleh berisi huruf dan spasi';
			}
		});

		document.getElementById('desk_ticket').addEventListener('blur', function() {
				var deskTicketInput = this.value;
				var deskTicketError = document.getElementById('desk_ticket_error');

				// Validasi input tidak boleh kosong
				if (deskTicketInput.trim() === '') {
					deskTicketError.innerHTML = 'Deskripsi tidak boleh kosong';
				} else {
					deskTicketError.innerHTML = ''; // Hapus pesan kesalahan
				}

				// Validasi untuk menghilangkan spasi di awal dan akhir
				var trimmedDeskTicket = deskTicketInput.trim();
				if (deskTicketInput !== trimmedDeskTicket) {
					this.value = trimmedDeskTicket; // Menghapus spasi di awal dan akhir
				}

				// Validasi untuk menghindari inputan skrip berbahaya
				var pattern = /<\s*script|javascript:|onerror|alert\(/i;
				if (pattern.test(deskTicketInput)) {
					deskTicketError.innerHTML = 'Tidak diperbolehkan input skrip berbahaya.';
				}
		});
			
		document.getElementById('tlp_ticket').addEventListener('blur', function() {
			var tlpTicketInput = this.value;
			var tlpTicketError = document.getElementById('tlp_ticket_error');

			// Validasi nomor telepon (hanya angka)
			var pattern = /^[0-9]+$/;
			if (!pattern.test(tlpTicketInput)) {
				tlpTicketError.innerHTML = 'Nomor Whatsapp hanya boleh angka.';
			} else {
				tlpTicketError.innerHTML = ''; // Hapus pesan kesalahan
			}
		});

		document.getElementById('email_ticket').addEventListener('blur', function() {
			var emailTicketInput = this.value;
			var emailTicketError = document.getElementById('email_ticket_error');

			// Validasi alamat email
			var pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
			if (!pattern.test(emailTicketInput)) {
				emailTicketError.innerHTML = 'Alamat Email tidak valid.';
			} else {
				emailTicketError.innerHTML = ''; // Hapus pesan kesalahan
			}
		});
	</script>

</body>

</html>
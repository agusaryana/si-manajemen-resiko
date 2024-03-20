<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo $dataorg['short_org'] . ' - ' . $title ?></title>

	<link href="<?php echo base_url() ?>asset/admininspina/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>asset/admininspina/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>asset/admininspina/css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>asset/admininspina/css/style.css" rel="stylesheet">
	<link rel="icon" href="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['favicon_org'] ?>" type="image/x-icon" />
	<!-- Sweet Alert -->
	<link href="<?php echo base_url() ?>asset/admininspina/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
	<style>
		/* CSS untuk mengatur tampilan tombol "Lihat Password" di pojok dalam input */
		.form-group {
			position: relative;
		}

		.password-input {
			position: relative;
		}

		.field-icon {
			position: absolute;
			top: 50%;
			right: 10px;
			transform: translateY(-50%);
			cursor: pointer;
			user-select: none;
		}
	</style>

</head>

<body class="gray-bg">

	<div class="middle-box text-center loginscreen animated fadeInDown">
		<div>
			<div>
				<img src="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['logo_org'] ?>" width="50%" height="50%">
			</div>
			</br>
			</br>
			</br>
			</br>
			<h2><b>SIMARKO</b></h2>
			<h3><b>Unit Penanggung Jawab</b></h3>
			<form class="m-t" role="form" action="<?php echo base_url() ?>troubleshoot/auth" method="POST">
				<div class="form-group">
					<input type="text" name="username_user" class="form-control" placeholder="Username" required>
				</div>
				<div class="form-group">
					<input type="password" name="pass_user" id="pass_user" class="form-control" placeholder="Password" required>
					<span toggle="#pass_user" class="fa fa-fw fa-eye field-icon toggle-password"></span>
				</div>
				<button type="submit" class="btn btn-success block full-width m-b">Login</button>

			</form>
			<p class="m-t"> <small><?php echo $dataorg['nama_org'] ?> &copy; 2023</small> </p>
		</div>
	</div>

	<!-- Mainly scripts -->
	<script src="<?php echo base_url() ?>asset/admininspina/js/jquery-3.1.1.min.js"></script>
	<script src="<?php echo base_url() ?>asset/admininspina/js/popper.min.js"></script>
	<script src="<?php echo base_url() ?>asset/admininspina/js/bootstrap.js"></script>
	<!-- Sweet alert -->
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/sweetalert/sweetalert.min.js"></script>

	<!-- Notifikasi -->
	<script>
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
	</script>
	<script>
		// Fungsi untuk mengganti tipe input dari password ke teks dan sebaliknya
		function togglePassword() {
			var passwordField = document.querySelector("#pass_user");
			var toggleButton = document.querySelector(".toggle-password");

			if (passwordField.type === "password") {
				passwordField.type = "text";
				toggleButton.classList.remove("fa-eye");
				toggleButton.classList.add("fa-eye-slash");
			} else {
				passwordField.type = "password";
				toggleButton.classList.remove("fa-eye-slash");
				toggleButton.classList.add("fa-eye");
			}
		}

		// Menambahkan event listener ke tombol "Lihat Password"
		document.querySelector(".toggle-password").addEventListener("click", togglePassword);
	</script>

</body>

</html>
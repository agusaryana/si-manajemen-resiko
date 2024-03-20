<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>
		<?php echo $dataorg['short_org'] . ' - ' . $title ?>
	</title>

	<link href="<?php echo base_url() ?>asset/admininspina/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>asset/admininspina/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>asset/admininspina/css/plugins/iCheck/custom.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>asset/admininspina/css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>asset/admininspina/css/style.css" rel="stylesheet">
	<link rel="icon" href="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['favicon_org'] ?>" type="image/x-icon" />
	<link href="<?php echo base_url() ?>asset/admininspina/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

	<!-- Sweet Alert -->
	<link href="<?php echo base_url() ?>asset/admininspina/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

</head>

<body>

	<div id="wrapper">

		<!-- Menu -->
		<?php
		$akses = $this->session->userdata('id_akses');
		if ($akses == 1) {

		?>
			<nav class="navbar-default navbar-static-side" role="navigation">
				<div class="sidebar-collapse">
					<ul class="nav metismenu" id="side-menu">
						<li class="nav-header">
							<div class="dropdown profile-element">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
									<span class="block m-t-xs font-bold">
										<?= @$_SESSION['nama_user']; ?>
									</span>
									<span class="text-muted text-xs block">
										<?= @$_SESSION['nama_akses']; ?> <b class="caret"></b>
									</span>
								</a>
								<ul class="dropdown-menu animated fadeInRight m-t-xs">
									<li><a class="dropdown-item" href="#">
											<?= @$_SESSION['nama_div']; ?>
										</a></li>
									<li class="dropdown-divider"></li>
									<li><a class="dropdown-item" href="<?php echo base_url() ?>troubleshoot/logout">Logout</a></li>
								</ul>
							</div>
							<div class="logo-element">
								B
							</div>
						</li>
						<li>
							<a href="<?php echo base_url() ?>ts/home"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
						</li>
						<li class="active">
							<a href="#"><i class="fa fa-gears"></i> <span class="nav-label">Administrator</span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="<?php echo base_url() ?>ts/user"><i class="fa fa-users"></i> Data Pengguna</a>
								</li>
								<li><a href="<?php echo base_url() ?>ts/klien"><i class="fa fa-users"></i> Data Klien</a>
								</li>
								<li><a href="<?php echo base_url() ?>ts/location"><i class="fa fa-building"></i> Data
										Lokasi</a></li>
								<li><a href="<?php echo base_url() ?>ts/department"><i class="fa fa-bank"></i> Data
										Departemen</a></li>
								<li><a href="<?php echo base_url() ?>ts/divisi"><i class="fa fa-user-md"></i> Data
										Divisi</a></li>
								<li><a href="<?php echo base_url() ?>ts/category"><i class="fa fa-sitemap"></i> Data
										Kategori</a></li>
								<li class="active"><a href="<?php echo base_url() ?>ts/organisasi"><i class="fa fa-institution"></i> Konfig
										Organisasi</a></li>
								<li><a href="<?php echo base_url() ?>ts/email"><i class="fa fa-envelope"></i>
										Konfig Email</a></li>
								<li><a href="<?php echo base_url() ?>ts/whatsapp"><i class="fa fa-send"></i> Konfig
										Whatsapp</a></li>
								<li><a href="<?php echo base_url() ?>ts/wagroup"><i class="fa fa-whatsapp"></i> Konfig WA Group</a></li>
								<li><a href="<?php echo base_url() ?>ts/backupdb"><i class="fa fa-download"></i> Backup
										Database</a></li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Ticket Helpdesk</span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li><a href="<?php echo base_url() ?>ts/ticket"><i class="fa fa-inbox"></i> Ticket Masuk</a>
								</li>
								<li><a href="<?php echo base_url() ?>ts/ticket/proses"><i class="fa fa-yelp"></i> Ticket
										Diproses</a></li>
								<li><a href="<?php echo base_url() ?>ts/ticket/selesai"><i class="fa fa-check-square"></i>
										Ticket Selesai</a></li>
							</ul>
						</li>
						<li>
							<a href="<?php echo base_url() ?>ts/report"><i class="fa fa-book"></i> <span class="nav-label">Rekap Ticket</span> </a>
						</li>
						<li>
							<a href="<?php echo base_url() ?>troubleshoot/logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
						</li>
					</ul>

				</div>
			</nav>
		<?php
		} else {
		?>
			<nav class="navbar-default navbar-static-side" role="navigation">
				<div class="sidebar-collapse">
					<ul class="nav metismenu" id="side-menu">
						<li class="nav-header">
							<div class="dropdown profile-element">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
									<span class="block m-t-xs font-bold">
										<?= @$_SESSION['nama_user']; ?>
									</span>
									<span class="text-muted text-xs block">
										<?= @$_SESSION['nama_akses']; ?> <b class="caret"></b>
									</span>
								</a>
								<ul class="dropdown-menu animated fadeInRight m-t-xs">
									<li><a class="dropdown-item" href="#">
											<?= @$_SESSION['nama_div']; ?>
										</a></li>
									<li class="dropdown-divider"></li>
									<li><a class="dropdown-item" href="<?php echo base_url() ?>troubleshoot/logout">Logout</a></li>
								</ul>
							</div>
							<div class="logo-element">
								B
							</div>
						</li>
						<li class="active">
							<a href="<?php echo base_url() ?>ts/home"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Ticket Helpdesk</span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li><a href="<?php echo base_url() ?>ts/ticket"><i class="fa fa-inbox"></i> Ticket Masuk</a>
								</li>
								<li><a href="<?php echo base_url() ?>ts/ticket/proses"><i class="fa fa-yelp"></i> Ticket
										Diproses</a></li>
								<li><a href="<?php echo base_url() ?>ts/ticket/selesai"><i class="fa fa-check-square"></i>
										Ticket Selesai</a></li>
							</ul>
						</li>
						<li>
							<a href="<?php echo base_url() ?>ts/report"><i class="fa fa-book"></i> <span class="nav-label">Rekap Ticket</span> </a>
						</li>
						<li>
							<a href="<?php echo base_url() ?>troubleshoot/logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
						</li>
					</ul>

				</div>
			</nav>
		<?php } ?>
		<!-- //Menu -->

		<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
					</div>
					<ul class="nav navbar-top-links navbar-right">
						<li>
							<a href="<?php echo base_url() ?>ts/trobuleshoot/logout">
								<i class="fa fa-sign-out"></i> Log out
							</a>
						</li>
					</ul>
				</nav>
			</div>
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-10">
					<h2>Konfigurasi Organisasi</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="#">Dashboard</a>
						</li>
						<li class="breadcrumb-item active">
							<a>Konfigurasi Organisasi</a>
						</li>
					</ol>
				</div>
			</div>

			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-8">
						<div class="ibox ">
							<div class="ibox-content">
								<div class="row">
									<div class="col-sm-12 b-r">
										<form role="form" method="POST" action="<?php echo base_url() ?>ts/organisasi/update">
											<input type="hidden" name="id_org" value="<?php echo $dataorg['id_org'] ?>">
											<div class="form-group">
												<label>Nama Organisasi</label>
												<input type="text" placeholder="Masukan Nama Organisasi Anda" class="form-control" name="nama_org" value="<?php echo $dataorg['nama_org'] ?>" required>
											</div>
											<div class="form-group">
												<label>Nama Pendek Organisasi (Max 15 Karakter)</label>
												<input type="text" placeholder="Masukan Nama Pendek Organisasi" class="form-control" name="short_org" value="<?php echo $dataorg['short_org'] ?>" required>
											</div>
											<div class="form-group">
												<label>Telepon</label>
												<input type="number" placeholder="Masukan Nomor Telepon Organisasi" class="form-control" name="tlp_org" value="<?php echo $dataorg['tlp_org'] ?>" required>
											</div>
											<div class="form-group">
												<label>Email</label>
												<input type="text" placeholder="Masukan Email Organisasi" class="form-control" name="email_org" value="<?php echo $dataorg['email_org'] ?>" required>
											</div>
											<div class="form-group">
												<label>Alamat Organisasi</label>
												<textarea class="form-control" name="alamat_org" required><?php echo $dataorg['alamat_org'] ?></textarea>
											</div>
											<div>
												<button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Simpan</strong></button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="row">
							<div class="col-sm-12 b-r">
								<div class="ibox ">
									<div class="ibox-title">
										<p><strong>Upload Logo Organisasi</strong></p>
									</div>
									<div class="ibox-content">
										<p><img alt="image" height="50%" width="50%" src="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['logo_org'] ?>"></p>
										<p>Ukuran maksimal 500KB</p>
										<form role="form" method="POST" action="<?php echo base_url() ?>ts/organisasi/updatelogo" enctype="multipart/form-data">
											<input type="hidden" name="id_org" value="<?php echo $dataorg['id_org'] ?>">
											<div class="input-group">
												<div class="custom-file">
													<input id="inputGroupFile01" type="file" class="custom-file-input" name="logo_org" accept=".jpg, .jpeg, .png" required>
													<label class="custom-file-label" for="inputGroupFile01">Pilih Gambar (.png|.jpeg|.jpg)</label>
												</div>
											</div>
											</br>
											<div>
												<button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Simpan</strong></button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="col-sm-12 b-r">
								<div class="ibox ">
									<div class="ibox-title">
										<p><strong>Upload Favicon Organisasi</strong></p>
									</div>
									<div class="ibox-content">
										<p><img alt="image" height="50%" width="50%" src="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['favicon_org'] ?>"></p>
										<p>Ukuran maksimal 10KB</p>
										<form role="form" method="POST" action="<?php echo base_url() ?>ts/organisasi/updatefavicon" enctype="multipart/form-data">
											<input type="hidden" name="id_org" value="<?php echo $dataorg['id_org'] ?>">
											<div class="input-group">
												<div class="custom-file">
													<input id="inputGroupFile01" type="file" class="custom-file-input" name="favicon_org" accept=".jpg, .jpeg, .png, .ico" required>
													<label class="custom-file-label" for="inputGroupFile01">Pilih Gambar (.png|.jpeg|.jpg|.ico)</label>
												</div>
											</div>
											</br>
											<div>
												<button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Simpan</strong></button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="footer">
				<div class="float-right">
					BluHelpdesk <strong>Version 1.1</strong>
				</div>
				<div>
					<strong>Copyright</strong> -
					<?php echo $dataorg['nama_org'] ?> &copy; 2023
				</div>
			</div>
		</div>
	</div>

	<!-- Mainly scripts -->
	<script src="<?php echo base_url() ?>asset/admininspina/js/jquery-3.1.1.min.js"></script>
	<script src="<?php echo base_url() ?>asset/admininspina/js/popper.min.js"></script>
	<script src="<?php echo base_url() ?>asset/admininspina/js/bootstrap.js"></script>
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

	<!-- Custom and plugin javascript -->
	<script src="<?php echo base_url() ?>asset/admininspina/js/inspinia.js"></script>
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/pace/pace.min.js"></script>

	<!-- Sweet alert -->
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/sweetalert/sweetalert.min.js"></script>

	<!-- BS custom file -->
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/bs-custom-file/bs-custom-file-input.min.js"></script>

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
		$(document).ready(function() {
			bsCustomFileInput.init()
		});
	</script>
</body>

</html>
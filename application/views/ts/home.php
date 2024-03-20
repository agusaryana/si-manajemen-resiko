<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo $dataorg['short_org'] . ' - ' . $title ?></title>

	<link href="<?php echo base_url() ?>asset/admininspina/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>asset/admininspina/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link rel="icon" href="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['favicon_org'] ?>" type="image/x-icon" />
	<link href="<?php echo base_url() ?>asset/admininspina/css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>asset/admininspina/css/style.css" rel="stylesheet">
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
									<span class="block m-t-xs font-bold"><?= @$_SESSION['nama_user']; ?></span>
									<span class="text-muted text-xs block"><?= @$_SESSION['nama_akses']; ?> <b class="caret"></b></span>
								</a>
								<ul class="dropdown-menu animated fadeInRight m-t-xs">
									<li><a class="dropdown-item" href="#"><?= @$_SESSION['nama_div']; ?></a></li>
									<li class="dropdown-divider"></li>
									<li><a class="dropdown-item" href="<?php echo base_url() ?>troubleshoot/logout">Logout</a></li>
								</ul>
							</div>
							<div class="logo-element">
								KCD
							</div>
						</li>
						<li class="active">
							<a href="<?php echo base_url() ?>ts/home"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
						</li>
						<!-- <li>
							<a href="#"><i class="fa fa-gears"></i> <span class="nav-label">Administrator</span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li><a href="<?php echo base_url() ?>ts/user"><i class="fa fa-users"></i> Data Pengguna</a></li>
								<li><a href="<?php echo base_url() ?>ts/klien"><i class="fa fa-users"></i> Data Klien</a></li>
								<li><a href="<?php echo base_url() ?>ts/location"><i class="fa fa-building"></i> Data Lokasi</a></li>
								<li><a href="<?php echo base_url() ?>ts/department"><i class="fa fa-bank"></i> Data Departemen</a></li>
								<li><a href="<?php echo base_url() ?>ts/divisi"><i class="fa fa-user-md"></i> Data Divisi</a></li>
								<li><a href="<?php echo base_url() ?>ts/category"><i class="fa fa-sitemap"></i> Data Kategori</a></li>
								<li><a href="<?php echo base_url() ?>ts/organisasi"><i class="fa fa-institution"></i> Konfig Organisasi</a></li>
								<li><a href="<?php echo base_url() ?>ts/email"><i class="fa fa-envelope"></i> Konfig Email</a></li>
								<li><a href="<?php echo base_url() ?>ts/whatsapp"><i class="fa fa-send"></i> Konfig Whatsapp</a></li>
								<li><a href="<?php echo base_url() ?>ts/wagroup"><i class="fa fa-whatsapp"></i> Konfig WA Group</a></li>
								<li><a href="<?php echo base_url() ?>ts/backupdb"><i class="fa fa-download"></i> Backup Database</a></li>
							</ul>
						</li> -->
						<li>
							<a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Request Inputer</span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li><a href="<?php echo base_url() ?>ts/ticket"><i class="fa fa-inbox"></i> Request Masuk</a></li>
								<li><a href="<?php echo base_url() ?>ts/ticket/proses"><i class="fa fa-yelp"></i> Request Diproses</a></li>
								<li><a href="<?php echo base_url() ?>ts/ticket/selesai"><i class="fa fa-check-square"></i> Request Selesai</a></li>
							</ul>
						</li>
						<li>
							<a href="<?php echo base_url() ?>ts/report"><i class="fa fa-book"></i> <span class="nav-label">Report LED</span> </a>
						</li>
						<li>
							<a href="<?php echo base_url() ?>troubleshoot/logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
						</li>
					</ul>

				</div>
			</nav>
		<?php
		} elseif ($akses == 4) {
		?>
			<nav class="navbar-default navbar-static-side" role="navigation">
				<div class="sidebar-collapse">
					<ul class="nav metismenu" id="side-menu">
						<li class="nav-header">
							<div class="dropdown profile-element">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
									<span class="block m-t-xs font-bold"><?= @$_SESSION['nama_user']; ?></span>
									<span class="text-muted text-xs block"><?= @$_SESSION['nama_akses']; ?> <b class="caret"></b></span>
								</a>
								<ul class="dropdown-menu animated fadeInRight m-t-xs">
									<li><a class="dropdown-item" href="#"><?= @$_SESSION['nama_div']; ?></a></li>
									<li class="dropdown-divider"></li>
									<li><a class="dropdown-item" href="<?php echo base_url() ?>troubleshoot/logout">Logout</a></li>
								</ul>
							</div>
							<div class="logo-element">
								KCD
							</div>
						</li>
						<li class="active">
							<a href="<?php echo base_url() ?>ts/home"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
						</li>
						<li class="active">
							<a href="<?php echo base_url() ?>ts/ticket/approve"><i class="fa fa-check"></i> <span class="nav-label">Approval</span></a>
						</li>
						<!-- <li class="active">
							<a href="<?php echo base_url() ?>ts/ticket/selesai"><i class="fa fa-check-square"></i> Request Selesai</a>
						</li> -->
						<li>
							<a href="<?php echo base_url() ?>ts/report"><i class="fa fa-book"></i> <span class="nav-label">Report LED</span> </a>
						</li>
						<li>
							<a href="<?php echo base_url() ?>troubleshoot/logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
						</li>
					</ul>

				</div>
			</nav>
		<?php } else {
		?>
			<nav class="navbar-default navbar-static-side" role="navigation">
				<div class="sidebar-collapse">
					<ul class="nav metismenu" id="side-menu">
						<li class="nav-header">
							<div class="dropdown profile-element">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
									<span class="block m-t-xs font-bold"><?= @$_SESSION['nama_user']; ?></span>
									<span class="text-muted text-xs block"><?= @$_SESSION['nama_akses']; ?> <b class="caret"></b></span>
								</a>
								<ul class="dropdown-menu animated fadeInRight m-t-xs">
									<li><a class="dropdown-item" href="#"><?= @$_SESSION['nama_div']; ?></a></li>
									<li class="dropdown-divider"></li>
									<li><a class="dropdown-item" href="<?php echo base_url() ?>troubleshoot/logout">Logout</a></li>
								</ul>
							</div>
							<div class="logo-element">
								KCD
							</div>
						</li>
						<li class="active">
							<a href="<?php echo base_url() ?>ts/home"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Request Inputer</span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li><a href="<?php echo base_url() ?>ts/ticket"><i class="fa fa-inbox"></i> Request Masuk</a></li>
								<li><a href="<?php echo base_url() ?>ts/ticket/proses"><i class="fa fa-yelp"></i> Request Diproses</a></li>
								<li><a href="<?php echo base_url() ?>ts/ticket/selesai"><i class="fa fa-check-square"></i> Request Selesai</a></li>
							</ul>
						</li>

						<li>
							<a href="<?php echo base_url() ?>ts/report"><i class="fa fa-book"></i> <span class="nav-label">Report LED</span> </a>
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
				<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-success " href="#"><i class="fa fa-bars"></i> </a>
					</div>
					<ul class="nav navbar-top-links navbar-right">
						<li>
							<a href="<?php echo base_url() ?>troubleshoot/logout">
								<i class="fa fa-sign-out"></i> Log out
							</a>
						</li>
					</ul>

				</nav>
			</div>
			<div class="wrapper wrapper-content">
				<div>
					<?php
					$today = date('Y-m-d');
					echo 'Hari ini: <strong>' . tgl_indo($today) . '</strong>';
					?>
				</div>
				</br>
				<div class="row">
					<div class="col-lg-3">
						<div class="ibox ">
							<div class="ibox-title">
								<div class="ibox-tools">
									<span class="label label-info float-right">Bulan Ini</span>
								</div>
								<h5>Request Masuk</h5>
							</div>
							<div class="ibox-content">
								<h1 class="no-margins">
									<?php
									$div = $this->session->userdata('id_div');
									if ($div == '1') {
										$start = date('Y-m');
										$end = date('Y-m-d');
										$start_date = $start . "-01";
										$this->db->select('id_ticket');
										$this->db->from('tb_ticket');
										$this->db->where('create_ticket >=', $start_date);
										$this->db->where('create_ticket <=', $end);
										echo $this->db->count_all_results();
									} else {
										$start = date('Y-m');
										$end = date('Y-m-d');
										$start_date = $start . "-01";
										$this->db->select('id_ticket');
										$this->db->from('tb_ticket');
										$this->db->where('create_ticket >=', $start_date);
										$this->db->where('create_ticket <=', $end);
										$this->db->where('id_div', $div);
										echo $this->db->count_all_results();
									}
									?>
								</h1>
								<small>Total Request</small>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="ibox ">
							<div class="ibox-title">
								<div class="ibox-tools">
									<span class="label label-success float-right">Bulan Ini</span>
								</div>
								<h5>Request Selesai</h5>
							</div>
							<div class="ibox-content">
								<h1 class="no-margins">
									<?php
									$div = $this->session->userdata('id_div');
									if ($div == '1') {
										$start = date('Y-m');
										$end = date('Y-m-d');
										$start_date = $start . "-01";
										$this->db->select('id_ticket');
										$this->db->from('tb_ticket');
										$this->db->where('create_ticket >=', $start_date);
										$this->db->where('create_ticket <=', $end);
										$this->db->where('sts_ticket', '3');
										echo $this->db->count_all_results();
									} else {
										$start = date('Y-m');
										$end = date('Y-m-d');
										$start_date = $start . "-01";
										$this->db->select('id_ticket');
										$this->db->from('tb_ticket');
										$this->db->where('create_ticket >=', $start_date);
										$this->db->where('create_ticket <=', $end);
										$this->db->where('id_div', $div);
										$this->db->where('sts_ticket', '3');
										echo $this->db->count_all_results();
									}
									?>
								</h1>
								<small>Total Request</small>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="ibox ">
							<div class="ibox-title">
								<div class="ibox-tools">
									<span class="label label-danger float-right">Bulan Ini</span>
								</div>
								<h5>Request On Progress</h5>
							</div>
							<div class="ibox-content">
								<h1 class="no-margins">
									<?php
									$div = $this->session->userdata('id_div');
									if ($div == '1') {
										$start = date('Y-m');
										$end = date('Y-m-d');
										$start_date = $start . "-01";
										$this->db->select('id_ticket');
										$this->db->from('tb_ticket');
										$this->db->where('create_ticket >=', $start_date);
										$this->db->where('create_ticket <=', $end);
										$this->db->where_not_in('sts_ticket', '3');
										echo $this->db->count_all_results();
									} else {
										$start = date('Y-m');
										$end = date('Y-m-d');
										$start_date = $start . "-01";
										$this->db->select('id_ticket');
										$this->db->from('tb_ticket');
										$this->db->where('create_ticket >=', $start_date);
										$this->db->where('create_ticket <=', $end);
										$this->db->where('id_div', $div);
										$this->db->where_not_in('sts_ticket', '3');
										echo $this->db->count_all_results();
									}
									?>
								</h1>
								<small>Total Request</small>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="ibox ">
							<div class="ibox-title">
								<h5>Divisi Aktif</h5>
							</div>
							<div class="ibox-content">
								<h1 class="no-margins">
									<?php
									$this->db->select('id_div');
									$this->db->from('tb_division');
									$this->db->where('sts_div', '1');
									echo $this->db->count_all_results();
									?>
								</h1>
								<small>Total Divisi Troubleshoot</small>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="ibox ">
							<div class="ibox-title">
								<h5>Chart Request</h5>
							</div>
							<div class="ibox-content">
								<div>
									<canvas id="itdept" height="140"></canvas>
								</div>
							</div>
						</div>
					</div>
					<div class="footer">
						<div class="float-right">
							Made with Love <strong>IT KCD | Version 1.2</strong>
						</div>
						<div>
							<strong>Copyright</strong> - <?php echo $dataorg['nama_org'] ?> &copy; 2023
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

			<!-- ChartJS-->
			<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/chartJs/Chart.min.js"></script>

			<!-- Sweet alert -->
			<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/sweetalert/sweetalert.min.js"></script>

			<script>
				$(function() {

					var barData = {
						labels: ["January", "February", "March", "April", "May", "June", "July"],
						datasets: [{
								label: "Request Masuk",
								backgroundColor: 'rgba(220, 220, 220, 0.5)',
								pointBorderColor: "#fff",
								data: [65, 59, 80, 81, 56, 55, 100]
							},
							{
								label: "Request Selesai",
								backgroundColor: 'rgba(26,179,148,0.5)',
								borderColor: "rgba(26,179,148,0.7)",
								pointBackgroundColor: "rgba(26,179,148,1)",
								pointBorderColor: "#fff",
								data: [28, 48, 40, 19, 86, 27, 90]
							}
						]
					};

					var barOptions = {
						responsive: true
					};


					var ctx2 = document.getElementById("xxx").getContext("2d");
					new Chart(ctx2, {
						type: 'bar',
						data: barData,
						options: barOptions
					});

				});
			</script>

			<script>
				$(document).ready(function() {
					$.ajax({
						url: "<?php echo base_url('ts/home/getticketdata'); ?>", // Ganti dengan URL endpoint di controller Anda
						type: "GET",
						dataType: "json",
						success: function(data) {
							var labels = data.labels;
							var values = data.data;
							var valuesf = data.dataf; // Data untuk "Tiket Selesai"

							var ctx = document.getElementById('itdept');

							if (ctx) {
								var chart = new Chart(ctx, {
									type: 'bar',
									data: {
										labels: labels,
										datasets: [{
												label: 'Request Masuk',
												data: values,
												backgroundColor: 'rgba(220, 220, 220, 0.5)'
											},
											{
												label: 'Request Selesai', // Label untuk "Tiket Selesai"
												backgroundColor: 'rgba(26, 179, 148, 0.5)',
												data: valuesf
											}
										]
									},
									options: {
										responsive: true
									}
								});
							}
						}
					});
				});
			</script>


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

</body>

</html>
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
		<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu">
					<li class="nav-header">
						<div class="dropdown profile-element">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="block m-t-xs font-bold"><?= @$_SESSION['nama_client']; ?></span>
								<span class="text-muted text-xs block"><?= @$_SESSION['nama_dept']; ?> <b class="caret"></b></span>
							</a>
							<ul class="dropdown-menu animated fadeInRight m-t-xs">
								<li><a class="dropdown-item" href="#"><?= @$_SESSION['nama_loc']; ?></a></li>
								<li class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="<?php echo base_url() ?>login/logout">Logout</a></li>
							</ul>
						</div>
						<div class="logo-element">
							KCD
						</div>
					</li>
					<li class="active">
						<a href="<?php echo base_url() ?>client/home"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>client/ticket/create"><i class="fa fa-ticket"></i> <span class="nav-label">New Request</span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>client/ticket"><i class="fa fa-book"></i> <span class="nav-label">Progres Request</span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>login/logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
					</li>
				</ul>

			</div>
		</nav>
		<!-- //Menu -->

		<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-success " href="#"><i class="fa fa-bars"></i> </a>
					</div>
					<ul class="nav navbar-top-links navbar-right">
						<li>
							<a href="<?php echo base_url() ?>login/logout">
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
					<div class="col-lg-6">
						<div class="ibox ">
							<div class="ibox-title">
								<div class="ibox-tools">
								</div>
								<h5>Request Proses</h5>
							</div>
							<div class="ibox-content">
								<h1 class="no-margins">
									<?php
									$client    = $this->session->userdata('id_client');
									$this->db->select('id_ticket');
									$this->db->from('tb_ticket');
									$this->db->where('id_client', $client);
									$this->db->where_not_in('sts_ticket', '3');
									echo $this->db->count_all_results();
									?>
								</h1>
								<small>Total Request</small>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="ibox ">
							<div class="ibox-title">
								<div class="ibox-tools">
								</div>
								<h5>Progres Request</h5>
							</div>
							<div class="ibox-content">
								<h1 class="no-margins">
									<?php
									$client    = $this->session->userdata('id_client');
									$this->db->select('id_ticket');
									$this->db->from('tb_ticket');
									$this->db->where('id_client', $client);
									echo $this->db->count_all_results();
									?>
								</h1>
								<small>Total Request</small>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="footer">
				<div class="float-right">
					Made With Love <strong><b>IT KCD | Version 1.2</b></strong>
				</div>
				<div>
					<strong>Copyright</strong> -
					<?php echo $dataorg['nama_org'] ?> &copy; 2023
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
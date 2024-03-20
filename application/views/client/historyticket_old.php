<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo $dataorg['short_org'] . ' - ' . $title ?></title>

	<link href="<?php echo base_url() ?>asset/admininspina/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>asset/admininspina/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>asset/admininspina/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>asset/admininspina/css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>asset/admininspina/css/style.css" rel="stylesheet">
	<link rel="icon" href="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['favicon_org'] ?>" type="image/x-icon" />
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
								<span class="block m-t-xs font-bold">
									<?= @$_SESSION['nama_client']; ?>
								</span>
								<span class="text-muted text-xs block">
									<?= @$_SESSION['nama_dept']; ?> <b class="caret"></b>
								</span>
							</a>
							<ul class="dropdown-menu animated fadeInRight m-t-xs">
								<li><a class="dropdown-item" href="#">
										<?= @$_SESSION['nama_loc']; ?>
									</a></li>
								<li class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="<?php echo base_url() ?>login/logout">Logout</a></li>
							</ul>
						</div>
						<div class="logo-element">
							KCD
						</div>
					</li>
					<li>
						<a href="<?php echo base_url() ?>client/home"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>client/ticket/create"><i class="fa fa-ticket"></i> <span class="nav-label">New Request</span></a>
					</li>
					<li class="active">
						<a href="<?php echo base_url() ?>client/ticket"><i class="fa fa-book"></i> <span class="nav-label">Progres Request</span></a>
					</li>
					<!-- <li>
						<a href="<?php echo base_url() ?>ts/report"><i class="fa fa-book"></i> <span class="nav-label">Rekap Request</span> </a>
					</li> -->
					<li>
						<a href="<?php echo base_url() ?>login/logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
					</li>
				</ul>

			</div>
		</nav>
		<!-- //Menu -->

		<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
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
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-10">
					<h2>Progres Request Anda</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="<?php echo base_url() ?>client/home">Home</a>
						</li>
						<li class="breadcrumb-item">
							<a>Client</a>
						</li>
						<li class="breadcrumb-item active">
							<strong>Data Progres Request</strong>
						</li>
					</ol>
				</div>
				<div class="col-lg-2">

				</div>
			</div>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox ">
							<div class="ibox-title">
							</div>
							<div class="ibox-content">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover dataTables-ticketselesai" id="table-ticketselesai">
										<thead>
											<tr>
												<th>Tanggal Input</th>
												<th>No Request</th>
												<th>Divisi Penanggung Jawab</th>
												<th>Kategori Resiko</th>
												<th>Durasi Penanganan</th>
												<th>Detail</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer">
				<div class="float-right">
					Made With Love <strong>IT KCD | Version 1.2</strong>
				</div>
				<div>
					<strong>Copyright</strong> - <?php echo $dataorg['nama_org'] ?> &copy; 2023
				</div>
			</div>

		</div>

		<!-- Modals Detail -->
		<div class="modal inmodal" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content animated fadeIn">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<div>
							<img src="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['logo_org'] ?>" width="20%" height="20%">
						</div><br>
						<!-- <i class="fa fa-ticket modal-icon"></i> -->
						<h4 class="modal-title">Detail Data LED</h4>
						<small>Lost Event Database</small>
					</div>

					<div class="modal-body" id="viewdetail">

					</div>
				</div>
			</div>
		</div>
		<!-- Modals -->

		<!-- Modals Timeline -->
		<div class="modal inmodal" id="modal-timeline" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content animated fadeIn">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<div>
							<img src="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['logo_org'] ?>" width="20%" height="20%">
						</div><br>
						<!-- <i class="fa fa-ticket modal-icon"></i> -->
						<h4 class="modal-title">Timeline Penanganan LED</h4>
						<small>Lost Event Database</small>
					</div>

					<div class="modal-body" id="viewtimeline">

					</div>
				</div>
			</div>
		</div>
		<!-- Modals -->

		<!-- Modals Hapus Data -->
		<div class="modal inmodal" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content animated fadeIn">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<div>
							<img src="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['logo_org'] ?>" width="20%" height="20%">
						</div><br>
						<!-- <i class="fa fa-ticket modal-icon"></i> -->
						<h4 class="modal-title">Hapus Data</h4>
						<small>Hapus Data LED</small>
					</div>

					<div class="modal-body" id="viewdelete">

					</div>
				</div>
			</div>
		</div>
		<!-- Modals -->

	</div>




	<!-- Mainly scripts -->
	<script src="<?php echo base_url() ?>asset/admininspina/js/jquery-3.1.1.min.js"></script>
	<script src="<?php echo base_url() ?>asset/admininspina/js/popper.min.js"></script>
	<script src="<?php echo base_url() ?>asset/admininspina/js/bootstrap.js"></script>
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

	<!-- Datatables scripts -->
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/dataTables/datatables.min.js"></script>

	<!-- Custom and plugin javascript -->
	<script src="<?php echo base_url() ?>asset/admininspina/js/inspinia.js"></script>
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/pace/pace.min.js"></script>

	<!-- Jquery Validate -->
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/validate/jquery.validate.min.js"></script>
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/jquery-ui/jquery-ui.min.js"></script>

	<!-- Sweet alert -->
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/sweetalert/sweetalert.min.js"></script>

	<!-- Page-Level Scripts -->
	<script>
		$(document).ready(function() {
			var dataTable = $('.dataTables-ticketselesai').DataTable({
				pageLength: 10,
				responsive: true,
				processing: true,
				serverSide: true,
				ajax: {
					url: '<?php echo base_url('client/ticket/dataticket'); ?>',
					type: 'POST'
				},
				columns: [{
						data: 'create_ticket'
					},
					{
						data: 'no_ticket'
					},
					{
						data: 'nama_div'
					},
					{
						data: 'nama_cat'
					},
					{
						data: 'down_time'
					},
					{
						data: 'detail'
					},
					{
						data: 'sts_ticket'
					},
					{
						data: 'aksi'
					},
				]
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

	<script>
		$("#table-ticketselesai").on('click', '.detail', function(e) {
			e.preventDefault();
			var ticket_id = $(e.currentTarget).attr('data-ticket-id');
			if (ticket_id === '') return;
			$.ajax({
				type: "POST",
				url: '<?= base_url('client/ticket/ajax?type=detail'); ?>',
				data: {
					ticket_id: ticket_id
				},
				beforeSend: function() {
					swal({
						title: "Mempersiapkan Data",
						text: "Please wait",
						showConfirmButton: false,
						allowOutsideClick: false
					});
				},
				success: function(data) {
					swal({
						title: "Mempersiapkan Data",
						text: "Please wait",
						showConfirmButton: false,
						allowOutsideClick: false,
						timer: 200, // Waktu dalam milidetik (dalam contoh ini, 0.8 detik)
					});
					$('#modal-detail').modal('show');
					$('#viewdetail').html(data);

				},
				error: function() {
					swal("Ambil Data Gagal", "Ada Kesalahan Saat menampilkan data!", "error");
				}
			});
		});

		$("#table-ticketselesai").on('click', '.timeline', function(e) {
			e.preventDefault();
			var ticket_id = $(e.currentTarget).attr('data-ticket-id');
			if (ticket_id === '') return;
			$.ajax({
				type: "POST",
				url: '<?= base_url('client/ticket/ajax?type=timeline'); ?>',
				data: {
					ticket_id: ticket_id
				},
				beforeSend: function() {
					swal({
						title: "Mempersiapkan Data",
						text: "Please wait",
						showConfirmButton: false,
						allowOutsideClick: false
					});
				},
				success: function(data) {
					swal({
						title: "Mempersiapkan Data",
						text: "Please wait",
						showConfirmButton: false,
						allowOutsideClick: false,
						timer: 200, // Waktu dalam milidetik (dalam contoh ini, 0.8 detik)
					});
					$('#modal-timeline').modal('show');
					$('#viewtimeline').html(data);

				},
				error: function() {
					swal("Ambil Data Gagal", "Ada Kesalahan Saat menampilkan data!", "error");
				}
			});
		});

		//ambil data ticket untuk dihapus
		$("#table-ticketselesai").on('click', '.delete', function(e) {
			e.preventDefault();
			var ticket_id = $(e.currentTarget).attr('data-ticket-id');
			if (ticket_id === '') return;
			$.ajax({
				type: "POST",
				url: '<?= base_url('client/ticket/ajax?type=delete'); ?>',
				data: {
					ticket_id: ticket_id
				},
				beforeSend: function() {
					swal({
						title: "Mempersiapkan Data",
						text: "Please wait",
						showConfirmButton: false,
						allowOutsideClick: false
					});
				},
				success: function(data) {
					swal({
						title: "Mempersiapkan Data",
						text: "Please wait",
						showConfirmButton: false,
						allowOutsideClick: false,
						timer: 200, // Waktu dalam milidetik (dalam contoh ini, 0.8 detik)
					});
					$('#modal-delete').modal('show');
					$('#viewdelete').html(data);

				},
				error: function() {
					swal("Ambil Data Gagal", "Ada Kesalahan Saat menampilkan data!", "error");
				}
			});
		});
	</script>

</body>

</html>
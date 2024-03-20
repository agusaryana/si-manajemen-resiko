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
						<li>
							<a href="<?php echo base_url() ?>ts/home"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
						</li>
						<!-- <li>
							<a href="#"><i class="fa fa-gears"></i> <span class="nav-label">Administrator</span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
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
						<li class="active">
							<a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Request Inputer</span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li><a href="<?php echo base_url() ?>ts/ticket"><i class="fa fa-inbox"></i> Request Masuk</a></li>
								<li class="active"><a href="<?php echo base_url() ?>ts/ticket/proses"><i class="fa fa-yelp"></i> Request Diproses</a></li>
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
						<li>
							<a href="<?php echo base_url() ?>ts/home"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
						</li>
						<li class="active">
							<a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Request Inputer</span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li><a href="<?php echo base_url() ?>ts/ticket"><i class="fa fa-inbox"></i> Request Masuk</a></li>
								<li class="active"><a href="<?php echo base_url() ?>ts/ticket/proses"><i class="fa fa-yelp"></i> Request Diproses</a></li>
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
		} ?>
		<!-- //Menu -->

		<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
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
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-10">
					<h2>Data Request Diproses</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="<?php echo base_url() ?>ts/home">Dashboard</a>
						</li>
						<li class="breadcrumb-item">
							<a>Execution</a>
						</li>
						<li class="breadcrumb-item active">
							<strong>Data Request Diproses</strong>
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
									<table class="table table-striped table-bordered table-hover dataTables-ticketproses" id="table-ticketproses">
										<thead>
											<tr>
												<th>No Req</th>
												<th>Tgl Input</th>
												<th>Nama Inputer</th>
												<!-- <th>Lokasi</th> -->
												<th>Durasi Penanganan</th>
												<!-- <th>Prioritas</th> -->
												<th>Penanggung Jawab</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											foreach ($ticket as $l) { ?>
												<tr>
													<td><?php echo $l->no_ticket ?></td>
													<td><?php echo tgl_indo($l->create_ticket) ?></td>
													<td><?php echo $l->nama_ticket ?></td>
													<!-- <td><?php echo $l->nama_loc ?></td> -->
													<td>
														<?php
														// Waktu saat ini
														$now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));

														// Waktu yang Anda miliki
														$yourDateTime = new DateTime('' . $l->exe_time . '', new DateTimeZone('Asia/Jakarta'));

														// Hitung selisih waktu
														$interval = $now->diff($yourDateTime);

														// Mendapatkan perbedaan jam
														$hours = $interval->h;

														// Mendapatkan perbedaan hari
														$days = $interval->days;

														if ($days > 0) {
															// Jika lebih dari satu hari, tampilkan perbedaan dalam hari
															echo $days . ' hari';
														} elseif ($hours > 0) {
															// Jika lebih dari satu jam, tampilkan perbedaan dalam jam
															echo $hours . ' jam';
														} else {
															// Jika kurang dari satu jam, tampilkan perbedaan dalam menit
															echo $interval->i . ' menit';
														}
														?>
													</td>
													<!-- <td>
														<?php if ($l->priority_ticket == 1) {
															echo '<button type="button" class="btn btn-primary btn-xs priority" data-ticket-id="' . $l->id_ticket . '" title="Prioritas Rendah"><i class="fa fa-edit"></i> Low</button>';
														} elseif ($l->priority_ticket == 2) {
															echo '<button type="button" class="btn btn-warning btn-xs priority" data-ticket-id="' . $l->id_ticket . '" title="Prioritas Normal"><i class="fa fa-edit"></i> Normal</button>';
														} elseif ($l->priority_ticket == 3) {
															echo '<button type="button" class="btn btn-danger btn-xs priority" data-ticket-id="' . $l->id_ticket . '" title="Prioritas Tinggi"><i class="fa fa-edit"></i> High</button>';
														}
														?>
													</td> -->
													<td><?php echo $l->nama_user ?></td>
													<td><button type="button" class="btn btn-warning btn-xs timeline" data-ticket-id="<?php echo $l->no_ticket ?>" title="Status Ticket">On Process</button>
													</td>
													<td><button type="button" class="btn btn-success btn-xs detail" data-ticket-id="<?php echo $l->id_ticket ?>" title="Deskripsi Ticket"><i class="fa fa-eye"></i> Detail</button> | <button type="button" class="btn btn-primary btn-xs finish" data-ticket-id="<?php echo $l->id_ticket ?>" title="Selesaikan Ticket"><i class="fa fa-check"></i> Selesai</button>
													</td>
												</tr>
											<?php } ?>
										</tbody>
										<!-- <tfoot>
											<tr>
												<th>No Req</th>
												<th>Tgl</th>
												<th>Nama Klien</th>
												<th>Lokasi</th>
												<th>Exe Time</th>
												<th>Prioritas</th>
												<th>PIC</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</tfoot> -->
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

		<!-- Modals Prioritas -->
		<div class="modal inmodal" id="modal-priority" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content animated fadeIn">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<div>
							<img src="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['logo_org'] ?>" width="20%" height="20%">
						</div><br>
						<!-- <i class="fa fa-ticket modal-icon"></i> -->
						<h4 class="modal-title">Prioritas LED</h4>
						<small>Lost Event Database</small>
					</div>

					<div class="modal-body" id="viewpriority">

					</div>
				</div>
			</div>
		</div>
		<!-- Modals -->

		<!-- Modals Timeline -->
		<div class="modal inmodal" id="modal-timeline" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
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

		<!-- Modals Finish -->
		<div class="modal inmodal" id="modal-finish" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content animated fadeIn">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<div>
							<img src="<?php echo base_url() ?>asset/gambar/<?php echo $dataorg['logo_org'] ?>" width="20%" height="20%">
						</div><br>
						<!-- <i class="fa fa-ticket modal-icon"></i> -->
						<h4 class="modal-title">Selesaikan Permasalahahan LED</h4>
						<small>Lost Event Database</small>
					</div>

					<div class="modal-body" id="viewfinish">

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
		// Mengatur kelas nama tombol yang ditingkatkan
		$.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

		var table; // Mendeklarasikan variabel 'table' sebagai variabel global

		$(document).ready(function() {
			table = $('.dataTables-ticketproses').DataTable({
				pageLength: 10,
				responsive: true,
				dom: '<"html5buttons"B>lTfgitp',
				buttons: [{
						extend: 'copy'
					},
					{
						extend: 'csv'
					},
					{
						extend: 'excel',
						title: 'ExampleFile'
					},
					{
						extend: 'pdf',
						title: 'ExampleFile'
					},
					{
						extend: 'print',
						customize: function(win) {
							$(win.document.body).addClass('white-bg');
							$(win.document.body).css('font-size', '10px');

							$(win.document.body).find('table')
								.addClass('compact')
								.css('font-size', 'inherit');
						}
					}
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
		$("#table-ticketproses").on('click', '.detail', function(e) {
			e.preventDefault();
			var ticket_id = $(e.currentTarget).attr('data-ticket-id');
			if (ticket_id === '') return;
			$.ajax({
				type: "POST",
				url: '<?= base_url('ts/ticket/ajax?type=detail'); ?>',
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

		$("#table-ticketproses").on('click', '.priority', function(e) {
			e.preventDefault();
			var ticket_id = $(e.currentTarget).attr('data-ticket-id');
			if (ticket_id === '') return;
			$.ajax({
				type: "POST",
				url: '<?= base_url('ts/ticket/ajax?type=priority'); ?>',
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
					$('#modal-priority').modal('show');
					$('#viewpriority').html(data);

				},
				error: function() {
					swal("Ambil Data Gagal", "Ada Kesalahan Saat menampilkan data!", "error");
				}
			});
		});

		$("#table-ticketproses").on('click', '.finish', function(e) {
			e.preventDefault();
			var ticket_id = $(e.currentTarget).attr('data-ticket-id');
			if (ticket_id === '') return;
			$.ajax({
				type: "POST",
				url: '<?= base_url('ts/ticket/ajax?type=finish'); ?>',
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
					$('#modal-finish').modal('show');
					$('#viewfinish').html(data);

				},
				error: function() {
					swal("Ambil Data Gagal", "Ada Kesalahan Saat menampilkan data!", "error");
				}
			});
		});

		$("#table-ticketproses").on('click', '.timeline', function(e) {
			e.preventDefault();
			var ticket_id = $(e.currentTarget).attr('data-ticket-id');
			if (ticket_id === '') return;
			$.ajax({
				type: "POST",
				url: '<?= base_url('ts/ticket/ajax?type=timeline'); ?>',
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
	</script>

</body>

</html>

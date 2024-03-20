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
					<li class="active">
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
				<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-success " href="#"><i class="fa fa-bars"></i> </a>
					</div>
					<ul class="nav navbar-top-links navbar-right">
						<li>
							<a href="<?php echo base_url() ?>client/login/logout">
								<i class="fa fa-sign-out"></i> Log out
							</a>
						</li>
					</ul>
				</nav>
			</div>
			<div class="row wrapper border-bottom white-bg page-heading">
				<div class="col-lg-10">
					<h2>Create New Request</h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="#">Home</a>
						</li>
						<li class="breadcrumb-item active">
							<a>Create Request</a>
						</li>
					</ol>
				</div>
			</div>

			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox ">
							<div class="ibox-content">
								<div class="row">
									<div class="col-sm-12 b-r">
										<form role="form" method="POST" action="<?php echo base_url() ?>client/ticket/add" enctype="multipart/form-data">
											<input type="hidden" name="nama_ticket" value="<?= @$_SESSION['nama_client']; ?>">
											<input type="hidden" name="email_ticket" value="<?= @$_SESSION['email_client']; ?>">
											<input type="hidden" name="tlp_ticket" value="<?= @$_SESSION['tlp_client']; ?>">
											<input type="hidden" name="id_loc" value="<?= @$_SESSION['id_loc']; ?>">
											<input type="hidden" name="id_dept" value="<?= @$_SESSION['id_dept']; ?>">
											<input type="hidden" name="id_client" value="<?= @$_SESSION['id_client']; ?>">
											<div class="row">
												<div class="form-group col-lg-4">
													<label><b>Tanggal kejadian</b></label>
													<input class="form-control m-b" type="date" name="tgl_kejadian" id="tgl_kejadian" required>
												</div>
												<div class="form-group col-lg-4">
													<label><b>Faktor Penyebab Kejadian</b></label>
													<select class="form-control m-b" name="faktor_penyebab" id="faktor_penyebab" required>
														<option selected="selected" value="Faktor Eksternal">Faktor Eksternal Lainnya</option>
														<option selected="selected" value="Human Error">Human Error/Kelalaian Manusia</option>
														<option selected="selected" value="Sistem">Sistem CoreBanking</option>
														<option selected="selected" value="Fraud Internal">Fraud Internal</option>
														<option selected="selected" value="Fraud Eksternal">Fraud Eksternal</option>
														<option selected="selected" value="Kesalahan Pembelian Produk">Kesalahan Penjelasan Produk</option>
														<option selected="selected" value="Kesalahan Pembelian Produk">Jaringan Koneksi</option>
														<option selected="selected" value="Lain-lain">Lain-lain</option>
														<option selected="selected" value="">--Pilih salah satu--</option>
													</select>
												</div>
												<!-- inputan tambahan faktor penyebab lain-lain -->
												<div class="form-group col-lg-4" id="faktor_penyebab_lain" style="display:none;">
													<label for="faktor_penyebab_lain"><b>Input Faktor Penyabab Lain-lain</b></label>
													<textarea class=" form-control mb" id="faktor_penyebab_lain" name="faktor_penyebab_lain" placeholder="Masukan faktor penyebab lain-lain"></textarea>
												</div>
												<!-- end -->
												<div class="form-group col-lg-4">
													<label><b>Kategori Resiko</b></label>
													<select class="form-control m-b" name="id_cat" id="id_cat" required>
														<option selected="selected" value="">-- Pilih salah satu
															--</option>
														<?php
														foreach ($tb_category as $row2) {
															echo '<option value="' . $row2->id_cat . '">' . $row2->nama_cat . '</option>';
														}
														?>
													</select>
												</div>
												<!-- <div class="form-group col-lg-4">
													<label><b>Kategori Resiko</b></label>
													<select class="form-control m-b" name="id_cat" id="id_cat" required>
														<option selected="selected" value="">-- Pilih divisi terlebih dahulu
															--</option>
													</select>
												</div> -->
											</div>
											<div class="row">
												<div class="form-group col-lg-4">
													<label><b>Jenis Transaksi</b></label>
													<select class="form-control m-b" name="jenis_transaksi" id="jenis_transaksi" required>
														<option selected="selected" value="Transaksi Penarikan">Transaksi Penarikan</option>
														<option selected="selected" value="Transaksi Penyetoran">Transaksi Penyetoran</option>
														<option selected="selected" value="Pencairan Deposito">Pencairan Deposito</option>
														<option selected="selected" value="Transaksi Pemindahbukuan">Transaksi Pemindahbukuan</option>
														<option selected="selected" value="Pembukaan Rekening">Pembukaan Rekening</option>
														<option selected="selected" value="Pembayaran Bunga Deposito">Pembayaran Bunga Deposito</option>
														<option selected="selected" value="Transaksi Transfer">Transaksi Transfer</option>
														<option selected="selected" value="Pembayaran Kredit">Pembayaran Kredit</option>
														<option selected="selected" value="Pembayaran Kredit">Pencairan Kredit</option>
														<option selected="selected" value="Pembayaran Kredit">Pelunasan Kredit</option>
														<option selected="selected" value="Pembayaran Kredit">Perpanjangan Kredit</option>
														<option selected="selected" value="Gangguan Jaringan">Gangguan Jaringan</option>
														<option selected="selected" value="Kerusakan Hardware">Kerusakan Hardware</option>
														<option selected="selected" value="Perbaikan/Maintenance">Perbaikan/Maintenance</option>
														<option selected="selected" value="Lainnya">Lainnya</option>
														<option selected="selected" value="">--Pilih salah satu--</option>
													</select>
												</div>
												<!-- inputan tambahan trasnaksi lainnya -->
												<div class="form-group col-lg-4" id="inputTambahan" style="display:none;">
													<label for="inputTambahan"><b>Input Jenis Transaksi Lainnya</b></label>
													<textarea class="form-control mb" id="inputTambahan" name="inputTambahan" placeholder="Masukan jenis transaksi lainnya"></textarea>
												</div>
												<!-- end -->
												<div class="form-group col-lg-4">
													<label><b>Tempat Kejadian</b></label>
													<select class="form-control m-b" name="tempat_kejadian" id="tempat_kejadian" required>
														<option selected="selected" value="Pusat Teuku Umar">Pusat Teuku Umar</option>
														<option selected="selected" value="Kantor Cabang Gianyar">Kantor Cabang Gianyar</option>
														<option selected="selected" value="Kantor Cabang Dalung">Kantor Cabang Dalung</option>
														<option selected="selected" value="Kantor Cabang Tabanan">Kantor Cabang Tabanan</option>
														<option selected="selected" value="Kantor Cabang Kuta">Kantor Cabang Kuta</option>
														<option selected="selected" value="Kantor Cabang Denpasar">Kantor Cabang Denpasar</option>
														<option selected="selected" value="Kantor Kas Kuta">Kantor Kas Kuta</option>
														<option selected="selected" value="Kantor Kas Semer">Kantor Kas Semer</option>
														<option selected="selected" value="">--Pilih salah satu--</option>
													</select>
												</div>
												<div class="form-group col-lg-4">
													<label for="nama_karyawan"><b>Nama Pelaksana Transaksi</b></label>
													<input class="form-control mb" type="text" id="nama_karyawan" name="nama_karyawan" placeholder="Masukan nama pelaksana" required>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-lg-4">
													<label for="jam_mulai"><b>Jam Mulai </b></label>
													<input class="form-control m-b" type="time" id="jam_mulai" name="jam_mulai" required>
												</div>
												<div class="form-group col-lg-4">
													<label for="jam_selesai"></label>
													<label for="jam_selesai"><b>Jam Selesai</b></label>
													<input class="form-control m-b" type="time" id="jam_selesai" name="jam_selesai" required>
												</div>
												<!-- <div class="form-group col-lg-4">
													<label><b>Target Date</b></label>
													<input class="form-control m-b" type="date" name="target_date" id="target_date" required>
												</div> -->
												<div class="form-group col-lg-4">
													<label><b>Unit Penanggung Jawab Kejadian</b></label>
													<select class="form-control m-b" name="id_div" id="id_div" required>
														<option selected="selected" value="">-- Pilih salah satu
															--</option>
														<?php
														foreach ($tb_division as $row2) {
															echo '<option value="' . $row2->id_div . '">' . $row2->nama_div . '</option>';
														}
														?>
													</select>
												</div>
												<!-- <div class="form-group col-lg-4">
													<label><b>Kode Kantor</b></label>
													<select class="form-control m-b" name="kode_kantor" id="kode_kantor" required>
														<option selected="selected" value="">-- Pilih salah satu
															--</option>
														<?php
														foreach ($tb_location as $row2) {
															echo '<option value="' . $row2->kode_kantor . '">' . $row2->nama_loc . '</option>';
														}
														?>
													</select>
												</div> -->
											</div>
											<div class="form-group">
												<label><b>Deskripsi/kronologi kejadian</b></label>
												<textarea class="form-control" name="desk_ticket" id="desk_ticket" placeholder="Isi detail masalah disini" required></textarea>
											</div>
											<div class="row">
												<div class="form-group col-lg-6">
													<label><b>Potensi Kerugian</b></label><br />
													<select class="form-control m-b" name="potensi_kerugian" id="potensi_kerugian" onChange="opsi(this)" required>
														<option>--Pilih salah satu--</option>
														<option value="Finansial">Finansial</option>
														<option value="Non Finansial">Non Finansial</option>
													</select>
												</div>
												<div class="form-group col-lg-6">
													<label><b>Nominal Potensi Kerugian</b></label>
													<input class="form-control m-b" name="nominal_perkiraan" type="number" id="inputku" placeholder="Nominal" required>
												</div>
												<!-- <div class="form-group col-lg-3">
													<label for="pejabat_penyetuju"><b>Pejabat Penyetuju</b></label>
													<input class="form-control m-b" name="pejabat_penyetuju" type="text" id="pejabat_penyetuju" placeholder="Masukan nama pejabat">
												</div>
												<div class="form-group col-lg-3">
													<label><b>Pembebanan Kerugian</b></label>
													<select class="form-control m-b" name="pembebanan_kerugian" id="pembebanan_kerugian" required>
														<option selected="selected" value="Perusahaan">Perusahaan</option>
														<option selected="selected" value="Nasabah">Nasabah</option>
														<option selected="selected" value="Personal">Personal</option>
														<option selected="selected" value="">Lainnya</option>
														<option selected="selected" value="">--Pilih salah satu--</option>
													</select>
												</div> -->
											</div>

											<div class="custom-file">
												<label for="lampiran_ticket"><b>Target Date</b></label>
												<input id="inputGroupFile01" type="file" class="custom-file-input" name="lampiran_ticket">
												<label class="custom-file-label" for="inputGroupFile01">Choose
													file</label>
											</div>
											<div class="form-group">
												<!-- <label for="durasi"><b>Durasi Kejadian (menit)</b></label> -->
												<input class="form-control m-b" type="hidden" id="durasi" name="durasi" readonly>
											</div>
											</br></br></br>
											<div>
												<button class="btn btn-sm btn-success float-right m-t-n-xs" type="submit"><strong>Simpan</strong></button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="col-lg-5">
						<div class="ibox ">
							<div class="ibox-title">
								<p><strong>MOHON DIBACA!</strong></p>
							</div>
							<div class="ibox-content">
								<p>1. Silakan isi divisi dan kategori yang sesuai dengan permasalahan anda.</p>
							</div>
						</div>
					</div> -->
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

	<!-- iCheck -->
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/iCheck/icheck.min.js"></script>
	<!-- BS custom file -->
	<script src="<?php echo base_url() ?>asset/admininspina/js/plugins/bs-custom-file/bs-custom-file-input.min.js"></script>

	<!-- script input jenis transaksi lainnya -->
	<script>
		// Gunakan jQuery atau JavaScript sesuai preferensi Anda
		$(document).ready(function() {
			$('#jenis_transaksi').change(function() {
				var selectedOption = $(this).val();

				// Sesuaikan kondisi berdasarkan opsi yang dipilih
				if (selectedOption == 'Lainnya') {
					$('#inputTambahan').show();
				} else {
					$('#inputTambahan').hide();
				}
			});
		});
	</script>
	<!-- end -->

	<!-- script input faktor penyebab kejadian -->
	<script>
		// Gunakan jQuery atau JavaScript sesuai preferensi Anda
		$(document).ready(function() {
			$('#faktor_penyebab').change(function() {
				var selectedOption = $(this).val();

				// Sesuaikan kondisi berdasarkan opsi yang dipilih
				if (selectedOption == 'Lain-lain') {
					$('#faktor_penyebab_lain').show();
				} else {
					$('#faktor_penyebab_lain').hide();
				}
			});
		});
	</script>
	<!-- end -->

	<script>
		$(document).ready(function() {
			$('.i-checks').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			$("#id_div").change(function() {
				var url = "<?php echo site_url('client/ticket/add_ajax_cat'); ?>/" + $(this).val();
				$('#id_cat').load(url);
				return false;
			});

			$(document).ready(function() {
				bsCustomFileInput.init()
			});

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

			var textarea = document.getElementById("desk_ticket");

			// Mengatur ukuran awal textarea
			textarea.style.height = "100px";

			// Fungsi untuk mengubah ukuran textarea saat ada input
			function autoResize() {
				this.style.height = "auto";
				this.style.height = (this.scrollHeight) + "px";
			}

			// Menambahkan event listener untuk memanggil fungsi autoResize saat ada input
			textarea.addEventListener("input", autoResize);
		});
	</script>

	<script type="text/javascript">
		$('button[name="remove_levels"]').on('click', function(e) {
			var $form = $(this).closest('form');
			e.preventDefault();
			$('#confirm').modal({
					backdrop: 'static',
					keyboard: false
				})
				.on('click', '#ya', function(e) {
					$form.trigger('submit');
				});
			$("#cancel").on('click', function(e) {
				e.preventDefault();
				$('#confirm').modal.model('hide');
			});
		});
	</script>

	<!-- script disable perkiraan nominal -->
	<script>
		function opsi(value) {
			var st = $("#potensi_kerugian").val();
			if (st == "Finansial") {
				document.getElementById("inputku").disabled = false;
			} else {
				document.getElementById("inputku").disabled = true;
			}
		}
	</script>

	<!-- script hitung waktu dalam menit -->
	<script>
		// Dapatkan elemen input waktu mulai, waktu selesai, dan durasi
		const jamMulai = document.getElementById('jam_mulai');
		const jamSelesai = document.getElementById('jam_selesai');
		const durasi = document.getElementById('durasi');

		// Tambahkan event listener untuk menghitung durasi saat nilai waktu selesai berubah
		jamSelesai.addEventListener('change', function() {
			// Ambil nilai waktu mulai dan waktu selesai
			const waktuMulai = new Date('1970-01-01 ' + jamMulai.value);
			const waktuSelesai = new Date('1970-01-01 ' + jamSelesai.value);

			// Hitung durasi dalam menit
			const diff = waktuSelesai - waktuMulai;
			const durasiMenit = Math.floor(diff / 60000);

			// Tampilkan durasi dalam input durasi
			durasi.value = durasiMenit;
		});
	</script>
	<!-- end hitung menit -->
</body>

</html>
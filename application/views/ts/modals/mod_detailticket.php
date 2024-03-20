<div class="row detail" id="detail">
	<div class="col-md-10 col-sm-8 col-6">
		<dl class="row">
			<dt class="col-sm-5">Nomor Request</dt>
			<dd class="col-sm-7">: <?= $ticket['no_ticket'] ?></dd>
			<dt class="col-sm-5">Tanggal Kejadian</dt>
			<dd class="col-sm-7">: <?= tgl_indo($ticket['tgl_kejadian']) ?></dd>
			<dt class="col-sm-5">Nama Inputer</dt>
			<dd class="col-sm-7">: <?= $ticket['nama_ticket'] ?></dd>
			<dt class="col-sm-5">Unit Kerja Pelaksana</dt>
			<dd class="col-sm-7">: <?= $ticket['nama_dept'] ?></dd>
			<dt class="col-sm-5">Nama Kantor</dt>
			<dd class="col-sm-7">: <?= $ticket['nama_loc'] ?></dd>
			<dt class="col-sm-5">Kode Kantor</dt>
			<dd class="col-sm-7">: <?= $ticket['kode_kantor'] ?></dd>
			<dt class="col-sm-5">Nama Unit Kerja Penanggung Jawab</dt>
			<dd class="col-sm-7">: <?= $ticket['nama_ticket'] ?></dd>
			<dt class="col-sm-5">Unit Kerja Penanggung Jawab</dt>
			<dd class="col-sm-7">: <?= $ticket['nama_div'] ?></dd>
			<dt class="col-sm-5">Kategori Resiko</dt>
			<dd class="col-sm-7">: <?= $ticket['nama_cat'] ?></dd>
			<dt class="col-sm-5">Jenis Transaksi</dt>
			<dd class="col-sm-7">: <?= $ticket['jenis_transaksi'] ?></dd>
			<dt class="col-sm-5">Jenis Transaksi Lainnya</dt>
			<dd class="col-sm-7">: <?= $ticket['inputTambahan'] ?></dd>
			<dt class="col-sm-5">Durasi Kejadian</dt>
			<dd class="col-sm-7">: <?= $ticket['durasi'] ?> Menit</dd>
			<dt class="col-sm-5">Tempat Kejadian</dt>
			<dd class="col-sm-7">: <?= $ticket['tempat_kejadian'] ?></dd>
			<dt class="col-sm-5">Faktor Penyebab Kejadian</dt>
			<dd class="col-sm-7">: <?= $ticket['faktor_penyebab'] ?></dd>
			<dt class="col-sm-5">Faktor Penyebab Kejadian Lain-lain</dt>
			<dd class="col-sm-7">: <?= $ticket['faktor_penyebab_lain'] ?></dd>
			<dt class="col-sm-5">Potensi Kerugian</dt>
			<dd class="col-sm-7">: <?= $ticket['potensi_kerugian'] ?></dd>
			<dt class="col-sm-5">Nominal Potensi Kerugian</dt>
			<dd class="col-sm-7">: <?= $ticket['nominal_perkiraan'] ?></dd>
			<dt class="col-sm-5">Nama Pelaksana Transaksi</dt>
			<dd class="col-sm-7">: <?= $ticket['nama_karyawan'] ?></dd>
			<dt class="col-sm-5">Detail Masalah</dt>
			<dd class="col-sm-7">: <?= $ticket['desk_ticket'] ?></dd>
			<!-- <dt class="col-sm-5">Target Penyelesaian</dt>
			<dd class="col-sm-7">: <?= tgl_indo($ticket['target_date']) ?></dd> -->
			<dt class="col-sm-5">Deskripsi Penyelesaian</dt>
			<dd class="col-sm-7">: <?= $ticket['remark_ticket'] ?></dd>
			<dt class="col-sm-5">Tanggal Selesai Penanggung Jawab</dt>
			<dd class="col-sm-7">: <?= tgl_indo($ticket['finish_ticket']) ?></dd>
			<dt class="col-sm-5">Total Nominal Kerugian</dt>
			<dd class="col-sm-7">: <?= $ticket['nominal_fix'] ?></dd>
			<dt class="col-sm-5">Pembebanan Kerugian</dt>
			<dd class="col-sm-7">: <?= $ticket['pembebanan_kerugian'] ?></dd>
			<dt class="col-sm-5">Nama Pejabat Penyetuju</dt>
			<dd class="col-sm-7">: <?= $ticket['pejabat_penyetuju'] ?></dd>
			<dt class="col-sm-5">Tanggal Approval</dt>
			<dd class="col-sm-7">: <?= $ticket['tgl_approve'] ?></dd>
			<dt class="col-sm-5">Lampiran</dt>
			<dd class="col-sm-7">
				: <?php if (empty($ticket['lampiran_ticket'])) {
						echo '-';
					} else { ?>
					<a href="<?php echo base_url() ?>asset/lampiran/<?= $ticket['lampiran_ticket'] ?>" target="_blank"><img src="<?php echo base_url() ?>asset/lampiran/<?= $ticket['lampiran_ticket'] ?>" alt="Lampiran" width="300" height="200"></a>
				<?php } ?>
			</dd>
		</dl>
	</div>
</div>
<button onclick="printContent('detail')" class="btn btn-primary float-right">Cetak</button>

<script>
	function printContent(elementId) {
		var content = document.getElementById(elementId).innerHTML;
		var mywindow = window.open('', 'Print', 'height=600,width=800');

		mywindow.document.write('<html><head><title>Cetak</title>');
		mywindow.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">'); // Tambahkan stylesheet Bootstrap
		mywindow.document.write('</head><body>');
		mywindow.document.write(content);
		mywindow.document.write('</body></html>');

		mywindow.document.close();
		mywindow.print();
	}
</script>
<!-- <script>
	function printContent(elementId) {
		var content = document.getElementById(elementId).innerHTML;
		var mywindow = window.open('', 'Print', 'height=600,width=800');

		mywindow.document.write('<html><head><title>Cetak</title>');
		mywindow.document.write('</head><body>');
		mywindow.document.write(content);
		mywindow.document.write('</body></html>');

		mywindow.document.close();
		mywindow.print();
	}
</script> -->
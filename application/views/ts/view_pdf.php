<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $dataorg['short_org'] . ' - ' . $title ?></title>
</head>
<style>
	ellipsis {
		max-width: 8px;
		/* Sesuaikan dengan lebar maksimum yang diinginkan */
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	body {
		margin: 10px;
		/* Sesuaikan dengan margin yang diinginkan */
	}

	table {
		width: 20%;
		border-collapse: collapse;
		margin-top: 5px;
		margin-right: 5px;
		/* Sesuaikan dengan margin atas yang diinginkan */
	}

	th,
	td {
		font-size: 8px;
		font-family: Arial, Helvetica, sans-serif;
		border: 0.5px solid black;
		/* Sesuaikan dengan tampilan border yang diinginkan */
		padding: 5px;
		padding-block: 5px;
		/* Sesuaikan dengan ruang padding yang diinginkan */
		text-align: center;
	}

	thead {
		background-color: #0F1035;
		color: #FFFFFF;
	}

	logo {
		max-width: 100px;
		/* Sesuaikan dengan lebar maksimum yang diinginkan */
		max-height: 100px;
		/* Sesuaikan dengan tinggi maksimum yang diinginkan */
	}

	h3 {
		margin-top: 5px;
	}
</style>


<body>
	<img src="data:image/jpeg;base64,<?php echo base64_encode(file_get_contents(base_url('asset/gambar/logo-kcd.jpg'))); ?>" width="15%" alt="KCD" class="logo">

	<h3 class="text-center" align="center">Lost Event Database Report | PT BPR Kita Centradana</h3>
	<h5 class="text-center" align="center">Periode Laporan Tanggal : <?php echo $tgl_awal; ?> Sampai Tanggal : <?php echo $tgl_akhir ?></h5>
	<!-- Tambahkan HTML sesuai dengan struktur data yang ingin ditampilkan -->
	<table border="0.5" style="width:100%;">
		<thead>
			<tr>
				<!-- Sesuaikan dengan struktur kolom -->
				<th>No</th>
				<th>Tgl<br>Penginputan</th>
				<th>Tgl Kejadian</th>
				<th>Tgl Penyelesaian</th>
				<th>Jenis Transaksi</th>
				<th>Kategori Resiko</th>
				<th>Durasi Kejadian</th>
				<th>Tempat Kejadian</th>
				<th>Faktor Penyebab</th>
				<th>Potensi Kerugian</th>
				<th>Unit Penanggung Jawab</th>
				<th>Waktu Penyelesaian</th>
				<th>Nominal Potensi Kerugian</th>
				<th>Pembebanan Kerugian</th>
				<th>Status Kejadian</th>
				<th>Nama Inputer</th>
				<th>Status Approve</th>
				<th>Pejabat Penyetuju</th>
				<!-- ... (dan seterusnya) ... -->
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			foreach ($ticket as $row) : ?>
				<tr>
					<!-- Sesuaikan dengan struktur data -->
					<td><?php echo $no++; ?></td>
					<td><?php echo tgl_indo($row->create_ticket) ?></td>
					<td><?php echo tgl_indo($row->tgl_kejadian) ?></td>
					<td><?php echo tgl_indo($row->finish_ticket) ?></td>
					<td><?php echo $row->jenis_transaksi; ?></td>
					<!-- <td><?php echo substr($row->desk_ticket, 0, 20); ?></td> -->
					<td><?php echo $row->nama_cat; ?></td>
					<td><?php echo $row->durasi; ?> Menit</td>
					<td><?php echo $row->tempat_kejadian; ?></td>
					<td><?php echo $row->faktor_penyebab; ?></td>
					<td><?php echo $row->potensi_kerugian; ?></td>
					<td><?php echo $row->nama_div; ?></td>
					<td><?php echo $row->exe_time; ?></td>
					<td><?php echo $row->nominal_fix; ?></td>
					<td><?php echo $row->pembebanan_kerugian; ?></td>
					<td>
						<?php
						if ($row->sts_ticket == '1') {
							$sts = 'Open';
						} elseif ($row->sts_ticket == '2') {
							$sts = 'Proses';
						} elseif ($row->sts_ticket == '3') {
							$sts = 'Selesai';
						}
						echo $sts; ?>
					</td>
					<td><?php echo $row->nama_ticket; ?></td>
					<td>
						<?php
						if ($row->approval_level == '0') {
							$aprlvl = '<button style="background-color: red; color: white;">Belum Disetujui</button>';
						} elseif ($row->approval_level == '1') {
							$aprlvl = '<button style="background-color: green; color: white;">Disetujui</button>';
						}
						echo $aprlvl; ?>
					</td>
					<td><?php echo $row->pejabat_penyetuju; ?></td>
					<!-- ... (dan seterusnya) ... -->
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</body>

</html>
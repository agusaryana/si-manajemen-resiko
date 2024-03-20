<!-- application/views/approval_events.php -->

<h2>Daftar Kejadian yang Memerlukan Persetujuan</h2>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Deskripsi</th>
			<th>Tanggal</th>
			<th>Lokasi</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($events as $event) : ?>
			<tr>
				<td><?= $event['id']; ?></td>
				<td><?= $event['description']; ?></td>
				<td><?= $event['date']; ?></td>
				<td><?= $event['location']; ?></td>
				<td>
					<a href="<?= base_url('event/approve_event/' . $event['id'] . '/approved'); ?>">Approve</a>
					|
					<a href="<?= base_url('event/approve_event/' . $event['id'] . '/rejected'); ?>">Reject</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
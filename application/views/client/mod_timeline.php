<div class="ibox-content inspinia-timeline">
	<?php
	$no = 1;
	foreach ($progress as $p) { ?>
		<div class="timeline-item">
			<div class="row">
				<div class="col-3 date">
					<i class="fa fa-ticket"></i>
					<?php echo tgl_indo($p->tgl_progress); ?>
					<br />
					<small class="text-navy"><?php echo $p->jam_progress ?></small>
				</div>
				<div class="col-7 content no-top-border">
					<p class="m-b-xs">Request Nomor <strong><?php echo $p->no_ticket ?></strong></p>

					<p><?php echo $p->ket_progress ?></p>

					<p>Nama Unit Penanggung Jawab: <strong><?php echo $p->nama_user ?></strong></p>
					<p>Target Date: <strong><?php echo $p->target_date_progres ?></strong></p>

				</div>
			</div>
		</div>
	<?php } ?>
</div>
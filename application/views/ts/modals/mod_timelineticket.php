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
					<small class="text-navy">
						<?php echo $p->jam_progress ?>
					</small>
				</div>
				<div class="col-7 content no-top-border">
					<p class="m-b-xs">Request Nomor <strong>
							<?php echo $p->no_ticket ?>
						</strong></p>

					<p>
						Keterangan: <strong><?php echo $p->ket_progress ?></strong>
					</p>

					<p>Nama PIC: <strong>
							<?php echo $p->nama_user ?>
						</strong></p>

					<p>
						Target Date : <strong><?php echo $p->target_date_progres ?></strong>
					</p>

				</div>
			</div>
		</div>
	<?php } ?>
</div>
</br>
<div class="ibox">
	<form role="form" id="form" method="POST" action="<?php echo base_url() ?>ts/ticket/addtimeline">
		<input type="hidden" name="no_ticket" value="<?php echo $p->no_ticket ?>">
		<div class="form-group">
			<label><b>Target Date (Optional)</b></label>
			<input class="form-control m-b" type="date" name="target_date_progres" id="target_date">
		</div>
		<div class="form-group">
			<label>Tambah Keterangan Progres</label>
			<textarea class="form-control" name="ket_progress" placeholder="Keterangan Progress" required></textarea>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success">Simpan</button>
		</div>
	</form>
</div>
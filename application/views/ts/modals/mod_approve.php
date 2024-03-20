<div>
	<form role="form" id="form" method="POST" action="<?php echo base_url() ?>ts/ticket/finish_approve">
		<p>Anda akan approve request dengan nomor request <strong><?= $ticket['no_ticket'] ?></strong> dengan informasi di bawah ini? <strong>:</strong></p>
		<div class="col-md-10 col-sm-8 col-6">
			<dl class="row">
				<dt class="col-sm-5">Potensi Kerugian</dt>
				<dd class="col-sm-7">: <?= $ticket['potensi_kerugian'] ?></dd>
				<dt class="col-sm-5">Perkiraan Nominal Kerugian</dt>
				<dd class="col-sm-7">: <?= $ticket['nominal_perkiraan'] ?></dd>
				<dt class="col-sm-5">Detail Masalah</dt>
				<dd class="col-sm-7">: <?= $ticket['desk_ticket'] ?></dd>
				<dt class="col-sm-5">Deskripsi Penyelesaian</dt>
				<dd class="col-sm-7">: <?= $ticket['remark_ticket'] ?></dd>
				<dt class="col-sm-5">Total Nominal Kerugian</dt>
				<dd class="col-sm-7">: <?= $ticket['nominal_fix'] ?></dd>
				<dt class="col-sm-5">Pembebanan Kerugian</dt>
				<dd class="col-sm-7">: <?= $ticket['pembebanan_kerugian'] ?></dd>
				<dt class="col-sm-5">Nama Pejabat Penyetuju</dt>
				<dd class="col-sm-7">: <?= $ticket['pejabat_penyetuju'] ?></dd>
			</dl>
		</div>
		<input type="hidden" id="pejabat_penyetuju" name="pejabat_penyetuju" value="<?= @$_SESSION['nama_user']; ?>">
		<input type="hidden" id="id_ticket" name="id_ticket" value="<?= $ticket['id_ticket'] ?>">
		<input type="hidden" id="no_ticket" name="no_ticket" value="<?= $ticket['no_ticket'] ?>">
		<input class="form-control" type="hidden" name="approval_level" id="approval_level" value="1"></input>
		<div class="modal-footer">
			<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-success">Approve</button>
		</div>
	</form>
	<form role="form" id="form" method="POST" action="<?php echo base_url() ?>ts/ticket/not_approve">
		<div class="modal-footer">
			<input type="hidden" id="id_ticket" name="id_ticket" value="<?= $ticket['id_ticket'] ?>">
			<input type="hidden" id="no_ticket" name="no_ticket" value="<?= $ticket['no_ticket'] ?>">
			<input type="hidden" name="sts_ticket" value="2">
			<button type="submit" class="btn btn-danger">Tolak</button>
		</div>
	</form>
</div>
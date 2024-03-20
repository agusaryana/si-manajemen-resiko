<form role="form" id="form" method="POST" action="<?php echo base_url() ?>ts/ticket/finish">
	<p>Anda akan menyelesaikan request nomor <strong><?= $ticket['no_ticket'] ?></strong>?</p>
	<input type="hidden" id="id_user" name="id_user" value="<?= @$_SESSION['id_user']; ?>">
	<input type="hidden" id="id_ticket" name="id_ticket" value="<?= $ticket['id_ticket'] ?>">
	<input type="hidden" id="no_ticket" name="no_ticket" value="<?= $ticket['no_ticket'] ?>">
	<input type="hidden" id="sts_ticket" name="sts_ticket" value="3">
	<div class="form-group">
		<label>Deskripsi Penyelesaian Kejadian</label>
		<textarea class="form-control" name="remark_ticket" placeholder="Masukan deskripsi penyelesaian kejadian" required></textarea>
	</div>
	<div class="form-group">
		<label>Total Nominal Kerugian</label>
		<input class="form-control" type="number" name="nominal_fix" placeholder="Masukkan total nominal kerugian"></input>
	</div>
	<div class="form-group">
		<label><b>Pembebanan Kerugian</b></label>
		<select class="form-control m-b" name="pembebanan_kerugian" id="pembebanan_kerugian" required>
			<option selected="selected" value="Perusahaan">Perusahaan</option>
			<option selected="selected" value="Nasabah">Nasabah</option>
			<option selected="selected" value="Personal">Personal</option>
			<option selected="selected" value="">Lainnya</option>
			<option selected="selected" value="">--Pilih salah satu--</option>
		</select>
	</div>
	<!-- <div class="form-group">
		<label>Pejabat Penyetuju</label>
		<input class="form-control" name="pejabat_penyetuju" placeholder="Masukkan pejabat penyetuju" required></input>
	</div> -->
	<div class="modal-footer">
		<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-success">Selesaikan</button>
	</div>
</form>
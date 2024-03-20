<form role="form" id="form" method="POST" action="<?php echo base_url() ?>ts/ticket/execution">
	<p>Anda akan menangani request nomor <strong><?= $ticket['no_ticket'] ?></strong>?</p>
	<input type="hidden" id="id_user" name="id_user" value="<?= @$_SESSION['id_user']; ?>">
	<input type="hidden" id="id_ticket" name="id_ticket" value="<?= $ticket['id_ticket'] ?>">
	<input type="hidden" id="no_ticket" name="no_ticket" value="<?= $ticket['no_ticket'] ?>">
	<input type="hidden" id="sts_ticket" name="sts_ticket" value="2">
	<div class="modal-footer">
		<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-warning">Tangani</button>
	</div>
</form>
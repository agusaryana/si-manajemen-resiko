	<form role="form" id="form" method="POST" action="<?php echo base_url() ?>client/ticket/deleteTicket">
		<p>Anda akan menghapus request <strong><?= $ticket['no_ticket'] ?></strong>?</p>
		<input type="hidden" id="delete_ticket" name="delete_ticket" value="<?= $ticket['id_ticket'] ?>">
		<div class="modal-footer">
			<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-danger">Hapus</button>
		</div>
	</form>
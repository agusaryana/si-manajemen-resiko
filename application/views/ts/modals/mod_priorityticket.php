<form role="form" id="form" method="POST" action="<?php echo base_url() ?>ts/ticket/priority">
	<input type="hidden" id="id_ticket" name="id_ticket" value="<?= $ticket['id_ticket'] ?>">
	<div class="form-group">
		<label>Prioritas</label>
		<select class="form-control m-b" name="priority_ticket">
			<option selected="selected" value="<?= $ticket['priority_ticket'] ?>">
				<?php
				if ($ticket['priority_ticket'] == 1) {
					echo "Low";
				} elseif ($ticket['priority_ticket'] == 2) {
					echo "Normal";
				} elseif ($ticket['priority_ticket'] == 3) {
					echo "High";
				}
				?>
			</option>
			<option value="1">Low</option>
			<option value="2">Normal</option>
			<option value="3">High</option>
		</select>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-success">Simpan</button>
	</div>
</form>
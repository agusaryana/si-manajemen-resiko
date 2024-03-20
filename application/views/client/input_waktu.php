<!-- View File: views/input_waktu.php -->
<form method="post" action="<?php echo base_url('controller/simpan_waktu'); ?>">
	<label for="jam">Jam:</label>
	<input type="number" id="jam" name="jam" min="0" max="23" value="<?php echo date('H'); ?>" required>

	<label for="menit">Menit:</label>
	<input type="number" id="menit" name="menit" min="0" max="59" value="<?php echo date('i'); ?>" required>

	<input type="submit" value="Simpan">
</form>
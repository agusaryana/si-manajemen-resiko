<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/department/edit">
    <input type="hidden" id="id_dept" name="id_dept" value="<?= $dept['id_dept'] ?>">
    <div class="form-group">
        <label>Nama Department</label>
        <input type="text" name="nama_dept" placeholder="Masukkan Nama Department" class="form-control" value="<?= $dept['nama_dept'] ?>" required>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
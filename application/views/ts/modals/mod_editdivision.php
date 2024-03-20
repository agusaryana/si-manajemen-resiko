<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/divisi/edit">
    <input type="hidden" id="id_div" name="id_div" value="<?= $divisi['id_div'] ?>">
    <div class="form-group">
        <label>Nama Divisi</label>
        <input type="text" name="nama_div" placeholder="Masukkan Nama Divisi" class="form-control" value="<?= $divisi['nama_div'] ?>" required>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
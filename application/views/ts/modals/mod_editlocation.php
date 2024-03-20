<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/location/edit">
    <input type="hidden" id="id_loc" name="id_loc" value="<?= $lokasi['id_loc'] ?>">
    <div class="form-group">
        <label>Nama Lokasi</label>
        <input type="text" name="nama_loc" placeholder="Masukkan Nama Lokasi" class="form-control" value="<?= $lokasi['nama_loc'] ?>" required>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
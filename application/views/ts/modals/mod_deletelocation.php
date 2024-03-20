<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/location/activation">
    <p>Anda akan menghapus lokasi <strong><?= $lokasi['nama_loc'] ?></strong>?</p>
    <input type="hidden" id="id_loc" name="id_loc" value="<?= $lokasi['id_loc'] ?>">
    <input type="hidden" id="sts_loc" name="sts_loc" value="3">
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
    </div>
</form>
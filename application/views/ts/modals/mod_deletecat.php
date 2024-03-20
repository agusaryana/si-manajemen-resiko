<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/category/activation">
    <p>Anda akan menghapus kategori <strong><?= $cat['nama_cat'] ?></strong>?</p>
    <input type="hidden" id="id_cat" name="id_cat" value="<?= $cat['id_cat'] ?>">
    <input type="hidden" id="sts_cat" name="sts_cat" value="3">
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
    </div>
</form>
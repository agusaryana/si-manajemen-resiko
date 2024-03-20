<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/divisi/activation">
    <p>Anda akan menghapus divisi <strong><?= $divisi['nama_div'] ?></strong>?</p>
    <input type="hidden" id="id_div" name="id_div" value="<?= $divisi['id_div'] ?>">
    <input type="hidden" id="sts_div" name="sts_div" value="3">
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
    </div>
</form>
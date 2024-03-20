<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/department/activation">
    <p>Anda akan menghapus department <strong><?= $dept['nama_dept'] ?></strong>?</p>
    <input type="hidden" id="id_dept" name="id_dept" value="<?= $dept['id_dept'] ?>">
    <input type="hidden" id="sts_dept" name="sts_dept" value="3">
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
    </div>
</form>
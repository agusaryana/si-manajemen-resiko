<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/user/activation">
    <p>Anda akan menghapus Pengguna <strong><?= $user['nama_user'] ?></strong>?</p>
    <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user'] ?>">
    <input type="hidden" id="sts_user" name="sts_user" value="3">
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
    </div>
</form>
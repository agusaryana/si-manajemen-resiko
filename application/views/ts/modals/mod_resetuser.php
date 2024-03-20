<form role="form" id="form" method="POST" action="<?php echo base_url() ?>ts/user/reset">
    <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user'] ?>">
    <input type="hidden" id="tlp_user" name="tlp_user" value="<?= $user['tlp_user'] ?>">
    <input type="hidden" id="nama_user" name="nama_user" value="<?= $user['nama_user'] ?>">
    <input type="hidden" id="username_user" name="username_user" value="<?= $user['username_user'] ?>">
    <div class="form-group">
        <label>Password Baru</label>
        <input type="password" name="pass_user" placeholder="Masukkan Password Baru User" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Konfirmasi Password Baru</label>
        <input type="password" name="cpass_user" placeholder="Konfirmasi Password Baru User" class="form-control" required>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
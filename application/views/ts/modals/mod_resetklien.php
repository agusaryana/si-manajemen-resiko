<form role="form" id="form" method="POST" action="<?php echo base_url() ?>ts/klien/reset">
    <input type="hidden" id="id_client" name="id_client" value="<?= $client['id_client'] ?>">
    <input type="hidden" id="tlp_client" name="tlp_client" value="<?= $client['tlp_client'] ?>">
    <input type="hidden" id="nama_client" name="nama_client" value="<?= $client['nama_client'] ?>">
    <input type="hidden" id="username_client" name="username_client" value="<?= $client['username_client'] ?>">
    <div class="form-group">
        <label>Password Baru</label>
        <input type="password" name="pass_client" placeholder="Masukkan Password Baru Klien" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Konfirmasi Password Baru</label>
        <input type="password" name="cpass_client" placeholder="Konfirmasi Password Baru Klien" class="form-control" required>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
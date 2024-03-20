<form role="form" id="form" method="POST" action="<?php echo base_url() ?>ts/user/edit">
    <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user'] ?>">
    <div class="form-group">
        <label>Nama User</label>
        <input type="text" name="nama_user" value="<?= $user['nama_user'] ?>" placeholder="Masukkan Nama Lengkap" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Lokasi</label>
        <select class="form-control m-b" name="id_loc" required>
            <option selected="selected" value="<?= $user['id_loc'] ?>"><?= $user['nama_loc'] ?></option>
            <?php
            foreach ($tb_location as $row1) {
                echo '<option value="' . $row1->id_loc . '">' . $row1->nama_loc . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Divisi</label>
        <select class="form-control m-b" name="id_div" required>
            <option selected="selected" value="<?= $user['id_div'] ?>"><?= $user['nama_div'] ?></option>
            <?php
            foreach ($tb_division as $row2) {
                echo '<option value="' . $row2->id_div . '">' . $row2->nama_div . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Akses</label>
        <select class="form-control m-b" name="id_akses" required>
            <option selected="selected" value="<?= $user['id_akses'] ?>"><?= $user['nama_akses'] ?></option>
            <?php
            foreach ($tb_akses as $row3) {
                echo '<option value="' . $row3->id_akses . '">' . $row3->nama_akses . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Telepon</label>
        <input type="number" name="tlp_user" placeholder="Masukkan Nomor Telepon" value="<?= $user['tlp_user'] ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username_user" placeholder="Masukkan Username" value="<?= $user['username_user'] ?>" class="form-control" disabled>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
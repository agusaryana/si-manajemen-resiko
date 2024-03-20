<form role="form" id="form" method="POST" action="<?php echo base_url() ?>ts/klien/edit">
    <input type="hidden" id="id_client" name="id_client" value="<?= $client['id_client'] ?>">
    <div class="form-group">
        <label>Nama Klien</label>
        <input type="text" name="nama_client" value="<?= $client['nama_client'] ?>" placeholder="Masukkan Nama Lengkap" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Lokasi</label>
        <select class="form-control m-b" name="id_loc" required>
            <option selected="selected" value="<?= $client['id_loc'] ?>"><?= $client['nama_loc'] ?> (Terpilih)</option>
            <?php
            foreach ($tb_location as $row1) {
                echo '<option value="' . $row1->id_loc . '">' . $row1->nama_loc . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Departemen</label>
        <select class="form-control m-b" name="id_dept" required>
            <option selected="selected" value="<?= $client['id_dept'] ?>"><?= $client['nama_dept'] ?> (Terpilih)</option>
            <?php
            foreach ($tb_department as $row2) {
                echo '<option value="' . $row2->id_dept . '">' . $row2->nama_dept . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Telepon</label>
        <input type="number" name="tlp_client" placeholder="Masukkan Nomor Telepon" value="<?= $client['tlp_client'] ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email_client" placeholder="Masukkan alamat email" value="<?= $client['email_client'] ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username_client" placeholder="Masukkan Username" value="<?= $client['username_client'] ?>" class="form-control" disabled>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
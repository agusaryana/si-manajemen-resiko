<form role="form" id="form" method="POST" action="<?php echo base_url() ?>ts/wagroup/edit">
    <input type="hidden" id="id_wagroup" name="id_wagroup" value="<?= $wagroup['id_wagroup'] ?>">
    <div class="form-group">
        <label>Lokasi</label>
        <select class="form-control m-b" name="id_loc" required>
            <option selected="selected" value="<?= $wagroup['id_loc'] ?>"><?= $wagroup['nama_loc'] ?></option>
            <?php
            foreach ($dataloc as $row1) {
                echo '<option value="' . $row1->id_loc . '">' . $row1->nama_loc . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Divisi</label>
        <select class="form-control m-b" name="id_div" required>
            <option selected="selected" value="<?= $wagroup['id_div'] ?>"><?= $wagroup['nama_div'] ?></option>
            <?php
            foreach ($datadiv as $row2) {
                echo '<option value="' . $row2->id_div . '">' . $row2->nama_div . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Nama WA Group</label>
        <input type="text" name="nama_wagroup" value="<?= $wagroup['nama_wagroup'] ?>" placeholder="Masukkan Nama Whatsapp Group" class="form-control" required>
    </div>
    <div class="form-group">
        <label>ID WA Group</label>
        <input type="text" name="token_wagroup" value="<?= $wagroup['token_wagroup'] ?>" placeholder="Masukkan ID Whatsapp Group" class="form-control" required>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
<form role="form" id="form" method="POST" action="<?php echo base_url() ?>ts/category/edit">
    <input type="hidden" id="id_cat" name="id_cat" value="<?= $cat['id_cat'] ?>">
    <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" name="nama_cat" placeholder="Masukkan Nama Kategori" class="form-control"
            value="<?= $cat['nama_cat'] ?>" required>
    </div>
    <div class="form-group">
        <label>Divisi</label>
        <select class="form-control m-b" name="id_div" required>
            <option selected="selected" value="<?= $cat['id_div'] ?>"><?= $cat['nama_div'] ?> (Terpilih)</option>
            <?php
            foreach ($datadiv as $row2) {
                echo '<option value="' . $row2->id_div . '">' . $row2->nama_div . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
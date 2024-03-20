<p>Anda akan merubah status aktivasi pengguna <?= $user['nama_user'] ?>?</p>
<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/user/activation">
    <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user'] ?>">
    <div class="form-group">
        <label>Aktivasi</label>
        <select class="form-control m-b" name="sts_user">
            <option selected="selected" value="<?= $user['sts_user'] ?>">
                <?php
                    if($user['sts_user'] == 1){
                        echo "Aktif";
                    }else{
                        echo "Non-Aktif";
                    }
                ?>
            </option>
            <option value="1">Aktif</option>
            <option value="2">Non-Aktif</option>
        </select>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
<p>Anda akan merubah status aktivasi Klien <?= $client['nama_client'] ?>?</p>
<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/klien/activation">
    <input type="hidden" id="id_client" name="id_client" value="<?= $client['id_client'] ?>">
    <div class="form-group">
        <label>Aktivasi</label>
        <select class="form-control m-b" name="sts_client">
            <option selected="selected" value="<?= $client['sts_client'] ?>">
                <?php
                    if($client['sts_client'] == 1){
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
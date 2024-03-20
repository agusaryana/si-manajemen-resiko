<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/location/activation">
    <input type="hidden" id="id_loc" name="id_loc" value="<?= $lokasi['id_loc'] ?>">
    <div class="form-group">
        <label>Aktivasi</label>
        <select class="form-control m-b" name="sts_loc">
            <option selected="selected" value="<?= $lokasi['sts_loc'] ?>">
                <?php
                    if($lokasi['sts_loc'] == 1){
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
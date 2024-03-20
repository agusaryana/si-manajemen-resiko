<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/wagroup/activation">
    <input type="hidden" id="id_wagroup" name="id_wagroup" value="<?= $wagroup['id_wagroup'] ?>">
    <div class="form-group">
        <label>Aktivasi</label>
        <select class="form-control m-b" name="sts_wagroup">
            <option selected="selected" value="<?= $wagroup['sts_wagroup'] ?>">
                <?php
                    if($wagroup['sts_wagroup'] == 1){
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
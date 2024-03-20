<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/category/activation">
    <input type="hidden" id="id_cat" name="id_cat" value="<?= $cat['id_cat'] ?>">
    <div class="form-group">
        <label>Aktivasi</label>
        <select class="form-control m-b" name="sts_cat">
            <option selected="selected" value="<?= $cat['sts_cat'] ?>">
                <?php
                    if($cat['sts_cat'] == 1){
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
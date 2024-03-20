<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/divisi/activation">
    <input type="hidden" id="id_div" name="id_div" value="<?= $divisi['id_div'] ?>">
    <div class="form-group">
        <label>Aktivasi</label>
        <select class="form-control m-b" name="sts_div">
            <option selected="selected" value="<?= $divisi['sts_div'] ?>">
                <?php
                    if($divisi['sts_div'] == 1){
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
<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/department/activation">
    <input type="hidden" id="id_dept" name="id_dept" value="<?= $dept['id_dept'] ?>">
    <div class="form-group">
        <label>Aktivasi</label>
        <select class="form-control m-b" name="sts_dept">
            <option selected="selected" value="<?= $dept['sts_dept'] ?>">
                <?php
                    if($dept['sts_dept'] == 1){
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
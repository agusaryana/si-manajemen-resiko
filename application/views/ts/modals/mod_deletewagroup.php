<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/wagroup/activation">
    <p>Anda akan menghapus Whatsapp Group <strong><?= $wagroup['nama_wagroup'] ?></strong>?</p>
    <input type="hidden" id="id_wagroup" name="id_wagroup" value="<?= $wagroup['id_wagroup'] ?>">
    <input type="hidden" id="sts_wagroup" name="sts_wagroup" value="3">
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
    </div>
</form>
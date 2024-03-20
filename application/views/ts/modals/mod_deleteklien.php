<form role="form" id="form" method="POST" action="<?php echo base_url()?>ts/klien/activation">
    <p>Anda akan menghapus Klien <strong><?= $client['nama_client'] ?></strong>?</p>
    <input type="hidden" id="id_client" name="id_client" value="<?= $client['id_client'] ?>">
    <input type="hidden" id="sts_client" name="sts_client" value="3">
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
    </div>
</form>
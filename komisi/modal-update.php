    <form action="form-action.php" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Data Komisi</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="id_komisi" name="id_komisi" value="<?php echo $fet['id_komisi']; ?>">
                <div class="form-group">
                    <label>Nama Komisi:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="nama_komisi" name="nama" value="<?php echo $fet['nama_komisi']; ?>" placeholder="Nama komisi">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Kode Komisi:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="kode_komisi" name="kode" value="<?php echo $fet['kode_komisi']; ?>" placeholder="Kode komisi untuk kode inventaris">
                    </div>  
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
            </div>
        </div>
    </form>
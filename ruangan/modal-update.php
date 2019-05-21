    <form action="form-action.php" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Data Ruangan</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="id_ruangan" name="id_ruangan" value="<?php echo $fet['id_ruangan']; ?>">
                <div class="form-group">
                    <label>Nama Ruangan:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="nama_ruangan" name="nama" value="<?php echo $fet['nama_ruangan']; ?>" placeholder="Nama ruangan">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Kode Ruangan:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="kode_ruangan" name="kode" value="<?php echo $fet['kode_ruangan']; ?>" placeholder="Kode ruangan untuk kode inventaris">
                    </div>  
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
            </div>
        </div>
    </form>
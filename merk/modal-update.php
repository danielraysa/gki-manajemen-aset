    <form action="form-action.php" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Data</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="id_merk" name="id_merk">
                
                <div class="form-group">
                    <label>Merk:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="merk" name="merk" placeholder="Merk barang">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label>Seri/Model:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="serimodel" name="serimodel" placeholder="Seri/Model barang">
                    </div>
                </div> -->
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
            </div>
        </div>
    </form>
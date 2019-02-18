    <form action="form-action.php" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Data Kategori</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="id_kategori" name="id_kategori">
                <div class="form-group">
                    <label>Nama Komisi:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="nama_kategori" name="nama" placeholder="Nama kategori barang">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Kode Komisi:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="kode_kategori" name="kode" placeholder="Kode kategori untuk kode inventaris">
                    </div>  
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="edit">Save changes</button>
            </div>
        </div>
    </form>
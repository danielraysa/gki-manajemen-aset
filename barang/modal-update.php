    <form action="form-action.php" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Data Barang</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="id_kategori" name="id_kategori">
                <div class="form-group">
                    <label>Nama Barang:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama barang">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Kategori Barang:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <select class="form-control select-box" id="kategori" name="kategori" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM kategori");
                                while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <option value="<?php echo $row['id_kategori']; ?>"><?php echo $row['nama_kategori']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>  
                </div>
                <div class="form-group">
                    <label>Merk:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="merk" name="merk" placeholder="Merk barang">
                    </div>
                </div>
                <div class="form-group">
                    <label>Seri/Model:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="serimodel" name="serimodel" placeholder="Seri/Model barang">
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="edit">Save changes</button>
            </div>
        </div>
    </form>
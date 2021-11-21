    <form action="form-action.php" method="post" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Data</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="id_aset" name="id_aset">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Nomor Induk:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" id="nomor_induk" name="nomor_induk" placeholder="Nomor Induk" required>
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>No. Telepon:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No. Telp" required>
                        </div>  
                    </div>
                    
                    <div class="form-group">
                        <label>Kelompok Jemaat:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                        <select class="form-control select2" id="kelompok_jemaat" name="kelompok_jemaat" style="width: 100%;"  aria-hidden="true">
                            <?php
                            while ($row = mysqli_fetch_array($_kelompok)) {
                            ?>
                            <option value="<?php echo $row['nama_kelompok']; ?>"><?php echo $row['nama_kelompok']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label>Gambar:</label>
                        <img id="gambar_aset" src="" class="img-responsive" />
                    </div> -->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Tanggal Lahir:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="minimal" id="checkbox_meninggal" type="checkbox" name="meninggal" checked> Meninggal
                    </div>
                    <div class="form-group">
                        <input class="minimal" id="checkbox_keluar" type="checkbox" name="keluar" checked> Keluar
                    </div>
                    <!-- <div class="form-group">
                        <label>Upload Gambar:</label>
                        <img id="img-upload" class="img-responsive" />  
                        <div class="btn btn-default btn-file btn-block">
                            Browse… <input type="file" id="imgInp" name="foto" accept="image/*" capture>
                        </div>
                    </div> -->
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="btnEdit" name="edit">Simpan</button>
            </div>
        </div>
    </form>
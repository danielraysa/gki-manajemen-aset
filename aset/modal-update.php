    <form action="form-action.php" method="post" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Aset</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" class="form-control" id="id_aset" name="id_aset">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h4 class="">Penamaan Aset</h4>
                        <div class="form-group">
                            <label>Kode Aset:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="kode_aset" name="kode" placeholder="Kode Aset" required>
                            </div>  
                        </div>
                        <div class="form-group">
                            <label>Nama Aset:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="nama_aset" name="nama" placeholder="Nama Aset" required>
                            </div>  
                        </div>
                        
                        <div class="form-group">
                            <label>Status:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                            <select class="form-control select2" id="status_aset" name="status" style="width: 100%;"  aria-hidden="true">
                                <?php
                                while ($row = mysqli_fetch_array($_status)) {
                                ?>
                                <option value="<?php echo $row['ID_STATUS']; ?>"><?php echo $row['NAMA_STATUS']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Gambar:</label>
                            <img id="gambar_aset" src="" class="img-responsive" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h4 class="">Keterangan Aset</h4>
                        <div class="form-group">
                            <label>Merk:</label>
                            <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <select class="form-control select2" id="merk_aset" name="merk" style="width: 100%;" aria-hidden="true">
                                <?php
                                while ($row = mysqli_fetch_array($_merk)) {
                                ?>
                                <option value="<?php echo $row['ID_MERK']; ?>"><?php echo $row['NAMA_MERK']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <!-- <div class="input-group-btn">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-merk"><i class="fa fa-plus"></i></button>
                            </div> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Seri/Model:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="seri_model" name="serimodel" placeholder="Seri/Model" required>
                            </div>  
                        </div>
                        <div class="form-group">
                            <label>Penempatan Lokasi:</label>
                            <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <select class="form-control select2" id="lokasi_aset" name="lokasi_aset" style="width: 100%;">
                                <?php
                                while ($row = mysqli_fetch_array($_lokasi)) {
                                ?>
                                <option value="<?php echo $row['ID_LOKASI']; ?>" data-ruang="<?php echo $row['KODE_LOKASI']; ?>"><?php echo $row['NAMA_LOKASI']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Penempatan Ruangan:</label>
                            <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <select class="form-control select2" id="ruangan_aset" name="ruangan_aset" style="width: 100%;">
                                <?php
                                while ($row = mysqli_fetch_array($_ruangan)) {
                                ?>
                                <option value="<?php echo $row['ID_RUANGAN']; ?>" data-ruang="<?php echo $row['KODE_RUANGAN']; ?>"><?php echo $row['NAMA_RUANGAN']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <!-- <div class="input-group-btn">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-ruangan"><i class="fa fa-plus"></i></button>
                            </div> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="minimal" id="checkbox_pinjam" type="checkbox" name="pinjam" checked> Dapat dipinjam
                        </div>
                        <div class="form-group">
                            <label>Upload Gambar:</label>
                            <img id="img-upload" class="img-responsive" />  
                            <div class="btn btn-default btn-file btn-block">
                                Browse… <input type="file" id="imgInp" name="foto" accept="image/*" capture>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="btnEdit" name="edit">Simpan</button>
            </div>
        </div>
    </form>
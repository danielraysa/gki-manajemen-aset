    <form action="form-action.php" method="post" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Aset</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="id_aset" name="id_aset">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Penamaan Aset</h3>
                        </div>
                        <div class="box-body">
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
                                    $data = mysqli_query($koneksi, "SELECT * FROM status");
                                    while ($row = mysqli_fetch_array($data)) {
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
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Keterangan Aset</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Merk:</label>
                                <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <select class="form-control select2" id="merk_aset" name="merk" style="width: 100%;" aria-hidden="true">
                                    <?php
                                    $data = mysqli_query($koneksi, "SELECT * FROM merk");
                                    while ($row = mysqli_fetch_array($data)) {
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
                                <label>Penempatan Ruangan:</label>
                                <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <select class="form-control select2" id="ruangan_aset" name="ruangan_aset" style="width: 100%;">
                                    <?php
                                    $data = mysqli_query($koneksi, "SELECT * FROM ruangan");
                                    while ($row = mysqli_fetch_array($data)) {
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
                                <label>Penempatan Komisi:</label>
                                <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <select class="form-control select2" id="komisi_aset" name="komisi" style="width: 100%;" aria-hidden="true">
                                    <?php
                                    $data = mysqli_query($koneksi, "SELECT * FROM komisi_jemaat");
                                    while ($row = mysqli_fetch_array($data)) {
                                    ?>
                                    <option value="<?php echo $row['ID_KOMISI']; ?>" data-komisi="<?php echo $row['KODE_KOMISI']; ?>"><?php echo $row['NAMA_KOMISI']." (".$row['KODE_KOMISI'].")"; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-komisi"><i class="fa fa-plus"></i></button>
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
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="btnEdit" name="edit">Simpan</button>
            </div>
        </div>
    </form>
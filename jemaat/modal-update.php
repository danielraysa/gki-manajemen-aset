    <form id="formJemaat" action="form-action.php" method="post" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah/Update Data</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" class="form-control" id="id_jemaat" name="id_jemaat">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Nomor Induk:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="no_induk" name="no_induk" placeholder="Nomor Induk" required>
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
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
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
                            <label>Alamat:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
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
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tempat Baptis:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="baptis_tempat" name="baptis_tempat" placeholder="Tanggal Baptis" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Baptis:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="date" class="form-control" id="baptis_tanggal" name="baptis_tanggal" placeholder="Tempat Baptis" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tempat Sidi:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="sidi_tempat" name="sidi_tempat" placeholder="Tanggal Sidi" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Sidi:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="date" class="form-control" id="sidi_tanggal" name="sidi_tanggal" placeholder="Tempat Sidi" >
                            </div>
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
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Email:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Golongan Darah:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="gol_darah" name="gol_darah" placeholder="Golongan Darah" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pernikahan:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="date" class="form-control" id="tanggal_pernikahan" name="tanggal_pernikahan" placeholder="Tanggal Pernikahan" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Atestasi Masuk (Asal):</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="atestasi_masuk_asal" name="atestasi_masuk_asal" placeholder="Atestasi Masuk (Asal)" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Atestasi Masuk (Tanggal):</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="date" class="form-control" id="atestasi_masuk_tanggal" name="atestasi_masuk_tanggal" placeholder="Atestasi Masuk (Tanggal)" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Atestasi Keluar (Tujuan):</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="atestasi_keluar_tujuan" name="atestasi_keluar_tujuan" placeholder="Atestasi Keluar (Tujuan)" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Atestasi Keluar (Tanggal):</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="date" class="form-control" id="atestasi_keluar_tanggal" name="atestasi_keluar_tanggal" placeholder="Atestasi Keluar (Tanggal)" >
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="minimal" id="checkbox_meninggal" type="checkbox" name="status_meninggal" value="Ya"> Meninggal
                            <input class="minimal" id="checkbox_keluar" type="checkbox" name="keluar" value="1"> Keluar
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
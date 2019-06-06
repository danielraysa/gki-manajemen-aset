
    <form action="form-action.php" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Data Komisi</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="id_user" name="id_user">
                <div class="form-group">
                        <label>Nama Pengguna:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama pengguna">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>Username:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username untuk login">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="password" class="form-control" id="new_password" name="password" placeholder="Password untuk login">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>Retype Password:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="password" class="form-control" id="new_confirm_password" name="passw" placeholder="Password untuk login">
                        </div>
                        <span id="message1"></span>
                    </div>
                    <div class="form-group">
                        <label>Hak Akses:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <select class="form-control" id="hak_akses_up" name="hak_akses">
                                <!-- <option value="Administrator">Administrator</option> -->
                                <option value="Ketua MJ">Ketua MJ</option>
                                <option value="Anggota MJ">Anggota MJ</option>
                                <option value="Peminjam">Peminjam</option>
                            </select>
                        </div>  
                    </div>
                    <!-- <div class="form-group">
                        <label>Keterangan:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan">
                        </div>  
                    </div> -->
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
            </div>
        </div>
    </form>
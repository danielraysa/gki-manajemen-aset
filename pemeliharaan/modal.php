<!-- Modal Tambah Jadwal Pemeliharaan -->
<div class="modal fade" id="modal-jadwal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Penjadwalan Pemeliharaan</h4>
            </div>
            <div class="modal-body">
                <form action="form-action.php" method="post">
                <input type="hidden" class="form-control" id="id_aset" name="id">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-5">
                            <label>Kode Aset:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="kode_aset" name="kode" placeholder="Kode Aset" readonly>
                            </div>  
                        </div>  
                        <div class="col-xs-7">
                            <label>Nama Aset:</label>
                            <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" id="nama_aset" name="nama" placeholder="Nama Aset" readonly>
                        </div>  
                    </div>  
                    </div>  
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-5">
                            <label>Tanggal Pemeliharaan:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" id="datepicker" name="pemeliharaan">
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <label>Notifikasi sebelum:</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="notif" name="notif" required>
                                <div class="input-group-addon">
                                    hari
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label>Pilihan:</label>
                        <!-- <input class="minimal" type="checkbox" id="check_penjadwalan" name="penjadwalan"> Penjadwalan Berkala -->
                            <!--     <input class="minimal" type="radio" name="radio_repeat" id="radio_repeat" value="sekali" checked> Sekali
                                <input class="minimal" type="radio" name="radio_repeat" id="radio_repeat" value="berulang"> Berulang -->
                                <select class="form-control select2" id="opsi_berkala" name="satuan" style="width: 100%;" required>
                                    <option value="sekali">Sekali</option>
                                    <option value="bulan">Tiap Bulan</option>
                                    <option value="awal_bulan">Tiap Awal Bulan</option>
                                    <option value="akhir_bulan">Tiap Akhir Bulan</option>
                                    <option value="tahun">Tiap Tahun</option>
                                    <option value="custom">Kustom</option>
                                </select>
                            
                        </div>
                    </div>
                </div>
                <div id="custom-box">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-4">
                            <label>Interval/Jarak antar Jadwal:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="number" class="form-control" id="interval" name="jumlah" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <label>Frekuensi:</label>
                                <select class="form-control select2" id="satuan" name="satuan" style="width: 100%;" required>
                                    <option value="Minggu">Minggu</option>
                                    <option value="Bulan">Bulan</option>
                                    <option value="Tahun">Tahun</option>
                                </select>
                            </div>
                            <div class="col-xs-5">
                                <div class="opsi_bulan">
                                    <label>Pilihan tanggal:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" id="multidate" name="tgl_pemeliharaan" required>
                                    </div>
                                </div>
                                <div class="opsi_tahun">
                                    <label>Pilihan bulan:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" id="year-picker" name="tgl_pemeliharaan" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-success pull-right" id="addJadwal" name="add-jadwal" data-dismiss="modal"><i class="fa fa-plus"></i> Add Schedule</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Maintenance -->
<div class="modal fade" id="modal-maintenance">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Pemeliharaan Aset</h4>
            </div>
            <div class="modal-body">
            <form action="form-action.php" method="post">
                <input type="hidden" class="form-control" id="id_maintenance" name="id">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <label>Kode Aset:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="kode_aset_s" name="kode" placeholder="Kode Aset" readonly>
                            </div>  
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <label>Nama Aset:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text" class="form-control" id="nama_aset_s" name="nama" placeholder="Nama Aset" readonly>
                            </div>  
                        </div>
                    </div>    
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Jadwal Pemeliharaan:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" id="datepicker_read" name="tgl_pemeliharaan" readonly>
                            </div>
                            </div>
                        <div class="col-md-6 col-xs-12">
                            <label>Tanggal Pemeliharaan:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" id="datepicker1" name="tgl_pemeliharaan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Selesai Pemeliharaan:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" id="datepicker2" name="tgl_pemeliharaan">
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label>Biaya Pemeliharaan:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-money"></i>
                                </div>
                                <input type="text" class="form-control" id="harga" name="harga" placeholder="(jika tidak ada diisi 0)">
                            </div>  
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Hasil Pemeliharaan:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                        </div>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan Pemeliharaan"></textarea>
                    </div>  
                </div>
                
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-success pull-right" id="btnMaintenance" type="submit" name="edit"data-dismiss="modal"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete Item</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <input type="hidden" id="id_delete" name="id"/>
                Batalkan dan hapus jadwal?
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger pull-right" id="btnDelete" data-dismiss="modal" name="delete"><i class="fa fa-trash"></i> Hapus</button>
                <!-- <button class="btn btn-danger pull-right" id="btnDelete" type="submit" data-dismiss="modal" name="delete"><i class="fa fa-trash"></i> Hapus</button> -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

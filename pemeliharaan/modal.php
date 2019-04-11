<!-- Modal Tambah Jadwal Pemeliharaan -->
<div class="modal fade" id="modal-jadwal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Schedule</h4>
            </div>
            <div class="modal-body">
                <form action="form-action.php" method="post">
                <input type="hidden" class="form-control" id="id_aset" name="id">
                <div class="form-group">
                    <label>Kode Aset:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="kode_aset" name="kode" placeholder="Kode Aset" readonly>
                    </div>  
                </div>
                <div class="form-group">
                    <label>Nama Aset:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="nama_aset" name="nama" placeholder="Nama Aset" readonly>
                    </div>  
                </div>
                <div class="form-group">
                    <label>Masa Pemeliharaan:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="reservation" name="tgl_pemeliharaan">
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
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
                <h4 class="modal-title">Maintenance</h4>
            </div>
            <div class="modal-body">
            <form action="form-action.php" method="post">
                <input type="hidden" class="form-control" id="id_maintenance" name="id">
                <div class="form-group">
                    <label>Kode Aset:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="kode_aset_s" name="kode" placeholder="Kode Aset" readonly>
                    </div>  
                </div>
                <div class="form-group">
                    <label>Nama Aset:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="nama_aset_s" name="nama" placeholder="Nama Aset" readonly>
                    </div>  
                </div>
                <div class="form-group">
                    <label>Tanggal Pemeliharaan:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="datepicker" name="tgl_pemeliharaan">
                    </div>
                </div>
                <div class="form-group">
                    <label>Biaya Pemeliharaan:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-money"></i>
                        </div>
                        <input type="0" class="form-control" id="harga" name="harga" placeholder="Biaya pemeliharaan (jika tidak ada diisi 0)">
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
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
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
                Batalkan jadwal?
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger pull-right" id="btnDelete "type="submit" data-dismiss="modal" name="delete"><i class="fa fa-trash"></i> Delete</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

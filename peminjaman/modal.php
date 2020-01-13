
<!-- Modal Delete Usulan -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Simpan Peminjaman</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Komisi Peminjam:</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                    </div>
                    <select class="form-control select2" id="komisi_peminjam" name="komisi" style="width: 100%;">
                        <?php
                        $data = mysqli_query($koneksi, "SELECT * FROM komisi_jemaat");
                        while ($row = mysqli_fetch_array($data)) {
                        ?>
                        <option value="<?php echo $row['ID_KOMISI']; ?>"><?php echo $row['NAMA_KOMISI']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nomor Peminjam:</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                    </div>
                    <input type="text" class="form-control" id="nohp" name="nohp" required/>
                    </div>
                    <span id="errmsg"></span>
                </div>
                <div class="form-group">
                    <label>Tanggal Pinjam - Kembali:</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" id="reservation" name="tgl_pinjam" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tanggal Pinjam - Kembali:</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" id="reservation" name="tgl_pinjam" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan Peminjaman/Penggunaan:</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                    </div>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger pull-right" type="submit" id="btnSimpan" name="simpan"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Usulan -->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Hapus Item</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <input type="hidden" id="id_delete" name="id"/>
                Hapus pengajuan peminjaman?
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger pull-right" type="submit" id="btnDelete" name="delete"><i class="fa fa-trash"></i> Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Approve -->
<div class="modal fade" id="modal-approve">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Terima Peminjaman</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <input type="hidden" id="id_approve" name="id"/>
                Terima pengajuan peminjaman?
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-success pull-right" id="btnApprove" type="submit" data-dismiss="modal" name="approve"><i class="fa fa-save"></i> Ya</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Reject -->
<div class="modal fade" id="modal-reject">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tolak Peminjaman</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <input type="hidden" id="id_reject" name="id"/>
                Tolak pengajuan peminjaman? Beri alasan/keterangan sebagai informasi bagi peminjam
                <textarea class="form-control" id="keterangan_tolak_pengadaan" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger pull-right" id="btnReject" type="submit" data-dismiss="modal" name="reject"><i class="fa fa-close"></i> Ya</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Usulan -->
<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">List Aset akan Dipinjam</h4>
            </div>
            <div class="modal-body">
                <table id="example4" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Aset</th>
                        <th>Jenis Barang</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                </table>                
            </div>
            
        </div>
        
    </div>
    
</div>

<!-- Modal Detail Usulan -->
<div class="modal fade" id="modal-pinjam">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Daftar Aset Terpinjam</h4>
            </div>
            <div class="modal-body">
                <table id="example5" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Aset</th>
                        <th>Jenis Barang</th>
                        
                    </tr>
                    </thead>
                </table>            
            </div>
            
        </div>
        
    </div>
    
</div>

<!-- Modal Pengembalian -->
<div class="modal fade" id="modal-pengembalian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Pengembalian Aset</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <div class="form-group">
                    <label>ID Peminjaman:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sign-in"></i>
                        </div>
                        <input type="text" class="form-control" id="id_pinjam" name="id_pinjam" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tanggal Pengembalian:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar-check-o"></i>
                        </div>
                        <input type="text" class="form-control" id="tgl_pengembalian" name="tgl_pengembalian" placeholder="Tanggal pengembalian" readonly>
                    </div>  
                </div>
                <div class="form-group">
                    <label>Realisasi Pengembalian:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar-check-o"></i>
                        </div>
                        <input type="text" class="form-control" id="realisasi_pengembalian" name="realisasi_pengembalian" placeholder="Realisasi pengembalian" required>
                    </div>  
                </div>
                <table id="tabel_catatan" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Aset</th>
                        <th>Jenis Barang</th>
                        <th>Catatan untuk Aset</th>
                    </tr>
                    </thead>
                </table>
                <div class="form-group">
                    <label>Catatan/Keterangan:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                        </div>
                        <textarea class="form-control" id="keterangan_kembali" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
                    </div>  
                </div>
                <!-- <input type="hidden" id="id_pinjam" name="id"/> -->
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-success pull-right" id="btnKembali" type="submit" data-dismiss="modal"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
        
    </div>
    
</div>
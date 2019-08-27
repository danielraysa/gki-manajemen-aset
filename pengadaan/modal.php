<!-- Modal Add Barang -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah Barang</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <div class="form-group">
                    <label>Nama Barang:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="modal_nama_barang" name="nama" placeholder="Nama Barang">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Kategori:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <select class="form-control select2" id="modal_kategori" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <?php
                            $data = mysqli_query($koneksi, "SELECT * FROM kategori");
                            while ($row = mysqli_fetch_array($data)) {
                        ?>
                            <option value="<?php echo $row['ID_KATEGORI']; ?>"><?php echo $row['NAMA_KATEGORI']; ?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-success pull-right" id="addBarang" data-dismiss="modal" name="add-barang"><i class="fa fa-plus"></i> Tambah</button>
            </div>
        </div>
        
    </div>
    
</div>

<!-- Modal Add Merk -->
<div class="modal fade" id="modal-merk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah Merk</h4>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                    <label>Nama Merk:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="modal_merk" name="nama" placeholder="Nama Merk">
                    </div>  
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-success pull-right" data-dismiss="modal" id="addMerk" name="add-merk"><i class="fa fa-plus"></i> Tambah</button>
            </div>
        </div>
        
    </div>
    
</div>

<!-- Modal Add Ruangan -->
<div class="modal fade" id="modal-ruangan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah Ruangan</h4>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                    <label>Nama Ruangan:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="modal_nama_ruangan" placeholder="Nama Ruangan">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Kode Ruangan:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="modal_kode_ruangan" placeholder="Kode Ruangan">
                    </div>  
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-success pull-right" data-dismiss="modal" id="addRuangan" name="add-ruangan"><i class="fa fa-plus"></i> Tambah</button>
            </div>
        </div>
        
    </div>
    
</div>

<!-- Modal Add Komisi -->
<div class="modal fade" id="modal-komisi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah Komisi Jemaat</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <div class="form-group">
                    <label>Nama Komisi Jemaat:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="modal_nama_komisi" name="nama_komisi" placeholder="Nama Komisi">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Kode Komisi Jemaat:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="modal_kode_komisi" placeholder="Kode Komisi">
                    </div>  
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-success pull-right" data-dismiss="modal" id="addKomisi" name="add-komisi"><i class="fa fa-plus"></i> Tambah</button>
            </div>
        </div>
        
    </div>
    
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Item</h4>
            </div>
            <div class="modal-body">
            <form action="form-action.php" method="post">
                <div class="form-group">
                    <label>Nama Aset:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Jenis Barang:</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                    </div>
                    <select class="form-control select2" id="barang" name="barang" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <?php
                        $data = mysqli_query($koneksi, "SELECT * FROM barang");
                        while ($row = mysqli_fetch_array($data)) {
                        ?>
                        <option value="<?php echo $row['id_barang']; ?>"><?php echo $row['nama_barang']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <!-- <div class="input-group-btn">
                        <i class="fa fa-plus"></i><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Tambah</button>
                    </div> -->
                    </div>
                </div>
                <!--
                <div class="form-group">
                    <label>Jumlah:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah barang">
                    </div>  
                </div> -->
                <div class="form-group">
                    <label>Harga per Item:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-money"></i>
                        </div>
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga per item">
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                        </div>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
                    </div>  
                </div>
                <input type="hidden" id="id_edit" name="id"/>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-success pull-right" type="submit" name="edit"><i class="fa fa-save"></i> Simpan</button>
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
                <h4 class="modal-title">Hapus Usulan</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <input type="hidden" id="id_delete" name="id"/>
                Hapus usulan pengadaan aset?
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger pull-right" type="submit" id="btnDelete" name="delete"><i class="fa fa-trash"></i> Ya</button>
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
                <h4 class="modal-title">Terima Usulan</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <input type="hidden" id="id_approve" name="id"/>
                Terima usulan pengadaan aset ini?
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
                <h4 class="modal-title">Tolak Usulan</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <input type="hidden" id="id_reject" name="id"/>
                Tolak usulan pengadaan aset ini? <br> Beri alasan/keterangan sebagai informasi bagi pengusul <br><br>
                <textarea class="form-control" id="keterangan_tolak_pengadaan" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger pull-right" id="btnReject" type="submit" data-dismiss="modal" name="reject"><i class="fa fa-close"></i> Tolak dan Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Aset -->
<!-- <div class="modal fade" id="modal-aset">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah Aset</h4>
            </div>
            <div class="modal-body">
            <form action="form-action.php" method="post">
                <div class="form-group">
                    <label>Kode Aset:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="kode_aset" name="kode" placeholder="Kode Aset">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Nama Aset:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="nama_aset" name="nama" placeholder="Nama Aset">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Nomor Aset:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" id="nomor_aset" name="nomor" placeholder="Nomor Aset">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Jenis Barang:</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                    </div>
                    <select class="form-control select2" id="barang_aset" name="barang" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <?php
                        $data = mysqli_query($koneksi, "SELECT * FROM barang");
                        while ($row = mysqli_fetch_array($data)) {
                        ?>
                        <option value="<?php echo $row['id_barang']; ?>"><?php echo $row['nama_barang']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ruangan:</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                    </div>
                    <select class="form-control select2" id="ruangan_aset" name="ruangan" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <?php
                        $data = mysqli_query($koneksi, "SELECT * FROM ruangan");
                        while ($row = mysqli_fetch_array($data)) {
                        ?>
                        <option value="<?php echo $row['id_ruangan']; ?>"><?php echo $row['nama_ruangan']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                    </div>
                    <select class="form-control select2" id="status_aset" name="status" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <?php
                        $data = mysqli_query($koneksi, "SELECT * FROM status");
                        while ($row = mysqli_fetch_array($data)) {
                        ?>
                        <option value="<?php echo $row['id_status']; ?>"><?php echo $row['nama_status']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Harga:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-money"></i>
                        </div>
                        <input type="text" class="form-control" id="harga_aset" name="harga" placeholder="Harga per item">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Tanggal Pengadaan:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar-check-o"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="tanggal_pengadaan" placeholder="Tanggal pengadaan">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Masa Manfaat:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="manfaat_aset" name="masa_manfaat" placeholder="Masa manfaat">
                        <div class="input-group-addon">
                            tahun
                        </div>
                    </div>  
                </div>
                <input type="hidden" id="id_aset" name="id"/>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-success pull-right" type="submit" name="tambah_aset"><i class="fa fa-save"></i> Tambah Aset</button>
            </div>
        </div>
    </div>
</div> -->

<!-- Modal Detail Usulan -->
<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Detail Aset yang Diusulkan</h4>
            </div>
            <div class="modal-body">
                <table id="example4" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Barang Usulan</th>
                        <th>Jenis Barang</th>
                        <th>Harga</th>
                    </tr>
                    </thead>
                </table>                
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-success pull-right" type="submit" name="add-barang"><i class="fa fa-plus"></i> Tambah</button>
            </div>  -->
        </div>
        
    </div>
    
</div>
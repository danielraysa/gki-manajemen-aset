<!-- Modal Add Barang -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Item</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <div class="form-group">
                    <label>Nama Barang:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Barang">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Kategori:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <select class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
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
                <!-- <div class="form-group">
                    <label>Merk:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" name="merk" placeholder="Merk barang">
                    </div>
                </div>
                <div class="form-group">
                    <label>Seri/Model:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-laptop"></i>
                        </div>
                        <input type="text" class="form-control" name="serimodel" placeholder="Seri/Model barang">
                    </div>
                </div> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button class="btn btn-success pull-right" type="submit" name="add-barang"><i class="fa fa-plus"></i> Add Item</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
                        <i class="fa fa-plus"></i><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Add New</button>
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
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button class="btn btn-success pull-right" type="submit" name="edit"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Delete Usulan -->
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
                Hapus usulan?
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger pull-right" type="submit" id="btnDelete" name="delete"><i class="fa fa-trash"></i> Delete</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Approve -->
<div class="modal fade" id="modal-approve">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Approve Item</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <input type="hidden" id="id_approve" name="id"/>
                Terima usulan?
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button class="btn btn-success pull-right" id="btnApprove" type="submit" data-dismiss="modal" name="approve"><i class="fa fa-save"></i> Approve</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal Reject -->
<div class="modal fade" id="modal-reject">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Reject Item</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <input type="hidden" id="id_reject" name="id"/>
                Tolak usulan?
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger pull-right" id="btnReject" type="submit" data-dismiss="modal" name="reject"><i class="fa fa-close"></i> Reject</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Aset -->
<div class="modal fade" id="modal-aset">
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
                    <!-- <div class="input-group-btn">
                        <i class="fa fa-plus"></i><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Add New</button>
                    </div> -->
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
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button class="btn btn-success pull-right" type="submit" name="tambah_aset"><i class="fa fa-save"></i> Tambah Aset</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Detail Usulan -->
<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Detail Items</h4>
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
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button class="btn btn-success pull-right" type="submit" name="add-barang"><i class="fa fa-plus"></i> Add Item</button>
            </div>  -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
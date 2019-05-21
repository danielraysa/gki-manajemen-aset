
<!-- Modal Delete Usulan -->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Hapus Usulan Penghapusan Aset</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <input type="hidden" id="id_delete" name="id"/>
                Hapus usulan penghapusan aset ini?
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger pull-right" type="submit" id="btnDelete" name="delete"><i class="fa fa-trash"></i> Hapus</button>
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
                <h4 class="modal-title">Terima Usulan</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <input type="hidden" id="id_approve" name="id"/>
                Terima usulan penghapusan aset ini?
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-success pull-right" id="btnApprove" type="submit" data-dismiss="modal" name="approve"><i class="fa fa-save"></i> Ya</button>
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
                <h4 class="modal-title">Tolak Usulan</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <input type="hidden" id="id_reject" name="id"/>
                Tolak usulan penghapusan aset ini?
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger pull-right" id="btnReject" type="submit" data-dismiss="modal" name="reject"><i class="fa fa-close"></i> Ya</button>
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
                <h4 class="modal-title">Detail Aset yang Diusulkan</h4>
            </div>
            <div class="modal-body">
                <table id="example4" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Aset</th>
                        <th>Umur</th>
                        <th>Jumlah Pemeliharaan</th>
                        <th>Nilai Aset</th>
                    </tr>
                    </thead>
                </table>                
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
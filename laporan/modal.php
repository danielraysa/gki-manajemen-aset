<!-- Modal Filter -->
<div class="modal fade" id="modal-filter">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Filter Laporan</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <input type="hidden" id="id_filter" name="id"/>
                <div class="form-group">
                    <label>Pilih Tanggal:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="datepicker" >
                        <div class="input-group-addon">
                            s.d.
                        </div>
                        <input type="text" class="form-control" id="datepicker1" >
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label>Pilih Periode:</label>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <select class="form-control select2" id="bulan" name="bulan" style="width: 100%;" required>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <select class="form-control select2" id="tahun" name="tahun" style="width: 100%;" required>
                                <option value="2019">2019</option>
                            </select>
                        </div>
                    </div> 
                </div> -->
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-success pull-right" id="btnFilter" type="submit" data-dismiss="modal"><i class="fa fa-search"></i> Filter</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-filter">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Filter Laporan</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="" method="post"> -->
                <input type="hidden" id="id_filter" name="id"/>
                
                <div class="form-group">
                    <label>Pilih Tanggal:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="reservation" >
                    </div>
                </div>

                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button class="btn btn-success pull-right" id="btnFilter" type="submit" data-dismiss="modal"><i class="fa fa-search"></i> Filter</button>
            </div>
        </div>
        
    </div>
</div>

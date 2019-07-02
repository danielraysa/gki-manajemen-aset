<?php
session_start();
setlocale (LC_TIME, 'INDONESIAN');
date_default_timezone_set("Asia/Jakarta");
require('../module/fpdf/fpdf.php');
require('../connection.php');
require('mc_table.php');

$filter = $_POST['filter'];
$tgl = $_POST['tgl_awal'];
$tgl2 = $_POST['tgl_akhir'];
$date = str_replace('/', '-', $tgl);
$date2 = str_replace('/', '-', $tgl2);
//echo $date."\n";
$tgl_awal = date("Y-m-d", strtotime($date));
$tgl_akhir = date("Y-m-d", strtotime($date2));

$pdf=new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetTitle('LAPORAN '.strtoupper($filter).' ASET');
$pdf->SetFont('Times','B',13);
$pdf->Text(75,33, 'LAPORAN '.strtoupper($filter).' ASET');
$pdf->SetFont('Times','',11);
$pdf->Text(80,37, 'Periode : '.tglIndo($tgl_awal).' - '.tglIndo($tgl_akhir));
//$pdf->SetFont('Times','',11);
//Table with 20 rows and 4 columns
$pdf->SetWidths(array(10,40,35,35,30,35));

$no = 1;
$pdf->SetFont('Times','B',11);
if($filter == 'pengadaan') {
    $pdf->SetWidths(array(10,40,35,35,30,35));
    $count = mysqli_query($koneksi,"SELECT p.id_pengadaan, d.id_aset, d.nama_aset, u.nama_lengkap, p.keterangan_usulan, p.tanggal_usulan, p.hasil_approval, d.harga_pembelian, d.tanggal_pembelian FROM pengadaan_aset p JOIN detil_usulan_pengadaan dp ON p.id_pengadaan = dp.id_pengadaan JOIN user u ON p.id_user = u.id_user JOIN daftar_aset d ON d.id_usulan_tambah = dp.id_usulan_tambah WHERE p.hasil_approval = 'Diterima' AND (d.tanggal_pembelian BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') ORDER BY d.tanggal_pembelian");
    $pdf->Row(array('No.','Usulan Aset','Nama Pengusul','Tanggal Pembelian','Nilai Beli','Keterangan'));
    $pdf->SetFont('Times','',11);
    //for($i=0;$i<20;$i++)
    while($row = mysqli_fetch_array($count)) {
        $pdf->Row(array($no,$row['nama_aset'],$row['nama_lengkap'],tglIndo($row['tanggal_pembelian']),asRupiah($row['harga_pembelian']),$row['keterangan_usulan']));
        $no++;
    }
}
if($filter == 'peminjaman') {
    $pdf->SetWidths(array(10,40,35,35,30,35));
    $count = mysqli_query($koneksi,"SELECT d.nama_aset, u.nama_lengkap, p.no_hp, p.keterangan_pinjam, p.tanggal_peminjaman, p.tanggal_pengembalian, p.realisasi_pengembalian, p.hasil_pengajuan FROM peminjaman_aset p JOIN user u ON p.id_user = u.id_user JOIN detail_peminjaman dp ON p.id_peminjaman = dp.id_peminjaman JOIN daftar_aset d ON dp.id_aset = d.id_aset WHERE p.hasil_pengajuan = 'Diterima' AND (p.tanggal_peminjaman BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') ORDER BY p.tanggal_peminjaman");
    $pdf->Row(array('No.','Nama Aset','Nama Peminjam','Tanggal Pinjam','Tanggal Kembali','Keterangan'));
    $pdf->SetFont('Times','',11);
    //for($i=0;$i<20;$i++)
    while($row = mysqli_fetch_array($count)) {
        $pdf->Row(array($no,$row['nama_aset'],$row['nama_lengkap'],tglIndo($row['tanggal_peminjaman']),tglIndo($row['tanggal_pengembalian']),$row['keterangan_pinjam']));
        $no++;
    }
}
if($filter == 'pemeliharaan') {
    $pdf->SetWidths(array(10,40,35,35,30,35));
    $count = mysqli_query($koneksi,"SELECT p.ID_PEMELIHARAAN, d.NAMA_ASET, d.KODE_ASET, p.BIAYA_PEMELIHARAAN, p.HASIL_PEMELIHARAAN, p.TANGGAL_PENJADWALAN, p.TANGGAL_PEMELIHARAAN, p.SELESAI_PEMELIHARAAN FROM pemeliharaan_aset p JOIN daftar_aset d ON p.ID_ASET = d.ID_ASET WHERE p.STATUS_PEMELIHARAAN = 'Selesai' AND (p.TANGGAL_PENJADWALAN BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') ORDER BY p.TANGGAL_PENJADWALAN");
    $pdf->Row(array('No.','Nama Aset','Hasil Pemeliharaan','Biaya Pemeliharaan','Tanggal Penjadwalan','Tanggal Pemeliharaan'));
    $pdf->SetFont('Times','',11);
    //for($i=0;$i<20;$i++)
    while($row = mysqli_fetch_array($count)) {
        $pdf->Row(array($no,$row['NAMA_ASET'],$row['HASIL_PEMELIHARAAN'],asRupiah($row['BIAYA_PEMELIHARAAN']),tglIndo($row['TANGGAL_PENJADWALAN']),tglIndo($row['TANGGAL_PEMELIHARAAN'])));
        $no++;
    }
}
if($filter == 'penghapusan') {
    $pdf->SetWidths(array(10,50,35,35,40));
    $count = mysqli_query($koneksi,"SELECT p.id_penghapusan, d.kode_aset, d.nama_aset, u.nama_lengkap, p.keterangan_penghapusan, p.tanggal_usulan, p.hasil_approval FROM penghapusan_aset p JOIN detil_usulan_penghapusan dp ON p.id_penghapusan = dp.id_penghapusan JOIN user u ON p.id_user = u.id_user JOIN daftar_aset d ON d.id_aset = dp.id_aset WHERE p.hasil_approval = 'Diterima' AND (p.tanggal_usulan BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') ORDER BY p.tanggal_usulan");
    $pdf->Row(array('No.','Usulan Aset','Nama Pengusul','Tanggal Usulan','Keterangan'));
    $pdf->SetFont('Times','',11);
    //for($i=0;$i<20;$i++)
    while($row = mysqli_fetch_array($count)) {
        $pdf->Row(array($no,$row['nama_aset'],$row['nama_lengkap'],tglIndo($row['tanggal_usulan']),$row['keterangan_penghapusan']));
        $no++;
    }
}
$pdf->Output('I','LAPORAN_'.strtoupper($filter).'_ASET.pdf');
?>
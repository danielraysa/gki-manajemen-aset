<?php
session_start();
if(!isset($_GET['kode'])){
    header('location:../');
    exit;
}
include '../connection.php';
require_once('../module/TCPDF-master/tcpdf.php');
$kode_barang = $_GET['kode'];
$sql = "SELECT * FROM daftar_baru db join merk m on db.ID_MERK = m.ID_MERK join lokasi l on db.LOKASI_BARANG = l.ID_LOKASI join ruangan r on db.RUANGAN_BARANG = r.ID_RUANGAN WHERE KODE_BARANG = '${kode_barang}'";

if(isset($_SESSION['kode_print_barcode']) && count($_SESSION['kode_print_barcode']) > 1 && $kode_barang == 'session'){
    $kode_all = implode("','",$_SESSION['kode_print_barcode']);
    $sql = "SELECT * FROM daftar_baru db join merk m on db.ID_MERK = m.ID_MERK join lokasi l on db.LOKASI_BARANG = l.ID_LOKASI join ruangan r on db.RUANGAN_BARANG = r.ID_RUANGAN WHERE KODE_BARANG in ('${kode_all}')";
}
$query = mysqli_query($koneksi, $sql);

$paper_size = array('70','30'); // 70mm x 30mm
// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new TCPDF('L', 'mm', $paper_size, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(2, 2, 2);
// $pdf->addPage('P','A5');
while($barang = mysqli_fetch_array($query)){

    $pdf->addPage('L', $paper_size);

    $pdf->SetTitle('Cetak Label');
    $pdf->SetAutoPageBreak(TRUE, 0);

    $pdf->SetFont('Times','',9);

    $pdf->Image('../logoGKI.jpg',2,2, 8, 8);
    $pdf->write1DBarcode($kode_barang, 'C128A', 4, 15, 32, 10);
    // $pdf->Image('https://barcode.tec-it.com/barcode.ashx?data='.$kode_barang.'&code=Code128&unit=mm&dpi=150&imagetype=jpg&hidehrt=true', 4, 15, 32, 10);
    $pdf->Text(10, 4, 'GKI SIDOARJO');
    $pdf->SetFont('Times','',8);
    $pdf->Text(40, 2, strtoupper($barang['NAMA_LOKASI']),false,false,true,0,0,'C');
    $pdf->Text(40, 5, strtoupper($barang['NAMA_RUANGAN']),false,false,true,0,0,'C');
    $pdf->Text(40, 10, $barang['KODE_BARANG'],false,false,true,0,0,'C');
    if(strlen($barang['NAMA_BARANG']) > 17){
        $pdf->SetFont('Times','',6);
    }
    if(strlen($barang['NAMA_BARANG']) > 20){
        $pdf->SetFont('Times','',5);
    }
    $pdf->Text(40, 13, strtoupper($barang['NAMA_BARANG']),false,false,true,0,0,'C');
    $pdf->SetFont('Times','',5);
    $pdf->Text(40, 20, 'GEREJA KRISTEN INDONESIA',false,false,true,0,0,'C');
    $pdf->Text(40, 22, 'JL. TRUNOJOYO 39A SIDOARJO',false,false,true,0,0,'C');
    $pdf->Text(40, 24, '031.8921922',false,false,true,0,0,'C');
}
$pdf->Output('label.pdf');
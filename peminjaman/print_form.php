<?php
session_start();

//$id = $_GET['print_id'];
$id = $_SESSION['print_id'];
require_once('../module/fpdf/fpdf.php');
require_once('../module/fpdi/src/autoload.php');
use setasign\Fpdi\Fpdi;
// use setasign\fpdf;
//require_once('../module/TCPDF-master/tcpdf.php');
//require_once('../module/fpdi/src/FpdiTrait.php');

//use setasign\Fpdi\TcpdfFpdi;
//use setasign\Fpdi\PdfReader;

include '../connection.php';
$query = mysqli_query($koneksi,"SELECT p.ID_PEMINJAMAN, u.NAMA_LENGKAP, p.NO_HP, k.NAMA_KOMISI, p.KETERANGAN_PINJAM, p.TANGGAL_PEMINJAMAN, p.TANGGAL_PENGEMBALIAN, p.TANGGAL_PENGAJUAN FROM peminjaman_aset p JOIN user u ON p.ID_USER = u.ID_USER JOIN komisi_jemaat k ON p.ID_KOMISI = k.ID_KOMISI WHERE p.ID_PEMINJAMAN = '".$id."'");
$row = mysqli_fetch_array($query);
$pdf = new Fpdi();
$pageCount = $pdf->setSourceFile('Formulir Peminjaman Inventaris Gereja web.pdf');
$pageId = $pdf->importPage(1);
$pdf->addPage('P','A5');
//$pdf->addPage('P','mm',array('148','210'));
//$pdf->useTemplate($pageId);
$pdf->useImportedPage($pageId, 0, 0);
$pdf->SetTitle('Form Pengajuan Peminjaman');

//$date = strftime("%d %B %Y", time());
$pdf->SetFont('Times','',12);
$pdf->Text(55, 48, $row['NAMA_LENGKAP']);
$pdf->Text(55, 54, $row['NAMA_KOMISI']);
$pdf->Text(55, 60, $row['NO_HP']);
$pdf->Text(55, 78, tglIndo_day($row['TANGGAL_PEMINJAMAN'])." - ".tglIndo_day($row['TANGGAL_PENGEMBALIAN']));
$pdf->Text(55, 84, $row['KETERANGAN_PINJAM']);
$pdf->Text(30, 115, strftime("%d %B %Y", time()));
//$pdf->Text(162, 18.5, $row['ID_PEMINJAMAN']);
//$pdf->Cell(0, 0, 'TEST CELL STRETCH: no stretch', 1, 1, 'C', 0, '', 0);

//$pdf = new PDF('P','mm','A4');
// Column headings
$pdf->addPage('P','A5');

$count = mysqli_query($koneksi, "SELECT da.NAMA_BARANG, m.NAMA_MERK FROM detail_peminjaman dp JOIN daftar_baru da on dp.ID_ASET = da.ID_ASET JOIN merk m ON da.ID_MERK = m.ID_MERK WHERE dp.ID_PEMINJAMAN = '".$id."'");
$pdf->SetFont('Times','B',13);

$pdf->SetFont('Times','B',13);
$pdf->Text(30,20,'DAFTAR ASET YANG DIPINJAM');

$pdf->SetFont('Times','I',8);
$pdf->Text(110,10, 'Dicetak pada '.strftime("%d %B %Y", time()));

$width_cell=array(10,70,35);
//$width_cell=array(10,40,60,40);
$pdf->SetFont('Times','B',13);
$pdf->SetXY(15,30);
//$pdf->SetY(30);
$pdf->SetFillColor(193,229,252); // Background color of header 
// Header starts /// 
$pdf->Cell($width_cell[0],10,'No.',1,0,'C',true); // First header column 
$pdf->Cell($width_cell[1],10,'Nama Barang',1,0,'C',true); // Second header column
$pdf->Cell($width_cell[2],10,'Merk',1,1,'C',true); // Third header column 
//$pdf->Cell($width_cell[3],10,'Tanggal Seleksi',1,1,'C',true); // Third header column 

//// header ends ///////

$pdf->SetFont('Times','',12);
$pdf->SetFillColor(235,236,236); // Background color of header 
$fill=false; // to give alternate background fill color to rows 
/// each record is one row
$no = 1;
while ($row = mysqli_fetch_array($count)) {
    $pdf->SetX(15);
    $pdf->Cell($width_cell[0],10,$no,1,0,'C',$fill);
    $pdf->Cell($width_cell[1],10,$row['NAMA_BARANG'],1,0,'C',$fill);
    $pdf->Cell($width_cell[2],10,$row['NAMA_MERK'],1,1,'C',$fill);
    //$pdf->Cell($width_cell[3],10,$row['TANGGALSELEKSI'],1,1,'C',$fill);
    $no++;
    $fill = !$fill; // to give alternate background fill  color to rows
}

$pdf->Output('I', 'FORM_PEMINJAMAN.pdf');
?>

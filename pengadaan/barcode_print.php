<?php

include '../connection.php';

require_once('../module/TCPDF-master/tcpdf.php');
$kode_barang = $_GET['kode'];
// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new TCPDF('L', 'mm', array('70','30'), true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(2, 2, 2);
// $pdf->addPage('P','A5');
$pdf->addPage('L',array('70','30'));

$pdf->SetTitle('Cetak Label');
$pdf->SetAutoPageBreak(TRUE, 0);

$pdf->SetFont('Times','',8);
$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing ';
// Multicell test
// $pdf->MultiCell(30, 1, '[LEFT] '.$txt);
$pdf->Image('../logoGKI.jpg',2,2, 8, 8);
$pdf->Image('https://barcode.tec-it.com/barcode.ashx?data='.$kode_barang.'&code=Code128&unit=mm&dpi=150&imagetype=jpg&hidehrt=true', 4, 15, 32, 10);
$pdf->Text(10, 2, 'GKI SIDOARJO');
$pdf->Text(40, 2, 'GEDUNG GEREJA',false,false,true,0,0,'C');
$pdf->Text(40, 5, 'DAPUR',false,false,true,0,0,'C');
$pdf->Text(40, 10, $kode_barang,false,false,true,0,0,'C');
$pdf->Text(40, 13, 'CERET',false,false,true,0,0,'C');
$pdf->SetFont('Times','',5);
$pdf->Text(40, 22, 'GEREJA KRISTEN INDONESIA',false,false,true,0,0,'C');
$pdf->Text(40, 24, 'JL. TRUNOJOYO 39A SIDOARJO',false,false,true,0,0,'C');
$pdf->Text(40, 26, '031.8921922',false,false,true,0,0,'C');
// $pdf->MultiCell(25, 5, '[RIGHT] '.$txt, 1, 'R', 0, 1, '', '', true);
// $pdf->write1DBarcode('0123456789', 'C128', '', '', 30);

$pdf->Output('label.pdf');
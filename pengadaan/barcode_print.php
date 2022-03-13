<?php

include '../connection.php';

require_once('../module/TCPDF-master/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// $pdf->addPage('P','A5');
$pdf->addPage('P','mm',array('50','100'));
//$pdf->useTemplate($pageId);
$pdf->SetTitle('Cetak Label');

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

$pdf->Output('I', 'label.pdf');
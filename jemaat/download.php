<?php

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


// $wilayah = $_POST['wilayah'];
$wilayah = 'Simson-Debora';

$listColumn = [
    'A' => 'No. Induk',
    'B' => 'Nama'
];
$listColumnParam = [
    'A' => 'no_induk',
    'B' => 'nama_lengkap'
];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');
foreach ($listColumn as $key => $value) {
    $sheet->setCellValue("{$key}1", $value);
}

$sql = "SELECT * FROM data_jemaat WHERE kelompok_jemaat = '$wilayah'";
$query = mysqli_query($koneksi, $sql);
$firstColumnNumber = 2;
while ($row = mysqli_fetch_assoc($query)) {
    foreach ($listColumnParam as $key => $value) {
        $sheet->setCellValue("{$key}{$firstColumnNumber}", $row[$value]);
    }
    $firstColumnNumber++;
}


$writer = new Xlsx($spreadsheet);
$date = date('Ymd_His');
// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=data_jemaat_{$wilayah}_{$date}.xlsx");
$writer->save('php://output');
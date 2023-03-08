<?php

require '../connection.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$wilayah = $_POST['kelompok'];
// $wilayah = 'Simson-Debora';
$sql = "SHOW columns FROM data_jemaat;";
$query = mysqli_query($koneksi, $sql);
$letter = 'A';
$listColumnParam = [];
while ($row = mysqli_fetch_assoc($query)) {
    $listColumnParam[$letter] = $row['Field'];
    $letter++;
}
$listColumn = array_map(function($item) {
    return ucwords(str_replace('_', ' ', $item));
}, $listColumnParam);

/* $listColumn = [
    'A' => 'No. Induk',
    'B' => 'Nama'
];
$listColumnParam = [
    'A' => 'no_induk',
    'B' => 'nama_lengkap'
]; */

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
// $sheet->setCellValue('A1', 'Hello World !');
foreach ($listColumn as $key => $value) {
    $sheet->setCellValue("{$key}1", $value);
}
$sql = "SELECT * FROM data_jemaat";
if ($wilayah != 'all') {
    $sql = "SELECT * FROM data_jemaat WHERE kelompok_jemaat = '$wilayah'";
}
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
header("Content-Disposition: attachment; filename=Data_Jemaat_{$wilayah}_{$date}.xlsx");
$writer->save('php://output');
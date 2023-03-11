<?php

require '../connection.php';
require '../vendor/autoload.php';

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$reader->setReadDataOnly(true);
$spreadsheet = $reader->load($_FILES['file_import']['tmp_name']);

$sheet = $spreadsheet->getSheet($spreadsheet->getFirstSheetIndex());
$dataSheet = $sheet->toArray();

$sql = "SHOW columns FROM data_jemaat;";
$query = mysqli_query($koneksi, $sql);
$letter = 'A';
$listColumnParam = [];
while ($row = mysqli_fetch_assoc($query)) {
    if ($row['Field'] != 'id_jemaat') {
        array_push($listColumnParam, $row['Field']);
    }
}
mysqli_begin_transaction($koneksi);
try {
    foreach ($dataSheet as $key => $data) {
        # code...
        if ($key != 0) {
            $params = [];
            foreach ($data as $value) {
                array_push($params, $value == null ? 'NULL' : "'".$value."'");
            }
            $sql = "INSERT INTO data_jemaat (".implode(', ',$listColumnParam).") VALUES (".implode(', ',$params).")";
            $query = mysqli_query($koneksi, $sql);
            if (!$query) {
                var_dump($listColumnParam, $params);
                mysqli_rollback($koneksi);
                die(mysqli_error($koneksi));
            }
            // die($sql);
        }
    }
    mysqli_commit($koneksi);
    $message = "Sukses import data.";
    $_SESSION['success-msg'] = $message;
    header("location: ../jemaat?success");
    exit;
} catch (mysqli_sql_exception $exception) {
    mysqli_rollback($koneksi);

    throw $exception;
    $_SESSION['error-msg'] = mysqli_error($koneksi);
    header("location: ../jemaat?error");
    exit;
}

<?php

use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require '../connection.php';
require '../vendor/autoload.php';

$path = $_FILES['file_import']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);

try {
    $reader = new Xls();
    if ($ext == 'xlsx') {
        $reader = new Xlsx();
    }
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load($_FILES['file_import']['tmp_name']);

    $sheet = $spreadsheet->getSheet($spreadsheet->getFirstSheetIndex());
    $dataSheet = $sheet->toArray();

} catch (Exception $exception) {
    $_SESSION['error-msg'] = $exception->getMessage();
    header("location: ../jemaat?error");
    exit;
}

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
                array_push($params, $value == null ? 'NULL' : "'".mysqli_real_escape_string($koneksi, $value)."'");
            }
            $sql = "INSERT INTO data_jemaat (".implode(', ',$listColumnParam).") VALUES (".implode(', ',$params).")";
            $query = mysqli_query($koneksi, $sql);
            if (!$query) {
                var_dump($sql, $listColumnParam, $params);
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

    $_SESSION['error-msg'] = mysqli_error($koneksi);
    header("location: ../jemaat?error");
    exit;
}

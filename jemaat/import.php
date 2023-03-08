<?php

require '../connection.php';
require '../vendor/autoload.php';

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$spreadsheet = $reader->load($_FILES['file_import']['tmp_name']);
// $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($_FILES['file_import']['tmp_name']);
var_dump($_FILES, $spreadsheet);
exit;
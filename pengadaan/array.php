<?php

    session_start();
    foreach($_SESSION['temp_item_2'] as $key => $items) {
        echo $items['temp_id'].": ".$items['nama'].", ".$items['jenis'].", ".$items['harga']."<br>";
    }
    print_r($_SESSION['temp_item']);

    //echo chdir(dirname(__FILE__));
    echo dirname('approval/index.php');
    //echo "<br>".getcwd();
    
    echo "<br>".basename(dirname($_SERVER['PHP_SELF']));;
    echo "<br>".basename(__DIR__);
    echo "<br>".$_SERVER['DOCUMENT_ROOT'];

    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/gki-sarpras/css-script.php";
    echo $path;
    include_once($path);

?>
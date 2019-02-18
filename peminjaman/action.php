<?php
    session_start();
    include "../connection.php";
    if (isset($_POST['scan'])) {
        $id = $_POST['id_barcode'];
        $qty = 1;
		$db_handle = new DBController();
        $productByCode = $db_handle->runQuery("SELECT * FROM sarpras WHERE id = '".$id."'");
        $itemArray = array($productByCode[0]["id"]=>array('id'=>$productByCode[0]["id"], 'nama'=>$productByCode[0]["nama"], 'jenis'=>$productByCode[0]["jenis"], 'qty'=>$qty));
        
        if(!empty($_SESSION["cart_item"])) {
            if(in_array($productByCode[0]["id"],array_keys($_SESSION["cart_item"]))) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                        if($productByCode[0]["id"] == $k) {
                            if(empty($_SESSION["cart_item"][$k]["qty"])) {
                                $_SESSION["cart_item"][$k]["qty"] = 0;
                            }
                            $_SESSION["cart_item"][$k]["qty"] += $qty;
                        }
                }
            } else {
                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
            }
        } else {
            $_SESSION["cart_item"] = $itemArray;
        }
    }
    if (isset($_POST['empty'])) {
        unset($_SESSION["cart_item"]);
        
    }
    header("location:index.php");
?>
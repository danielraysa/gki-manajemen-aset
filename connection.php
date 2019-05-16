<?php
    $koneksi = mysqli_connect("localhost","root","","gki_backup");
    
    function randString($length) {
        $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
        }
        return $str;
    }

    function randomID($table, $id_table, $char) {
        $koneksi = mysqli_connect("localhost","root","","gki_backup");
        $random_id = randString($char);
        $is_unique = false;
        while (!$is_unique) {
            $query = mysqli_query($koneksi,"SELECT * FROM ".$table." WHERE ".$id_table." = '".$random_id."'");
            if (mysqli_num_rows($query) == 0) {  
                // if you don't get a result, then you're good
                $is_unique = true;
                return $random_id;
            }
            else {
                $random_id = randString($char);
            }
        }
    }
    
    class DBController {
        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private $database = "gki_backup";
        private $conn;
        
        function __construct() {
            $this->conn = $this->connectDB();
        }
        
        function connectDB() {
            $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
            return $conn;
        }
        
        function runQuery($query) {
            $result = mysqli_query($this->conn,$query);
            while($row=mysqli_fetch_assoc($result)) {
                $resultset[] = $row;
            }		
            if(!empty($resultset))
                return $resultset;
        }
        
        function numRows($query) {
            $result  = mysqli_query($this->conn,$query);
            $rowcount = mysqli_num_rows($result);
            return $rowcount;	
        }
    }
?>
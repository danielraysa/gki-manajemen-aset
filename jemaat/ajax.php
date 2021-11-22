<?php

    include "../connection.php";
    header('Content-Type: application/json; charset=utf-8');
    if (isset($_POST['ID'])) {
        $id = $_POST['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM daftar_baru WHERE ID_BARANG = '".$id."'");
        $row = mysqli_fetch_array($query);
        $nama = $row['NAMA_BARANG'];
        $kode = $row['KODE_BARANG'];
        $merk = $row['MERK'];
        $komisi = $row['KOMISI'];
        $ruangan = $row['LOKASI_BARANG'];
        $seri = "";
        if(!empty($row['FOTO_ASET'])){
            $foto = $row['FOTO_ASET'];
            $myObj = array('id' => $id, 'nama' => $nama, 'kode' => $kode, 'ruangan' => $ruangan, 'komisi' => $komisi, 'seri' => $seri, 'merk' => $merk, 'foto' => $foto);
        }
        else {
            $myObj = array('id' => $id, 'nama' => $nama, 'kode' => $kode, 'ruangan' => $ruangan, 'komisi' => $komisi, 'seri' => $seri, 'merk' => $merk, 'foto' => 'blank');
        }
        $myJSON = json_encode($myObj);
        echo $myJSON;
    }
    
    if(isset($_POST['datatable'])) {
        $search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
        $limit = $_POST['length']; // Ambil data limit per page
        $start = $_POST['start']; // Ambil data start
        $sql = mysqli_query($connect, "SELECT nis FROM siswa"); // Query untuk menghitung seluruh data siswa
        $sql_count = mysqli_num_rows($sql); // Hitung data yg ada pada query $sql
        $query = "SELECT * FROM siswa WHERE (nis LIKE '%".$search."%' OR nama LIKE '%".$search."%' OR telp LIKE '%".$search."%' OR alamat LIKE '%".$search."%')";
        $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
        $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
        $order = " ORDER BY ".$order_field." ".$order_ascdesc;
        $sql_data = mysqli_query($connect, $query.$order." LIMIT ".$limit." OFFSET ".$start); // Query untuk data yang akan di tampilkan
        $sql_filter = mysqli_query($connect, $query); // Query untuk count jumlah data sesuai dengan filter pada textbox pencarian
        $sql_filter_count = mysqli_num_rows($sql_filter); // Hitung data yg ada pada query $sql_filter
        $data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC); // Untuk mengambil data hasil query menjadi array
        $callback = array(
            'draw'=>$_POST['draw'], // Ini dari datatablenya
            'recordsTotal'=>$sql_count,
            'recordsFiltered'=>$sql_filter_count,
            'data'=>$data
        );
        echo json_encode($callback); // Convert array $callback ke json
    }

?>
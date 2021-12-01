<?php

    include "../connection.php";
    header('Content-Type: application/json; charset=utf-8');
    if (isset($_POST['id_jemaat'])) {
        $id = $_POST['id_jemaat'];
        $query = mysqli_query($koneksi, "SELECT * FROM data_jemaat WHERE id_jemaat = '".$id."'");
        $row = mysqli_fetch_assoc($query);
        echo json_encode($row);
    }
    
    if(isset($_POST['datatable'])) {
        $search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
        $limit = $_POST['length']; // Ambil data limit per page
        $start = $_POST['start']; // Ambil data start
        $sql = mysqli_query($koneksi, "SELECT * FROM data_jemaat"); // Query untuk menghitung seluruh data siswa
        $sql_count = mysqli_num_rows($sql); // Hitung data yg ada pada query $sql
        $query = "SELECT * FROM data_jemaat WHERE no_induk LIKE '%".$search."%' OR nama_lengkap LIKE '%".$search."%' OR no_telp LIKE '%".$search."%' OR alamat LIKE '%".$search."%'";
        $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
        $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
        $order = " ORDER BY ".$order_field." ".$order_ascdesc;
        $sql_data = mysqli_query($koneksi, $query.$order." LIMIT ".$limit." OFFSET ".$start); // Query untuk data yang akan di tampilkan
        $sql_filter = mysqli_query($koneksi, $query); // Query untuk count jumlah data sesuai dengan filter pada textbox pencarian
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
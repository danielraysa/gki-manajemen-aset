<?php

    include "../connection.php";
    
    if (isset($_POST['ID'])) {
        $id = $_POST['ID'];
        $query = mysqli_query($koneksi, "SELECT * FROM daftar_baru WHERE ID_ASET = '".$id."'");
        $row = mysqli_fetch_array($query);
        $nama = $row['NAMA_BARANG'];
        $kode = $row['KODE_BARANG'];
        $jenis = $row['JENIS_BARANG'];
        $merk = $row['ID_MERK'];
        // $komisi = $row['KOMISI'];
        $lokasi = $row['LOKASI_BARANG'];
        $ruangan = $row['RUANGAN_BARANG'];
        $seri = $row['SERI_MODEL'];
        $foto = $row['FOTO_ASET'];
        
        $myObj = array('id' => $id, 'nama' => $nama, 'kode' => $kode, 'jenis_barang' => $jenis, 'ruangan' => $ruangan, 'lokasi' => $lokasi, 'seri' => $seri, 'merk' => $merk, 'foto' => $foto);
        echo json_encode($myObj);
    }

    if(isset($_POST['datatable'])) {
        $_sql = "SELECT * FROM daftar_baru db join merk m on db.ID_MERK = m.ID_MERK join lokasi l on db.LOKASI_BARANG = l.ID_LOKASI join ruangan r on db.RUANGAN_BARANG = r.ID_RUANGAN ";
        $search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
        $limit = $_POST['length']; // Ambil data limit per page
        $start = $_POST['start']; // Ambil data start
        $sql = mysqli_query($koneksi, $_sql); // Query untuk menghitung seluruh data aset
        $sql_count = mysqli_num_rows($sql); // Hitung data yg ada pada query $sql
        $query = $_sql." WHERE (KODE_BARANG LIKE '%".$search."%' OR NAMA_BARANG LIKE '%".$search."%')";
        /* if($param != null && $value != null){
            $query = "SELECT * FROM daftar_baru WHERE ${param} like '%${value}%' and (KODE_BARANG LIKE '%".$search."%' OR NAMA_BARANG LIKE '%".$search."%')";
        } */
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

    exit;

?>
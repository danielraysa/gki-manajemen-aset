<?php
    session_start();
    setlocale (LC_TIME, 'INDONESIAN');
    date_default_timezone_set("Asia/Jakarta");
    include "../connection.php";
    /* if(isset($_POST['ID'])) {
        $id = "datanew";
        $add = array(1, 2, 3, 4, 5, "<button class='btn btn-danger' data-delete='".$id."'><i class='fa fa-trash'></i> Delete</button>");
        array_push($_SESSION['temp_item'], $add);
        //$myObj = array('id' => $id, 'nama' => $nama, 'barang' => $barang, 'harga' => $harga, 'keterangan' => $keterangan);
        //$myJSON = json_encode($add);
        $myJSON = json_encode($_SESSION['temp_item']);
        echo $myJSON;
    } */

    if(isset($_POST['empty'])){
        unset($_SESSION['item_pinjam']);
    }

    if(isset($_POST['add-pinjam'])) {
        $id = $_POST['add-pinjam'];
        $query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.KODE_ASET, d.NAMA_ASET, b.NAMA_BARANG, m.NAMA_MERK FROM daftar_aset d JOIN merk m ON d.ID_MERK = m.ID_MERK JOIN detil_usulan_pengadaan dp ON d.ID_USULAN_TAMBAH = dp.ID_USULAN_TAMBAH JOIN barang b ON dp.ID_BARANG = b.ID_BARANG WHERE d.ID_ASET = '".$id."'");
        $fet = mysqli_fetch_array($query);
        $kode_aset = $fet['KODE_ASET'];
        $nama_aset = $fet['NAMA_ASET'];
        $nama_barang = $fet['NAMA_BARANG'];
        
        $add = array('id_aset' => $id, 'kode_aset' => $kode_aset, 'nama_aset' => $nama_aset, 'barang' => $nama_barang);
        array_push($_SESSION['item_pinjam'], $add);
        $myJSON = json_encode($_SESSION['item_pinjam']);
        echo $myJSON;
    }

    if(isset($_POST['hapus_item'])) {
        $val = $_POST['hapus_item'];
        //echo search_array($val);
        $key_index = array_search($val, array_column($_SESSION['item_pinjam'], 'nama'));
        array_splice($_SESSION['item_pinjam'], $key_index, 1);
        //unset($_SESSION['temp_item'][$key_index]);
        //print_r($_SESSION['temp_item']);
    }

    if(isset($_POST['simpan_pinjam'])){
        $id_user = $_POST['id_peminjam'];
        $id_komisi = $_POST['id_komisi'];
        $no_hp = $_POST['no_hp'];
        $tgl = $_POST['tgl_peminjaman'];
        $keterangan = $_POST['keterangan'];
        $date = str_replace('/', '-', $tgl);
        echo $date."<br>";
        $tgl_awal = date("Y-m-d", strtotime(substr($date,0,10)));
        echo $tgl_awal."<br>";
        $tgl_akhir = date("Y-m-d", strtotime(substr($date,13)));
        echo $tgl_akhir."<br>";
        $date_now = date('Y-m-d H:i:s');
        $random_id = randString(10);
        $is_unique = false;

        while (!$is_unique) {
            $select = mysqli_query($koneksi, "SELECT * FROM peminjaman_aset WHERE ID_PEMINJAMAN = '".$random_id."'");
            if (mysqli_num_rows($select) == 0) {  
                // if you don't get a result, then you're good
                $is_unique = true;
                ECHO "INSERT INTO peminjaman_aset (ID_PEMINJAMAN, ID_USER, ID_KOMISI, KETERANGAN_PINJAM, HASIL_PENGAJUAN, TANGGAL_PENGAJUAN, TANGGAL_PEMINJAMAN, TANGGAL_PENGEMBALIAN, STATUS_PEMINJAMAN) VALUES ('".$random_id."','".$id_user."','".$id_komisi."','".$keterangan."','Pending','".$date_now."','".$tgl_awal."','".$tgl_akhir."','Aktif') <br>";
                $query = mysqli_query($koneksi, "INSERT INTO peminjaman_aset (ID_PEMINJAMAN, ID_USER, ID_KOMISI, KETERANGAN_PINJAM, HASIL_PENGAJUAN, TANGGAL_PENGAJUAN, TANGGAL_PEMINJAMAN, TANGGAL_PENGEMBALIAN, STATUS_PEMINJAMAN) VALUES ('".$random_id."','".$id_user."','".$id_komisi."','".$keterangan."','Pending','".$date_now."','".$tgl_awal."','".$tgl_akhir."','Aktif')");
                if(!$query) {
                    $_SESSION['error-msg'] = mysqli_error($koneksi);
                    echo $_SESSION['error-msg'];
                    break;
                }
            }
            else {
                $random_id = randString(10);
            }
        }

        foreach($_SESSION['item_pinjam'] as $select => $value){
            $random_id_item = randString(10);
            $is_unique_new = false;

            while (!$is_unique_new) {
                $select = mysqli_query($koneksi, "SELECT * FROM detail_peminjaman WHERE ID_DETIL_PINJAM = '".$random_id_item."'");
                if (mysqli_num_rows($select) == 0) {
                    // if you don't get a result, then you're good
                    $is_unique_new = true;
                    echo "INSERT INTO detail_peminjaman (ID_DETIL_PINJAM, ID_PEMINJAMAN, ID_ASET) VALUES ('".$random_id_item."','".$random_id."','".$value['id_aset']."') <br>";
                    $insert = mysqli_query($koneksi, "INSERT INTO detail_peminjaman (ID_DETIL_PINJAM, ID_PEMINJAMAN, ID_ASET) VALUES ('".$random_id_item."','".$random_id."','".$value['id_aset']."')");
                    if(!$insert) {
                        $_SESSION['error-msg'] = mysqli_error($koneksi);
                        echo $_SESSION['error-msg'];
                        //header("location: ../pengadaan/?error");
                        $success = false;
                        break;
                    }
                }
                else {
                    $random_id_item = randString(10);
                }
            }
        }

    }
?>
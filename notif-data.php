<?php
session_start();
include "connection.php";

if (isset($_POST['id_notif'])) {
    $id = $_POST['id_notif'];
    if($_SESSION['role'] == "Peminjam") {
        $query = mysqli_query($koneksi, "UPDATE notifikasi n JOIN peminjaman_aset p ON n.ID_REF = p.ID_PEMINJAMAN SET n.READ_NOTIF = 1 WHERE n.TABEL_REF = 'peminjaman_aset' AND p.ID_USER = '".$id."'");
        // echo "UPDATE notifikasi n JOIN peminjaman_aset p ON n.ID_REF = p.ID_PEMINJAMAN SET n.READ_NOTIF = 1 WHERE n.TABEL_REF = 'peminjaman_aset' AND p.ID_USER = '".$id."'";
    }
    if($_SESSION['role'] == "Anggota MJ") {
        if($_POST['tabel'] == "pengadaan") {
            $query = mysqli_query($koneksi, "UPDATE notifikasi n JOIN pengadaan_aset p ON n.ID_REF = p.ID_PENGADAAN SET n.READ_NOTIF = 1 WHERE n.TABEL_REF = 'pengadaan_aset' AND p.ID_USER = '".$id."'");
            // echo "UPDATE notifikasi n JOIN pengadaan_aset p ON n.ID_REF = p.ID_PENGADAAN SET n.READ_NOTIF = 0 WHERE n.TABEL_REF = 'pengadaan_aset' AND p.ID_USER = '".$id."' \n";
        }
        if($_POST['tabel'] == "penghapusan") {
            $query2 = mysqli_query($koneksi, "UPDATE notifikasi n JOIN penghapusan_aset p ON n.ID_REF = p.ID_PENGHAPUSAN SET n.READ_NOTIF = 1 WHERE n.TABEL_REF = 'peminjaman_aset' AND p.ID_USER = '".$id."'");
            // echo "UPDATE notifikasi n JOIN penghapusan_aset p ON n.ID_REF = p.ID_PENGHAPUSAN SET n.READ_NOTIF = 0 WHERE n.TABEL_REF = 'peminjaman_aset' AND p.ID_USER = '".$id."'";
        }
    }
    if(isset($_SESSION['notif'])){
        unset($_SESSION['notif']);
    }
}
?>
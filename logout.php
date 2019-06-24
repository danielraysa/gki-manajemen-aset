<?php
    //if (isset($_GET['logout'])) {
        session_start();
        if (isset($_SESSION['notifikasi-pengadaan'])) {
            $pengadaan = $_SESSION['notifikasi-pengadaan'];
            echo "hapus 1 \n";
            print_r($pengadaan);
        }
        if (isset($_SESSION['notifikasi-peminjaman'])) {
            $peminjaman = $_SESSION['notifikasi-peminjaman'];
            echo "hapus 2 \n";
        }
        if (isset($_SESSION['notifikasi-penghapusan'])) {
            $penghapusan = $_SESSION['notifikasi-penghapusan'];
            echo "hapus 3 \n";
        }
        session_destroy();
        session_start();
        if (isset($pengadaan)) {
            $_SESSION['notifikasi-pengadaan'] = $pengadaan;
            echo "kembali 1 \n";
            print_r($_SESSION['notifikasi-pengadaan']);
        }
        if (isset($peminjaman)) {
            $_SESSION['notifikasi-peminjaman'] = $peminjaman;
            echo "kembali 2 \n";
        }
        if (isset($penghapusan)) {
            $_SESSION['notifikasi-penghapusan'] = $penghapusan;
            echo "kembali 3 \n";
        }
        header("location:login/");
    //}
?>
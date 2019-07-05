<?php
    session_start();
    if (!isset($_SESSION['login_user'])) {
      header("location:../index.php");
    }
    if(!isset($_SESSION['item_pinjam'])) {
      $_SESSION['item_pinjam'] = array();
    }
    setlocale (LC_TIME, 'INDONESIAN');
    date_default_timezone_set("Asia/Jakarta");
    $dir = basename(__DIR__);
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "css-script.php"; ?>
    <?php include "../connection.php"; ?>
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
    <?php
      include "header.php";
      include "main-sidebar.php";
      if($_SESSION['role'] == "Peminjam") {
        /* if(isset($_GET['edit'])){
          include "edit-peminjaman.php";
        }
        else {
          include "content.php";
        } */
        include "content.php";
      }
      if($_SESSION['role'] == "Anggota MJ") {
        include "approval.php";
      }
    ?>
    
    <?php include "../footer.php"; ?>
    <?php include "../control-sidebar.php"; ?>
    </div>
    <?php include "js-script.php"; ?>
    <?php
      if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $data = mysqli_query($koneksi, "SELECT * FROM peminjaman_aset WHERE ID_PEMINJAMAN = '".$id."'");
        $fetch = mysqli_fetch_array($data);
        $date1 = date("d/m/Y", strtotime($fetch['TANGGAL_PEMINJAMAN']));
        $date2 = date("d/m/Y", strtotime($fetch['TANGGAL_PENGEMBALIAN']));
        $new_date = $date1." - ".$date2;
        ?>
        <script>
            $('#komisi_peminjam').val('<?php echo $fetch['ID_KOMISI']; ?>');
            $("#komisi_peminjam").select2("destroy").select2();
            $('#nohp').val('<?php echo $fetch['NO_HP']; ?>');
            $('#keterangan').val('<?php echo $fetch['KETERANGAN_PINJAM']; ?>');
            //$('#reservation').daterangepicker({ startDate: '<?php echo $date1; ?>', endDate: '<?php echo $date2; ?>' });
            $('#reservation').data('daterangepicker').setStartDate('<?php echo $date1; ?>');
            $('#reservation').data('daterangepicker').setEndDate('<?php echo $date2; ?>');
        </script>
        <?php
      }
    ?>
</body>
</html>
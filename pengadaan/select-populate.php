<?php
    include "../connection.php";

    if(isset($_POST['load_komisi'])){ ?>
        <option value="">Pilih Komisi</option>
        <?php
            $select = mysqli_query($koneksi,"SELECT * FROM komisi_jemaat");
            while($row = mysqli_fetch_array($select)){ 
        ?>
            <option value="<?php echo $row['ID_KOMISI']; ?>" data-komisi="<?php echo $row['KODE_KOMISI']; ?>"><?php echo $row['NAMA_KOMISI']." (".$row['KODE_KOMISI'].")"; ?></option>
        <?php
        }
    }
    if(isset($_POST['load_merk'])){
        $select = mysqli_query($koneksi,"SELECT * FROM merk"); ?>
        <option value="">Pilih Merk</option>
        <?php
        while($row = mysqli_fetch_array($select)){ ?>
            <option value="<?php echo $row['ID_MERK']; ?>"><?php echo $row['NAMA_MERK']; ?></option>
        <?php
        }
    }
    if(isset($_POST['load_ruangan'])){
        $select = mysqli_query($koneksi,"SELECT * FROM ruangan"); ?>
        <option value="">Pilih Komisi</option>
        <?php
        while($row = mysqli_fetch_array($select)){ ?>
            <option value="<?php echo $row['ID_RUANGAN']; ?>" data-ruang="<?php echo $row['KODE_RUANGAN']; ?>"><?php echo $row['NAMA_RUANGAN']; ?></option>
        <?php
        }
    }
    if(isset($_POST['load_barang'])){ ?>
        <option>Pilih jenis barang</option>
        <?php
            $data = mysqli_query($koneksi, "SELECT * FROM barang");
            while ($row = mysqli_fetch_array($data)) {
        ?>
            <option value="<?php echo $row['ID_BARANG']; ?>"><?php echo $row['NAMA_BARANG']; ?></option>
        <?php
        }
    }
?>
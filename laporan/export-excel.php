<?php
    session_start();
    include "../connection.php";

	// untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
	// membuat koneksi
	$conn = mysqli_connect($servername, $username, $password, $database);
	//Akhir koneksi
	$query = mysqli_query($conn, "SELECT * FROM maintenance where Plat_Nomer ='".$plat."' ");
	
    $output .= "
    <table class='table' bordered='1'>
    <tr>
        <td colspan='10'></td>
    </tr>
    <tr>
        <td>Nomor Maintenance</td>
        <td>Plat Nomor</td>
        <td>Tanggal Planning</td>
        <td>Tanggal Process</td>
        <td>Tanggal Finish</td>
        <td>Status</td>
        <td>Kilometer</td>
        <td>Biaya Akhir</td>
        <td>Kerusakan</td>
        <td>Vendor</td>
        <td>Biaya</td>
        <td>Kode Aset</td>
        <td>PIC</td>
	</tr>";
	while($row = mysqli_fetch_array($query)) {
	$output .= "
	<tr>
        <td>".$row['No_Maintenance']."</td>
        <td>".$row['Plat_Nomer']."</td>
        <td>".$row['Tgl_Planning']."</td>
        <td>".$row['Tgl_Proces']."</td>
        <td>".$row['Tgl_Finish']."</td>
        <td>".$row['Status']."</td>
        <td>".$row['Kilometer']."</td>
        <td>".$row['biaya_akhir']."</td>
        <td>".$row['Kerusakan']."</td>
        <td>".$row['vendor']."</td>
        <td>".$row['biaya']."</td>
        <td>".$row['Kode_Aset']."</td>
        <td>".$row['PIC']."</td>
	</tr>
	";
	}
    $output .= "</table>";
    header("Content-Type: application/xlsx");
    header("Default-Charset : utf-8 ");
    header("Content-Disposition: attachment; filename=".$namafile.".xls");
    echo $output;

?>
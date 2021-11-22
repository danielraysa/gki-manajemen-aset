<?php
    session_start();
    if (!isset($_SESSION['login_user'])) {
        header("location:../index.php");
        exit;
    }
    include "../connection.php";

    $dir = basename(__DIR__);
	$_kelompok = mysqli_query($koneksi, "SELECT * FROM kelompok_jemaat");
	$query = mysqli_query($koneksi,"SELECT * FROM data_jemaat");
?>
<!DOCTYPE html>
<html>

<head>
	<?php include "../css-script.php"; ?>
</head>

<body class="hold-transition skin-purple sidebar-mini">
	<div class="wrapper">
		<?php
        include "../header.php";
        include "../main-sidebar.php";
    ?>
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Data Jemaat
				</h1>

			</section>

			<!-- Main content -->
			<section class="content">
				<?php
				if(isset($_GET['success'])) {
				?>
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-check"></i> Sukses!</h4>
					Berhasil menambahkan data baru.
				</div>
				<?php
				}
				if(isset($_GET['edit'])) {
				?>
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-pencil"></i> Sukses!</h4>
					Berhasil mengubah data.
				</div>
				<?php
				}
				if(isset($_GET['delete'])) {
				?>
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-trash"></i> Sukses!</h4>
					Berhasil menghapus data.
				</div>
				<?php
				}
				if(isset($_GET['error'])) {
				?>
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-check"></i> Alert!</h4>
					<?php echo $_SESSION['error-msg']; ?>
				</div>
				<?php
				}
				?>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="box">
							<div class="box-body">
								<button type="button" class="btn btn-primary" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-test"><i class="fa fa-plus-circle"></i> Tambah Data</button>
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-hover" style="width: 100%">
										<thead>
											<tr>
												<th>No. Induk</th>
												<th>Nama Lengkap</th>
												<th>Jenis Kelamin</th>
												<th>Kelompok Jemaat</th>
												<th>No. Telp</th>
												<th>Alamat</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												while($row = mysqli_fetch_array($query)) {
											?>
											<tr>
												<td><?php echo $row['no_induk'] == null ? '-' : str_pad($row['no_induk'], 6, "0", STR_PAD_LEFT); ?></td>
												<td><?php echo $row['nama_lengkap']; ?></td>
												<td><?php echo $row['jenis_kelamin']; ?></td>
												<td><?php echo $row['kelompok_jemaat']; ?></td>
												<td><?php echo $row['no_telp']; ?></td>
												<td><?php echo $row['alamat']; ?></td>
												<td>
													<button class="btn btn-warning modalLink" data-toggle="modal" data-target="#modal-test" data-id="<?php echo $row['id_jemaat']; ?>"><i class="fa fa-pencil"></i> Edit</button>
												</td>
											</tr>
											<?php
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
						<!-- /.box-body -->
						</div>
						<!-- /.box -->
					</div>
					<!-- /.col -->
				</div>
			<!-- /.row -->
			<!-- Modal -->
				<div class="modal fade" id="modal-test">
					<div class="modal-dialog modal-lg">
						<?php include "modal-update.php"; ?>
					</div>
				</div>
				
			</section>
			<!-- /.content -->
		</div>
	<!-- /.content-wrapper -->
	<?php include "../footer.php"; ?>
	<?php include "../control-sidebar.php"; ?>
	</div>
	<?php include "js-script.php"; ?>
	<?php
    if (isset($_SESSION['success_login'])) {
        unset($_SESSION['success_login']);
    ?>
	<script>
		const toast = swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});

		toast({
			type: 'success',
			title: 'Signed in successfully'
		})
	</script>
	<?php
    }
    ?>
	<script>
		var tabel = null;
		$(document).ready(function() {
			tabel = $('#example1').DataTable({
				"processing": true,
				"serverSide": true,
				"ordering": true, // Set true agar bisa di sorting
				"order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
				"ajax":
				{
					"url": "ajax.php", // URL file untuk proses select datanya
					"type": "POST"
				},
				"deferRender": true,
				"aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
				"columns": [
					{ "data": "nis" }, // Tampilkan nis
					{ "data": "nama" },  // Tampilkan nama
					{ "render": function ( data, type, row ) {  // Tampilkan jenis kelamin
							var html = ""
							if(row.jenis_kelamin == 1){ // Jika jenis kelaminnya 1
								html = 'Laki-laki' // Set laki-laki
				}else{ // Jika bukan 1
								html = 'Perempuan' // Set perempuan
							}
							return html; // Tampilkan jenis kelaminnya
						}
					},
					{ "data": "telp" }, // Tampilkan telepon
					{ "data": "alamat" }, // Tampilkan alamat
					{ "render": function ( data, type, row ) { // Tampilkan kolom aksi
							var html  = "<a href=''>EDIT</a> | "
							html += "<a href=''>DELETE</a>"
							return html
						}
					},
				],
			});
		});
	</script>
</body>

</html>
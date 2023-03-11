<?php
    session_start();
    if (!isset($_SESSION['login_user'])) {
        header("location:../index.php");
        exit;
    }
    include "../connection.php";

    $dir = basename(__DIR__);
	// $query = mysqli_query($koneksi,"SELECT * FROM data_jemaat");
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
				<h1>Data Jemaat</h1>
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
								<div class="row">
									<div class="col-lg-4 col-sm-3">
									<button type="button" id="btnTambah" class="btn btn-primary" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-form"><i class="fa fa-plus-circle"></i> Tambah Data</button>
									<button type="button" class="btn btn-success" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-download"><i class="fa fa-download"></i> Download</button>
									<button type="button" class="btn btn-info" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-import"><i class="fa fa-upload"></i> Import</button>
									</div>
									<div class="col-lg-3 col-sm-3">
										<select name="filter" id="filter" class="form-control select2" style="width: 100%">
											<option selected disabled>Filter:</option>
										</select>
									</div>
									<div class="col-lg-3 col-sm-3">
										<input type="text" id="filter_value" class="form-control" name="filter_value" />
									</div>
									<div class="col-lg-2 col-sm-3">
										<button id="search" type="button" name="search" class="btn btn-success"><i class="fa fa-search"></i> Filter</button>
										<button id="reset" type="reset" class="btn btn-danger">Reset</button>
									</div>
								</div>
								<div class="table-responsive">
									<table id="exampleAjax" class="table table-bordered table-hover" style="width: 100%">
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
												//while($row = mysqli_fetch_array($query)) {
											?>
											<!-- <tr>
												<td><?php // echo $row['no_induk'] == null ? '-' : str_pad($row['no_induk'], 6, "0", STR_PAD_LEFT); ?></td>
												<td><?php // echo $row['nama_lengkap']; ?></td>
												<td><?php // echo $row['jenis_kelamin']; ?></td>
												<td><?php // echo $row['kelompok_jemaat']; ?></td>
												<td><?php // echo $row['no_telp']; ?></td>
												<td><?php // echo $row['alamat']; ?></td>
												<td>
													<button class="btn btn-warning modalLink" data-toggle="modal" data-target="#modal-form" data-id="<?php //echo $row['id_jemaat']; ?>"><i class="fa fa-pencil"></i> Edit</button>
												</td>
											</tr> -->
											<?php
												//}
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
				<div class="modal fade" id="modal-form">
					<div class="modal-dialog modal-lg">
						<?php include "modal-update.php"; ?>
					</div>
				</div>
				<div class="modal fade" id="modal-download">
					<div class="modal-dialog">
						<div class="modal-content">
							<form action="download.php" method="post">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span></button>
								<h4 class="modal-title">Download</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label>Pilih Kelompok</label>
									<select name="kelompok" class="form-control select2" style="width: 100%;">
										<option value="all">Semua</option>
										<?php 
										$_kelompok = mysqli_query($koneksi, "SELECT * FROM kelompok_jemaat");
										while ($_kel = mysqli_fetch_assoc($_kelompok)): ?>
										<option value="<?php echo $_kel['nama_kelompok']; ?>"><?php echo $_kel['nama_kelompok']; ?></option>
										<?php endwhile; ?>
									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-success">Download</button>
							</div>
							</form>
						</div>
					</div>
				</div>
				<div class="modal fade" id="modal-import">
					<div class="modal-dialog">
						<div class="modal-content">
							<form action="import.php" method="post" enctype="multipart/form-data">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span></button>
								<h4 class="modal-title">Import</h4>
							</div>
							<div class="modal-body">
								<p>Format file/isian yang dapat diimport dapat <a href="import-example.xlsx">didownload disini</a>. Harap perhatikan hal berikut ini:</p>
								<ol>
									<li>Kolom jenis kelamin diisi <code>L</code> (laki-laki) atau <code>P</code> (perempuan)</li>
									<li>Kolom isian tanggal (tanggal lahir, nikah, atestasi, dll) diisi dengan format <code>YYYY-MM-DD</code> (tahun, bulan, hari dalam angka)</li>
								</ol>
								<div class="form-group">
									<label>Upload file (.xls / .xlsx)</label>
									<input type="file" name="file_import" accept=".xls,.xlsx" class="form-control" />
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-success">Upload</button>
							</div>
							</form>
						</div>
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
</body>

</html>
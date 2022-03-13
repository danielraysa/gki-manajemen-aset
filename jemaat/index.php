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
								<div class="row">
									<div class="col-lg-2 col-sm-3">
									<button type="button" id="btnTambah" class="btn btn-primary" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-form"><i class="fa fa-plus-circle"></i> Tambah Data</button>
									</div>
									<div class="col-lg-3 col-sm-3">
										<select name="filter" id="filter" class="form-control select2" style="width: 100%">
											<option selected disabled>Filter:</option>
										</select>
									</div>
									<div class="col-lg-3 col-sm-3">
										<input type="text" id="filter_value" class="form-control" name="filter_value" />
									</div>
									<div class="col-lg-3 col-sm-3">
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
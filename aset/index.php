<?php
    session_start();
    if (!isset($_SESSION['login_user'])) {
        header("location:../index.php");
        exit;
    }
    include "../connection.php";

    $dir = basename(__DIR__);
	$_status = mysqli_query($koneksi, "SELECT * FROM status");
	$_merk = mysqli_query($koneksi, "SELECT * FROM merk");
	$_ruangan = mysqli_query($koneksi, "SELECT * FROM ruangan");
	$_komisi = mysqli_query($koneksi, "SELECT * FROM komisi_jemaat");
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
					Data Aset
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
							<div class="box-header">

							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-hover" style="width: 100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Kode Aset</th>
												<th>Nama Aset</th>
												<th>Merk</th>
												<th>Ruangan</th>
												<th>Komisi</th>
												<th>Status</th>
												<!-- <th>Action</th> -->
											</tr>
										</thead>
										<tbody>
											<?php
												//$query = mysqli_query($koneksi,"SELECT d.ID_ASET, d.KODE_ASET, d.NAMA_ASET, m.NAMA_MERK, d.HARGA_PEMBELIAN, d.TANGGAL_PEMBELIAN, r.NAMA_RUANGAN, k.NAMA_KOMISI, d.MASA_MANFAAT, d.STATUS_ASET FROM daftar_aset d JOIN merk m ON d.ID_MERK = m.ID_MERK JOIN ruangan r ON d.ID_RUANGAN = r.ID_RUANGAN JOIN komisi_jemaat k ON d.ID_KOMISI = k.ID_KOMISI");
												$query = mysqli_query($koneksi,"SELECT * FROM daftar_baru JOIN kategori ON daftar_baru.kode_jenis = kategori.kode_kategori");
												$a = 1;
												while($row = mysqli_fetch_array($query)) {
											?>
											<tr>
												<td><?php echo $a; ?></td>
												<td><?php echo $row['KODE_BARANG']; ?></td>
												<td><?php echo $row['NAMA_BARANG']; ?></td>
												<td><?php echo $row['MERK']; ?></td>
												<td><?php echo $row['LOKASI_BARANG']; ?></td>
												<td><?php echo $row['KOMISI']; ?></td>
												<td><?php echo $row['STATUS_ASET']; ?></td>
												<!-- <td>
													<button class="btn btn-warning modalLink" data-toggle="modal" data-target="#modal-test" data-id="<?php echo $row['ID_ASET']; ?>"><i class="fa fa-pencil"></i> Edit</button>
												</td> -->
											</tr>
											<?php
												$a++;
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
				<div class="modal fade" id="modal-delete">
					<div class="modal-dialog modal-sm">
						<form action="form-action.php" method="post">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span></button>
									<h4 class="modal-title">Hapus Data Kategori</h4>
								</div>
								<div class="modal-body">
									<input type="hidden" id="id-komisi" class="form-control" name="id_komisi" value="">
									Hapus item ini?
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
									<button type="submit" class="btn btn-primary" name="delete">Hapus</button>
								</div>
							</div>
						</form>
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
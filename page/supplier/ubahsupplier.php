<?php
$id_supplier = $_GET['id_supplier'];
$sql2 = $koneksi->query("SELECT * FROM tb_supplier WHERE id_supplier = '$id_supplier'");
$tampil = $sql2->fetch_assoc();
?>

<div class="container-fluid">
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Ubah Supplier</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="body">
					<form method="POST" enctype="multipart/form-data">
						<label for="">Kode Supplier</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="id_supplier" value="<?= $tampil['id_supplier']; ?>" class="form-control" required disabled />

							</div>
						</div>

						<label for="">Nama Supplier</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama_supplier" value="<?= $tampil['nama_supplier']; ?>" class="form-control" required />

							</div>
						</div>

						<label for="">Alamat</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="alamat" value="<?= $tampil['alamat']; ?>" class="form-control" required />

							</div>
						</div>

						<label for="">Telepon</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="telepon" value="<?= $tampil['telepon']; ?>" class="form-control" required />

							</div>
						</div>
						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
					</form>
					<?php
					if (isset($_POST['simpan'])) {
						$nama_supplier = $_POST['nama_supplier'];
						$alamat = $_POST['alamat'];
						$telepon = $_POST['telepon'];

						$sql = $koneksi->query("UPDATE tb_supplier set nama_supplier='$nama_supplier', alamat='$alamat', telepon='$telepon' WHERE id_supplier='$id_supplier'");

						if ($sql) :
					?>

							<script type="text/javascript">
								alert("Data Berhasil Diubah");
								window.location.href = "?page=supplier";
							</script>

					<?php
						endif;
					}
					?>
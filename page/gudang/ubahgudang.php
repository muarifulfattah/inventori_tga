<?php
$id_barang = $_GET['id_barang'];
$sql2 = $koneksi->query("SELECT * FROM gudang WHERE id_barang = '$id_barang'");
$tampil = $sql2->fetch_assoc();

$level = $tampil['level'];
?>

<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Ubah User</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">


				<div class="body">

					<form method="POST" enctype="multipart/form-data">

						<label for="">Kode Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="id_barang" class="form-control" disabled id="id_barang" value="<?php echo $tampil['id_barang']; ?>" required />
							</div>
						</div>


						<label for="">Nama Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama_barang" value="<?php echo $tampil['nama_barang']; ?>" class="form-control" required />
							</div>
						</div>



						<label for="">Jenis Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="id_jenis_barang" class="form-control" required />
								<?php

								$sql = $koneksi->query("SELECT * FROM jenis_barang ORDER BY id");
								while ($data = $sql->fetch_assoc()) {
									if ($data['id'] == $tampil['id_jenis_barang']) {
										echo "<option value='$data[id]' selected>$data[id] - $data[jenis_barang]</option>";
									} else {
										echo "<option value='$data[id]'>$data[id] - $data[jenis_barang]</option>";
									}
								}
								?>
								</select>
							</div>
						</div>

						<label for="">Jumlah</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="jumlah" class="form-control" id="jumlah" placeholder="Masukkan Jumlah Barang" value="<?= $tampil['jumlah']; ?>" required />
							</div>
						</div>


						<label for="">Satuan Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="satuan" class="form-control" />
								<?php
								$sql = $koneksi->query("SELECT * FROM satuan ORDER BY id");
								while ($data = $sql->fetch_assoc()) {
									if ($data['satuan'] == $tampil['satuan']) {
										echo "<option value='$data[id].$data[satuan]' selected>$data[satuan]</option>";
									} else {
										echo "<option value='$data[id].$data[satuan]'>$data[satuan]</option>";
									}
								}
								?>
								</select>
							</div>
						</div>

						<label for="">Harga Satuan</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="harga_satuan" class="form-control" id="harga_satuan" required placeholder="Masukkan Harga Satuan" value="<?= $tampil['harga_satuan']; ?>" />
							</div>
						</div>

						<label for="">Gambar Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="file" name="image" class="form-control" id="image" placeholder="Masukkan Harga Satuan" />
							</div>
						</div>
						<input type="hidden" name="old_image" value="<?= $tampil['image']; ?>">

						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
					</form>
					<?php
					if (isset($_POST['simpan'])) {
						$nama_barang = $_POST['nama_barang'];
						$id_jenis_barang = $_POST['id_jenis_barang'];
						$jumlah = $_POST['jumlah'];
						$harga_satuan = $_POST['harga_satuan'];
						$pecah_jenis = explode(".", $id_jenis_barang);

						$satuan = $_POST['satuan'];
						$pecah_satuan = explode(".", $satuan);

						$satuan = $pecah_satuan[1];

						if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
							$image = strtotime(date('d-m-Y')) . '-' . $_FILES['image']['name'];
							$lokasi = $_FILES['image']['tmp_name'];
							$upload = move_uploaded_file($lokasi, "img/" . $image);
						} else {
							$image = $_POST['old_image'];
						}

						$sql = $koneksi->query("UPDATE gudang SET nama_barang='$nama_barang', id_jenis_barang='$id_jenis_barang', satuan='$satuan', jumlah='$jumlah', harga_satuan='$harga_satuan', image='$image' WHERE id_barang='$id_barang'");

						if ($sql2) {
					?>

							<script type="text/javascript">
								alert("Data Berhasil Diubah");
								window.location.href = "?page=gudang";
							</script>

					<?php
						}
					}
					?>
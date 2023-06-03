<?php
$id = $_GET['id'];
$sql2 = $koneksi->query("SELECT * FROM barang_masuk WHERE id = '$id'");
$tampil = $sql2->fetch_assoc();

$level = $tampil['level'];
?>

<script>
	function sum() {
		var check = document.getElementById('stok');
		if (check) {
			var stok = check.innerHTML;
		}
		var jumlah = document.getElementById('jumlah').value;
		if (jumlah == '') {
			jumlah = 0;
		}
		var result = parseInt(stok) + parseInt(jumlah);
		if (!isNaN(result)) {
			document.getElementById('jumlah_stok').value = result;
		}
	}
	document.addEventListener("DOMContentLoaded", function(event) {
		sum();
	})
</script>
<div class="container-fluid">
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Ubah Barang Masuk</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="body">
					<form method="POST" enctype="multipart/form-data">
						<label for="">ID Transaksi</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="id" class="form-control" id="id" value="<?= $tampil['id']; ?>" disabled />
							</div>
						</div>
						<label for="">Tanggal Masuk</label>
						<div class="form-group">
							<div class="form-line">
								<input type="date" name="tanggal_masuk" class="form-control" id="tanggal_masuk" value="<?= $tampil['tanggal']; ?>" required />
							</div>
						</div>
						<label for="">Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="id_barang" id="cmb_barang" class="form-control select2-on" required />
								<option value="">--- Pilih Barang ---</option>
								<?php
								$sql = $koneksi->query("SELECT * FROM gudang ORDER BY id_barang");
								while ($data = $sql->fetch_assoc()) {
									if ($tampil['id_barang'] == $data['id_barang']) {
										echo "<option value='$data[id_barang]' selected>$data[id_barang] - $data[nama_barang]</option>";
									} else {
										echo "<option value='$data[id_barang]'>$data[id_barang] - $data[nama_barang]</option>";
									}
								}
								?>
								</select>
								<div class="tampung">
									<div class="form-label">Jumlah Stok Gudang : <span id="stok">
											<?php
											$stok_gudang = $koneksi->query("SELECT * FROM gudang WHERE id_barang='$tampil[id_barang]'");
											$data_gudang = $stok_gudang->fetch_assoc();
											echo $data_gudang['jumlah'];
											?>
										</span></div>
								</div>
							</div>
						</div>


						<label for="">Jumlah</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="jumlah" id="jumlah" onkeyup="sum()" class="form-control" required value="<?= $tampil['jumlah']; ?>" />
								<input type="hidden" name="jumlah_lama" value="<?= $tampil['jumlah']; ?>">
							</div>
						</div>

						<label for="jumlah_stok">Total Stok</label>
						<div class="form-group">
							<div class="form-line">
								<input readonly="readonly" name="jumlah_stok" id="jumlah_stok" type="number" class="form-control" required>
							</div>
						</div>

						<div class="tampung1"></div>

						<label for="">Supplier</label>
						<div class="form-group">
							<div class="form-line">
								<select name="id_supplier" class="form-control select2-on" required />
								<?php
								$sql = $koneksi->query("SELECT * FROM tb_supplier ORDER BY nama_supplier");
								while ($data = $sql->fetch_assoc()) {
									if ($tampil['id_supplier'] == $data['id_supplier']) {
										echo "<option value='$data[id_supplier]' selected>$data[nama_supplier]</option>";
									} else {
										echo "<option value='$data[id_supplier]'>$data[nama_supplier]</option>";
									}
								}
								?>
								</select>
							</div>
						</div>
						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

					</form>

					<?php
					if (isset($_POST['simpan'])) {
						$tanggal = $_POST['tanggal_masuk'];
						$id_barang = $_POST['id_barang'];
						if (!isset($_POST['id_barang'])) {
							echo "<script type='text/javascript'>
										alert('Simpan Data Gagal!!');
										window.location.href = '?page=barangmasuk';
									</script>";
						}

						$jumlah = $_POST['jumlah'];
						$satuan = $_POST['satuan'];
						$id_supplier = $_POST['id_supplier'];
						if (!isset($_POST['id_supplier'])) {
							echo "<script type='text/javascript'>
										alert('Simpan Data Gagal!!');
										window.location.href = '?page=barangmasuk';
									</script>";
						}

						$sql = $koneksi->query("UPDATE barang_masuk SET tanggal='$tanggal', id_barang='$id_barang', jumlah='$jumlah', satuan='$satuan', id_supplier='$id_supplier' WHERE id='$id'");

						$jumlah_stok = $_POST['jumlah_stok'];
						$data_gudang = $koneksi->query("SELECT * FROM gudang WHERE id_barang='$tampil[id_barang]'");
						$data_gudang = $data_gudang->fetch_assoc();
						$stok_lama = $data_gudang['jumlah'] - $_POST['jumlah_lama'];

						$koneksi->query("UPDATE gudang SET jumlah='$stok_lama' WHERE id_barang='$tampil[id_barang]'");

						$koneksi->query("UPDATE gudang SET jumlah='$jumlah_stok' WHERE id_barang='$id_barang'");

						if ($sql) {
					?>
							<script type="text/javascript">
								alert("Data Berhasil Diubah");
								window.location.href = "?page=barangmasuk";
							</script>
					<?php
						}
					}
					?>
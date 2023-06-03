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
  </script>

  <?php

	$koneksi = new mysqli("localhost", "root", "", "inventori");
	$no = mysqli_query($koneksi, "SELECT id FROM barang_masuk ORDER BY id DESC");
	$idtran = mysqli_fetch_array($no);
	$kode = $idtran['id'];


	$urut = substr($kode, 8);
	$tambah = (int) $urut + 1;
	$bulan = date("m");
	$tahun = date("y");


	$format = "TRM-" . $bulan . $tahun .  sprintf('%04d', $tambah);
	$tanggal_masuk = date("Y-m-d");

	?>

  <div class="container-fluid">
  	<!-- DataTales Example -->
  	<div class="card shadow mb-4">
  		<div class="card-header py-3">
  			<h6 class="m-0 font-weight-bold text-primary">Tambah Barang Masuk</h6>
  		</div>
  		<div class="card-body">
  			<div class="table-responsive">
  				<div class="body">
  					<form method="POST" enctype="multipart/form-data">
  						<label for="">Id Transaksi</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="id" class="form-control" id="id" value="<?php echo $format; ?>" readonly />
  							</div>
  						</div>
  						<label for="">Tanggal Masuk</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="date" name="tanggal_masuk" class="form-control" id="tanggal_masuk" value="<?php echo $tanggal_masuk; ?>" required />
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
										echo "<option value='$data[id_barang]'>$data[id_barang] - $data[nama_barang]</option>";
									}
									?>
  								</select>
  								<div class="tampung"></div>
  							</div>
  						</div>


  						<label for="">Jumlah</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="number" name="jumlah" id="jumlah" onkeyup="sum()" class="form-control" required />
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
										echo "<option value='$data[id_supplier]'>$data[nama_supplier]</option>";
									}
									?>
  								</select>
  							</div>
  						</div>
  						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

  					</form>

  					<?php

						if (isset($_POST['simpan'])) {
							$id = $_POST['id'];
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

							$sql = $koneksi->query("INSERT INTO barang_masuk (id, tanggal, id_barang, jumlah, satuan, id_supplier) VALUES('$id','$tanggal','$id_barang','$jumlah','$satuan','$id_supplier')");

							$stok_baru = $_POST['jumlah_stok'];
							$koneksi->query("UPDATE gudang SET jumlah='$stok_baru' WHERE id_barang='$id_barang'");

							if ($sql) {
						?>
  							<script type="text/javascript">
  								alert("Simpan Data Berhasil");
  								window.location.href = "?page=barangmasuk";
  							</script>
  					<?php
							}
						}


						?>
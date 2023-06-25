<?php
$koneksi = new mysqli("localhost", "root", "", "inventori");
$no = mysqli_query($koneksi, "SELECT id_barang FROM gudang ORDER BY id_barang DESC");
$kdbarang = mysqli_fetch_array($no);
$kode = $kdbarang['id_barang'];


$urut = substr($kode, 8);
$tambah = (int) $urut + 1;
$bulan = date("m");
$tahun = date("y");

$format = "BAR-" . $bulan . $tahun .  sprintf('%04d', $tambah);
?>

<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tambah Barang</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="body">
					<form method="POST" enctype="multipart/form-data">
						<label for="">Kode Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="id_barang" class="form-control" id="id_barang" value="<?php echo $format; ?>" readonly />
							</div>
						</div>

						<label for="">Nama Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama_barang" class="form-control" placeholder="Masukkan Nama Barang" required />
							</div>
						</div>

						<label for="">Jenis Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="id_jenis_barang" class="form-control select2-on" required />
								<?php
								$sql = $koneksi->query("SELECT * FROM jenis_barang ORDER BY id");
								while ($data = $sql->fetch_assoc()) {
									echo "<option value='$data[id]'>$data[id] - $data[jenis_barang]</option>";
								}
								?>
								</select>
							</div>
						</div>

						<label for="">Jumlah</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="jumlah" class="form-control" id="jumlah" placeholder="Masukkan Jumlah Barang" required />
							</div>
						</div>

						<label for="">Satuan Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="satuan" class="form-control select2-on" required />
								<?php
								$sql = $koneksi->query("select * from satuan order by id");
								while ($data = $sql->fetch_assoc()) {
									echo "<option value='$data[id].$data[satuan]'>$data[satuan]</option>";
								}
								?>
								</select>
							</div>
						</div>

						<label for="">Harga Satuan</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="harga_satuan" class="form-control" id="harga_satuan" required placeholder="Masukkan Harga Satuan" />
							</div>
						</div>
						<label for="">Gambar Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="file" name="image" class="form-control" id="image" required placeholder="Masukkan Harga Satuan" />
							</div>
						</div>

						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
					</form>

					<?php
					if (isset($_POST['simpan'])) {
						$id_barang = $_POST['id_barang'];
						$nama_barang = $_POST['nama_barang'];
						$id_jenis_barang = $_POST['id_jenis_barang'];
						$harga_satuan = $_POST['harga_satuan'];

						$jumlah = $_POST['jumlah'];

						$satuan = $_POST['satuan'];
						$pecah_satuan = explode(".", $satuan);

						$satuan = $pecah_satuan[1];

						$image = strtotime(date('d-m-Y')) . '-' . $_FILES['image']['name'];
						$lokasi = $_FILES['image']['tmp_name'];
						$upload = move_uploaded_file($lokasi, "img/" . $image);

						$sql = $koneksi->query("INSERT INTO gudang (id_barang, nama_barang, id_jenis_barang, jumlah, satuan, harga_satuan, image ) VALUES('$id_barang','$nama_barang','$id_jenis_barang','$jumlah','$satuan', '$harga_satuan', '$image')");

						if ($sql) :
					?>

							<script type="text/javascript">
								alert("Data Berhasil Disimpan");
								window.location.href = "?page=gudang";
							</script>
					<?php

						endif;
					}


					?>
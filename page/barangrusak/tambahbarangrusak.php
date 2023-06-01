<?php
$koneksi = new mysqli("localhost", "root", "", "inventori");
$no = mysqli_query($koneksi, "SELECT id FROM barang_rusak ORDER BY id DESC");
$kdbarang = mysqli_fetch_array($no);
$kode = $kdbarang['id'];


$urut = substr($kode, 8);
$tambah = (int) $urut + 1;
$bulan = date("m");
$tahun = date("y");

$format = "RUS-" . $bulan . $tahun .  sprintf('%04d', $tambah);
?>

<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tambah Barang Rusak</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="body">
					<form method="POST" enctype="multipart/form-data">
						<label for="">Pilih Barang Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="id_barang" id="id_barang" class="form-control select2-on">
									<?php
									$brg_rusak = $koneksi->query('SELECT * FROM gudang');
									while ($data = $brg_rusak->fetch_assoc()) :
									?>
										<option value="<?= $data['id_barang']; ?>"><?= $data['id_barang'] . ' - ' . $data['nama_barang']; ?></option>
									<?php endwhile; ?>
								</select>
							</div>
						</div>

						<label for="">Tanggal Rusak</label>
						<div class="form-group">
							<div class="form-line">
								<input type="date" name="tgl_rusak" class="form-control" id="tgl_rusak" required value="<?= date('Y-m-d'); ?>" />
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

						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
					</form>

					<?php
					if (isset($_POST['simpan'])) {
						$id_barang = $_POST['id_barang'];
						$jumlah = $_POST['jumlah'];
						$satuan = $_POST['satuan'];
						$tgl_rusak = $_POST['tgl_rusak'];
						$pecah_satuan = explode(".", $satuan);
						$satuan = $pecah_satuan[1];

						$sql = $koneksi->query("INSERT INTO barang_rusak (id_barang, tgl_rusak, jumlah, satuan) VALUES('$id_barang', '$tgl_rusak', '$jumlah', '$satuan')");

						if ($sql) :
					?>

							<script type="text/javascript">
								alert("Data Berhasil Disimpan");
								window.location.href = "?page=barangrusak";
							</script>
					<?php
						endif;
					}
					?>
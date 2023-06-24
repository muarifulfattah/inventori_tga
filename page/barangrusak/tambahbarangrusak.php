<script>
	function sum() {
		var check = document.getElementById('stok');
		if (check) {
			var stok = check.innerHTML;
		}
		var jumlah = document.getElementById('jumlah');
		if (jumlah.value == '') {
			jumlah.value = 0;
		}
		var result = parseInt(stok) - parseInt(jumlah.value);
		if (!isNaN(result)) {
			if (result < 0) {
				document.getElementById('jumlah_stok').value = 0;
				jumlah.classList.add('is-invalid');
			} else {
				document.getElementById('jumlah_stok').value = result;
				jumlah.classList.remove('is-invalid');
			}
		}
	}
</script>

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
						<label for="id">ID Barang Rusak</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="id" class="form-control" id="id" value="<?= $format; ?>" readonly />
							</div>
						</div>

						<label for="tgl_rusak">Tanggal Rusak</label>
						<div class="form-group">
							<div class="form-line">
								<input type="date" name="tgl_rusak" class="form-control" id="tgl_rusak" required value="<?= date('Y-m-d'); ?>" />
							</div>
						</div>

						<label for="cmb_barang">Barang</label>
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

						<label for="jumlah">Jumlah</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="jumlah" class="form-control" id="jumlah" placeholder="Masukkan Jumlah Barang" required onkeyup="sum()" />
								<div id="valid-jumlah" class="invalid-feedback">
									Jumlah Barang Rusak Tidak Sesuai dengan Stok!
								</div>
							</div>
						</div>

						<label for="jumlah_stok">Sisa Stok</label>
						<div class="form-group">
							<div class="form-line">
								<input readonly="readonly" name="jumlah_stok" id="jumlah_stok" type="number" class="form-control">
							</div>
						</div>

						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
					</form>

					<?php
					if (isset($_POST['simpan'])) {
						$id = $_POST['id'];
						$id_barang = $_POST['id_barang'];
						$jumlah = $_POST['jumlah'];
						$tgl_rusak = $_POST['tgl_rusak'];

						$brg = $koneksi->query("SELECT jumlah, satuan FROM gudang WHERE id_barang='$id_barang'")->fetch_assoc();
						if (($brg['jumlah'] - $jumlah) < 0) {
							echo "<script type='text/javascript'>
										alert('Stok Barang Tidak Tersedia dengan Jumlah Barang Rusak!');
										window.location.href = '?page=barangkeluar&aksi=tambahbarangkeluar';
									</script>";
						} else {
							$sisa = $brg['jumlah'] - $jumlah;
							$satuan = $brg['satuan'];

							$sql = $koneksi->query("INSERT INTO barang_rusak (id, id_barang, tgl_rusak, jumlah, satuan) VALUES('$id','$id_barang', '$tgl_rusak', '$jumlah', '$satuan')");

							$sql2 = $koneksi->query("UPDATE gudang SET jumlah='$sisa' WHERE id_barang='$id_barang'");

							if ($sql) :
					?>

								<script type="text/javascript">
									alert("Data Berhasil Disimpan");
									window.location.href = "?page=barangrusak";
								</script>
					<?php
							endif;
						}
					}
					?>

					<!--script for this page-->
					<script>
						jQuery(document).ready(function($) {
							$('#cmb_barang').change(function() {
								var id_barang = $(this).val();
								$.ajax({
									type: 'POST', // Metode pengiriman data menggunakan POST
									url: 'page/barangrusak/get_barang.php', // File yang akan memproses data
									data: 'id_barang=' + id_barang, // Data yang akan dikirim ke file pemroses
									success: function(data) { // Jika berhasil
										$('.tampung').html(data);
									}
								});
							});
						});
					</script>

					<script>
						jQuery(document).ready(function($) {
							$('#cmb_barang').change(function() {
								var id_barang = $(this).val();
								$.ajax({
									type: 'POST', // Metode pengiriman data menggunakan POST
									url: 'page/barangrusak/get_satuan.php', // File yang akan memproses data
									data: 'id_barang=' + id_barang, // Data yang akan dikirim ke file pemroses
									success: function(data) { // Jika berhasil
										$('.tampung1').html(data);
									}
								});
							});
						});
					</script>
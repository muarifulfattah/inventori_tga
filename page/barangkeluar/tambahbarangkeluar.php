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
	$no = mysqli_query($koneksi, "SELECT id_barang_keluar FROM barang_keluar ORDER BY id_barang_keluar DESC");
	$idtran = mysqli_fetch_array($no);
	$kode = $idtran['id_barang_keluar'];


	$urut = substr($kode, 8, 3);
	$tambah = (int) $urut + 1;
	$bulan = date("m");
	$tahun = date("y");


	$urut = substr($kode, 8);
	$tambah = (int) $urut + 1;
	$bulan = date("m");
	$tahun = date("y");


	$format = "KLR-" . $bulan . $tahun .  sprintf('%04d', $tambah);
	$tanggal_masuk = date("Y-m-d");

	?>

  <div class="container-fluid">

  	<!-- DataTales Example -->
  	<div class="card shadow mb-4">
  		<div class="card-header py-3">
  			<h6 class="m-0 font-weight-bold text-primary">Tambah Barang Keluar</h6>
  		</div>
  		<div class="card-body">
  			<div class="table-responsive">
  				<div class="body">
  					<form method="POST" enctype="multipart/form-data">
  						<label for="id_barang_keluar">Id Transaksi</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" class="form-control" name="id_barang_keluar" id="id_barang_keluar" value="<?= $format; ?>" readonly />
  							</div>
  						</div>

  						<label for="tanggal_transaksi">Tanggal Transaksi</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="datetime-local" name="tanggal_transaksi" class="form-control" id="tanggal_transaksi" value="<?= date('Y-m-d H:i:s'); ?>" required />
  							</div>
  						</div>

  						<label for="">Barang</label>
  						<div class="form-group">
  							<div class="form-line">
  								<select name="barang" id="cmb_barang" class="form-control select2-on" />
  								<option value="">--- Pilih Barang ---</option>
  								<?php
									$sql = $koneksi->query("SELECT * FROM gudang ORDER BY id_barang");
									while ($data = $sql->fetch_assoc()) {
										echo "<option value='$data[id_barang]'>$data[id_barang] | $data[nama_barang]</option>";
									}
									?>
  								</select>
  								<div class="tampung"></div>
  							</div>
  						</div>


  						<label for="jumlah">Jumlah Transaksi</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="number" name="jumlah" class="form-control" id="jumlah" onkeyup="sum()" placeholder="Masukkan Jumlah Transaksi" />
  								<div id="valid-jumlah" class="invalid-feedback">
  									Jumlah Barang yang Dibeli Tidak Sesuai dengan Jumlah Barang Tersedia!
  								</div>
  							</div>
  						</div>

  						<label for="jumlah_stok">Sisa Stok</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input readonly="readonly" name="jumlah_stok" id="jumlah_stok" type="number" class="form-control">
  							</div>
  						</div>

  						<div class="tampung1"></div>
  						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
  					</form>
  					<?php
						if (isset($_POST['simpan'])) {
							$id_barang_keluar = $_POST['id_barang_keluar'];
							$tgl_pembelian = $_POST['tanggal_transaksi'];
							$id_barang = $_POST['barang'];
							$jumlah = $_POST['jumlah'];
							$satuan = $_POST['satuan'];

							$brg = $koneksi->query("SELECT jumlah FROM gudang WHERE id_barang='$id_barang'")->fetch_assoc();
							if (($brg['jumlah'] - $jumlah) < 0) {
								echo "<script type='text/javascript'>
										alert('Stok Barang Habis, Transaksi Tidak Dapat Dilakukan!');
										window.location.href = '?page=barangkeluar&aksi=tambahbarangkeluar';
									</script>";
							} else {
								$sisa = $brg['jumlah'] - $jumlah;

								$sql = $koneksi->query("INSERT INTO barang_keluar (id_barang_keluar, tgl_pembelian, id_barang, jumlah, satuan) VALUES('$id_barang_keluar','$tgl_pembelian','$id_barang','$jumlah','$satuan')");

								$sql2 = $koneksi->query("UPDATE gudang SET jumlah='$sisa' WHERE id_barang='$id_barang'");
						?>
  							<script type="text/javascript">
  								alert("Data Berhasil Tersimpan!");
  								window.location.href = "?page=barangkeluar";
  							</script>
  					<?php
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
  									url: 'page/barangkeluar/get_barang.php', // File yang akan memproses data
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
  									url: 'page/barangkeluar/get_satuan.php', // File yang akan memproses data
  									data: 'id_barang=' + id_barang, // Data yang akan dikirim ke file pemroses
  									success: function(data) { // Jika berhasil
  										$('.tampung1').html(data);
  									}
  								});
  							});
  						});
  					</script>
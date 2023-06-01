<?php
$koneksi = new mysqli("localhost", "root", "", "inventori");
$no = mysqli_query($koneksi, "SELECT id_supplier FROM tb_supplier ORDER BY id_supplier DESC");
$kdsupplier = mysqli_fetch_array($no);
$kode = $kdsupplier['id_supplier'];


$urut = substr($kode, 8);
$tambah = (int) $urut + 1;
$bulan = date("m");
$tahun = date("y");

$format = "SUP-" . $bulan . $tahun .  sprintf('%04d', $tambah);
?>

<div class="container-fluid">
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tambah Supplier</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="body">
					<form method="POST" enctype="multipart/form-data">
						<label for="">Kode Supplier</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="id_supplier" class="form-control" id="id_supplier" value="<?php echo $format; ?>" readonly />
							</div>
						</div>

						<label for="">Nama Supplier</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama_supplier" class="form-control" placeholder="Masukkan Nama Supplier" required />
							</div>
						</div>

						<label for="">Alamat</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat Supplier" required />

							</div>
						</div>

						<label for="">Telepon</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="telepon" class="form-control" placeholder="Masukkan Nomor Telepon" required />
							</div>
						</div>
						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
					</form>
					<?php
					if (isset($_POST['simpan'])) {
						$id_supplier = $_POST['id_supplier'];
						$nama_supplier = $_POST['nama_supplier'];
						$alamat = $_POST['alamat'];
						$telepon = $_POST['telepon'];

						$sql = $koneksi->query("INSERT INTO tb_supplier (id_supplier, nama_supplier, alamat, telepon) VALUES('$id_supplier','$nama_supplier','$alamat','$telepon')");

						if ($sql) :
					?>

							<script type="text/javascript">
								alert("Data Berhasil Disimpan");
								window.location.href = "?page=supplier";
							</script>

					<?php
						endif;
					}
					?>
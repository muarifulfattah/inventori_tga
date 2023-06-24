<?php
$bulan = $bulan = array(
	'Januari',
	'Februari',
	'Maret',
	'April',
	'Mei',
	'Juni',
	'Juli',
	'Agustus',
	'September',
	'Oktober',
	'November',
	'Desember'
);

if (isset($_POST['submit'])) { ?>
	<?php
	$koneksi = new mysqli("localhost", "root", "", "inventori");

	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Barang_Masuk (" . date('d-m-Y') . ").xls");

	$bln = $_POST['bln'];
	$thn = $_POST['thn'];

	echo "<html xmlns:x='urn:schemas-microsoft-com:office:excel'>
			<head>
					<!--[if gte mso 9]>
					<xml>
						<x:ExcelWorkbook>
							<x:ExcelWorksheets>
								<x:ExcelWorksheet>
									<x:Name>Sheet 1</x:Name>
									<x:WorksheetOptions>
										<x:Print>
											<x:ValidPrinterInfo/>
										</x:Print>
									</x:WorksheetOptions>
								</x:ExcelWorksheet>
							</x:ExcelWorksheets>
						</x:ExcelWorkbook>
					</xml>
				<![endif]-->
			</head>";

	if ($bln == 'all') : ?>

		<body>
			<center>
				<h2>Laporan Barang Masuk Tahun <?= $thn; ?></h2>
			</center>
			<table border="1">
				<tr>
					<th>No</th>
					<th>Kode Barang Masuk</th>
					<th>Tanggal Masuk</th>
					<th>Kode Barang</th>
					<th>Nama Barang</th>
					<th>Pengirim</th>
					<th>Jumlah Masuk</th>
					<th>Satuan Barang</th>
				</tr>
				<?php
				$no = 1;
				$sql = $koneksi->query("SELECT a.id, a.id_barang, a.id_supplier, a.tanggal, a.jumlah, a.satuan, b.nama_barang, c.nama_supplier FROM barang_masuk a, gudang b, tb_supplier c WHERE a.id_barang=b.id_barang AND a.id_supplier=c.id_supplier AND YEAR(a.tanggal) = '$thn'");
				while ($data = $sql->fetch_assoc()) :
				?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $data['id'] ?></td>
						<td><?= $data['tanggal'] ?></td>
						<td><?= $data['id_barang'] ?></td>
						<td><?= $data['nama_barang'] ?></td>
						<td><?= $data['nama_supplier'] ?></td>
						<td><?= $data['jumlah'] ?></td>
						<td><?= $data['satuan'] ?></td>
					</tr>
				<?php
				endwhile;
				?>
			</table>
		</body>

	<?php
	else :
	?>

		<body>
			<center>
				<h2>Laporan Barang Masuk Bulan <?= $bulan[$bln - 1]; ?> Tahun <?= $thn; ?></h2>
			</center>
			<table border="1">
				<tr>
					<th>No</th>
					<th>Kode Barang Masuk</th>
					<th>Tanggal Masuk</th>
					<th>Kode Barang</th>
					<th>Nama Barang</th>
					<th>Pengirim</th>
					<th>Jumlah Masuk</th>
					<th>Satuan Barang</th>
				</tr>
				<?php
				$no = 1;
				$sql = $koneksi->query("SELECT a.id, a.id_barang, a.id_supplier, a.tanggal, a.jumlah, a.satuan, b.nama_barang, c.nama_supplier FROM barang_masuk a, gudang b, tb_supplier c WHERE a.id_barang=b.id_barang AND a.id_supplier=c.id_supplier AND MONTH(a.tanggal)='$bln' AND YEAR(a.tanggal)='$thn'");
				while ($data = $sql->fetch_assoc()) :
				?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $data['id'] ?></td>
						<td><?= $data['tanggal'] ?></td>
						<td><?= $data['id_barang'] ?></td>
						<td><?= $data['nama_barang'] ?></td>
						<td><?= $data['nama_supplier'] ?></td>
						<td><?= $data['jumlah'] ?></td>
						<td><?= $data['satuan'] ?></td>
					</tr>
				<?php
				endwhile;
				?>
			</table>
		</body>

<?php
	endif;
}
?>

<!-- FUNGSI MENAMPILKAN DATA SESUAI BULAN DAN TAHUN -->
<?php
$koneksi = new mysqli("localhost", "root", "", "inventori");
$bln = $_POST['bln'];
$thn = $_POST['thn'];
?>

<?php
if ($bln == 'all') :
?>
	<div class="table-responsive">
		<table class="display table table-bordered" id="transaksi">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Barang Masuk</th>
					<th>Tanggal Masuk</th>
					<th>Kode Barang</th>
					<th>Nama Barang</th>
					<th>Pengirim</th>
					<th>Jumlah Masuk</th>
					<th>Satuan Barang</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				$sql = $koneksi->query("SELECT a.id, a.id_barang, a.id_supplier, a.tanggal, a.jumlah, a.satuan, b.nama_barang, c.nama_supplier FROM barang_masuk a, gudang b, tb_supplier c WHERE a.id_barang=b.id_barang AND a.id_supplier=c.id_supplier AND YEAR(a.tanggal) = '$thn'");
				while ($data = $sql->fetch_assoc()) :
				?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $data['id'] ?></td>
						<td><?= $data['tanggal'] ?></td>
						<td><?= $data['id_barang'] ?></td>
						<td><?= $data['nama_barang'] ?></td>
						<td><?= $data['nama_supplier'] ?></td>
						<td><?= $data['jumlah'] ?></td>
						<td><?= $data['satuan'] ?></td>
					</tr>
				<?php
				endwhile;
				?>
			</tbody>
		</table>
	</div>
<?php
else : ?>
	<div class="table-responsive">
		<table class="display table table-bordered" id="transaksi">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Barang Masuk</th>
					<th>Tanggal Masuk</th>
					<th>Kode Barang</th>
					<th>Nama Barang</th>
					<th>Pengirim</th>
					<th>Jumlah Masuk</th>
					<th>Satuan Barang</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				$sql = $koneksi->query("SELECT a.id, a.id_barang, a.id_supplier, a.tanggal, a.jumlah, a.satuan, b.nama_barang, c.nama_supplier FROM barang_masuk a, gudang b, tb_supplier c WHERE a.id_barang=b.id_barang AND a.id_supplier=c.id_supplier AND MONTH(a.tanggal)='$bln' AND YEAR(a.tanggal)='$thn'");
				while ($data = $sql->fetch_assoc()) :
				?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $data['id'] ?></td>
						<td><?= $data['tanggal'] ?></td>
						<td><?= $data['id_barang'] ?></td>
						<td><?= $data['nama_barang'] ?></td>
						<td><?= $data['nama_supplier'] ?></td>
						<td><?= $data['jumlah'] ?></td>
						<td><?= $data['satuan'] ?></td>
					</tr>
				<?php
				endwhile;
				?>
			</tbody>
		</table>
	</div>

<?php
endif;
?>
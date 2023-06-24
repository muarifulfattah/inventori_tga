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
$koneksi = new mysqli("localhost", "root", "", "inventori");
$bln = $_POST['bln'];
$thn = $_POST['thn'];

$query = "SELECT a.id, a.id_barang, a.id_supplier, a.tanggal, a.jumlah, a.satuan, b.nama_barang, b.image, c.nama_supplier FROM barang_masuk a, gudang b, tb_supplier c WHERE a.id_barang=b.id_barang AND a.id_supplier=c.id_supplier";

if ($bln !== 'all') {
	$query .= " AND MONTH(a.tanggal) = '$bln'";
} else {
	$bln = null;
}
if ($thn !== 'all') {
	$query .= " AND YEAR(a.tanggal) = '$thn'";
} else {
	$thn = null;
}

$no = 1;
$sql = $koneksi->query($query);

if (isset($_POST['submit'])) :
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Barang_Masuk (" . date('d-m-Y') . ").xls");

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
			</head>"; ?>

	<body>
		<center>
			<h2>Laporan Barang Masuk <?= ($bln) ? 'Bulan ' . $bulan[$_POST['bln'] - 1] : ''; ?> <?= ($thn) ? 'Tahun ' . $_POST['thn'] : ''; ?></h2>
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
			while ($data = $sql->fetch_assoc()) : ?>
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
			<?php endwhile; ?>
		</table>
	</body>
<?php endif; ?>

<!-- FUNGSI MENAMPILKAN DATA SESUAI BULAN DAN TAHUN -->

<div class="table-responsive">
	<table class="display table table-bordered" id="transaksi">
		<thead>
			<tr>
				<th>No</th>
				<th>Gambar</th>
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
			while ($data = $sql->fetch_assoc()) : ?>
				<tr>
					<td><?= $no++; ?></td>
					<td><img src="img/<?= $data['image'] ?>" alt="Gambar Barang" width="75" height="75"></td>
					<td><?= $data['id'] ?></td>
					<td><?= $data['tanggal'] ?></td>
					<td><?= $data['id_barang'] ?></td>
					<td><?= $data['nama_barang'] ?></td>
					<td><?= $data['nama_supplier'] ?></td>
					<td><?= $data['jumlah'] ?></td>
					<td><?= $data['satuan'] ?></td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
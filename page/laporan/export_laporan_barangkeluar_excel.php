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

$query = "SELECT a.id_barang_keluar, a.id_barang, a.tgl_pembelian, a.jumlah, a.satuan, b.nama_barang, b.image FROM barang_keluar a, gudang b WHERE a.id_barang=b.id_barang";

if ($bln !== 'all') {
	$query = " AND MONTH(a.tgl_pembelian) = '$bln'";
} else {
	$bln = null;
}
if ($thn !== 'all') {
	$query = " AND YEAR(a.tgl_pembelian) = '$thn'";
} else {
	$thn = null;
}
$no = 1;
$query .= "  ORDER BY a.created_at DESC";
$sql = $koneksi->query($query);

if (isset($_POST['submit'])) :
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Barang_Keluar(" . date('d-m-Y') . ").xls");

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
			<h2>Laporan Barang Keluar <?= ($bln) ? 'Bulan ' . $bulan[$_POST['bln'] - 1] : ''; ?> <?= ($thn) ? 'Tahun ' . $_POST['thn'] : ''; ?></h2>
		</center>
		<table border="1">
			<tr>
				<th>No</th>
				<th>Kode Barang Keluar</th>
				<th>Tanggal Keluar</th>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th>Jumlah Keluar</th>
				<th>Satuan Barang</th>
			</tr>
			<?php
			while ($data = $sql->fetch_assoc()) : ?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $data['id_barang_keluar'] ?></td>
					<td><?= $data['tgl_pembelian'] ?></td>
					<td><?= $data['id_barang'] ?></td>
					<td><?= $data['nama_barang'] ?></td>
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
				<th>Kode Barang Keluar</th>
				<th>Tanggal Keluar</th>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th>Jumlah Keluar</th>
				<th>Satuan Barang</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($data = $sql->fetch_assoc()) : ?>
				<tr>
					<td><?= $no++; ?></td>
					<td><img src="img/<?= $data['image'] ?>" alt="Gambar Barang" width="75" height="75"></td>
					<td><?= $data['id_barang_keluar'] ?></td>
					<td><?= $data['tgl_pembelian'] ?></td>
					<td><?= $data['id_barang'] ?></td>
					<td><?= $data['nama_barang'] ?></td>
					<td><?= $data['jumlah'] ?></td>
					<td><?= $data['satuan'] ?></td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
<?php
$koneksi = new mysqli("localhost", "root", "", "inventori");

$bln = $_POST['bln'];
$thn = $_POST['thn'];

?>

<body>
	<center>
		<h2>Laporan Barang Keluar Bulan <?= ucwords($bln); ?> Tahun <?= $thn; ?></h2>
	</center>

	<?php

	header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header("Content-Disposition: attachment; filename=Laporan_Barang_Keluar (" . date('d-m-Y') . ").xls");
	if (isset($_POST['submit']) && $bln != 'all') { ?>

		<table border="1">
			<tr>
				<th>No</th>
				<th>Id Transaksi</th>
				<th>Tanggal Keluar</th>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th>Jumlah Keluar</th>

			</tr>
			<?php
			$no = 1;
			$sql = $koneksi->query("SELECT a.id_barang_keluar, a.tgl_pembelian, a.id_barang, a.jumlah, a.satuan, b.nama_barang FROM barang_keluar a, gudang b WHERE a.id_barang=b.id_barang AND MONTH(a.tgl_pembelian) = '$bln' AND YEAR(a.tgl_pembelian) = '$thn'");
			while ($data = $sql->fetch_assoc()) {
			?>

				<tr>
					<td><?= $no++; ?></td>
					<td><?= $data['id_barang_keluar'] ?></td>
					<td><?= $data['tgl_pembelian'] ?></td>
					<td><?= $data['id_barang'] ?></td>
					<td><?= $data['nama_barang'] ?></td>
					<td><?= $data['jumlah'] ?></td>

				</tr>
			<?php } ?>
		</table>
	<?php
	} else if (isset($_POST['submit']) && $bln == 'all') {
	?>
		<div class="table-responsive">
			<table class="display table table-bordered" id="transaksi">
				<thead>
					<tr>
						<th>No</th>
						<th>Id Transaksi</th>
						<th>Tanggal Keluar</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Jumlah Keluar</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$sql = $koneksi->query("SELECT a.id_barang_keluar, a.tgl_pembelian, a.id_barang, a.jumlah, a.satuan, b.nama_barang FROM barang_keluar a, gudang b WHERE YEAR(a.tgl_pembelian) = '$thn' AND a.id_barang=b.id_barang");
					while ($data = $sql->fetch_assoc()) {

					?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $data['id_barang_keluar'] ?></td>
							<td><?= $data['tgl_pembelian'] ?></td>
							<td><?= $data['id_barang'] ?></td>
							<td><?= $data['nama_barang'] ?></td>
							<td><?= $data['jumlah'] ?></td>

						</tr>
					<?php
					}
					?>

				</tbody>
			</table>
		</div>


	<?php } else { ?>
		<div class="table-responsive">
			<table class="display table table-bordered" id="transaksi">
				<thead>
					<tr>
						<th>No</th>
						<th>Id Transaksi</th>
						<th>Tanggal Keluar</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Jumlah Keluar</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$sql = $koneksi->query("SELECT a.id_barang_keluar, a.tgl_pembelian, a.id_barang, a.jumlah, a.satuan, b.nama_barang FROM barang_keluar a, gudang b WHERE MONTH(tgl_pembelian) = '$bln' AND YEAR(tgl_pembelian) = '$thn' AND a.id_barang=b.id_barang");
					while ($data = $sql->fetch_assoc()) {
					?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $data['id_barang_keluar'] ?></td>
							<td><?= $data['tgl_pembelian'] ?></td>
							<td><?= $data['id_barang'] ?></td>
							<td><?= $data['nama_barang'] ?></td>
							<td><?= $data['jumlah'] ?></td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>

	<?php } ?>

</body>
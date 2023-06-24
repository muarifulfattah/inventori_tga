 <?php
	$koneksi = new mysqli("localhost", "root", "", "inventori");
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Stok_Gudang(" . date('d-m-Y') . ").xls");
	?>

 <html xmlns:x="urn:schemas-microsoft-com:office:excel">

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
 </head>

 <center>
 	<h2>Laporan Stok Gudang</h2>
 </center>

 <table border="1">
 	<tr>
 		<th>No</th>
 		<th>Kode Barang</th>
 		<th>Nama Barang</th>
 		<th>Jenis Barang</th>
 		<th>Jumlah Barang</th>
 		<th>Satuan</th>
 		<th>Harga Satuan</th>
 	</tr>

 	<?php
		$no = 1;
		$sql = $koneksi->query("SELECT * FROM gudang a, jenis_barang b WHERE a.id_jenis_barang=b.id");
		while ($data = $sql->fetch_assoc()) {
		?>

 		<tr>
 			<td><?= $no++; ?></td>
 			<td><?= $data['id_barang'] ?></td>
 			<td><?= $data['nama_barang'] ?></td>
 			<td><?= $data['jenis_barang'] ?></td>
 			<td><?= $data['jumlah'] ?></td>
 			<td><?= $data['satuan'] ?></td>
 			<td>Rp <?= number_format($data['harga_satuan'], 0, ',', '.') ?></td>
 		</tr>
 	<?php } ?>
 </table>
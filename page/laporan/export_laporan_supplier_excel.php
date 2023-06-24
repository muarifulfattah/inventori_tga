 <?php
	$koneksi = new mysqli("localhost", "root", "", "inventori");
	$file = 'Laporan_Supplier(' . date('d-m-Y') . ').xls';
	// Melakukan pengunduhan dokumen dengan penggunaan fungsi attachment php
	header("Content-Disposition: attachment; filename=$file");
	// Mengatur jenis dokumen yang akan diekspor
	header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
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

 <body>
 	<center>
 		<h2>Laporan Data Supplier</h2>
 	</center>
 	<table border="1">
 		<tr>
 			<th>No</th>
 			<th>Kode Supplier</th>
 			<th>Nama Supplier</th>
 			<th>Alamat</th>
 			<th>Telepon</th>
 		</tr>

 		<?php
			// Membuat nilai iterasi perulangan
			$no = 1;

			// Mengambil data dari tb_supplier
			$sql = $koneksi->query("SELECT * FROM tb_supplier");

			// Melakukan Perulangan untuk seluruh data yang terambil
			while ($data = $sql->fetch_assoc()) :
			?>
 			<tr>
 				<td><?= $no++; ?></td>
 				<!-- Mencetak Data Hasil perulangan -->
 				<td><?= $data['id_supplier'] ?></td>
 				<td><?= $data['nama_supplier'] ?></td>
 				<td><?= $data['alamat'] ?></td>
 				<td><?= $data['telepon'] ?></td>
 			</tr>
 		<?php
			endwhile; ?>
 	</table>
 </body>
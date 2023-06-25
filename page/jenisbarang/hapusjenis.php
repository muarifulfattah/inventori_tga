 <?php
	//  Ambil ID yang dikirim
	$id = $_GET['id'];

	// Cek data id jenis barang, apakah tersedia dalam tabel gudang atau tidak
	$cek = $koneksi->query("SELECT * FROM gudang WHERE id_jenis_barang='$id'");

	// Jika tidak tersedia
	if (!mysqli_num_rows($cek) > 0) :
		// Lakukan penghapusan jenis barang
		$query = $koneksi->query("DELETE FROM jenis_barang WHERE id = '$id'");
		if ($query) :
	?>
 		<script type="text/javascript">
 			alert("Data Berhasil Dihapus!");
 			window.location.href = "?page=jenisbarang";
 		</script>
 	<?php endif; ?>

 	<!-- dan jika tersedia -->
 <?php else : ?>
 	<!-- Tampilkan gagal hapus -->
 	<script type="text/javascript">
 		alert("Data Gagal Dihapus!!");
 		window.location.href = "?page=jenisbarang";
 	</script>
 <?php endif; ?>
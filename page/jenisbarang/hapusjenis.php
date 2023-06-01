 <?php
	$id = $_GET['id'];
	$cek = $koneksi->query("SELECT * FROM gudang WHERE id_jenis_barang='$id'");

	if (!$cek) :
		$query = "DELETE FROM jenis_barang WHERE id = '$id'";
		if (mysqli_query($koneksi, $query)) :
	?>
 		<script type="text/javascript">
 			alert("Data Berhasil Dihapus");
 			window.location.href = "?page=jenisbarang";
 		</script>
 	<?php endif;
		?>
 <?php else : ?>
 	<script type="text/javascript">
 		alert("Data Gagal Dihapus!!");
 		window.location.href = "?page=jenisbarang";
 	</script>
 <?php
	endif; ?>
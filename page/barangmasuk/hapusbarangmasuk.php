 <?php

	$id_transaksi = $_GET['id_transaksi'];
	$sql = $koneksi->query("DELETE FROM barang_masuk WHERE id_transaksi = '$id_transaksi'");

	if ($sql) {

	?>


 	<script type="text/javascript">
 		alert("Data Berhasil Dihapus");
 		window.location.href = "?page=barangmasuk";
 	</script>

 <?php

	}

	?>
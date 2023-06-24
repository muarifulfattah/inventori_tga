 <?php
	$id_barang_keluar = $_GET['id_barang_keluar'];
	$sql = $koneksi->query("DELETE FROM barang_keluar WHERE id_barang_keluar = '$id_barang_keluar'");
	if ($sql) {
	?>
 	<script type="text/javascript">
 		alert("Data Berhasil Dihapus!");
 		window.location.href = "?page=barangkeluar";
 	</script>

 <?php
	}
	?>
 <?php
	$id_barang = $_GET['id_barang'];
	$sql = $koneksi->query("DELETE FROM gudang WHERE id_barang = '$id_barang'");
	if ($sql) :
	?>
 	<script type="text/javascript">
 		alert("Data Berhasil Dihapus");
 		window.location.href = "?page=gudang";
 	</script>

 <?php
	endif;
	?>
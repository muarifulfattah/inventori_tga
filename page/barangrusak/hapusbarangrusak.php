 <?php
	$id = $_GET['id'];
	$sql = $koneksi->query("DELETE FROM barang_rusak WHERE id = '$id'");
	if ($sql) :
	?>
 	<script type="text/javascript">
 		alert("Data Berhasil Dihapus");
 		window.location.href = "?page=barangrusak";
 	</script>

 <?php
	endif;
	?>
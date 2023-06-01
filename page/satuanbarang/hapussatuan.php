 <?php
	$id = $_GET['id'];
	$sql = $koneksi->query("DELETE FROM satuan WHERE id = '$id'");
	if ($sql) :
	?>
 	<script type="text/javascript">
 		alert("Data Berhasil Dihapus");
 		window.location.href = "?page=satuanbarang";
 	</script>
 <?php endif; ?>
 <?php
	$id_supplier = $_GET['id'];
	$sql = $koneksi->query("DELETE FROM tb_supplier WHERE id_supplier = '$id_supplier'");

	if ($sql) :
	?>
 	<script type="text/javascript">
 		alert("Data Berhasil Dihapus");
 		window.location.href = "?page=supplier";
 	</script>

 <?php endif; ?>
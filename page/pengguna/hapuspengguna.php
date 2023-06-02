 <?php
	if (in_array($level, ['admin'])) :
		$id = $_GET['id'];
		$sql = $koneksi->query("DELETE FROM users WHERE id = '$id'");

		if ($sql) : ?>
 		<script type="text/javascript">
 			alert("Data Berhasil Dihapus");
 			window.location.href = "?page=pengguna";
 		</script>

 <?php endif;
	endif;	?>
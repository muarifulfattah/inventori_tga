 <?php
	$id = $_GET['id'];
	$id_barang = $_GET['id_barang'];
	$data_br_masuk = $koneksi->query("SELECT * FROM barang_masuk WHERE id='$id'");
	$data_br_masuk = $data_br_masuk->fetch_assoc();

	$data_gudang = $koneksi->query("SELECT * FROM gudang WHERE id_barang='$id_barang'");
	$data_gudang = $data_gudang->fetch_assoc();

	$jumlah_stok_baru = $data_gudang['jumlah'] - $data_br_masuk['jumlah'];
	if ($jumlah_stok_baru < 0) {
		$jumlah_stok_baru = 0;
	}

	$koneksi->query("UPDATE gudang SET jumlah='$jumlah_stok_baru' WHERE id_barang='$id_barang'");

	$sql = $koneksi->query("DELETE FROM barang_masuk WHERE id = '$id'");
	if ($sql) {
	?>
 	<script type="text/javascript">
 		alert("Data Berhasil Dihapus");
 		window.location.href = "?page=barangmasuk";
 	</script>

 <?php

	}
	?>
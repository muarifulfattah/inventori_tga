<?php
include("../../koneksi.php");
$id_barang = $_POST['id_barang'];
$sql = "SELECT *
    FROM gudang
    where id_barang = '$id_barang'";
$result = mysqli_query($koneksi, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while ($row = mysqli_fetch_assoc($result)) {

?>
    <div class="rounded img-thumbnail mt-2" style="display: inline-block;">
      <img src="img/<?= $row['image']; ?>" alt="Gambar" width="75" height="75">
    </div>
    <span class="form-label">Jumlah Stok Gudang : <span id="stok"><?= $row['jumlah']; ?></span></span>
<?php
  }
} else {
  echo "<div class='form-label'>Jumlah Stok Gudang : <span id='stok'>0</span></div>";
}

mysqli_close($koneksi);

?>
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
    <label for="satuan">Satuan</label>
    <div class="form-group">
      <div class="form-line">
        <input readonly id="satuan" name="satuan" type="text" class="form-control" value="<?= $row["satuan"]; ?>">
        </input>
      </div>
    </div>
<?php
  }
} else {
  echo "0 results";
}

mysqli_close($koneksi);

?>
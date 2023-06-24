<?php
$gdg = $koneksi->query('SELECT * FROM barang_masuk ORDER BY tanggal limit 1');
$gdg = $gdg->fetch_assoc();
$tahun = date('Y', strtotime($gdg['tanggal']));
$bulan = $bulan = array(
  'Januari',
  'Februari',
  'Maret',
  'April',
  'Mei',
  'Juni',
  'Juli',
  'Agustus',
  'September',
  'Oktober',
  'November',
  'Desember'
);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Barang Masuk</h6>
    </div>
    <div class="card-body">
      <table>
        <tr>
          <td>
            Export Data Barang Masuk
          </td>
        </tr>
        <tr>
          <td width="50%">
            <form action="page/laporan/export_laporan_barangmasuk_excel.php" method="post">
              <div class="row form-group">
                <div class="col-md-5">
                  <select class="form-control " name="bln">
                    <option value="all" selected="">ALL</option>
                    <?php foreach ($bulan as $index => $value) : ?>
                      <option value="<?= $index + 1; ?>"><?= $value; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-3">
                  <?php
                  $now = date('Y');
                  echo "<select name='thn' class='form-control'>";
                  echo "<option value='all' selected=''>ALL</option>";
                  for ($a = $tahun; $a <= $now; $a++) {
                    echo "<option value='$a'>$a</option>";
                  }
                  echo "</select>";
                  ?>
                </div>

                <input type="submit" class="" name="submit" value="Export to Excel">
              </div>
            </form>
          </td>
        </tr>
        <tr>
          <td>
            Tampilkan Barang Masuk Sesuai Dengan Tanggal
          </td>
        </tr>
        <tr>
          <td>
            <form id="FormBrgMasuk">
              <div class="row form-group">
                <div class="col-md-5">
                  <select class="form-control " name="bln">
                    <option value="all" selected="">ALL</option>
                    <?php foreach ($bulan as $index => $value) : ?>
                      <option value="<?= $index + 1; ?>"><?= $value; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-3">
                  <?php
                  $now = date('Y');
                  echo "<select name='thn' class='form-control'>";
                  echo "<option value='all' selected=''>ALL</option>";
                  for ($a = $tahun; $a <= $now; $a++) {
                    echo "<option value='$a'>$a</option>";
                  }
                  echo "</select>";
                  ?>
                </div>
                <input type="submit" class="" name="submit2" value="Tampilkan">
              </div>
            </form>
          </td>
        </tr>
      </table>

      <div class="tampung1">

        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Kode Barang Masuk</th>
                <th>Tanggal Masuk</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Pengirim</th>
                <th>Jumlah Masuk</th>
                <th>Satuan Barang</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sql = $koneksi->query("SELECT a.id, a.id_barang, a.id_supplier, a.tanggal, a.jumlah, a.satuan, b.nama_barang, b.image, c.nama_supplier FROM barang_masuk a, gudang b, tb_supplier c WHERE a.id_barang=b.id_barang AND a.id_supplier=c.id_supplier");
              while ($data = $sql->fetch_assoc()) :
              ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><img src="img/<?= $data['image'] ?>" alt="Gambar Barang" width="75" height="75"></td>
                  <td><?= $data['id'] ?></td>
                  <td><?= $data['tanggal'] ?></td>
                  <td><?= $data['id_barang'] ?></td>
                  <td><?= $data['nama_barang'] ?></td>
                  <td><?= $data['nama_supplier'] ?></td>
                  <td><?= $data['jumlah'] ?></td>
                  <td><?= $data['satuan'] ?></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(function() {
        $('#FormBrgMasuk').submit(function() {
          $.ajax({
            type: 'POST',
            url: 'page/laporan/export_laporan_barangmasuk_excel.php',
            data: $(this).serialize(),
            success: function(data) {
              $(".tampung1").html(data);
              $('.table').DataTable();
            }
          });

          return false;
          e.preventDefault();
        });
      });
    });
  </script>
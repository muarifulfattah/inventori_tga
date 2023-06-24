<?php
$gdg = $koneksi->query('SELECT * FROM barang_rusak ORDER BY tgl_rusak limit 1');
$gdg = $gdg->fetch_assoc();
$tahun = date('Y', strtotime($gdg['tgl_rusak']));
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
      <h6 class="m-0 font-weight-bold text-primary">Barang Rusak</h6>
    </div>
    <div class="card-body">
      <table>
        <tr>
          <td>
            Export Data Barang Rusak
          </td>
        </tr>
        <tr>
          <td width="50%">
            <form action="page/laporan/export_laporan_barangrusak_excel.php" method="post">
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
            Tampilkan Barang Rusak Sesuai Dengan Tanggal
          </td>
        </tr>
        <tr>
          <td>
            <form id="FormBrgRusak" method="POST" action="">
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

      <div class="tampung2">

        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Id Transaksi</th>
                <th>Tanggal Rusak</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Rusak</th>
                <th>Harga Satuan</th>
                <th>Satuan Barang</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sql = $koneksi->query("SELECT a.id, a.tgl_rusak, a.id_barang, a.jumlah, a.satuan, b.nama_barang, b.image, b.harga_satuan FROM barang_rusak a, gudang b WHERE a.id_barang=b.id_barang ORDER BY a.created_at DESC");
              while ($data = $sql->fetch_assoc()) :  ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><img src="img/<?= $data['image'] ?>" alt="Gambar Barang" width="75" height="75"></td>
                  <td><?= $data['id'] ?></td>
                  <td><?= $data['tgl_rusak'] ?></td>
                  <td><?= $data['id_barang'] ?></td>
                  <td><?= $data['nama_barang'] ?></td>
                  <td><?= $data['jumlah'] ?></td>
                  <td>Rp <?= number_format($data['harga_satuan'], 0, ',', '.') ?></td>
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
        $('#FormBrgRusak').submit(function() {
          $.ajax({
            type: 'POST',
            url: 'page/laporan/export_laporan_barangrusak_excel.php',
            data: $(this).serialize(),
            success: function(data) {
              $(".tampung2").html(data);
              $('.table').DataTable();
            }
          });

          return false;
          e.preventDefault();
        });
      });
    });
  </script>
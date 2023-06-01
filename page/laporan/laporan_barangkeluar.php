<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Barang Keluar</h6>
    </div>
    <div class="card-body">
      <table>
        <tr>
          <td>
            LAPORAN PERBULAN DAN PERTAHUN
          </td>
        </tr>
        <tr>
          <td width="50%">
            <form action="page/laporan/export_laporan_barangkeluar_excel.php" method="post">
              <div class="row form-group">

                <div class="col-md-5">
                  <select class="form-control " name="bln">
                    <option value="all" selected="">ALL</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <?php
                  $now = date('Y');
                  echo "<select name='thn' class='form-control'>";
                  for ($a = 2018; $a <= $now; $a++) {
                    echo "<option value='$a'>$a</option>";
                  }
                  echo "</select>";
                  ?>
                </div>

                <input type="submit" class="" name="submit" value="Export to Excel">
              </div>
            </form>


            <form id="Myform2" method="POST" action="">
              <div class="row form-group">
                <div class="col-md-5">
                  <select class="form-control " name="bln">
                    <option value="all" selected="">ALL</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <?php
                  $now = date('Y');
                  echo "<select name='thn' class='form-control'>";
                  for ($a = 2018; $a <= $now; $a++) {
                    echo "<option value='$a'>$a</option>";
                  }
                  echo "</select>";
                  ?>
                </div>
                <input type="submit" class="" name="submit" value="Tampilkan">
              </div>
            </form>
          </td>


      </table>

      <div class="tampung2">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Id Transaksi</th>
                <th>Tanggal Keluar</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Keluar</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              if (isset($_GET['submit2'])) {
                $bln = $_GET['bln'];
                $thn = $_GET['thn'];

                if ($bln == 'all') {
                  $sql = $koneksi->query("SELECT a.id_barang_keluar, a.tgl_pembelian, a.id_barang, a.jumlah, a.satuan, b.nama_barang, b.image FROM barang_keluar a, gudang b WHERE a.id_barang=b.id_barang AND (YEAR(a.tgl_pembelian) = '$thn') ORDER BY a.created_at DESC");
                } else {
                  $sql = $koneksi->query("SELECT a.id_barang_keluar, a.tgl_pembelian, a.id_barang, a.jumlah, a.satuan, b.nama_barang, b.image FROM barang_keluar a, gudang b WHERE a.id_barang=b.id_barang AND (YEAR(a.tgl_pembelian) = '$thn' OR MONTH(a.tgl_pembelian) = '$bln') ORDER BY a.created_at DESC");
                }
              } else {
                $sql = $koneksi->query("SELECT a.id_barang_keluar, a.tgl_pembelian, a.id_barang, a.jumlah, a.satuan, b.nama_barang, b.image FROM barang_keluar a, gudang b WHERE a.id_barang=b.id_barang ORDER BY a.created_at DESC");
              }
              while ($data = $sql->fetch_assoc()) {
              ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><img src="img/<?= $data['image'] ?>" alt="Gambar Barang" width="75" height="75"></td>
                  <td><?= $data['id_barang_keluar'] ?></td>
                  <td><?= $data['tgl_pembelian'] ?></td>
                  <td><?= $data['id_barang'] ?></td>
                  <td><?= $data['nama_barang'] ?></td>
                  <td><?= $data['jumlah'] ?></td>
                </tr>
              <?php } ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
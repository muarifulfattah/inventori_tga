<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Stok Gudang</h6>
    </div>
    <div class="card-body">
      <div class="mb-3">
        <a href="page/laporan/export_laporan_gudang_excel.php" class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i> Export To Excel</a>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Gambar</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Jenis Barang</th>
              <th>Jumlah Barang</th>
              <th>Satuan</th>
              <th>Harga Satuan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $sql = $koneksi->query("SELECT * FROM gudang a, jenis_barang b WHERE a.id_jenis_barang=b.id");
            while ($data = $sql->fetch_assoc()) {
            ?>

              <tr>
                <td><?= $no++; ?></td>
                <td><img src="img/<?= $data['image']; ?>" alt="Gambar" width="75" height="75"></td>
                <td><?= $data['id_barang'] ?></td>
                <td><?= $data['nama_barang'] ?></td>
                <td><?= $data['jenis_barang'] ?></td>
                <td><?= $data['jumlah'] ?></td>
                <td><?= $data['satuan'] ?></td>
                <td>Rp <?= number_format($data['harga_satuan'], 0, ',', '.') ?></td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
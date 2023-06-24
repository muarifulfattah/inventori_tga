<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Stok Barang</h6>
    </div>
    <div class="card-body">
      <div class="mb-3">
        <a href="?page=gudang&aksi=tambahgudang" class="btn btn-primary">Tambah Data Barang</a>
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
              <th>Tanggal Upload</th>
              <th>Pengaturan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $sql = $koneksi->query("SELECT * FROM gudang a, jenis_barang b WHERE a.id_jenis_barang=b.id ORDER BY created_at DESC");
            while ($data = $sql->fetch_assoc()) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><img src="img/<?= $data['image'] ?>" alt="Gambar Barang" width="75" height="75"></td>
                <td><?= $data['id_barang'] ?></td>
                <td><?= $data['nama_barang'] ?></td>
                <td><?= $data['jenis_barang'] ?></td>
                <td><?= $data['jumlah'] ?></td>
                <td><?= $data['satuan'] ?></td>
                <td>Rp <?= number_format($data['harga_satuan'], 0, ',', '.') ?></td>
                <td><?= $data['created_at'] ?></td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="?page=gudang&aksi=ubahgudang&id_barang=<?= $data['id_barang'] ?>" class="btn btn-success">Ubah</a>
                    <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=gudang&aksi=hapusgudang&id_barang=<?= $data['id_barang'] ?>" class="btn btn-danger">Hapus</a>
                  </div>
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
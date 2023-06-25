<?php
session_start();
$user = $_SESSION['data'];
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Jenis Barang</h6>
    </div>
    <div class="card-body">
      <div class="mb-3">
        <a href="?page=jenisbarang&aksi=tambahjenis" class="btn btn-primary">Tambah Jenis Barang</a>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Jenis Barang</th>
              <th>Pengaturan</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $no = 1;
            $sql = $koneksi->query("SELECT * FROM jenis_barang ORDER BY id DESC");
            while ($data = $sql->fetch_assoc()) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['jenis_barang'] ?></td>
                <td>
                  <a href="?page=jenisbarang&aksi=ubahjenis&id=<?= $data['id'] ?>" class="btn btn-success">Ubah</a>
                  <?php if ($level == 'admin') : ?>
                    <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=jenisbarang&aksi=hapusjenis&id=<?= $data['id'] ?>" class="btn btn-danger">Hapus</a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
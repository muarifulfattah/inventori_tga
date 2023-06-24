<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Barang Rusak</h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <a href="?page=barangrusak&aksi=tambahbarangrusak" class="btn btn-primary">Tambah Barang Rusak</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>ID Barang Rusak</th>
                            <th>Tanggal Rusak</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Rusak</th>
                            <th>Satuan Barang</th>
                            <th>Pengaturan</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = $koneksi->query("SELECT a.id, a.tgl_rusak, a.id_barang, b.nama_barang, a.jumlah, a.satuan, b.image FROM barang_rusak a, gudang b WHERE a.id_barang=b.id_barang ORDER BY a.created_at DESC");
                        while ($data = $sql->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><img src="img/<?= $data['image'] ?>" alt="Gambar Barang" width="75" height="75"></td>
                                <td><?= $data['id'] ?></td>
                                <td><?= $data['tgl_rusak'] ?></td>
                                <td><?= $data['id_barang'] ?></td>
                                <td><?= $data['nama_barang'] ?></td>
                                <td><?= $data['jumlah'] ?></td>
                                <td><?= $data['satuan'] ?></td>
                                <td>

                                    <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=barangrusak&aksi=hapusbarangrusak&id=<?= $data['id'] ?>" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
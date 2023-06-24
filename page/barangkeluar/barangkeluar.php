<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Barang Keluar</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="mb-3">
					<a href="?page=barangkeluar&aksi=tambahbarangkeluar" class="btn btn-primary">Tambah Transaksi</a>
				</div>
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
							<th>Harga Satuan</th>
							<th>Satuan</th>
							<th>Pengaturan</th>
						</tr>
					</thead>
					<tbody>
						<?php

						$no = 1;
						$sql = $koneksi->query("SELECT a.id_barang_keluar, a.tgl_pembelian, a.id_barang, a.jumlah, a.satuan, b.nama_barang, b.image, b.harga_satuan FROM barang_keluar a, gudang b WHERE a.id_barang=b.id_barang ORDER BY a.tgl_pembelian DESC");
						while ($data = $sql->fetch_assoc()) {
						?>
							<tr>
								<td><?= $no++; ?></td>
								<td><img src="img/<?= $data['image']; ?>" alt="Gambar" width="75" height="75"></td>
								<td><?= $data['id_barang_keluar'] ?></td>
								<td><?= date('d-m-Y H:i:s', strtotime($data['tgl_pembelian'])) ?></td>
								<td><?= $data['id_barang'] ?></td>
								<td><?= $data['nama_barang'] ?></td>
								<td><?= $data['jumlah'] ?></td>
								<td>Rp <?= number_format($data['harga_satuan'], 0, ',', '.') ?></td>
								<td><?= $data['satuan'] ?></td>
								<td>
									<a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=barangkeluar&aksi=hapusbarangkeluar&id_barang_keluar=<?= $data['id_barang_keluar'] ?>" class="btn btn-danger">Hapus</a>
								</td>
							</tr>
						<?php } ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
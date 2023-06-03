<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Barang Masuk</h6>
		</div>
		<div class="card-body">
			<div class="mb-3">
				<a href="?page=barangmasuk&aksi=tambahbarangmasuk" class="btn btn-primary">Tambah Barang Masuk</a>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Gambar</th>
							<th>Id Barang</th>
							<th>Tanggal Masuk</th>
							<th>Nama Barang</th>
							<th>Supplier</th>
							<th>Jumlah Masuk</th>
							<th>Satuan Barang</th>
							<th>Pengaturan</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$sql = $koneksi->query("SELECT a.id, b.id_barang, a.tanggal, b.nama_barang, c.nama_supplier, a.jumlah, a.satuan, b.image FROM barang_masuk a, gudang b, tb_supplier c WHERE a.id_barang=b.id_barang AND a.id_supplier=c.id_supplier ORDER BY a.created_at");
						while ($data = $sql->fetch_assoc()) {
						?>
							<tr>
								<td><?= $no++; ?></td>
								<td><img src="img/<?= $data['image']; ?>" alt="Gambar" width="75" height="75"></td>
								<td><?= $data['id_barang'] ?></td>
								<td><?= $data['tanggal'] ?></td>
								<td><?= $data['nama_barang'] ?></td>
								<td><?= $data['nama_supplier'] ?></td>
								<td><?= $data['jumlah'] ?></td>
								<td><?= $data['satuan'] ?></td>
								<td>
									<div class="btn-group">
										<a href="?page=barangmasuk&aksi=ubahbarangmasuk&id=<?= $data['id'] ?>" class="btn btn-success">Ubah</a>
										<?php if (in_array($level, ['admin'])) : ?>
											<a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=barangmasuk&aksi=hapusbarangmasuk&id=<?= $data['id'] ?>&id_barang=<?= $data['id_barang']; ?>" class="btn btn-danger">Hapus</a>
										<?php endif; ?>
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
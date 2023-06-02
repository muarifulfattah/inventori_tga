<?php
$id = $_GET['id'];
$sql2 = $koneksi->query("SELECT * FROM users WHERE id = '$id'");
$tampil = $sql2->fetch_assoc();

$level = $tampil['level'];

?>

<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Ubah User</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="body">
					<form method="POST" enctype="multipart/form-data">
						<label for="">NIK</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="nik" value="<?= $tampil['nik']; ?>" class="form-control" required />

							</div>
						</div>

						<label for="">Nama</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama" value="<?= $tampil['nama']; ?>" class="form-control" required />

							</div>
						</div>

						<label for="">Telepon</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="telepon" value="<?= $tampil['telepon']; ?>" class="form-control" required />

							</div>
						</div>

						<label for="">Username</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="username" value="<?= $tampil['username']; ?>" class="form-control" required />

							</div>
						</div>

						<label for="">Password</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="password" value="" placeholder="Masukkan password baru!" class="form-control" />

							</div>
						</div>


						<label for="">Level</label>
						<div class="form-group">
							<div class="form-line">
								<select name="level" class="form-control show-tick" required>
									<?php $role = ['admin', 'petugas_penjualan', 'petugas_gudang']; ?>
									<?php foreach ($role as $akses) : ?>
										<?php if ($akses == $level) : ?>
											<option value="<?= $akses; ?>" selected><?= ucwords(str_replace('_', ' ', $akses)); ?></option>
										<?php else : ?>
											<option value="<?= $akses; ?>"><?= ucwords(str_replace('_', ' ', $akses)); ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>


						<label for="">Foto</label>
						<div class="form-group">
							<div class="form-line">
								<img src="img/<?= $tampil['foto']; ?> " width="50" height="50" alt="">
								<input type="hidden" name="old_image" value="<?= $tampil['foto']; ?>">
							</div>
						</div>


						<label for="">Ganti Foto</label>
						<div class="form-group">
							<div class="form-line">
								<input type="file" name="image" class="form-control" />
							</div>
						</div>

						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
					</form>

					<?php
					if (isset($_POST['simpan'])) {
						$nik = $_POST['nik'];
						$nama = $_POST['nama'];
						$telepon = $_POST['telepon'];
						$username = $_POST['username'];
						$password = md5($_POST['password']);
						$level = $_POST['level'];

						$image = strtotime(date('d-m-Y')) . '-' . $_FILES['image']['name'];
						$lokasi = $_FILES['image']['tmp_name'];

						if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
							$image = $_POST['old_image'];
						}

						if (!empty($lokasi)) {
							$upload = move_uploaded_file($lokasi, "img/" . $foto);
							if (!empty($_POST['password'])) {
								$sql = $koneksi->query("UPDATE users SET nik='$nik', nama='$nama', telepon='$telepon', username='$username', password='$password', level='$level', foto='$foto' WHERE id='$id'");
							} else {
								$sql = $koneksi->query("UPDATE users SET nik='$nik', nama='$nama', telepon='$telepon', username='$username', level='$level', foto='$foto' WHERE id='$id'");
							}
							if ($sql) {
					?>
								<script type="text/javascript">
									alert("Data Berhasil Diubah");
									window.location.href = "?page=pengguna";
								</script>

							<?php
							}
						} else {

							$sql = $koneksi->query("update users set nik='$nik', username='$username', nama='$nama', telepon='$telepon', level='$level' where id='$id'");

							if ($sql) {
							?>

								<script type="text/javascript">
									alert("Data Berhasil Diubah");
									window.location.href = "?page=pengguna";
								</script>

					<?php
							}
						}
					}
					?>
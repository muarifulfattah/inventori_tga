  <div class="container-fluid">

  	<!-- DataTales Example -->
  	<div class="card shadow mb-4">
  		<div class="card-header py-3">
  			<h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
  		</div>
  		<div class="card-body">
  			<div class="table-responsive">
  				<div class="body">
  					<form method="POST" enctype="multipart/form-data">
  						<label for="">NIK</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="number" name="nik" class="form-control" required placeholder="Masukkan NIK" />
  							</div>
  						</div>

  						<label for="">Nama</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="nama" class="form-control" required placeholder="Masukkan Nama" />
  							</div>
  						</div>

  						<label for="">Telepon</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="number" name="telepon" class="form-control" required placeholder="Masukkan Nomor HP" />
  							</div>
  						</div>


  						<label for="">Username</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="username" class="form-control" required placeholder="Masukkan Username" />
  							</div>
  						</div>

  						<label for="">Password</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="password" name="password" class="form-control" required placeholder="Masukkan Password" />
  							</div>
  						</div>

  						<label for="">Level</label>
  						<div class="form-group">
  							<div class="form-line">
  								<select name="level" class="form-control show-tick" required>
  									<?php $role = ['admin', 'petugas_penjualan', 'petugas_gudang']; ?>
  									<?php foreach ($role as $akses) : ?>
  										<option value="<?= $akses; ?>"><?= ucwords(str_replace('_', ' ', $akses)); ?></option>
  									<?php endforeach; ?>
  								</select>
  							</div>
  						</div>

  						<label for="">Foto</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="file" name="foto" class="form-control" required />
  							</div>
  						</div>

  						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
  					</form>
  					<?php
						if (isset($_POST['simpan'])) :
							$nik = $_POST['nik'];
							$nama = $_POST['nama'];

							$telepon = $_POST['telepon'];
							$username = $_POST['username'];
							$password = md5($_POST['password']);
							$level = $_POST['level'];

							$foto = strtotime(date('d-m-Y')) . '-' . $_FILES['foto']['name'];
							$lokasi = $_FILES['foto']['tmp_name'];
							$upload = move_uploaded_file($lokasi, "img/" . $foto);

							if ($upload) :

								$sql = $koneksi->query("INSERT INTO users (nik, nama, telepon, username, password, level, foto) VALUES('$nik','$nama','$telepon','$username','$password','$level','$foto')");

								if ($sql) :
						?>
  								<script type="text/javascript">
  									alert("Data Berhasil Disimpan");
  									window.location.href = "?page=pengguna";
  								</script>
  					<?php
								endif;
							endif;
						endif; ?>
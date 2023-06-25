  <div class="container-fluid">

  	<!-- DataTales Example -->
  	<div class="card shadow mb-4">
  		<div class="card-header py-3">
  			<h6 class="m-0 font-weight-bold text-primary">Tambah Jenis Barang</h6>
  		</div>
  		<div class="card-body">
  			<div class="table-responsive">
  				<div class="body">
  					<form method="POST" enctype="multipart/form-data">
  						<label for="jenis_barang">Jenis Barang</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="jenis_barang" placeholder="Masukkan Jenis Barang" class="form-control" />
  							</div>
  						</div>
  						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
  					</form>
  					<?php
						if (isset($_POST['simpan'])) :
							$jenis_barang = $_POST['jenis_barang'];
							$cek = $koneksi->query("SELECT * FROM jenis_barang WHERE jenis_barang='$jenis_barang'");
							if (mysqli_num_rows($cek) > 0) : ?>
  							<script type="text/javascript">
  								alert("Data Telah Ada!");
  								window.location.href = "?page=jenisbarang";
  							</script>
  							<?php
							else :
								$sql = $koneksi->query("INSERT INTO jenis_barang (jenis_barang) VALUES('$jenis_barang')");

								if ($sql) :
								?>

  								<script type="text/javascript">
  									alert("Data Berhasil Disimpan");
  									window.location.href = "?page=jenisbarang";
  								</script>

  					<?php endif;
							endif;
						endif; ?>
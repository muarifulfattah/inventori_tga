  <div class="container-fluid">

  	<!-- DataTales Example -->
  	<div class="card shadow mb-4">
  		<div class="card-header py-3">
  			<h6 class="m-0 font-weight-bold text-primary">Tambah Satuan Barang</h6>
  		</div>
  		<div class="card-body">
  			<div class="table-responsive">
  				<div class="body">
  					<form method="POST" enctype="multipart/form-data">
  						<label for="">Satuan Barang</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="satuan" class="form-control" placeholder="Masukkan Satuan Barang" required />
  							</div>
  						</div>
  						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

  					</form>
  					<?php
						if (isset($_POST['simpan'])) {
							$satuan = $_POST['satuan'];
							$cek = $koneksi->query("SELECT * FROM satuan WHERE satuan LIKE '%$satuan%'");

							if ($cek->num_rows == 0) :
								$sql = $koneksi->query("INSERT INTO satuan (satuan) VALUES ('$satuan')");
								if ($sql) :
						?>
  								<script type="text/javascript">
  									alert("Data Berhasil Disimpan");
  									window.location.href = "?page=satuanbarang";
  								</script>
  							<?php else : ?>
  								<script type="text/javascript">
  									alert("Data Gagal Disimpan!!");
  									window.location.href = "?page=satuanbarang";
  								</script>

  							<?php
								endif; ?>
  						<?php else : ?>
  							<script type="text/javascript">
  								alert("Data Gagal Disimpan!!");
  								window.location.href = "?page=satuanbarang";
  							</script>
  					<?php
							endif;
						}
						?>
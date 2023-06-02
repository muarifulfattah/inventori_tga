<br>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

  </div>
  <h3>Sistem Informasi Inventaris Barang Fitrah Elektronik</h3>
  <br></br>
  <!-- Content Row -->
  <div class="row">
    <?php if (in_array($level, ['admin'])) : ?>
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <a href="?page=pengguna">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    <h5>Data Pengguna</h5>
                  </div>
                </a>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">

                  </div>
                  <div class="col">
                    <?php
                    $users = mysqli_query($koneksi, "SELECT * FROM users");
                    echo 'Total ' . mysqli_num_rows($users);
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-black-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if (in_array($level, ['admin', 'petugas_gudang'])) : ?>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <a href="?page=supplier">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                    <h5>Data Supplier</h5>
                  </div>
                </a>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">

                  </div>
                  <div class="col">
                    <?php
                    $tb_supplier = mysqli_query($koneksi, "SELECT * FROM tb_supplier");
                    echo 'Total ' . mysqli_num_rows($tb_supplier);
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-black-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <a href="?page=gudang">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                    <h5>Data Gudang</h5>
                  </div>
                </a>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">

                  </div>
                  <div class="col">
                    <?php
                    $gudang = mysqli_query($koneksi, "SELECT * FROM gudang");
                    echo 'Total ' . mysqli_num_rows($gudang);
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-black-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <a href="?page=barangmasuk">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                    <h5>Barang Masuk</h5>
                  </div>
                </a>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">

                  </div>
                  <div class="col">
                    <?php
                    $barang_masuk = mysqli_query($koneksi, "SELECT * FROM barang_masuk");
                    echo 'Total ' . mysqli_num_rows($barang_masuk);
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-black-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col">
                <a href="?page=barangrusak">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                    <h5>Barang Rusak</h5>
                  </div>
                </a>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">

                  </div>
                  <div class="col">
                    <?php
                    $barang_rusak = mysqli_query($koneksi, "SELECT * FROM barang_rusak");
                    echo 'Total ' . mysqli_num_rows($barang_rusak);
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-box-open fa-2x text-black-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if (in_array($level, ['admin', 'petugas_penjualan'])) : ?>
      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <a href="?page=barangkeluar">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                    <h5>Barang Keluar</h5>
                  </div>
                </a>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">

                  </div>
                  <div class="col">
                    <?php
                    $barang_keluar = mysqli_query($koneksi, "SELECT * FROM barang_keluar");
                    echo 'Total ' . mysqli_num_rows($barang_keluar);
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-comments fa-2x text-black-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
<?php endif; ?>

</div>
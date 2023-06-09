<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

include('koneksi.php');

if (empty($_SESSION['data'])) {
  header("location:login.php");
}

$data = $_SESSION['data'];
$level = $data['level'];
$page = $_GET['page'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistem Inventaris Barang</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">


  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

  <!-- SELECT2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
  <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index3.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-building"></i>
        </div>
        <div class="sidebar-brand-text mx-2">Fitrah Elektronik</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!--sidebar start-->
      <li class="d-flex align-items-center justify-content-center">
        <a class="nav-link">
          <img src="img/<?= $data['foto'] ?>" class="img-circle" width="80" alt="User" /></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link">
          <div class="d-flex align-items-center justify-content-center" class="name"> <?= ucwords($data['nama']); ?></div>
          </font>
          <div class="d-flex align-items-center justify-content-center" class="email"><?= ucwords(str_replace('_', ' ', $data['level'])); ?></div>
        </a>
      </li>


      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?= ($page == 'home' || !isset($page)) ? 'active' : ''; ?>">
        <a class="nav-link" href="?page=home">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu Utama
      </div>

      <!-- Nav Item - Pages Collapse Menu -->

      <?php if (in_array($level, ['admin'])) : ?>
        <li class="nav-item <?= ($page == 'pengguna') ? 'active' : ''; ?>">
          <a class="nav-link" href="?page=pengguna">
            <i class="fas fa-fw fa-user"></i>
            <span>Data Pengguna</span></a>
        </li>
      <?php endif; ?>


      <?php if (in_array($level, ['admin', 'petugas_gudang'])) : ?>
        <?php
        $data_master = in_array($page, ['gudang', 'jenisbarang', 'satuanbarang', 'supplier', 'barangrusak']);
        ?>
        <li class="nav-item <?= ($data_master) ? 'active' : ''; ?>">
          <a class="nav-link <?= ($data_master) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseData" aria-expanded="true" aria-controls="collapseData">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data Master</span>
          </a>
          <div id="collapseData" class="collapse <?= ($data_master) ? 'show' : ''; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Menu:</h6>
              <a class="collapse-item <?= ($page == 'gudang') ? 'active' : ''; ?>" href="?page=gudang">Data Barang</a>
              <a class="collapse-item <?= ($page == 'jenisbarang') ? 'active' : ''; ?>" href="?page=jenisbarang">Jenis Barang</a>
              <a class="collapse-item <?= ($page == 'satuanbarang') ? 'active' : ''; ?>" href="?page=satuanbarang">Satuan Barang</a>
              <a class="collapse-item <?= ($page == 'supplier') ? 'active' : ''; ?>" href="?page=supplier">Data Supplier</a>
              <a class="collapse-item <?= ($page == 'barangrusak') ? 'active' : ''; ?>" href="?page=barangrusak">Barang Rusak</a>

            </div>
          </div>
        </li>
      <?php endif; ?>

      <?php $transaksi = in_array($page, ['barangmasuk', 'barangkeluar']); ?>
      <li class="nav-item <?= ($transaksi) ? 'active' : ''; ?>">
        <a class="nav-link <?= ($transaksi) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Transaksi</span>
        </a>
        <div id="collapsePages" class="collapse <?= ($transaksi) ? 'show' : ''; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu:</h6>

            <?php if (in_array($level, ['admin', 'petugas_gudang'])) : ?>
              <a class="collapse-item <?= ($page == 'barangmasuk') ? 'active' : ''; ?>" href="?page=barangmasuk">Barang Masuk</a>
            <?php endif; ?>
            <?php if (in_array($level, ['admin', 'petugas_penjualan'])) : ?>
              <a class="collapse-item <?= ($page == 'barangkeluar') ? 'active' : ''; ?>" href="?page=barangkeluar">Barang Keluar</a>
            <?php endif; ?>
          </div>
        </div>
      </li>


      <?php if (in_array($level, ['admin'])) : ?>
        <?php $laporan = in_array($page, ['laporan_supplier', 'laporan_barangkeluar', 'laporan_gudang', 'laporan_barangmasuk', 'laporan_barangrusak']); ?>
        <!-- Heading -->
        <div class="sidebar-heading">
          Laporan
        </div>
        <li class="nav-item <?= ($laporan) ? 'active' : ''; ?>">
          <a class="nav-link <?= ($laporan) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
            <i class="fas fa-fw fa-folder"></i>
            <span>Laporan</span>
          </a>
          <div id="collapseLaporan" class="collapse <?= ($laporan) ? 'show' : ''; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Menu Laporan:</h6>
              <a class="collapse-item <?= ($page == 'laporan_supplier') ? 'active' : ''; ?>" href="?page=laporan_supplier">Laporan Supplier</a>
              <a class="collapse-item <?= ($page == 'laporan_barangmasuk') ? 'active' : ''; ?>" href="?page=laporan_barangmasuk">Laporan Barang Masuk</a>
              <a class="collapse-item <?= ($page == 'laporan_gudang') ? 'active' : ''; ?>" href="?page=laporan_gudang">Laporan Stok Gudang</a>
              <a class="collapse-item <?= ($page == 'laporan_barangkeluar') ? 'active' : ''; ?>" href="?page=laporan_barangkeluar">Laporan Barang Keluar</a>
              <a class="collapse-item <?= ($page == 'laporan_barangrusak') ? 'active' : ''; ?>" href="?page=laporan_barangrusak">Laporan Barang Rusak</a>
            </div>
          </div>
        </li>
      <?php endif; ?>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <div class="top-menu">
                <ul class="nav pull-right top-menu">
                  <li>
                    <a onclick="return confirm('Apakah anda yakin akan logout?')" class="btn btn-danger" class="logout" href="logout.php">Keluar</a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <main>
          <div class="container-fluid">
            <section class="content">
              <?php
              $aksi = $_GET['aksi'];
              // PENGGUNA
              if (in_array($level, ['admin'])) {
                if ($page == "pengguna") {
                  if ($aksi == "") {
                    include "page/pengguna/pengguna.php";
                  }
                  if ($aksi == "tambahpengguna") {
                    include "page/pengguna/tambahpengguna.php";
                  }
                  if ($aksi == "ubahpengguna") {
                    include "page/pengguna/ubahpengguna.php";
                  }

                  if ($aksi == "hapuspengguna") {
                    include "page/pengguna/hapuspengguna.php";
                  }
                }
              }


              // MENU PETUGAS GUDANG
              if (in_array($level, ['admin', 'petugas_gudang'])) {
                if ($page == "supplier") {
                  if ($aksi == "") {
                    include "page/supplier/supplier.php";
                  }
                  if ($aksi == "tambahsupplier") {
                    include "page//supplier/tambahsupplier.php";
                  }
                  if ($aksi == "ubahsupplier") {
                    include "page/supplier/ubahsupplier.php";
                  }

                  if ($aksi == "hapussupplier") {
                    include "page/supplier/hapussupplier.php";
                  }
                }

                if ($page == "jenisbarang") {
                  if ($aksi == "") {
                    include "page/jenisbarang/jenisbarang.php";
                  }
                  if ($aksi == "tambahjenis") {
                    include "page/jenisbarang/tambahjenis.php";
                  }
                  if ($aksi == "ubahjenis") {
                    include "page/jenisbarang/ubahjenis.php";
                  }

                  if ($aksi == "hapusjenis") {
                    include "page/jenisbarang/hapusjenis.php";
                  }
                }

                if ($page == "satuanbarang") {
                  if ($aksi == "") {
                    include "page/satuanbarang/satuan.php";
                  }
                  if ($aksi == "tambahsatuan") {
                    include "page//satuanbarang/tambahsatuan.php";
                  }
                  if ($aksi == "ubahsupplier") {
                    include "page/supplier/ubahsupplier.php";
                  }

                  if ($aksi == "hapussupplier") {
                    include "page/supplier/hapussupplier.php";
                  }
                }

                if ($page == "barangmasuk") {
                  if ($aksi == "") {
                    include "page/barangmasuk/barangmasuk.php";
                  }
                  if ($aksi == "tambahbarangmasuk") {
                    include "page/barangmasuk/tambahbarangmasuk.php";
                  }
                  if ($aksi == "ubahbarangmasuk") {
                    include "page/barangmasuk/ubahbarangmasuk.php";
                  }

                  if ($aksi == "hapusbarangmasuk") {
                    include "page/barangmasuk/hapusbarangmasuk.php";
                  }
                }

                if ($page == "gudang") {
                  if ($aksi == "") {
                    include "page/gudang/gudang.php";
                  }
                  if ($aksi == "tambahgudang") {
                    include "page/gudang/tambahgudang.php";
                  }
                  if ($aksi == "ubahgudang") {
                    include "page/gudang/ubahgudang.php";
                  }

                  if ($aksi == "hapusgudang") {
                    include "page/gudang/hapusgudang.php";
                  }
                }

                if ($page == "barangrusak") {
                  if ($aksi == "") {
                    include "page/barangrusak/barangrusak.php";
                  }
                  if ($aksi == "tambahbarangrusak") {
                    include "page/barangrusak/tambahbarangrusak.php";
                  }
                  if ($aksi == "ubahbarangrusak") {
                    include "page/barangrusak/ubahbarangrusak.php";
                  }
                  if ($aksi == "hapusbarangrusak") {
                    include "page/barangrusak/hapusbarangrusak.php";
                  }
                }
              }



              // MENU PETUGAS PENJUALAN
              if (in_array($level, ['admin', 'petugas_penjualan'])) {
                if ($page == "barangkeluar") {
                  if ($aksi == "") {
                    include "page/barangkeluar/barangkeluar.php";
                  }
                  if ($aksi == "tambahbarangkeluar") {
                    include "page/barangkeluar/tambahbarangkeluar.php";
                  }
                  if ($aksi == "ubahbarangkeluar") {
                    include "page/barangkeluar/ubahbarangkeluar.php";
                  }

                  if ($aksi == "hapusbarangkeluar") {
                    include "page/barangkeluar/hapusbarangkeluar.php";
                  }
                }
              }


              // MENU ADMIN
              if (in_array($level, ['admin'])) {
                if ($page == "laporan_supplier") {
                  if ($aksi == "") {
                    include "page/laporan/laporan_supplier.php";
                  }
                }
                if ($page == "laporan_barangmasuk") {
                  if ($aksi == "") {
                    include "page/laporan/laporan_barangmasuk.php";
                  }
                }

                if ($page == "laporan_gudang") {
                  if ($aksi == "") {
                    include "page/laporan/laporan_gudang.php";
                  }
                }
                if ($page == "laporan_barangkeluar") {
                  if ($aksi == "") {
                    include "page/laporan/laporan_barangkeluar.php";
                  }
                }

                if ($page == "laporan_barangrusak") {
                  if ($aksi == "") {
                    include "page/laporan/laporan_barangrusak.php";
                  }
                }
              }

              if ($page == "") {
                include "home.php";
              }
              if ($page == "home") {
                include "home.php";
              }
              ?>
            </section>
          </div>
        </main>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; 2023. Sistem Informasi Inventaris Barang | Muariful Fattah</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <!-- Chart -->
  <!-- <script src="js/demo/chart-area-demo.js"></script> -->
  <script src="js/demo/chart-pie-demo.js"></script>


  <script>
    $(document).ready(function() {
      $('.select2-on').select2();
    });
  </script>
</body>

</html>
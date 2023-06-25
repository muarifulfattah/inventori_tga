<?php
// Membuat array bulan
$bulan = array(
  'Januari',
  'Februari',
  'Maret',
  'April',
  'Mei',
  'Juni',
  'Juli',
  'Agustus',
  'September',
  'Oktober',
  'November',
  'Desember'
);


// Contoh data stok barang
$data = $koneksi->query("SELECT a.id_barang, b.nama_barang, MONTH(a.tgl_pembelian) as bulan, a.jumlah, SUM(a.jumlah*b.harga_satuan) as jumlah_penjualan FROM barang_keluar a, gudang b WHERE a.id_barang=b.id_barang AND a.tgl_pembelian >= DATE_SUB(CURDATE(), INTERVAL 300 DAY) GROUP BY a.id_barang");

// $barang = array();
// foreach ($data as $index => $row) {
//   $barang[$index][0] = $row['nama_barang'];
//   $barang[$index][1] = $row['jumlah_penjualan'];
// }


// // Konfigurasi k-means
// $k = 5; // Jumlah kelompok yang diinginkan
// $maxIter = 1000; // Jumlah iterasi maksimum
// $epsilon = 0.001; // Toleransi perubahan centroid

// // Inisialisasi centroid secara acak
// $centroids = array();
// for ($i = 0; $i < $k; $i++) {
//   $centroids[] = rand(0, 100);
// }

// // Pemrosesan k-means
// for ($iter = 0; $iter < $maxIter; $iter++) {
//   // Mengelompokkan data ke centroid terdekat
//   $clusters = array();
//   for ($i = 0; $i < count($barang); $i++) {
//     $distances = array();
//     for ($j = 0; $j < $k; $j++) {
//       $distance = abs($barang[$i][1] - $centroids[$j]);
//       $distances[] = $distance;
//     }
//     $clusterIndex = array_search(min($distances), $distances);
//     $clusters[$clusterIndex][] = $barang[$i];
//   }

//   // Menghitung centroid baru
//   $newCentroids = array();
//   foreach ($clusters as $cluster) {
//     $total = 0;
//     foreach ($cluster as $item) {
//       $total += $item[1];
//     }
//     $count = count($cluster);
//     $newCentroids[] = ($count > 0) ? ($total / $count) : 0;
//   }

//   // Menghentikan iterasi jika centroid tidak berubah signifikan
//   $centroidDiff = array_map(function ($a, $b) {
//     return abs($a - $b);
//   }, $centroids, $newCentroids);
//   if (max($centroidDiff) < $epsilon) {
//     break;
//   }

//   $centroids = $newCentroids;
// }

// // Mengambil barang yang harus ditingkatkan stok
// $recommendedItems = $clusters[array_search(max($centroids), $centroids)];

// Menampilkan rekomendasi barang
// echo "Rekomendasi Barang yang Harus Ditingkatkan Stok:<br>";
// foreach ($recommendedItems as $item) {
//   echo $item[0] . " | Dengan Penjualan : " . $item[1] . "<br>";
// }
?>

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
          <a href="?page=pengguna">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Data Pengguna
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php
                    $users = mysqli_query($koneksi, "SELECT * FROM users");
                    echo 'Pengguna ' . mysqli_num_rows($users);
                    ?>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-black-300"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    <?php endif; ?>

    <?php if (in_array($level, ['admin', 'petugas_gudang'])) : ?>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <a href="?page=supplier">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                    Data Supplier
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php
                    $tb_supplier = mysqli_query($koneksi, "SELECT * FROM tb_supplier");
                    echo 'Supplier ' . mysqli_num_rows($tb_supplier);
                    ?>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-black-300"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>


      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
          <a href="?page=gudang">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                    Data Gudang
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php
                    $gudang = mysqli_query($koneksi, "SELECT * FROM gudang");
                    echo 'Data Barang ' . mysqli_num_rows($gudang);
                    ?>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-building fa-2x text-black-300"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>


      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <a href="?page=barangmasuk">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                    Barang Masuk
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php
                    $barang_masuk = mysqli_query($koneksi, "SELECT * FROM barang_masuk");
                    echo 'Barang Masuk ' . mysqli_num_rows($barang_masuk);
                    ?>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-box-open fa-2x text-black-300"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <a href="?page=barangrusak">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                    Barang Rusak
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php
                    $barang_rusak = mysqli_query($koneksi, "SELECT * FROM barang_rusak");
                    echo 'Barang Rusak ' . mysqli_num_rows($barang_rusak);
                    ?>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-comments fa-2x text-black-300"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    <?php endif; ?>

    <?php if (in_array($level, ['admin', 'petugas_penjualan'])) : ?>
      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <a href="?page=barangkeluar">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                    Barang Keluar
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php
                    $barang_keluar = mysqli_query($koneksi, "SELECT * FROM barang_keluar");
                    echo 'Barang Penjualan ' . mysqli_num_rows($barang_keluar);
                    ?>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-dollar-sign fa-2x text-black-300"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    <?php endif; ?>
  </div>


  <?php
  $tahun = date('Y');
  $penjualan = $koneksi->query("SELECT MONTH(tgl_pembelian) as bulan, SUM(jumlah) as jumlah FROM barang_keluar WHERE YEAR(tgl_pembelian)=$tahun GROUP BY MONTH(tgl_pembelian)");

  // Memeriksa apakah query berhasil dijalankan
  if ($penjualan) {
    $result = array();
    // Mendapatkan hasil query
    foreach ($penjualan as $index => $row) {
      $result[0][$index] = $bulan[$row['bulan'] - 1];
      $result[1][$index] = $row['jumlah'];
    }

    $labels = json_encode($result[0]);
    $data = json_encode($result[1]);
  }

  ?>
  <div class="row">
    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Grafik Penjualan Bulanan</h6>
          <!-- <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div> -->
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <div class="chartjs-size-monitor">
              <div class="chartjs-size-monitor-expand">
                <div class=""></div>
              </div>
              <div class="chartjs-size-monitor-shrink">
                <div class=""></div>
              </div>
            </div>
            <canvas id="chartPenjualan" style="display: block; height: 320px; width: 692px;" width="1038" height="480" class="chartjs-render-monitor"></canvas>
          </div>
        </div>
      </div>
    </div>

    <script>
      // Area Chart Example
      var chartPenjualan = document.getElementById("chartPenjualan");
      let labels = <?= $labels; ?>;
      let data = <?= $data; ?>;
      var myLineChart = new Chart(chartPenjualan, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: "Penjualan Bulanan Tahun " + "<?= $tahun; ?>",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: data,
          }],
        },
        options: {
          maintainAspectRatio: false,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          scales: {},
          legend: {
            display: false
          },
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
          }
        }
      });
    </script>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <div class="chartjs-size-monitor">
              <div class="chartjs-size-monitor-expand">
                <div class=""></div>
              </div>
              <div class="chartjs-size-monitor-shrink">
                <div class=""></div>
              </div>
            </div>
            <canvas id="myPieChart" width="469" height="367" style="display: block; height: 245px; width: 313px;" class="chartjs-render-monitor"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle text-primary"></i> Direct
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-success"></i> Social
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-info"></i> Referral
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Content Column -->
    <div class="col-lg-6 mb-4">
      <!-- Project Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
        </div>
        <div class="card-body">
          <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
          <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="table-responsive">
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
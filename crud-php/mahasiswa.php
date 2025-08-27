<?php
session_start();

// Akses login
if (!isset($_SESSION['login'])) {
    echo "<script>
            alert('Login dulu!');
            document.location.href='login.php';
          </script>";
    exit;
}

// Batasan level akses
if ($_SESSION['level'] != 1 && $_SESSION['level'] != 3) {
    echo "<script>
            alert('Anda tidak punya akses!');
            document.location.href='crud-modal.php';
          </script>";
    exit;
}

include 'database.php';

// Fungsi ambil data
function select($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}



// Pagination setup
$jumlahDataPerhalaman = 5;
$halamanAktif = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

// Hitung total data
$jumlahData = count(select("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

// Ambil data mahasiswa
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC LIMIT $awalData, $jumlahDataPerhalaman");

$title = 'Data Mahasiswa';
include 'layout/header.php';
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Yang ada Pada Halaman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
  <div class="container-fluid">
    <div class="row">

      <!-- Data Barang -->
      <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #000; color: #fff; box-shadow: 0 0 15px rgba(0, 123, 255, 0.6); border-radius: 10px;">
          <div class="inner">
            <h4 style="color: #fff; text-shadow: 0 0 5px rgba(0, 123, 255, 0.8);">Data Barang</h4>
          </div>
          <div class="icon" style="font-size: 40px; color: #fff; text-shadow: 0 0 5px rgba(0, 123, 255, 0.8);">
            <i class="fas fa-box"></i>
          </div>
          <a href="index.php" class="small-box-footer" style="display: block; padding: 10px; background-color: rgba(0, 123, 255, 0.1); color: #fff; border-top: 1px solid rgba(0,123,255,0.2); text-align: center; text-shadow: 0 0 3px rgba(0,123,255,0.8);">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <!-- Data Mahasiswa -->
      <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #000; color: #fff; box-shadow: 0 0 15px rgba(0, 123, 255, 0.6); border-radius: 10px;">
          <div class="inner">
            <h5 style="color: #fff; text-shadow: 0 0 5px rgba(0, 123, 255, 0.8);">Data Mahasiswa</h5>
          </div>
          <div class="icon" style="font-size: 40px; color: #fff; text-shadow: 0 0 5px rgba(0, 123, 255, 0.8);">
            <i class="fas fa-user-graduate"></i>
          </div>
          <a href="mahasiswa.php" class="small-box-footer" style="display: block; padding: 10px; background-color: rgba(0, 123, 255, 0.1); color: #fff; border-top: 1px solid rgba(0,123,255,0.2); text-align: center; text-shadow: 0 0 3px rgba(0,123,255,0.8);">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <!-- Data Pegawai -->
      <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #000; color: #fff; box-shadow: 0 0 15px rgba(0, 123, 255, 0.6); border-radius: 10px;">
          <div class="inner">
            <h4 style="color: #fff; text-shadow: 0 0 5px rgba(0, 123, 255, 0.8);">Data Pegawai</h4>
          </div>
          <div class="icon" style="font-size: 40px; color: #fff; text-shadow: 0 0 5px rgba(0, 123, 255, 0.8);">
            <i class="fas fa-user-tie"></i>
          </div>
          <a href="pegawai.php" class="small-box-footer" style="display: block; padding: 10px; background-color: rgba(0, 123, 255, 0.1); color: #fff; border-top: 1px solid rgba(0,123,255,0.2); text-align: center; text-shadow: 0 0 3px rgba(0,123,255,0.8);">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <!-- Data Akun -->
      <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #000; color: #fff; box-shadow: 0 0 15px rgba(0, 123, 255, 0.6); border-radius: 10px;">
          <div class="inner">
            <h4 style="color: #fff; text-shadow: 0 0 5px rgba(0, 123, 255, 0.8);">Data Akun</h4>
          </div>
          <div class="icon" style="font-size: 40px; color: #fff; text-shadow: 0 0 5px rgba(0, 123, 255, 0.8);">
            <i class="fas fa-users-cog"></i>
          </div>
          <a href="crud-modal.php" class="small-box-footer" style="display: block; padding: 10px; background-color: rgba(0, 123, 255, 0.1); color: #fff; border-top: 1px solid rgba(0,123,255,0.2); text-align: center; text-shadow: 0 0 3px rgba(0,123,255,0.8);">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

 


    <section class="content">
        <div class="container-fluid">
            <!-- Card -->
           <div class="card shadow-sm">
  <div class="card-header" style="
       background-color: #000; 
       color: #fff; 
       box-shadow: 0 0 15px rgba(0, 123, 255, 0.8);
       text-shadow: 0 0 8px rgba(0, 123, 255, 0.9);
       border-radius: 5px 5px 0 0;">
    <h3 class="card-title" style="font-weight: 700;">
      <i class="fas fa-user-graduate" style="text-shadow: 0 0 8px rgba(0,123,255,1);"></i> Data Mahasiswa
    </h3>
  </div>

                <div class="card-body">
                    <!-- Action Buttons -->
                   <div class="mb-3">
  <a href="tambah-mahasiswa.php"
     style="background-color:#000;color:#fff;box-shadow:0 0 12px rgba(0,123,255,0.6);border-radius:50px;
            padding:10px 20px;border:none;text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
    <i class="fas fa-user-graduate"></i> Tambah Mahasiswa
  </a>
  <a href="download-excel-mahasiswa.php"
     style="background-color:#000;color:#fff;box-shadow:0 0 12px rgba(0,123,255,0.6);border-radius:50px;
            padding:10px 20px;border:none;text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
    <i class="fas fa-file-excel"></i> Download Excel
  </a>
  <a href="download-pdf-mahasiswa.php"
     style="background-color:#000;color:#fff;box-shadow:0 0 12px rgba(0,123,255,0.6);border-radius:50px;
            padding:10px 20px;border:none;text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
    <i class="fas fa-file-pdf"></i> Download PDF
  </a>
  
</div>


                    <!-- Tabel Mahasiswa -->
                    <div class="table-responsive">
                        <table id="example3" class="table table-striped table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = $awalData + 1; ?>
                                <?php foreach ($data_mahasiswa as $mhs): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($mhs['nama']); ?></td>
                                        <td><?= htmlspecialchars($mhs['prodi']); ?></td>
                                        <td><?= htmlspecialchars($mhs['jk']); ?></td>
                                        <td><?= htmlspecialchars($mhs['telepon']); ?></td>
         <td class="text-center" width="20%">
  <a href="detail-mahasiswa.php?id_mahasiswa=<?= $mhs['id_mahasiswa']; ?>" 
     class="btn btn-sm" 
     style="background-color: #000; color: #fff; box-shadow: 0 0 10px rgba(0,123,255,0.6);">
    Detail
  </a>
  
  <a href="ubah-mahasiswa.php?id_mahasiswa=<?= $mhs['id_mahasiswa']; ?>" 
     class="btn btn-sm" 
     style="background-color: #000; color: #fff; box-shadow: 0 0 10px rgba(0,123,255,0.6);">
    Ubah
  </a>
  
  <a href="hapus-mahasiswa.php?id_mahasiswa=<?= $mhs['id_mahasiswa']; ?>" 
     class="btn btn-sm" 
     onclick="return confirm('Yakin ingin menghapus data ini?')"
     style="background-color: #000; color: #fff; box-shadow: 0 0 10px rgba(0,123,255,0.6);">
    Hapus
  </a>
</td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
<nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination justify-content-center"
        style="background-color: #000; border-radius: 8px; box-shadow: 0 0 15px rgba(0,123,255,0.6); padding: 10px;">
        
        <?php if ($halamanAktif > 1): ?>
            <li class="page-item" style="margin: 0 4px;">
                <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>"
                   style="color: #fff; background-color: transparent; border: 1px solid rgba(0,123,255,0.7);
                   border-radius: 5px; text-shadow: 0 0 5px rgba(0,123,255,0.8);">
                   &laquo;
                </a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $jumlahHalaman; $i++): ?>
            <li class="page-item" style="margin: 0 4px;">
                <a class="page-link" href="?halaman=<?= $i; ?>"
                   style="
                        color: <?= $i == $halamanAktif ? '#007bff' : '#fff' ?>;
                        background-color: <?= $i == $halamanAktif ? 'rgba(0,123,255,0.2)' : 'transparent' ?>;
                        border: 1px solid rgba(0,123,255,0.7);
                        border-radius: 5px;
                        text-shadow: <?= $i == $halamanAktif ? '0 0 8px rgba(0,123,255,1)' : '0 0 5px rgba(0,123,255,0.8)' ?>;
                        font-weight: <?= $i == $halamanAktif ? '700' : '400' ?>;
                   ">
                   <?= $i; ?>
                </a>
            </li>
        <?php endfor; ?>

        <?php if ($halamanAktif < $jumlahHalaman): ?>
            <li class="page-item" style="margin: 0 4px;">
                <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>"
                   style="color: #fff; background-color: transparent; border: 1px solid rgba(0,123,255,0.7);
                   border-radius: 5px; text-shadow: 0 0 5px rgba(0,123,255,0.8);">
                   &raquo;
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<hr>
<h5 class="text-center">Visualisasi Data Mahasiswa</h5>
<div class="row mt-4">
  <div class="col-md-6">
    <canvas id="chartProdi"></canvas>
  </div>
  <div class="col-md-6">
    <canvas id="chartJK"></canvas>
  </div>
</div>

<?php
  // Ambil semua data mahasiswa tanpa limit untuk keperluan chart
  $all_mahasiswa = select("SELECT * FROM mahasiswa");

  $prodiCounts = [];
  $jkCounts = ['Laki Laki' => 0, 'Perempuan' => 0];

  foreach ($all_mahasiswa as $mhs) {
    $prodi = $mhs['prodi'];
    $jk = $mhs['jk'];

    // Hitung prodi
    if (!isset($prodiCounts[$prodi])) {
      $prodiCounts[$prodi] = 1;
    } else {
      $prodiCounts[$prodi]++;
    }

    // Hitung jenis kelamin
    if (isset($jkCounts[$jk])) {
      $jkCounts[$jk]++;
    }
  }
?>

<script>
  const prodiLabels = <?= json_encode(array_keys($prodiCounts)); ?>;
  const prodiData = <?= json_encode(array_values($prodiCounts)); ?>;

  const jkLabels = <?= json_encode(array_keys($jkCounts)); ?>;
  const jkData = <?= json_encode(array_values($jkCounts)); ?>;

  const configProdi = {
    type: 'pie',
    data: {
      labels: prodiLabels,
      datasets: [{
        label: 'Jumlah Mahasiswa',
        data: prodiData,
        backgroundColor: 'rgba(0, 123, 255, 0.6)',
        borderColor: 'rgba(0, 123, 255, 1)',
        borderWidth: 1,
        borderRadius: 6
      }]
    },
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Jumlah Mahasiswa per Program Studi'
        },
        legend: { display: false }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  };

  const configJK = {
    type: 'line',
    data: {
      labels: jkLabels,
      datasets: [{
        label: 'Jenis Kelamin',
        data: jkData,
        backgroundColor: [
          'rgba(0, 123, 255, 0.6)',
          'rgba(255, 99, 132, 0.6)'
        ],
        borderColor: [
          'rgba(0, 123, 255, 1)',
          'rgba(255, 99, 132, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Distribusi Mahasiswa Berdasarkan Jenis Kelamin'
        }
      }
    }
  };

  new Chart(document.getElementById('chartProdi'), configProdi);
  new Chart(document.getElementById('chartJK'), configJK);
</script>


                </div>
            </div>
        </div>
    </section>
</div>



<?php include 'layout/footer.php'; ?>

<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>


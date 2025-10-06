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
$jumlahData = count(select("SELECT * FROM anggota_pmr"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

// Ambil data anggota
$data_anggota = select("SELECT * FROM anggota_pmr ORDER BY id DESC LIMIT $awalData, $jumlahDataPerhalaman");

$title = 'Data Anggota PMR';
include 'layout/header.php';
?>

<div class="content-wrapper" style="background: linear-gradient(135deg, #3EB489, #2E8B7D); min-height: 100vh; color: #fff;">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0" style="color: #fff; text-shadow: 0 0 8px rgba(0,0,0,0.3);">Data Anggota Palang Merah Remaja</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#" style="color: #fff;">Home</a></li>
            <li class="breadcrumb-item active" style="color: #e0e0e0;">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card shadow-lg" style="border-radius: 10px;">
        <div class="card-header" style="
             background-color: #00695c; 
             color: #fff; 
             box-shadow: 0 0 15px rgba(0, 255, 204, 0.8);
             text-shadow: 0 0 8px rgba(0, 255, 204, 0.9);
             border-radius: 5px 5px 0 0;">
          <h3 class="card-title" style="font-weight: 700;">
            <i class="fas fa-user-graduate" style="text-shadow: 0 0 8px rgba(0,255,204,1);"></i> Data PMR
          </h3>
        </div>

        <div class="card-body" style="background-color: #f8f9fa; color: #000;">
          <!-- Action Buttons -->
          <div class="mb-3">
            <a href="tambah-anggota.php" style="background-color:#00695c;color:#fff;box-shadow:0 0 12px rgba(0,255,204,0.6);border-radius:50px;padding:10px 20px;border:none;text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
              <i class="fas fa-user-plus"></i> Tambah Anggota
            </a>
          </div>

          <!-- Tabel Anggota -->
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead style="background-color: #2E8B7D; color: white;">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Kelas</th>
                  <th>Tanggal Lahir</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = $awalData + 1; ?>
                <?php foreach ($data_anggota as $anggota): ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($anggota['nama']); ?></td>
                    <td><?= htmlspecialchars($anggota['jenis_kelamin']); ?></td>
                    <td><?= htmlspecialchars($anggota['kelas']); ?></td>
                    <td><?= htmlspecialchars($anggota['tanggal_lahir']); ?></td>
                    <td><?= htmlspecialchars($anggota['alamat']); ?></td>
                    <td><?= htmlspecialchars($anggota['no_telp']); ?></td>
                    <td class="text-center" width="20%">
                      <a href="detail-anggota.php?id=<?= $anggota['id']; ?>" class="btn btn-sm btn-primary">Detail</a>
                      <a href="ubah-anggota.php?id=<?= $anggota['id']; ?>" class="btn btn-sm btn-warning">Ubah</a>
                      <a href="hapus-mahasiswa.php?id=<?= $anggota['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
              <?php if ($halamanAktif > 1): ?>
                <li class="page-item">
                  <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
                </li>
              <?php endif; ?>
              <?php for ($i = 1; $i <= $jumlahHalaman; $i++): ?>
                <li class="page-item <?= $i == $halamanAktif ? 'active' : '' ?>">
                  <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                </li>
              <?php endfor; ?>
              <?php if ($halamanAktif < $jumlahHalaman): ?>
                <li class="page-item">
                  <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
                </li>
              <?php endif; ?>
            </ul>
          </nav>

          <!-- Chart JK -->
          <hr>
          <h5 class="text-center">Visualisasi Data Anggota Berdasarkan Jenis Kelamin</h5>
          <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
              <canvas id="chartJK"></canvas>
            </div>
          </div>

          <?php
            $all_anggota = select("SELECT * FROM anggota_pmr");
            $jkCounts = ['L' => 0, 'P' => 0];
            foreach ($all_anggota as $anggota) {
                $jk = $anggota['jenis_kelamin'];
                if (isset($jkCounts[$jk])) $jkCounts[$jk]++;
            }
          ?>
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <script>
            const jkLabels = <?= json_encode(array_keys($jkCounts)); ?>;
            const jkData = <?= json_encode(array_values($jkCounts)); ?>;
            new Chart(document.getElementById('chartJK'), {
              type: 'doughnut',
              data: {
                labels: jkLabels,
                datasets: [{
                  data: jkData,
                  backgroundColor: ['rgba(0, 255, 204, 0.6)', 'rgba(255, 99, 132, 0.6)'],
                  borderColor: ['rgba(0,255,204,1)', 'rgba(255,99,132,1)'],
                  borderWidth: 1
                }]
              },
              options: {
                plugins: {
                  title: { display: true, text: 'Distribusi Anggota Berdasarkan Jenis Kelamin' },
                  legend: { position: 'bottom' }
                }
              }
            });
          </script>

        </div>
      </div>
    </div>
  </section>
</div>

<?php include 'layout/footer.php'; ?>

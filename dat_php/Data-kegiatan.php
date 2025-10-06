<?php
session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>alert('Login dulu!');document.location.href='login.php';</script>";
    exit;
}

if ($_SESSION['level'] != 1 && $_SESSION['level'] != 3) {
    echo "<script>alert('Anda tidak punya akses!');document.location.href='crud-modal.php';</script>";
    exit;
}

include 'config/app.php';

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

$title = 'Data Kegiatan Sosial';
include 'layout/header.php';

// Ambil semua data kegiatan
$data_kegiatan = select("SELECT * FROM kegiatan");

// --- Fungsi ubah "X Jam Y Menit" jadi menit total ---
function convertToMinutes($text) {
    $jam = 0;
    $menit = 0;
    if (preg_match('/(\d+)\s*Jam/i', $text, $m)) $jam = (int)$m[1];
    if (preg_match('/(\d+)\s*Menit/i', $text, $m)) $menit = (int)$m[1];
    return $jam * 60 + $menit;
}

// Hitung total jam partisipasi per anggota (dalam jam desimal)
$jamCounts = [];
$kegiatanCounts = [];

foreach ($data_kegiatan as $kg) {
    $menit = convertToMinutes($kg['jam_partisipasi']);
    $jamCounts[$kg['nama_anggota']] = ($jamCounts[$kg['nama_anggota']] ?? 0) + ($menit / 60);
    $kegiatanCounts[$kg['nama_anggota']] = ($kegiatanCounts[$kg['nama_anggota']] ?? 0) + 1;
}
?>

<div class="content-wrapper" style="background: linear-gradient(135deg, #3EB489, #2E8B7D); min-height: 100vh; color: #fff;">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0" style="color: #fff; text-shadow: 0 0 8px rgba(0,0,0,0.3);">
            Data Kegiatan Sosial
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#" style="color: #fff;">Home</a></li>
            <li class="breadcrumb-item active" style="color: #e0e0e0;">Kegiatan</li>
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
            <i class="fas fa-hands-helping" style="text-shadow: 0 0 8px rgba(0,255,204,1);"></i>
            Data Kegiatan Sosial
          </h3>
        </div>

        <div class="card-body" style="background-color: #f8f9fa; color: #000;">
          <!-- Table Section -->
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead style="background-color: #2E8B7D; color: white;">
                <tr>
                  <th>No</th>
                  <th>Nama Anggota</th>
                  <th>Tanggal</th>
                  <th>Lokasi</th>
                  <th>Deskripsi</th>
                  <th>Jam Partisipasi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($data_kegiatan as $kg): ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($kg['nama_anggota']); ?></td>
                    <td><?= htmlspecialchars($kg['tanggal']); ?></td>
                    <td><?= htmlspecialchars($kg['lokasi']); ?></td>
                    <td><?= htmlspecialchars($kg['deskripsi']); ?></td>
                    <td><?= htmlspecialchars($kg['jam_partisipasi']); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

          <!-- Chart Section -->
          <hr style="border-color: rgba(0,255,204,0.3);">
          <h5 class="text-center mt-4" style="color:#00695c;">Visualisasi Kegiatan Sosial</h5>
          <div class="row mt-4 mb-4">
            <div class="col-md-12">
              <canvas id="chartGabungan"></canvas>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const anggotaLabels = <?= json_encode(array_keys($jamCounts)); ?>;
const jamData   = <?= json_encode(array_values($jamCounts)); ?>;
const kegiatanData   = <?= json_encode(array_values($kegiatanCounts)); ?>;

new Chart(document.getElementById('chartGabungan'), {
  type: 'line',
  data: {
    labels: anggotaLabels,
    datasets: [
      {
        label: 'Total Jam Partisipasi (Jam)',
        data: jamData,
        borderColor: 'rgba(0, 255, 204, 1)',
        backgroundColor: 'rgba(0, 255, 204, 0.3)',
        yAxisID: 'y',
        tension: 0.35,
        fill: true
      },
      {
        label: 'Jumlah Kegiatan',
        data: kegiatanData,
        borderColor: '#2E8B7D',
        backgroundColor: 'rgba(46, 139, 125, 0.3)',
        yAxisID: 'y1',
        tension: 0.35,
        fill: true
      }
    ]
  },
  options: {
    responsive: true,
    interaction: { mode: 'index', intersect: false },
    plugins: {
      legend: { labels: { color: '#000' } },
      title: {
        display: true,
        text: 'Statistik Partisipasi Anggota',
        color: '#00695c',
        font: { size: 18, weight: 'bold' }
      }
    },
    scales: {
      x: {
        ticks: { color: '#000' },
        grid: { color: 'rgba(0,0,0,0.1)' }
      },
      y: {
        type: 'linear',
        position: 'left',
        beginAtZero: true,
        ticks: { color: '#000' },
        grid: { color: 'rgba(0,0,0,0.1)' }
      },
      y1: {
        type: 'linear',
        position: 'right',
        beginAtZero: true,
        ticks: { color: '#000' },
        grid: { drawOnChartArea: false }
      }
    }
  }
});
</script>

<?php include 'layout/footer.php'; ?>

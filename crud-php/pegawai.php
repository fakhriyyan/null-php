<?php
session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>
            alert('Login dulu!');
            document.location.href='login.php';
          </script>";
    exit;
}

if ($_SESSION['level'] != 1 && $_SESSION['level'] != 3) {
    echo "<script>
            alert('Anda tidak punya akses!');
            document.location.href='crud-modal.php';
          </script>";
    exit;
}

include 'database.php';

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

$title = 'Data Pegawai';
include 'layout/header.php';

// Ambil semua data pegawai untuk grafik
$data_pegawai = select("SELECT * FROM pegawai");

// Hitung jumlah pegawai per jabatan dan alamat
$jabatanCounts = [];
$alamatCounts = [];

foreach ($data_pegawai as $pgw) {
    $jabatanCounts[$pgw['jabatan']] = ($jabatanCounts[$pgw['jabatan']] ?? 0) + 1;
    $alamatCounts[$pgw['alamat']] = ($alamatCounts[$pgw['alamat']] ?? 0) + 1;
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pegawai</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="card shadow-sm">
          <div class="card-header" style="background-color: #000; color: #fff; box-shadow: 0 0 15px rgba(0, 123, 255, 0.8); text-shadow: 0 0 8px rgba(0, 123, 255, 1); display: flex; align-items: center;">
              <i class="fas fa-user-tie" style="font-size: 30px; margin-right: 10px; text-shadow: 0 0 8px rgba(0, 123, 255, 1);"></i>
              <h3 class="card-title" style="font-weight: 700;">Data Pegawai</h3>
          </div>

          <div class="card-body">
              <!-- Tabel Pegawai -->
              <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                      <thead class="thead-light">
                          <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Jabatan</th>
                              <th>Email</th>
                              <th>Telepon</th>
                              <th>Alamat</th>
                          </tr>
                      </thead>
                      <tbody id="live_data">
                          <!-- Data pegawai dimuat oleh AJAX -->
                      </tbody>
                  </table>
              </div>

              <!-- Chart Section -->
              <hr>
              <h5 class="text-center mt-4">Visualisasi Data Pegawai</h5>
              <div class="row mt-4 mb-4">
                <div class="col-md-6">
                  <canvas id="chartJabatan"></canvas>
                </div>
                <div class="col-md-6">
                  <canvas id="chartAlamat"></canvas>
                </div>
              </div>

          </div>
        </div>
      </div>
    </section>
</div>

<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  $(document).ready(function () {
    getPegawai();
  });

  function getPegawai() {
    $.ajax({
      url: "realtime-pegawai.php",
      type: "GET",
      success: function(response) {
        $('#live_data').html(response);
      },
      error: function() {
        alert("Error fetching data!");
      }
    });
  }

  // Chart Data from PHP
  const jabatanLabels = <?= json_encode(array_keys($jabatanCounts)); ?>;
  const jabatanData = <?= json_encode(array_values($jabatanCounts)); ?>;

  const alamatLabels = <?= json_encode(array_keys($alamatCounts)); ?>;
  const alamatData = <?= json_encode(array_values($alamatCounts)); ?>;

  // Chart Jabatan
  new Chart(document.getElementById('chartJabatan'), {
    type: 'bar',
    data: {
      labels: jabatanLabels,
      datasets: [{
        label: 'Jumlah Pegawai',
        data: jabatanData,
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
          text: 'Jumlah Pegawai per Jabatan'
        },
        legend: { display: false }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });

  // Chart Alamat
  new Chart(document.getElementById('chartAlamat'), {
    type: 'pie',
    data: {
      labels: alamatLabels,
      datasets: [{
        label: 'Jumlah Pegawai',
        data: alamatData,
        backgroundColor: [
          'rgba(0,123,255,0.6)',
          'rgba(99, 245, 255, 0.6)',
          'rgba(0, 89, 255, 0.6)',
          'rgba(75,192,192,0.6)'
        ],
        borderColor: 'rgba(255,255,255,1)',
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Distribusi Pegawai per Alamat'
        }
      }
    }
  });
</script>

<?php include 'layout/footer.php'; ?>

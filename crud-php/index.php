<?php



    session_start();


if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!');
            document.location.href='login.php';
        </script>";
    exit;
}

if ($_SESSION["level"] != 1 and $_SESSION["level"] != 2 ) {
    echo "<script>
            alert('Perhatian Anda Tidak Punya Hak Akses!!');
            document.location.href='akun.php';
        </script>";
    exit;
}


$title = 'Daftar Barang';

include 'layout/header.php';

// $data_barang = select("SELECT * FROM barang ORDER BY id_barang ASC");

$jumlahDataPerhalaman = 5; // Set the number of items per page
$halamanAktif = 1; // Default active page
$jumlahHalaman = 1; // Default number of pages



if (isset($_POST['filter'])) {
  $tgl_awal = strip_tags($_POST['tgl_awal'] . " 00:00:00");
  $tgl_akhir = strip_tags($_POST['tgl_akhir'] . " 23:59:59");

  $data_barang = select("SELECT * FROM barang WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY id_barang DESC");
} else {
  // Get total data count
  $jumlahData = count(select("SELECT * FROM barang"));
  $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
  $halamanAktif = (isset($_GET["halaman"]) ? (int)$_GET['halaman'] : 1);
  $awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

  // Fetch data for the current page
  $data_barang = select("SELECT * FROM barang ORDER BY id_barang DESC LIMIT $awalData, $jumlahDataPerhalaman");
}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



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
        <div class="small-box" style="background-color: #000000ff; color: #ffffffff; box-shadow: 0 0 15px rgba(0, 123, 255, 0.6); border-radius: 10px;">
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
    <div class="row">
       <div class="col-12">
        <div class="card shadow-sm rounded">
         <div class="card-header" style="background-color: #000; box-shadow: 0 0 12px rgba(0,123,255,0.7); border-radius: 8px;">
  <h3 class="card-title" style="color: #fff; text-shadow: 0 0 6px rgba(0,123,255,0.9); font-weight: 600;">
    <i class="nav-icon fas fa-box" style="text-shadow: 0 0 6px rgba(0,123,255,0.9);"></i> Data Barang
  </h3>
</div>

          <div class="card-body">
            <!-- Action Buttons -->
           <div class="mb-3">
  <a href="tambah-barang.php"
     class="btn"
     style="background-color: #000; color: #fff; box-shadow: 0 0 12px rgba(0,123,255,0.6); border-radius: 50px; padding: 10px 20px; text-shadow: 0 0 4px rgba(0,123,255,0.9);">
     Tambah Barang
  </a>

  <button type="button"
          class="btn"
          data-toggle="modal"
          data-target="#modalFilter"
          style="background-color: #000; color: #fff; box-shadow: 0 0 12px rgba(0,123,255,0.6); border-radius: 50px; padding: 10px 20px; text-shadow: 0 0 4px rgba(0,123,255,0.9);">
    <i class="fas fa-search"></i> Filter Data
  </button>
</div>


            <!-- Table -->
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
   
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example3" class="table table-bordered table-hover">
                   <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Barcode</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          <?php foreach ($data_barang as $barang): ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $barang['nama']; ?></td>
              <td><?= $barang['jumlah']; ?></td>
              <td>Rp.<?= number_format($barang['harga'], 0, ',', '.'); ?></td>
              <td class="text-center">
               <img src="barcode.php?text=123456&codetype=code128&print=true" alt="barcode" />

              </td>
              <td><?= date("d/m/y | H:i:s", strtotime($barang['tanggal'])); ?></td>
              <td class="text-center" width="20%">
  <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>" 
     class="btn btn-sm" 
     style="background-color: #000; color: #fff; box-shadow: 0 0 10px rgba(0,123,255,0.6);">
    Ubah
  </a>
  
  <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" 
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
              <!-- Chart Section -->
<hr>
<h5 class="text-center">Visualisasi Data Barang</h5>
<div class="row mt-4">
  <div class="col-md-6">
    <canvas id="chartJumlah"></canvas>
  </div>
  <div class="col-md-6">
    <canvas id="chartHarga"></canvas>
  </div>
</div>

<!-- Chart Data Script -->
<?php
  $labels = [];
  $dataJumlah = [];
  $dataHarga = [];

  foreach ($data_barang as $item) {
    $labels[] = $item['nama'];
    $dataJumlah[] = $item['jumlah'];
    $dataHarga[] = $item['harga'];
  }
?>

<script>
  const labels = <?= json_encode($labels); ?>;
  const dataJumlah = <?= json_encode($dataJumlah); ?>;
  const dataHarga = <?= json_encode($dataHarga); ?>;

  const configJumlah = {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        label: 'Jumlah Barang',
        data: dataJumlah,
        backgroundColor: 'rgba(0, 123, 255, 0.6)',
        borderColor: 'rgba(0, 123, 255, 1)',
        borderWidth: 1,
        borderRadius: 5
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        title: {
          display: true,
          text: 'Jumlah Barang per Item'
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  };

  const configHarga = {
    type: 'doughnut',
    data: {
      labels: labels,
      datasets: [{
        label: 'Harga Barang (Rp)',
        data: dataHarga,
        backgroundColor: 'rgba(0, 119, 255, 0.53)',
        borderColor: 'rgba(1, 90, 255, 1)',
        borderWidth: 1,
        borderRadius: 5
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        title: {
          display: true,
          text: 'Harga Barang per Item'
        }
      },
      scales: {
        y: {
          beginAtZero: false
        }
      }
    }
  };

  new Chart(document.getElementById('chartJumlah'), configJumlah);
  new Chart(document.getElementById('chartHarga'), configHarga);
</script>

              <!-- /.card-body -->
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
    <!--pagination-->
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

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <!-- /.content -->
  </div>


<!-- Model Firter -->
<div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #000; box-shadow: 0 0 12px rgba(0,123,255,0.7); border-radius: 6px;">
  <h5 class="modal-title" id="exampleModalLabel" style="color: #fff; text-shadow: 0 0 6px rgba(0,123,255,0.9); font-weight: 600;">
    <i class="fas fa-search" style="text-shadow: 0 0 6px rgba(0,123,255,0.9);"></i> Filter Data
  </h5>
  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="color: #fff; opacity: 1;">
      <span aria-hidden="true">&times;</span>
  </button>
</div>

      <div class="modal-body">
              <form action="" method="post">
                <div class="from-group"  >
                  <label for="tgl_awal">Tanggal Awal</label>
                 <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" 
  style="box-shadow: 0 0 8px rgba(0,123,255,0.7); border-radius: 6px; border: 1px solid #007bff;">

                </div>
                <div class="from-group"  >
                  <label for="tgl_akhir">Tanggal Akhir</label>
                 <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" 
  style="box-shadow: 0 0 8px rgba(0,123,255,0.7); border-radius: 6px; border: 1px solid #007bff;">

                </div>
      <div class="modal-footer">
  <button type="button" class="btn" data-dismiss="modal"
    style="background-color: #000; color: #fff; box-shadow: 0 0 10px rgba(0,123,255,0.6); border-radius: 50px; padding: 8px 18px; border:none;">
    Batal
  </button>
  <button type="submit" name="filter"
    style="background-color: #000; color: #fff; box-shadow: 0 0 12px rgba(0,123,255,0.8); border-radius: 50px; padding: 8px 22px; border:none;">
    Submit
  </button>
</div>

      </form>
      </div>
    </div>
  </div>
</div>



  <?php include 'layout/footer.php' ?>

  
    
          
                  

  

    

  
   




<?php
session_start();
//membatasi halaman sebelum login
if (!isset($_SESSION['login'])){
  echo "<script>
         alert('login Dulu!');
         document.location.href = 'login.php';
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

// Pagination setup
$jumlahDataPerhalaman = 5;
$halamanAktif = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

// Hitung total data
$jumlahData = count(select("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <title>CRUD PHP MYSQL Bootstrap</title>
  </head>
  <body>

   

    <?php 
    include 'layout/header.php'; 
    $title= 'Daftar Akun';
   
    //tampilkan seluruh data
$data_akun = select("SELECT * FROM akun");

//tampilkan data berdasarkan user login
$id_akun = $_SESSION['id_akun'];
$data_bylogin = select("SELECT * FROM akun WHERE id_akun = $id_akun");
    
    //jika Tombol Tambah Ditekan jalankan script berikut
    if(isset($_POST['tambah'])){
        if(create_akun($_POST)> 0){
        echo "<script>
                alert('Data Akun Berhasil Ditambahkan');
                document.location.href = 'crud-modal.php';
                </script>";
        }else{
            echo  "<script>
                alert('Data Akun Gagal Ditambahkan');
                document.location.href = 'crud-modal.php';
                </script>"; 
        }         
    }
    
   //buat yang ubah
   //jika Tombol ubah Ditekan jalankan script berikut
    if(isset($_POST['ubah'])){
        if(update_akun($_POST)> 0){
        echo "<script>
                alert('Data Akun Berhasil Diubah');
                document.location.href = 'crud-modal.php';
                </script>";
        }else{
            echo  "<script>
                alert('Data Akun Gagal Diubah');
                document.location.href = 'crud-modal.php';
                </script>"; 
        }         
    }


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
          <a href="#" class="small-box-footer" style="display: block; padding: 10px; background-color: rgba(0, 123, 255, 0.1); color: #fff; border-top: 1px solid rgba(0,123,255,0.2); text-align: center; text-shadow: 0 0 3px rgba(0,123,255,0.8);">
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


   <div class="card-header text-white"
     style="
       background-color: #000;
       color: #fff;
       box-shadow: 0 0 15px rgba(0, 123, 255, 0.7);
       border-radius: 8px 8px 0 0;
       padding: 15px 20px;
       border-bottom: 1px solid rgba(0, 123, 255, 0.4);
       text-shadow: 0 0 6px rgba(0, 123, 255, 0.9);
     ">
  <h3 class="card-title m-0"><i class="fas fa-users-cog"></i> Data Akun</h3>
</div>


      <?php if ($_SESSION['level'] == 1) : ?>
    <button type="button"
        class="btn mb-1"
        style="
          background-color: #000;
          color: #fff;
          border: 1px solid rgba(0, 123, 255, 0.9);
          box-shadow: 0 0 12px rgba(0, 123, 255, 0.8);
          text-shadow: 0 0 6px rgba(0, 123, 255, 0.9);
          padding: 8px 16px;
          border-radius: 50px;
          display: inline-flex;
          align-items: center;
          gap: 6px;
        "
        data-bs-toggle="modal"
        data-bs-target="#modalTambah">
  <i class="fas fa-plus-circle"></i> Tambah
</button>

       <?php endif; ?>  

      <table id="table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- Menggunakan PHP untuk menampilkan data akun ke dalam tabel -->
          <?php $no = 1; ?>
          <?php if ($_SESSION['level'] == 1) : ?>
          <?php foreach ($data_akun as $akun) : ?>
              <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $akun['nama']; ?></td>
                  <td><?= $akun['username']; ?></td>
                  <td><?= $akun['email']; ?></td>
                  <td><p>Password Ter-enkripsi</p></td>
                  <td class="text-center">
                     <!-- Tombol Ubah (Glow Biru) -->
<button type="button"
        class="btn mb-1"
        style="
          background-color: #000;
          color: #fff;
          border: 1px solid rgba(0, 123, 255, 0.9);
          box-shadow: 0 0 12px rgba(0, 123, 255, 0.8);
          text-shadow: 0 0 6px rgba(0, 123, 255, 0.9);
          padding: 5px 15px;
          border-radius: 5px;
        "
        data-bs-toggle="modal"
        data-bs-target="#modalUbah<?= $akun['id_akun']; ?>">
  Ubah
</button>

<!-- Tombol Hapus (Glow Biru) -->
<button type="button"
        class="btn mb-1"
        style="
          background-color: #000;
          color: #fff;
          border: 1px solid rgba(0, 123, 255, 0.9);
          box-shadow: 0 0 12px rgba(0, 123, 255, 0.8);
          text-shadow: 0 0 6px rgba(0, 123, 255, 0.9);
          padding: 5px 15px;
          border-radius: 5px;
        "
        data-bs-toggle="modal"
        data-bs-target="#modalHapus<?= $akun['id_akun']; ?>">
  Hapus
</button>

                  </td>
              </tr>
          <?php endforeach; ?>
          <?php else: ?>
          <!-- tampil data berdasarkan user login -->
           ,,<?php foreach ($data_bylogin as $akun) : ?>
              <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $akun['nama']; ?></td>
                  <td><?= $akun['username']; ?></td>
                  <td><?= $akun['email']; ?></td>
                  <td><p>Password Ter-enkripsi</p></td>
                  <td class="text-center">
                      <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal"
                       data-bs-target="#modalUbah<?= $akun['id_akun']; ?>">Ubah</button>
                      
              </tr>
          <?php endforeach; ?>

          <?php endif; ?>
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


   <!-- Modal Tambah Akun -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 8px; box-shadow: 0 0 15px rgba(0,123,255,0.5);">

      <!-- Header -->
      <div class="modal-header" style="background-color: #000; box-shadow: 0 0 12px rgba(0,123,255,0.7); border-radius: 6px;">
        <h5 class="modal-title" id="modalTambahLabel" style="color: #fff; text-shadow: 0 0 6px rgba(0,123,255,0.9); font-weight: 600;">
          <i class="fas fa-user-plus" style="text-shadow: 0 0 6px rgba(0,123,255,0.9);"></i> Tambah Akun
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form action="" method="post">
          <div class="mb-3">
            <label for="nama" style="color: #000;">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control"
              style="background-color: #fff; color: #000; border-radius: 6px; box-shadow: 0 0 8px rgba(0,123,255,0.4); border: 1px solid #007bff;" required>
          </div>

          <div class="mb-3">
            <label for="username" style="color: #000;">Username</label>
            <input type="text" name="username" id="username" class="form-control"
              style="background-color: #fff; color: #000; border-radius: 6px; box-shadow: 0 0 8px rgba(0,123,255,0.4); border: 1px solid #007bff;" required>
          </div>

          <div class="mb-3">
            <label for="email" style="color: #000;">Email</label>
            <input type="email" name="email" id="email" class="form-control"
              style="background-color: #fff; color: #000; border-radius: 6px; box-shadow: 0 0 8px rgba(0,123,255,0.4); border: 1px solid #007bff;" required>
          </div>

          <div class="mb-3">
            <label for="password" style="color: #000;">Password</label>
            <input type="password" name="password" id="password" class="form-control"
              style="background-color: #fff; color: #000; border-radius: 6px; box-shadow: 0 0 8px rgba(0,123,255,0.4); border: 1px solid #007bff;" required>
          </div>

          <div class="mb-3">
            <label for="level" style="color: #000;">Level</label>
            <select name="level" id="level" class="form-control"
              style="background-color: #fff; color: #000; border-radius: 6px; box-shadow: 0 0 8px rgba(0,123,255,0.4); border: 1px solid #007bff;" required>
              <option value="">-- Pilih Level --</option>
              <option value="1">Admin</option>
              <option value="2">Operator Barang</option>
              <option value="3">Operator Mahasiswa</option>
            </select>
          </div>

          <!-- Footer -->
          <div class="modal-footer">
            <button type="button" class="btn"
              data-bs-dismiss="modal"
              style="background-color: #000; color: #fff; box-shadow: 0 0 10px rgba(0,123,255,0.6); border-radius: 50px; padding: 8px 18px; border:none;">
              Kembali
            </button>
            <button type="submit" name="tambah" class="btn"
              style="background-color: #000; color: #fff; box-shadow: 0 0 12px rgba(0,123,255,0.8); border-radius: 50px; padding: 8px 22px; border:none;">
              Tambah
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

    <?php foreach ($data_akun as $akun) : ?>
     <!-- Modal hapus -->
     <div class="modal fade" id="modalHapus<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger   text-white">
            <h5 class="modal-title" id="exampleModalLabel">Hapus Akun</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body"></div>
                <p> Yakin Ingin Menghapus Data Akun : <?= $akun['nama']; ?> .?</p>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
           <a href="hapus-akun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-danger">Hapus</a>

           </form> 
          </div>
        </div>
      </div>
    </div>
     <?php endforeach; ?>  
      
      
      <?php foreach ($data_akun as $akun) : ?>
  <!-- Modal ubah -->
  <div class="modal fade" id="modalUbah<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Akun</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="" method="post">
            <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">
            
            <div class="mb-3">
              <label for="nama">Nama</label>
              <input type="text" name="nama" id="nama" class="form-control" value="<?= $akun['nama']; ?>" required>
            </div>

            <div class="mb-3">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control" value="<?= $akun['username']; ?>" required>
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" value="<?= $akun['email']; ?>" required>
            </div>

            <div class="mb-3">
              <label for="password">Password<small>(Masukkan Password Lama)</small></label>
              <input type="password" name="password" id="password" class="form-control" required minlength="6">
            </div>

            <?php  if ($_SESSION['level'] == 1) :?>

            <div class="mb-3">
              <label for="level">Level</label>
              <select name="level" id="level" class="form-control" required>
                <?php $level =$akun['level']; ?>
                <option value="1" <?= $level == '1' ? 'selected' : null ?>>Admin</option>
                <option value="2" <?= $level == '2' ? 'selected' : null ?>>Operator Barang</option>
                <option value="3" <?= $level == '3' ? 'selected' : null ?>>Operator Mahasiswa</option>
              </select>
            </div>

            <?php endif; ?>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
          <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- ======= GRAFIK CHART.JS ======= -->
<hr>
<h5 class="text-center mt-5">Visualisasi Data Akun</h5>
<div class="row mb-5">
  <div class="col-md-6">
    <canvas id="chartLevel"></canvas>
  </div>
  <div class="col-md-6">
    <canvas id="chartEmail"></canvas>
  </div>
</div>

<?php
  // Hitung data untuk chart level
  $levelCounts = ['Admin' => 0, 'Operator Barang' => 0, 'Operator Mahasiswa' => 0];
  $emailDomains = [];

  foreach ($data_akun as $akun) {
    // Hitung level
    switch ($akun['level']) {
      case '1': $levelCounts['Admin']++; break;
      case '2': $levelCounts['Operator Barang']++; break;
      case '3': $levelCounts['Operator Mahasiswa']++; break;
    }

    // Hitung domain email
    $parts = explode('@', $akun['email']);
    if (count($parts) === 2) {
      $domain = strtolower($parts[1]);
      $emailDomains[$domain] = ($emailDomains[$domain] ?? 0) + 1;
    }
  }
?>



    <?php include 'layout/footer.php'; ?>

    <!-- ✅ JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- ✅ Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ✅ DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- ✅ Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // Chart Level Akun
  const levelLabels = <?= json_encode(array_keys($levelCounts)); ?>;
  const levelData = <?= json_encode(array_values($levelCounts)); ?>;

  new Chart(document.getElementById('chartLevel'), {
    type: 'bar',
    data: {
      labels: levelLabels,
      datasets: [{
        label: 'Jumlah Akun',
        data: levelData,
        backgroundColor: 'rgba(0, 123, 255, 0.6)',
        borderColor: 'rgba(0, 198, 248, 1)',
        borderWidth: 1,
        borderRadius: 5
      }]
    },
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Jumlah Akun per Level'
        },
        legend: { display: false }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });

  // Chart Email Domain Akun
  const emailLabels = <?= json_encode(array_keys($emailDomains)); ?>;
  const emailData = <?= json_encode(array_values($emailDomains)); ?>;

  new Chart(document.getElementById('chartEmail'), {
    type: 'doughnut',
    data: {
      labels: emailLabels,
      datasets: [{
        data: emailData,
        backgroundColor: [
          'rgba(0,123,255,0.6)',
          'rgba(99, 206, 255, 1)',
          'rgba(0, 140, 255, 0.73)',
          'rgba(75,192,192,0.6)',
          'rgba(153,102,255,0.6)'
        ],
        borderColor: '#fff',
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        title: {
          display: true,
          text: 'Distribusi Domain Email Pengguna'
        }
      }
    }
  });
</script>


    <!-- ✅ Init DataTables -->
    <script>
      $(document).ready(function () {
        $('#table').DataTable(); // Inisialisasi DataTables di tabel id=table
      });
    </script>
  </body>
</html>



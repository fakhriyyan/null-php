<?php
session_start();

if (!isset($_SESSION['login'])) {
    echo "<script>alert('Login dulu!');document.location.href='login.php';</script>";
    exit;
}

include 'config/app.php';
include 'layout/header.php';

// Ambil data akun dari database
$data_akun = mysqli_query($db, "SELECT * FROM akun ORDER BY id_akun ASC");
?>

<!-- Wrapper -->
<div class="content-wrapper" style="background: linear-gradient(180deg, #00796b, #009688); color: #333; min-height: 100vh; padding: 25px;">
  <div class="content-header text-center mb-4">
    <h1 class="m-0" style="color: #ffffff;">Data Akun Pengguna</h1>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card shadow" style="border-radius: 10px;">
        <div class="card-header d-flex justify-content-between align-items-center" 
             style="background-color: #009688; color: white; border-radius: 10px 10px 0 0;">
          <h3 class="card-title mb-0">
            <i class="fas fa-users me-2"></i> Data Akun
          </h3>
          <a href="tambah_akun.php" class="btn btn-light" style="color: #009688; font-weight: 600;">
            <i class="fas fa-plus-circle"></i> Tambah Akun
          </a>
        </div>

        <div class="card-body" style="background-color: #ffffff; border-radius: 0 0 10px 10px;">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" style="margin-bottom: 0;">
              <thead style="background-color: #00796b; color: #fff;">
                <tr class="text-center">
                  <th style="width: 50px;">No</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th style="width: 150px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; while ($akun = mysqli_fetch_assoc($data_akun)) : ?>
                <tr class="text-center align-middle">
                  <td><?= $no++; ?></td>
                  <td><?= htmlspecialchars($akun['nama']); ?></td>
                  <td><?= htmlspecialchars($akun['username']); ?></td>
                  <td><?= htmlspecialchars($akun['email']); ?></td>
                  <td>Password terenkripsi</td>
                  <td>
                    <a href="ubah_akun.php?id_akun=<?= $akun['id_akun']; ?>" 
                       class="btn btn-warning btn-sm text-white fw-bold">Ubah</a>
                    <a href="hapus_akun.php?id_akun=<?= $akun['id_akun']; ?>" 
                       class="btn btn-danger btn-sm fw-bold"
                       onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                  </td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Sidebar harmonization -->
<style>
  .main-sidebar {
    background-color: #00695c !important;
  }

  .nav-link, .brand-link {
    color: #fff !important;
  }

  .nav-link.active, .nav-link:hover {
    background-color: #009688 !important;
    color: #fff !important;
  }

  .content-wrapper {
    margin-left: 260px;
  }

  .table td, .table th {
    vertical-align: middle;
  }

  body {
    background-color: #00796b !important;
  }
</style>

<?php include 'layout/footer.php'; ?>

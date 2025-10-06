<?php
include 'config/app.php';
// Cukup koneksi saja, jangan buat ulang fungsi select()
include_once 'database.php';
?>

 

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $title; ?> </title> 
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css">


 <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">CRUD PHP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php if ($_SESSION['level'] == 1 or $_SESSION['level'] == 2) :?>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Barang</a>
            </li>
             <?php endif; ?>
             
              <?php if ($_SESSION['level'] == 1 or $_SESSION['level'] == 3) :?>
            <li class="nav-item">
              <a class="nav-link" href="mahasiswa.php">Mahasiswa</a>
            </li>
            <?php endif; ?>

            <li class="nav-item">
              <a class="nav-link" href="crud-modal.php">Akun</a> 
            </li>

            <li class="nav-item">
              <a class="nav-link" href="logout.php" onclick= "return confirm('Yakin ingin keluar.?')">keluar</a> 
            </li>
         </ul>
 <div>
      <a class="navbar-brand" href="#"><?= $_SESSION['nama']; ?></a>
  </div>
      </div>
    </nav>
</div>
  </head>

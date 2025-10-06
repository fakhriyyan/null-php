<?php 
include 'config/app.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title; ?></title>

  <!-- DataTables -->
  <link rel="stylesheet" href="assets-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets-template/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets-template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="assets-template/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets-template/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets-template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets-template/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="assets-template/plugins/summernote/summernote-bs4.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">

  <!-- jQuery -->
  <script src="assets-template/plugins/jquery/jquery.min.js"></script>

  <!-- 🌊 DARKER TURQUOISE THEME -->
  <style>
    :root {
      --main-color: #1ABC9C;      /* dark turquoise */
      --main-dark: #148F77;       /* deep teal */
      --main-light: #A2D9CE;      /* soft light teal */
      --text-light: #ffffff;
      --text-dark: #0d0d0d;
    }

    /* SIDEBAR */
    .main-sidebar {
      background-color: var(--main-dark) !important;
    }

    .main-sidebar .brand-link,
    .main-sidebar .user-panel a,
    .main-sidebar .nav-link,
    .main-sidebar .nav-header {
      color: var(--text-light) !important;
    }

    .main-sidebar .nav-link.active {
      background-color: var(--main-color) !important;
      color: var(--text-light) !important;
    }

    .main-sidebar .nav-link:hover {
      background-color: var(--main-color) !important;
      color: var(--text-light) !important;
    }

    /* BRAND LOGO */
    .brand-logo {
      background-color: var(--main-color);
    }

    .brand-logo h4 {
      color: var(--text-light);
      margin: 0;
    }

    /* NAVBAR */
    .main-header.navbar {
      background-color: var(--main-dark) !important;
      color: var(--text-light);
    }

    .main-header .navbar .nav-link,
    .main-header .navbar .brand-link {
      color: var(--text-light) !important;
    }

    /* PRELOADER */
    #preloader {
      background-color: var(--main-dark);
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
    }

    .loader i {
      color: var(--text-light);
      text-shadow: 0 0 10px rgba(255, 255, 255, 0.6),
                   0 0 20px rgba(255, 255, 255, 0.4);
    }

    #preloader.fade-out {
      opacity: 0;
      transition: opacity 0.5s ease;
    }

    /* PAGE BACKGROUND */
    body {
      background-color: #E8F6F3;
    }

    /* DATATABLES BUTTONS */
    .btn-primary {
      background-color: var(--main-color);
      border-color: var(--main-dark);
    }

    .btn-primary:hover {
      background-color: var(--main-dark);
      border-color: var(--main-dark);
    }

    /* CARD HEADERS */
    .card-header {
      background-color: var(--main-color);
      color: var(--text-light);
    }

    /* Table header */
    table thead {
      background-color: var(--main-color);
      color: white;
    }
  </style>

  <script>
    window.addEventListener("load", function () {
      const preloader = document.getElementById("preloader");
      preloader.classList.add("fade-out");
      setTimeout(() => preloader.style.display = "none", 500);
    });
  </script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<!-- PRELOADER -->
<div id="preloader">
  <div class="loader">
    <i class="fas fa-spinner fa-spin fa-3x"></i>
  </div>
</div>

<!-- NAVBAR -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>
</nav>

<!-- SIDEBAR -->
<aside class="main-sidebar elevation-4">
  <!-- Brand Logo -->
  <div class="d-flex align-items-center p-4 brand-logo">
    <h4 class="mb-0">Kegiatan Bakti Sosial PMR</h4>
  </div>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="index.php" class="d-block" style="color: #fff;">
          <?= htmlspecialchars($_SESSION['nama']); ?>
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header" style="color: #fff;">Daftar Menu</li>
        <li class="nav-item">
          <a href="Data-Anggota.php" class="nav-link" style="color: #fff;">
            <i class="nav-icon fas fa-user-graduate"></i>
            <p>Data PMR</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="Data-kegiatan.php" class="nav-link" style="color: #fff;">
            <i class="nav-icon fas fa-hand-holding-heart"></i>
            <p>Data Kegiatan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="akun.php" class="nav-link" style="color: #fff;">
            <i class="nav-icon fas fa-user"></i>
            <p>Data Akun</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link" onclick="return confirm('Yakin Anda Ingin Keluar.?');" style="color: #fff;">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>

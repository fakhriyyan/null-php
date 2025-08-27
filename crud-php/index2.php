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

//membatasi halaman sesuai user login
if ($_SESSION['level'] != 1 and $_SESSION['level']  != 2){
  echo "<script>
         alert('Maaf, Anda Tidak Punya Akses');
         document.location.href = 'crud-modal.php';
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

$data_barang = select("SELECT * FROM barang ORDER BY id_barang DESC");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--  DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    
    

    <title>CRUD PHP MYSQL Bootstrap</title>
  </head>
  <body>
    

 

     <?php include 'layout/header.php'; ?>

    <div class="container mt-5">
      <h1>Data Barang</h1>
      <a href="tambah-barang.php" class="btn btn-primary mb-3"  ><i class="fas fa-plus-circle"></i>Tambah</a>

      <table id="table" class="table table-bordered table-striped">
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
              <td class= "text-center">
                <img alt="barcode" src="barcode.php?codetype=code128&size=15&text=<?= $barang['barcode']; ?>&print=true" />
              </td>
              <td><?= date("d/m/y | H:i:s", strtotime($barang['tanggal'])); ?></td>
              <td width="15%" class="text-center">
                <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-success btn-sm">Ubah</a>
                <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Data Barang Akan Dihapus');">Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php include 'layout/footer.php'; ?>

    <!--  JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!--  Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!--  DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!--  Init DataTables -->
    <script>
      $(document).ready(function () {
        $('#table').DataTable(); // Inisialisasi DataTables di tabel id=table
      });
    </script>
  </body>
</html>

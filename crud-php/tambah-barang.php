<?php

session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}


$title = 'Tambah Barang';

include 'layout/header.php';
if (isset($_POST['tambah'])) {
    if (create_barang($_POST) > 0) {
        echo "<script>
            alert('Data Barang Berhasil Ditambahkan');
            document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
        alert('Data Barang Gagal Ditambahkan');
            document.location.href = 'index.php';
            </script>";
    }
}
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container mt-5">
    <h1> Tambah Data Barang </h1>
    <hr>


    <form action="" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang..." required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Barang</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Barang..." required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga Barang</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Barang..." required>
        </div>
  <div style="display: flex; justify-content: flex-end; gap: 10px; align-items: center;">
  <a href="index.php"
     class="btn"
     style="
       background-color: #000;
       color: #fff;
       box-shadow: 0 0 12px rgba(0,123,255,0.6);
       border-radius: 50px;
       padding: 10px 20px;
       border: none;
       text-shadow: 0 0 4px rgba(0,123,255,0.9);
       display: inline-flex;
       align-items: center;
       gap: 8px;
       text-decoration: none;
       height: 40px;
       line-height: 20px;
     ">
    <i class="fa-solid fa-right-from-bracket"></i> Kembali
  </a>

  <button type="submit"
          class="btn btn-primary rounded-pill"
          name="tambah"
          style="
            background-color: #000;
            color: #fff;
            box-shadow: 0 0 12px rgba(0, 123, 255, 0.8);
            border: 1px solid rgba(0, 123, 255, 0.9);
            text-shadow: 0 0 6px rgba(0, 123, 255, 0.9);
            padding: 10px 20px;
            height: 40px;
            line-height: 20px;
            border-radius: 50px;
            cursor: pointer;
            ">
    Tambah
  </button>
</div>


    </form>
</div>
  </div>
  

  <?php include 'layout/footer.php' ?>
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
            alert('Email berhasil di kirim');
            document.location.href = 'email.php';
            </script>";
    } else {
        echo "<script>
        alert('Email Gagall di kirim');
            document.location.href = 'email.php';
            </script>";
    }
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container mt-5">
    <h1> Kirim Email </h1>
    <hr>
   <selection class="content">
    <div class="container-fluid">
    <form action="" method="post">
        <div class="mb-3">
            <label for="email penerima" class="form-label">Email Penerima</label>
            <input type="text" class="form-control" id="email penerima" name="email penerima" placeholder="Email Penerima..." required>
        </div>
        
        <div class="mb-3">
            <label for="subject" class="form-label">Subject </label>
            <input type="next" class="form-control" id="subject" name="subject" placeholder="Subject ..." required>
        </div>
        
        <div class="mb-3">
            <label for="pesan" class="form-label">Pesan</label>
            <textarea name="pesan" id="pesan" cols="30" rows="10" style="margin-left: 20px; padding-left: 10px;"></textarea>
        </div>
        
        <div style="display: flex; justify-content: flex-end; gap: 10px; align-items: right;">
            <button type="submit"
                    class="btn btn-primary rounded-pill"
                    name="tambah"
                    style="background-color: #000;
                           color: #fff;
                           box-shadow: 0 0 12px rgba(0, 123, 255, 0.8);
                           border: 1px solid rgba(0, 123, 255, 0.9);
                           text-shadow: 0 0 6px rgba(0, 123, 255, 0.9);
                           padding: 10px 20px;
                           height: 40px;
                           line-height: 20px;
                           border-radius: 50px;
                           cursor: pointer;">
                Kirim
            </button>
        </div>
    </form>
    </div>
  </div>

  <?php include 'layout/footer.php' ?>

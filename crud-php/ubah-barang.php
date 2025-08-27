<?php

session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}


$title = 'Ubah Barang';

include 'layout/header.php';

$id_barang = (int) $_GET['id_barang'];

$barang = mysqli_query($db, "SELECT * FROM barang WHERE id_barang=$id_barang");

while ($barang_data = mysqli_fetch_array($barang)) {
    $id_barang = $barang_data['id_barang'];
    $nama = $barang_data['nama'];
    $jumlah = $barang_data['jumlah'];
    $harga = $barang_data['harga'];

}

if (isset($_POST['ubah'])) {
    if (update_barang($_POST) > 0) {
        echo "<script>
                        alert('Data Barang Berhasil Di Ubah');
                        document.location.href='index.php';
                    </script>";
    } else {
        echo "<script>
                        alert('Data Barang Gagal Di Ubah');
                        document.location.href='index.php';
                    </script>";
    }

}
?>

<div class="content-wrapper">
    <div class="container mt-5">
        <h1>Ubah Barang</h1>
        <hr>

      


        <form action="" method="POST">

            <input type="hidden" name="id_barang" value="<?= $id_barang ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $jumlah ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?= $harga ?>" required>
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
          name="ubah"
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
    Ubah
  </button>
</div>


        </form>

    </div>
</div>

<?php include 'layout/footer.php'; ?>
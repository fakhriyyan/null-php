<?php

session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}

$title = 'Detail Mahasiswa';

include 'layout/header.php';


// menagmbil id mahasiswa dari url
$id_mahasiswa = (int) $_GET['id_mahasiswa'];

// menampilkan data mahasiswa
$mahasiswa = mysqli_query($db, "SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa");
$mahasiswa = mysqli_fetch_array($mahasiswa);

?>

<div class="content-wrapper mt-5">
    <h1>Data <?= $mahasiswa['nama']; ?></h1>
    <hr>

    <table class="table table-bordered table-striped mt-3">

        <tr>
            <td>Nama</td>
            <td>: <?= $mahasiswa['nama']; ?></td>
        </tr>

        <tr>
            <td>prodi</td>
            <td>: <?= $mahasiswa['prodi']; ?></td>
        </tr>

        <tr>
            <td>Jenis Kelamin</td>
            <td>: <?= $mahasiswa['jk']; ?></td>
        </tr>

        <tr>
            <td>Telepon</td>
            <td>: <?= $mahasiswa['telepon']; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?= $mahasiswa['alamat']; ?></td>
        </tr>

        <tr>
            <td>Email</td>
            <td>: <?= $mahasiswa['email']; ?></td>
        </tr>

        <tr>
            <td width="30%">Foto</td>
            <td>
                <a href="assets/img/<?= $mahasiswa['foto'] ?>">
                    <img src="assets/img/<?= $mahasiswa['foto'] ?>" . alt="foto" width="20%">
                </a>
            </td>
        </tr>
    </table>
      <div style="display: flex; justify-content: flex-end; gap: 10px; align-items: center;">
  <a href="mahasiswa.php"
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
      </div>
</div>

<?php include 'layout/footer.php'; ?>
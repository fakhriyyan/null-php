<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}

$title = 'Detail Anggota PMR';
include 'layout/header.php';

// Ambil id anggota dari URL
$id = (int) $_GET['id'];

// Ambil data anggota
$anggota = mysqli_query($db, "SELECT * FROM anggota_pmr WHERE id = $id");
$anggota = mysqli_fetch_array($anggota);
?>

<div class="content-wrapper mt-5">
    <h1>Data <?= htmlspecialchars($anggota['nama']); ?></h1>
    <hr>

    <table class="table table-bordered table-striped mt-3">
        <tr>
            <td>Nama</td>
            <td>: <?= htmlspecialchars($anggota['nama']); ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <?= htmlspecialchars($anggota['jenis_kelamin']); ?></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>: <?= htmlspecialchars($anggota['kelas']); ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>: <?= htmlspecialchars($anggota['tanggal_lahir']); ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?= htmlspecialchars($anggota['alamat']); ?></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>: <?= htmlspecialchars($anggota['no_telp']); ?></td>
        </tr>
    </table>

    <div style="display: flex; justify-content: flex-end; gap: 10px; align-items: center; margin-top: 20px;">
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

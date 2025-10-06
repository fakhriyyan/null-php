<?php
session_start();
require 'database.php'; // pastikan file ini menghubungkan ke $db

if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}

$title = 'Ubah Anggota';
include 'layout/header.php';

// Pastikan parameter id ada di URL
if (!isset($_GET['id'])) {
    echo "<script>
            alert('Data tidak ditemukan!');
            document.location.href='Data-Anggota.php';
        </script>";
    exit;
}

$id_anggota = (int) $_GET['id'];

// Ambil data anggota dari database
$result = mysqli_query($db, "SELECT * FROM anggota_pmr WHERE id = $id_anggota");
if (!$result || mysqli_num_rows($result) === 0) {
    echo "<script>
            alert('Data anggota tidak ditemukan!');
            document.location.href='Data-Anggota.php';
        </script>";
    exit;
}

$anggota = mysqli_fetch_assoc($result);

// Fungsi update anggota
function update_anggota($data)
{
    global $db;

    $id = $data['id'];
    $nama = mysqli_real_escape_string($db, $data['nama']);
    $kelas = mysqli_real_escape_string($db, $data['kelas']);
    $jenis_kelamin = mysqli_real_escape_string($db, $data['jenis_kelamin']);
    $tanggal_lahir = mysqli_real_escape_string($db, $data['tanggal_lahir']);

    // Bersihkan tag HTML agar <p> tidak ikut tersimpan
    $alamat = mysqli_real_escape_string($db, strip_tags($data['alamat']));
    $no_telp = mysqli_real_escape_string($db, $data['no_telp']);

    $query = "UPDATE anggota_pmr SET
                nama = '$nama',
                kelas = '$kelas',
                jenis_kelamin = '$jenis_kelamin',
                tanggal_lahir = '$tanggal_lahir',
                alamat = '$alamat',
                no_telp = '$no_telp'
              WHERE id = $id";

    return mysqli_query($db, $query);
}

// Jika form disubmit
if (isset($_POST['ubah'])) {
    if (update_anggota($_POST) > 0) {
        echo "<script>
                alert('Data anggota berhasil diubah!');
                document.location.href='Data-Anggota.php';
            </script>";
    } else {
        echo "<script>
                alert('Data anggota gagal diubah!');
                document.location.href='Data-Anggota.php';
            </script>";
    }
}
?>

<div class="content-wrapper" style="background-color: #75b8a8; color: #fff; min-height: 100vh;">
  <div class="container mt-5">
    <h1 class="fw-bold mb-4">Ubah Data Anggota</h1>
    <hr style="border-color: #fff;">

    <form action="" method="post">
      <input type="hidden" name="id" value="<?= htmlspecialchars($anggota['id']); ?>">

      <div class="mb-3">
        <label for="nama" class="form-label">Nama Anggota</label>
        <input type="text" class="form-control" id="nama" name="nama" required
          value="<?= htmlspecialchars($anggota['nama']); ?>">
      </div>

      <div class="row">
        <div class="mb-3 col-md-6">
          <label for="kelas" class="form-label">Kelas</label>
          <input type="text" class="form-control" id="kelas" name="kelas" required
            value="<?= htmlspecialchars($anggota['kelas']); ?>">
        </div>

        <div class="mb-3 col-md-6">
          <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
          <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
            <?php $jk = $anggota['jenis_kelamin']; ?>
            <option value="L" <?= $jk == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
            <option value="P" <?= $jk == 'P' ? 'selected' : ''; ?>>Perempuan</option>
          </select>
        </div>
      </div>

      <div class="mb-3">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required
          value="<?= htmlspecialchars($anggota['tanggal_lahir']); ?>">
      </div>

      <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" class="form-control" rows="3" required><?= htmlspecialchars(strip_tags($anggota['alamat'])); ?></textarea>
      </div>

      <div class="mb-3">
        <label for="no_telp" class="form-label">Nomor Telepon</label>
        <input type="text" class="form-control" id="no_telp" name="no_telp" required
          value="<?= htmlspecialchars($anggota['no_telp']); ?>">
      </div>

      <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="Data-Anggota.php" class="btn" style="background-color: #004d40; color: #fff; border-radius: 50px; padding: 10px 25px;">
          <i class="fa-solid fa-right-from-bracket"></i> Kembali
        </a>

        <button type="submit" name="ubah" style="background-color: #00695c; color: #fff; border: none; padding: 10px 25px; border-radius: 50px;">
          Ubah
        </button>
      </div>
    </form>

    <hr style="border-color: #fff;">
  </div>
</div>

<?php include 'layout/footer.php'; ?>

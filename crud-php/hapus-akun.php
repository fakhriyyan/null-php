<?php
session_start();
include 'config/app.php';

// menerima id_akun
$id_akun = (int)$_GET['id_akun'];

// panggil fungsi delete
if (delete_akun($id_akun) > 0) {
    echo "<script>
            alert('Data Akun Berhasil Dihapus');
            document.location.href = 'crud-modal.php';
          </script>";
} else {
    echo "<script>
            alert('Data Akun Gagal Dihapus');
            document.location.href = 'crud-modal.php';
          </script>";
}

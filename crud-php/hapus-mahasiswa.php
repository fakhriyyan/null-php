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


include 'config/app.php';

// menerima id_mahasiswa
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

// panggil fungsi delete
if (delete_mahasiswa($id_mahasiswa) > 0) {
    echo "<script>
            alert('Data mahasiswa Berhasil Dihapus');
            document.location.href = 'mahasiswa.php';
          </script>";
} else {
    echo "<script>
            alert('Data mahasiswa Gagal Dihapus');
            document.location.href = 'mahasiswa.php';
          </script>";
}

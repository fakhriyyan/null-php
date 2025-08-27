<?php
session_start();

// Batasi halaman sebelum login
if (!isset($_SESSION['login'])) {
    echo "<script>
            alert('Login Dulu!');
            document.location.href = 'login.php';
          </script>";
    exit;
}

// Batasi halaman sesuai level user
if ($_SESSION['level'] != 1 && $_SESSION['level'] != 3) {
    echo "<script>
            alert('Maaf, Anda Tidak Punya Akses');
            document.location.href = 'crud-modal.php';
          </script>";
    exit;
}

require 'config/app.php';
require 'vendor/autoload.php';

use Spipu\Html2pdf\Html2Pdf;

// Inisialisasi variabel $content
$content = ''; // Variabel $content harus diinisialisasi

// Ambil data mahasiswa
$data_barang = select("SELECT * FROM mahasiswa");

// Menambahkan style CSS
$content .= '<style type="text/css">
  .gambar {
     width: 50px;
}
</style>';

// Membuat tabel HTML
$content .= '
<page>
  <table border="1" align="center">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Program Studi</th>
      <th>Jenis Kelamin</th>
      <th>Telepon</th>
      <th>Email</th>
      <th>Foto</th>
    </tr>';

$no = 1;
foreach ($data_barang as $barang) {
    $content .= '
    <tr>
      <td>' . $no++ . '</td>
      <td>' . $barang['nama'] . '</td>
      <td>' . $barang['prodi'] . '</td>
      <td>' . $barang['jk'] . '</td>
      <td>' . $barang['telepon'] . '</td>
      <td>' . $barang['email'] . '</td>
      <td><img src="assets/img/' .$barang['foto'] . '" class="gambar" width="60"></td>
    </tr>';
}

$content .= '</table>
</page>';

// Membuat dan menulis file PDF
$html2pdf = new  html2pdf();
$html2pdf->writeHTML($content);
$html2pdf->output('Laporan-mahasiswa.pdf', 'D'); // 'D' untuk mendownload PDF langsung

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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Buat spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom
$sheet->setCellValue('A2', 'No');
$sheet->setCellValue('B2', 'Nama');
$sheet->setCellValue('C2', 'Program Studi');
$sheet->setCellValue('D2', 'Jenis Kelamin');
$sheet->setCellValue('E2', 'Telepon');
$sheet->setCellValue('F2', 'Email');
$sheet->setCellValue('G2', 'Foto');

// Ambil data
$data_mahasiswa = select("SELECT * FROM mahasiswa");

$no = 1;
$row = 3;

foreach ($data_mahasiswa as $mhs) {
    $sheet->setCellValue('A' . $row, $no++);
    $sheet->setCellValue('B' . $row, $mhs['nama']);
    $sheet->setCellValue('C' . $row, $mhs['prodi']);
    $sheet->setCellValue('D' . $row, $mhs['jk']);
    $sheet->setCellValue('E' . $row, $mhs['telepon']);
    $sheet->setCellValue('F' . $row, $mhs['email']);
    $sheet->setCellValue('G' . $row, 'https://localhost/crud-php/assets/img/' . $mhs['foto']);
    $row++;
}

// Tambahkan border
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$sheet->getStyle('A2:G' . ($row - 1))->applyFromArray($styleArray);

// Buat dan kirim file ke browser
$filename = 'Laporan Data Mahasiswa.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($filename);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
readfile($filename);
unlink($filename);
exit;

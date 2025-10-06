<?php

// render halaman menjadi JSON
header('Content-Type: application/json');

// Koneksi ke database
$db = mysqli_connect('localhost', 'root', '', 'crud-php');

// Cek koneksi
if (mysqli_connect_errno()) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

// Fungsi select untuk mengambil data
function select($query) {
    global $db; // Menggunakan koneksi database yang sudah dibuat
    $result = mysqli_query($db, $query); // Menjalankan query
    $data = []; // Array untuk menampung hasil query

    // Ambil hasil query dan masukkan ke dalam array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data; // Mengembalikan data yang sudah diambil
}

// Query untuk mengambil semua data barang
$query = select("SELECT * FROM barang");

// Kirim hasil query dalam format JSON
echo json_encode(['data_barang' => $query]);

?>

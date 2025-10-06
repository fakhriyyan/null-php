<?php
include "config/app.php";

// Ambil data pegawai dari database
$data_pegawai = select("SELECT * FROM pegawai ORDER BY id_pegawai DESC");

// Mulai nomor urut
$no = 1;
?>

<?php foreach ($data_pegawai as $pegawai) : ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($pegawai['nama']); ?></td>
        <td><?= htmlspecialchars($pegawai['jabatan']); ?></td>
        <td><?= htmlspecialchars($pegawai['email']); ?></td>
        <td><?= htmlspecialchars($pegawai['telepon']); ?></td>
        <td><?= htmlspecialchars($pegawai['alamat']); ?></td>
    </tr>
<?php endforeach; ?>

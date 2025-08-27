<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Autoload PHPMailer dari composer
require 'vendor/autoload.php';

// Inisialisasi PHPMailer
$mail = new PHPMailer(true);

try {
    // Konfigurasi SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'gghahah55@gmail.com'; // GANTI: emailmu
    $mail->Password = 'your_app_password';   // GANTI: gunakan app password Gmail, BUKAN password akun langsung
    $mail->SMTPSecure = 'ssl'; // atau 'tls' jika port 587
    $mail->Port = 465; // Gunakan 587 jika pakai 'tls'

    // Debugging (0 = off, 2 = verbose)
    $mail->SMTPDebug = 0; 

    if (isset($_POST['kirim'])) {
        // Set pengirim dan penerima
        $mail->setFrom('gghahah55@gmail.com', 'Firman Dwi');
        $mail->addAddress($_POST['email_penerima']);
        $mail->addReplyTo('gghahah55@gmail.com', 'Firman Dwi');

        // Konten email
        $mail->isHTML(true); // Jika ingin kirim HTML, atau false untuk plain text
        $mail->Subject = $_POST['subject'];
        $mail->Body    = nl2br(htmlspecialchars($_POST['pesan'])); // untuk amankan dan ubah \n jadi <br>

        $mail->send();
        echo "<script>
            alert('Email Berhasil Dikirimkan');
            document.location.href = 'email.php';
        </script>";
    }
} catch (Exception $e) {
    echo "<script>
        alert('Email Gagal Dikirimkan: {$mail->ErrorInfo}');
        document.location.href = 'email.php';
    </script>";
}
?>

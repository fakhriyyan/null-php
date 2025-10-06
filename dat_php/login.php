<?php
session_start();
include 'config/app.php';

// cek apakah tombol login ditekan
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // cek username
    $result = mysqli_query($db, "SELECT * FROM akun WHERE username = '$username'");

    // jika user ditemukan
    if (mysqli_num_rows($result) == 1) {
        $hasil = mysqli_fetch_assoc($result);

        // cek password (plain text version, gunakan password_hash() jika ingin aman)
        if ($password === $hasil['password']) {
            // set session
            $_SESSION['login']     = true;
            $_SESSION['id_akun']   = $hasil['id_akun'];
            $_SESSION['nama']      = $hasil['nama'];
            $_SESSION['username']  = $hasil['username'];
            $_SESSION['email']     = $hasil['email'];
            $_SESSION['level']     = $hasil['level'];

            header("location: Data-Anggota.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
      body {
        background: linear-gradient(135deg, #1f2a2c, #3d524f);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', sans-serif;
        color: #f5f5f5;
      }

      .login-box {
        background-color: #2d3b3c;
        border-radius: 15px;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
        padding: 40px;
        width: 350px;
        height: 430px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
      }

      .login-box h1 {
        font-size: 1.6rem;
        margin-bottom: 25px;
        font-weight: bold;
        color: #f8f9fa;
      }

      .form-control {
        background-color: #1f2a2c;
        color: #f5f5f5;
        border: 1px solid #4B6260;
        border-radius: 10px;
      }

      .form-control:focus {
        background-color: #253334;
        border-color: #00c896;
        box-shadow: 0 0 10px #00c896;
        color: #ffffff;
      }

      label {
        color: #cfcfcf;
      }

      .btn-primary {
        background-color: #00c896;
        border: none;
        border-radius: 10px;
        font-weight: bold;
        transition: all 0.3s ease;
      }

      .btn-primary:hover {
        background-color: #00a37a;
        box-shadow: 0 0 15px #00c896;
      }

      .footer-text {
        margin-top: 20px;
        font-size: 0.9rem;
        color: #aaa;
      }

      .footer-text a {
        color: #00c896;
        text-decoration: none;
      }

      .footer-text a:hover {
        text-decoration: underline;
      }

      .alert {
        background-color: #b53737;
        border: none;
        color: #fff;
        font-size: 0.9rem;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 20px;
      }
    </style>
  </head>
  <body>

    <div class="login-box">
      <form method="POST">
        <h1><i class="fa-solid fa-user-lock"></i> Admin Login</h1>

        <?php if (isset($error)) : ?>
          <div class="alert">
            <i class="fa-solid fa-circle-exclamation"></i> <?= $error; ?>
          </div>
        <?php endif; ?>

        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
          <label for="username">Username</label>
        </div>

        <div class="form-floating mb-4">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>

        <div class="footer-text">
          <p>Forgot password? <a href="#">Click here</a></p>
        </div>
      </form>
    </div>

  </body>
</html>

<?php

session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}


$title = 'Tambah Mahasiswa';

include 'layout/header.php';

if (isset($_POST['tambah'])) {
    if (create_mahasiswa($_POST) > 0) {
        echo "<script>
            alert('Data Mahasiswa Berhasil Ditambahkan');
            document.location.href = 'mahasiswa.php';
            </script>";
    } else {
        echo "<script>
        alert('Data Mahasiswa Gagal Ditambahkan');
            document.location.href = 'mahasiswa.php';
            </script>";
    }
}
?>

<div class="content-wrapper">
    <div class="content mt-5">
        <h1> Tambah Data Mahasiswa </h1>
        <hr>
     
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama mahaSiswa..." required>
            </div>
    
            
    
                <div class="mb-3 col-6">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select name="jk" id="jk" class="form-control" required>
                        <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="Laki Laki">Laki Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
    
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Telepon..." Required>
            </div>
            
            <div class="mb-3">
                <label for="Alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control"></textarea>
            </div>
    
    
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email..." Required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto...">
            </div>
    
              <div style="display: flex; justify-content: flex-end; gap: 10px; align-items: center;">
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

  <button type="submit"
          class="btn btn-primary rounded-pill"
          name="tambah"
          style="
            background-color: #000;
            color: #fff;
            box-shadow: 0 0 12px rgba(0, 123, 255, 0.8);
            border: 1px solid rgba(0, 123, 255, 0.9);
            text-shadow: 0 0 6px rgba(0, 123, 255, 0.9);
            padding: 10px 20px;
            height: 40px;
            line-height: 20px;
            border-radius: 50px;
            cursor: pointer;
            ">
    Tambah
  </button>
</div>
    
        </form>
    </div>
    </div>


<?php include 'layout/footer.php'; ?>
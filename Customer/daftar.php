<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Pendaftaran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: white;
      font-family: 'Poppins', sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      
    }

    .card {
      max-width: 850px;
      width: 100%;
      border: none;
      border-radius: 15px;
      overflow: hidden;
      border: 1.5px solid  #0a3b7e;
      box-shadow: 0 5px 15px ;
    }

    .card img {
      height: 100%;
      object-fit: cover;
      filter: grayscale(60%);
      background-color:rgb(195, 190, 190);
    }

    .form-control {
      border: 1.5px solid  #0a3b7e;
      border-radius: 5px;
      box-shadow: none;
    }

    .btn-primary {
      background-color:  #0a3b7e;
      border: none;
      font-weight: bold;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      transition: background-color 0.3s, box-shadow 0.3s;
      border-radius: 5px;
    }

    .btn-primary:hover {
      background-color:  #0a3b7e;
      box-shadow: 0 6px 8px rgba(0,0,0,0.15);
    }

    h4 {
      color:  #0a3b7e;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
<form method="POST" action="proses_daftar.php">
<div class="card d-flex flex-row">
<div class="col-md-6 d-none d-md-block" style="background-color: #c3bebe; display: flex; align-items: center; justify-content: center;">
  <img src="PCX.png" class="img-fluid" alt="Motor" style="max-height: 600px; object-fit: contain;">
</div>

  <div class="col-md-6 p-5">
    <h4 class="text-center">Buat akun baru</h4>
    <form>
      <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" class="form-control" id="nama" name="nama" required>
      </div>
      <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="mb-3">
      <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
      <input type="password" class="form-control" id="konfirmasi" name="konfirmasi" required>
      </div>
      <button type="submit" class="btn btn-primary w-50 d-block mx-auto">Daftar</button>
      <div class="text-center mt-3">
      <span>Sudah memiliki akun? <a href="login.php" class="text-primary fw-bold text-decoration-none">Login</a></span>
      </div>
    </form>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

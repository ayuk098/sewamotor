<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Pendaftaran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f5f5;
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
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .card img {
      height: 100%;
      object-fit: cover;
      filter: grayscale(60%);
    }

    .form-control {
      border: 1.5px solid  #0a3b7e;
    }

    .btn-primary {
      background-color:  #0a3b7e;
      border: none;
      font-weight: bold;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .btn-primary:hover {
      background-color:  #0a3b7e;
    }

    h4 {
      color:  #0a3b7e;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

<div class="card d-flex flex-row">
  <div class="col-md-6 d-none d-md-block">
  <img src="nmax.jpg" class="img-fluid mt-5" alt="Motor" style="max-height: 400px; object-fit: contain;">
  </div>
  <div class="col-md-6 p-5">
    <h4 class="text-center">Buat akun baru</h4>
    <form>
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" required>
      </div>
      <div class="mb-3">
        <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
        <input type="password" class="form-control" id="konfirmasi" required>
      </div>
      <a href="login.php" class="btn btn-primary w-50 d-block mx-auto">Daftar</a>
    </form>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

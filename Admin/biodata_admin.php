<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biodata Admin JSRent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
      body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', sans-serif;
        background-color: #f7f7f7;
      }

      .d-flex {
        min-height: 100vh;
        align-items: stretch;
      }

      .sidebar {
        width: 260px;
        background-color: #fff;
        border-right: 1px solid #ddd;
        padding-top: 0;
        padding-bottom: 0;
        min-height: 100vh;
      }

      .logo {
        display: flex;
        align-items: center;
        padding: 30px 32px 24px 32px;
        border-bottom: 1px solid #f0f0f0;
      }

      .logo img {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        margin-right: 10px;
      }

      .logo span {
        font-size: 1.3rem;
        font-weight: 700;
        color: #0F4181;
      }

      .sidebar a {
        padding: 13px 32px;
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #8b8b8b;
        font-size: 1.08rem;
        gap: 13px;
        border-radius: 0 30px 30px 0;
        margin-bottom: 2px;
        transition: background 0.2s, color 0.2s;
      }

      .sidebar a i {
        min-width: 20px;
        text-align: center;
        font-size: 1.15rem;
      }

      .sidebar a.active,
      .sidebar a:hover {
        background-color: #f2f2f2;
        color: #0F4181;
        font-weight: 600;
      }

      .main-content {
        flex-grow: 1;
        background: #f7f7f7;
        padding: 44px 55px 44px 55px;
        position: relative;
        display: flex;
        flex-direction: column;
      }

      .admin-profile {
        position: absolute;
        top: 36px;
        right: 48px;
        z-index: 10;
      }

      .admin-profile img {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        border: 3px solid #fff;
        object-fit: cover;
        box-shadow: 0 2px 7px rgba(0,0,0,0.10);
        background: #f0f0f0;
        cursor: pointer;
      }

      /* Welcome text */
      .welcome-header {
        font-size: 1.15rem;
        font-weight: 500;
        color: #0F4181;
        margin-top: 16px;
        margin-bottom: 4px;
      }
      .welcome-header span {
        color: orange;
      }
      .welcome-sub {
        color: #0F4181;
        font-size: 1.02rem;
        margin-bottom: 30px;
        font-weight: 400;
      }

      /* Form styling */
      .biodata-form {
        background: #fff;
        border-radius: 14px;
        padding: 38px 34px 38px 34px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        max-width: 950px;
        margin: 0 auto 0 auto;
      }
      .form-label {
        color: #9c9c9c;
        font-size: 1.08rem;
        font-weight: 500;
        margin-bottom: 6px;
      }
      .form-control {
        border-radius: 9px;
        border: 1px solid #bababa;
        min-height: 38px;
        font-size: 1.06rem;
        padding: 6px 16px;
        color: #222;
        background: #fafafa;
      }
      .form-control:focus {
        border-color: #0F4181;
        box-shadow: 0 0 0 2px rgba(15,65,129, 0.07);
      }
      .row .form-group {
        margin-bottom: 22px;
      }

      /* Button styling */
      .save-btn {
        background-color: #FFC107;
        color: #fff;
        border: none;
        padding: 10px 32px;
        border-radius: 7px;
        font-weight: 500;
        font-size: 1.04rem;
        margin-top: 30px;
        transition: background 0.18s, box-shadow 0.15s;
        box-shadow: 0 3px 0.5rem rgba(255,193,7,0.17);
        float: right;
      }
      .save-btn:hover {
        background-color: #ffb300;
        color: #fff;
      }

      @media (max-width: 900px) {
        .main-content {
          padding: 20px;
        }
        .biodata-form {
          padding: 18px 10px;
        }
      }
      @media (max-width: 700px) {
        .sidebar {
          width: 70px;
        }
        .sidebar .logo span {
          display: none;
        }
        .sidebar a {
          padding: 12px 10px;
          font-size: 1rem;
        }
        .main-content {
          padding: 10px;
        }
      }
    </style>
  </head>
  <body>
    <div class="d-flex">
      <!-- Sidebar -->
      <div class="sidebar d-flex flex-column">
        <div class="logo">
          <img src="logo.png" alt="JSRent Logo">
          <span>JSRent</span>
        </div>
        <a href="halamanutama.php"><i class="fas fa-home"></i>Dashboard</a>
        <a href="customer/halamanutama.php"><i class="fas fa-user"></i>Customer</a>
        <a href="pembayaran/halutpembayaran.php"><i class="fas fa-money-bill-wave"></i>Pembayaran</a>
        <a href="penyewaan/halutpenyewaan.php"><i class="fas fa-file-invoice"></i>Penyewaan</a>
        <a href="kendaraan/halutkendaraan.php"><i class="fas fa-tools"></i>Kendaraan</a>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <div class="admin-profile">
          <a href="biodata_admin.php">
            <img src="admin.jpg" alt="Admin Profile" title="Profil Admin">
          </a>
        </div>
        <div class="welcome-header">
          Welcome Admin, <span>Keyla Aura!</span>
        </div>
        <div class="welcome-sub">
          Informasi mengenai profil kamu
        </div>
        <form class="biodata-form">
          <div class="row">
            <div class="col-md-6 form-group">
              <label class="form-label" for="nama">Nama Lengkap</label>
              <input type="text" class="form-control" id="nama" value="Keyla Aura">
            </div>
            <div class="col-md-6 form-group">
              <label class="form-label" for="alamat">Domisili</label>
              <input type="text" class="form-control" id="alamat" value="Jln Sentul 07">
            </div>
            <div class="col-md-6 form-group">
              <label class="form-label" for="ttl">Tempat, tanggal lahir</label>
              <input type="text" class="form-control" id="ttl" value="Jakarta, 07 Juli 2000">
            </div>
            <div class="col-md-6 form-group">
              <label class="form-label" for="kota">Kota</label>
              <input type="text" class="form-control" id="kota" value="Yogyakarta">
            </div>
            <div class="col-md-6 form-group">
              <label class="form-label" for="jk">Jenis Kelamin</label>
              <input type="text" class="form-control" id="jk" value="Perempuan">
            </div>
            <div class="col-md-6 form-group">
              <label class="form-label" for="kab">Kabupaten</label>
              <input type="text" class="form-control" id="kab" value="Sleman">
            </div>
            <div class="col-md-6 form-group">
              <label class="form-label" for="telp">Nomor Telepon</label>
              <input type="text" class="form-control" id="telp" value="081234567890">
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6 form-group">
              <label class="form-label" for="email">Email</label>
              <input type="email" class="form-control" id="email" value="Keylaauraa27@gmail.com">
            </div>
          </div>
          <button class="save-btn" type="submit">Simpan Perubahan</button>
        </form>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php
include 'koneksi.php';

// Jumlah kendaraan
$jumlah_kendaraan = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) as total FROM kendaraan"))['total'] ?? 0;

$pelanggan_hari_ini = mysqli_fetch_assoc(mysqli_query($connect, "
    SELECT COUNT(*) as total 
    FROM customer 
    WHERE DATE(tanggal_pesan) = CURDATE()
"))['total'] ?? 0;


// Total pendapatan hari ini
$total_pendapatan = mysqli_fetch_assoc(mysqli_query($connect, "
    SELECT SUM(jumlah_pembayaran) as total 
    FROM pembayaran 
"))['total'] ?? 0;

// Jumlah seluruh pelanggan
$jumlah_pelanggan = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) as total FROM customer"))['total'] ?? 0;
$total_pelanggan = $jumlah_pelanggan;



$transaksi_pembayaran = mysqli_query($connect, "
    SELECT metode_bayar, YEAR(tanggal_bayar) as tahun, SUM(jumlah_pembayaran) as total 
    FROM pembayaran 
    WHERE tanggal_bayar IS NOT NULL 
    GROUP BY metode_bayar, YEAR(tanggal_bayar) 
    ORDER BY tahun DESC 
    LIMIT 5
");

// Pendapatan per bulan (bulan + total)
$pendapatan_bulanan = mysqli_query($connect, "
    SELECT DATE_FORMAT(tanggal_bayar, '%M %Y') as bulan, SUM(jumlah_pembayaran) as total 
    FROM pembayaran 
    GROUP BY YEAR(tanggal_bayar), MONTH(tanggal_bayar) 
    ORDER BY tanggal_bayar DESC 
    LIMIT 3
");
// Pelanggan setia (top 5)
$pelanggan_setia = mysqli_query($connect, "
    SELECT c.nama, COUNT(p.id_penyewaan) as total_sewa
    FROM penyewaan p 
    JOIN customer c ON p.id_customer = c.id_customer 
    GROUP BY p.id_customer 
    ORDER BY total_sewa DESC 
    LIMIT 5
");
// Kendaraan Terlaris
$kendaraan_terlaris = mysqli_fetch_assoc(mysqli_query($connect, "
    SELECT k.nama AS nama_kendaraan, COUNT(p.id_penyewaan) as total_sewa
    FROM penyewaan p
    JOIN kendaraan k ON p.id_kendaraan = k.id_kendaraan
    GROUP BY p.id_kendaraan
    ORDER BY total_sewa DESC
    LIMIT 1
"));
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin JSRent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
  body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    background-color: #f7f7f7;
  }

  .sidebar {
    height: 100vh;
    width: 250px;
    background-color: white;
    border-right: 1px solid #ddd;
    padding-top: 20px;
  }

  .sidebar a {
    padding: 15px 20px;
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #6c757d;
    transition: 0.3s;
  }

  .sidebar a:hover, .sidebar a.active {
    background-color: #f0f0f0;
    color: #0F4181;
    font-weight: 500;
  }

 .sidebar i {
     margin-right: 10px;
  }
  .logo img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 2px solid white;
  }

  .logo span {
    display: block;
    margin-top: 10px;
    font-size: 1.8rem;
    font-weight: 700;
    color: #0F4181;
  }

  .main-content {
    flex-grow: 1;
    padding: 40px;
  }

  .page-title {
    font-size: 1.8rem;
    font-weight: bold;
    color: orange;
    margin-bottom: 30px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
  }

  .stat-card {
  display: flex; /* Gunakan Flexbox */
  justify-content: space-between; /* Posisikan elemen di kiri dan kanan */
  align-items: center; /* Pusatkan elemen secara vertikal */
  background: #fff;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  text-align: left; /* Pastikan teks berada di kiri */
  color: #6c757d;
  cursor: pointer;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
  }

  .stat-card h3 {
    font-size: 1rem;
    margin-bottom: 10px;
    color: #6c757d;
  }

  .stat-card h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0F4181;
  }

  .stat-icon {
  font-size: 1.5rem; /* Ukuran ikon */
  margin-left: auto; /* Pindahkan ke kanan */
  color: #FFA500;
}

  .card-container {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  .card {
  background: #fff;
  border-radius: 15px; 
  padding: 20px; 
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
  transition: transform 0.3s ease, box-shadow 0.3s ease; 
}

.card:hover {
  transform: translateY(-5px); 
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
}

.card h5 {
  font-size: 1.2rem; 
  font-weight: bold;
  color: #FFA500; 
  margin-bottom: 15px;
}

.card-table th {
  font-size: 1rem;
  font-weight: bold;
  color: #0F4181; 
  text-align: left;
}

.card-table td {
  font-size: 0.9rem;
  color:rgb(60, 67, 74); 
  padding: 8px 0; 
}

.card-table {
  width: 100%;
  border-collapse: collapse; 
}

.card-table tr:nth-child(even) {
  background-color: #f9f9f9; 
}

  .admin-profile {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
    display: flex;
    align-items: center;   }

  .admin-profile img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 2px solid #0F4181;
    cursor: pointer;
    transition: transform 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  }

  .admin-profile img:hover {
    transform: scale(1.1);
  }

  footer {
    text-align: center;
    padding: 10px;
    background-color: #1E90FF;
    color: white;
    position: fixed;
    bottom: 0;
    width: 100%;
  }
</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  </head>
  <body>
    <div class="d-flex">
      <!-- Sidebar -->
      <div class="sidebar d-flex flex-column">
      <div class="logo d-flex align-items-center px-3 mb-4">
         <img src="logo.png" alt="JSRent Logo" style="width: 60px; height: 60px; border-radius: 50%; margin-right: 10px;">
         <span style="font-size: 1.5rem; font-weight: 700; color: #0F4181;">JSRent</span>
      </div>
        <a href="#" class="active"><i class="fas fa-home"></i>Dashboard</a>
        <a href="customer/halamanutama.php"><i class="fas fa-user"></i> Customer</a>
        <a href="pembayaran/halutpembayaran.php"><i class="fas fa-money-bill-wave"></i>Pembayaran</a>
        <a href="penyewaan/halutpenyewaan.php"><i class="fas fa-file-invoice"></i>Penyewaan</a>
        <a href="kendaraan/halutkendaraan.php"><i class="fas fa-tools"></i>Kendaraan</a>
      </div>

<!-- Foto Admin -->
<div class="admin-profile">
      <a href="biodata_admin.php">
        <img src="admin.jpg" alt="Admin Profile" title="Profil Admin">
      </a>
      </div>
<!-- Main Content -->
    <div class="main-content">
      <h1 class="page-title">Dashboard</h1>  
<!-- Statistik Utama -->
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 mb-4">
  <!-- Card 1: Jumlah Kendaraan -->
  <div class="col">
    <a href="kendaraan/halutkendaraan.php" style="text-decoration: none;">
      <div class="stat-card">
        <div>
          <h3>Jumlah Kendaraan</h3>
          <h2><?= $jumlah_kendaraan ?></h2>
        </div>
        <div class="stat-icon">
          <i class="fas fa-car"></i>
        </div>
      </div>
    </a>
  </div>

  <!-- Card 2: Pelanggan Hari Ini -->
  <div class="col">
    <div class="stat-card">
      <div>
        <h3>Pelanggan Hari Ini</h3>
        <h2><?= $pelanggan_hari_ini ?></h2>
      </div>
      <div class="stat-icon">
        <i class="fas fa-user-clock"></i>
      </div>
    </div>
  </div>

  <!-- Card 3: Total Pendapatan -->
  <div class="col">
    <a href="pembayaran/halutpembayaran.php" style="text-decoration: none;">
      <div class="stat-card">
        <div>
          <h3>Total Pendapatan</h3>
          <h2>Rp <?= number_format($total_pendapatan ?? 0, 0, ',', '.') ?></h2>
        </div>
        <div class="stat-icon">
          <i class="fas fa-coins"></i>
        </div>
      </div>
    </a>
  </div>

  <!-- Card 4: Jumlah Pelanggan -->
  <div class="col">
    <a href="customer/halamanutama.php" style="text-decoration: none;">
      <div class="stat-card">
        <div>
          <h3>Jumlah Pelanggan</h3>
          <h2><?= $total_pelanggan ?></h2>
        </div>
        <div class="stat-icon">
          <i class="fas fa-users"></i>
        </div>
      </div>
    </a>
  </div>
</div>
<div class="card-container">

<div class="container mt-4">
  <div class="row row-cols-1 row-cols-md-2 g-4">
    <!-- Card 1: Transaksi Pembayaran -->
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 style="color:orange;">Transaksi Pembayaran</h5>
          <table class="card-table">
            <thead>
              <tr>
                <th>Metode</th>
                <th>Tahun</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($transaksi_pembayaran)) { ?>
              <tr>
                <td><?= $row['metode_bayar'] ?></td>
                <td><?= $row['tahun'] ?></td>
                <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Card 3: Pelanggan Setia -->
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 style="color:orange;">Pelanggan Setia</h5>
          <table class="card-table">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Total Sewa</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($pelanggan_setia)) { ?>
              <tr>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= $row['total_sewa'] ?> kali</td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Card 2: Pendapatan Perbulan -->
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 style="color:orange;">Pendapatan Perbulan</h5>
          <table class="card-table">
            <thead>
              <tr>
                <th>Bulan</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($pendapatan_bulanan)) { ?>
              <tr>
                <td><?= $row['bulan'] ?></td>
                <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Card 4: Kendaraan Terlaris -->
    <div class="col">
      <a href="penyewaan/halutpenyewaan.php" style="text-decoration: none;">
        <div class="stat-card">
          <div>
            <h3>Kendaraan Terlaris</h3>
            <h2><?= htmlspecialchars($kendaraan_terlaris['nama_kendaraan']) ?></h2>
            <p style="color: #6c757d; font-size: 0.9rem;">Disewa <?= $kendaraan_terlaris['total_sewa'] ?> kali</p>
          </div>
          <div class="stat-icon">
            <i class="fas fa-motorcycle"></i>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
      </div>
    </div>
  </body>
</html>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
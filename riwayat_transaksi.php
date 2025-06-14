<?php
session_start();
include 'koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['id_customer'])) {
    header("Location: login.html?pesan=belum_login");
    exit();
}

$id_customer = $_SESSION['id_customer'];

// Ambil data riwayat transaksi dari database
$query_transaksi = "SELECT penyewaan.id_penyewaan, kendaraan.nama AS nama_kendaraan, kendaraan.merk, 
                    penyewaan.tanggal_sewa, penyewaan.batas_sewa, penyewaan.status_penyewaan, 
                    pembayaran.metode_bayar, pembayaran.jumlah_pembayaran
                    FROM penyewaan
                    JOIN kendaraan ON penyewaan.id_kendaraan = kendaraan.id_kendaraan
                    JOIN pembayaran ON penyewaan.id_penyewaan = pembayaran.id_penyewaan
                    WHERE penyewaan.id_customer = '$id_customer'
                    ORDER BY penyewaan.tanggal_sewa DESC";
$result_transaksi = mysqli_query($connect, $query_transaksi);

if (!$result_transaksi) {
    die('Error: ' . mysqli_error($connect));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Transaksi - JSRent</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      color: #212529;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #003b8b;
      color: white;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .logo {
      font-size: 1.5rem;
      font-weight: 700;
    }

    .nav-right {
      display: flex;
      align-items: center;
      gap: 1.5rem;
    }

    .nav-right a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s;
    }

    .nav-right a:hover {
      color: #ffc107;
    }

    .container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 0 1rem;
      display: flex;
      gap: 2rem;
    }

    .sidebar {
      width: 250px;
      background-color: white;
      border-radius: 10px;
      padding: 1.5rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      height: fit-content;
      border: 1px solid #003b8b;
    }

    .sidebar h2 {
      color: #003b8b;
      font-size: 1.25rem;
      margin-bottom: 1.5rem;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid #e9ecef;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar li {
      margin-bottom: 1rem;
    }

    .sidebar a {
      color: #212529;
      text-decoration: none;
      font-weight: 500;
      display: block;
      padding: 0.5rem 0;
      transition: color 0.3s;
    }

    .sidebar a:hover {
      color: #ffc107;
    }

    .main-content {
      flex: 1;
      background-color: white;
      border-radius: 10px;
      padding: 2rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      border: 1px solid #003b8b;
    }

    h1 {
      color: #003b8b;
      font-size: 1.5rem;
      margin-bottom: 1rem;
      text-align: center;
    }

    h2 {
      color: #ffc107;
      font-size: 1.25rem;
      margin-bottom: 0.5rem;
    }

    .table-container {
      overflow-x: auto;
      margin-top: 1rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
      font-size: 0.9rem;
      text-align: left;
    }

    table th, table td {
      padding: 0.75rem 1rem;
      border: 1px solid #e9ecef;
    }

    table th {
      background-color: #003b8b;
      color: white;
      text-transform: uppercase;
      font-size: 0.85rem;
    }

    table tr:nth-child(even) {
      background-color: #f8f9fa;
    }

    table tr:hover {
      background-color: #f1f1f1;
    }

    table td {
      color: #212529;
    }

    .status {
      font-weight: bold;
      padding: 0.25rem 0.5rem;
      border-radius: 5px;
      display: inline-block;
    }

    .status.Proses {
      background-color: #ffc107;
      color: #212529;
    }

    .status.Selesai {
      background-color: #28a745;
      color: white;
    }

    .status.Dibatalkan {
      background-color: #dc3545;
      color: white;
    }

    .no-data {
      text-align: center;
      color: #6c757d;
      font-size: 1rem;
      margin-top: 1rem;
    }
  </style>
</head>
<body>
<header>
  <a class="logo">JSRent</a>
  <div class="nav-right">
    <a href="index.html"><i class="fas fa-home"></i> Home</a>
    <a href="daftarmotor.php"><i class="fas fa-motorcycle"></i> Sewa Motor</a>
    <a href="Logout.php"><i class="fas fa-user"></i> Logout</a>
  </div>
</header>

<div class="container">
  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Navigasi Profil</h2>
    <ul>
      <li><a href="profil_customer.php">Profil Saya</a></li>
      <li><a href="riwayat_transaksi.php">Riwayat Transaksi</a></li>
    </ul>
  </div>

  <!-- Konten Utama -->
  <div class="main-content">
    <h1>Riwayat Transaksi</h1>
    <h2>Daftar Transaksi Anda</h2>

    <?php if (mysqli_num_rows($result_transaksi) > 0): ?>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>ID Transaksi</th>
              <th>Kendaraan</th>
              <th>Tanggal Sewa</th>
              <th>Batas Sewa</th>
              <th>Metode Pembayaran</th>
              <th>Harga</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($transaksi = mysqli_fetch_assoc($result_transaksi)): ?>
              <tr>
                <td><?= htmlspecialchars($transaksi['id_penyewaan']) ?></td>
                <td><?= htmlspecialchars($transaksi['merk'] . ' ' . $transaksi['nama_kendaraan']) ?></td>
                <td><?= htmlspecialchars($transaksi['tanggal_sewa']) ?></td>
                <td><?= htmlspecialchars($transaksi['batas_sewa']) ?></td>
                <td><?= htmlspecialchars($transaksi['metode_bayar']) ?></td>
                <td>Rp <?= number_format($transaksi['jumlah_pembayaran'], 0, ',', '.') ?></td>
                <td><span class="status <?= htmlspecialchars($transaksi['status_penyewaan']) ?>"><?= htmlspecialchars($transaksi['status_penyewaan']) ?></span></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="no-data">Tidak ada riwayat transaksi.</p>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
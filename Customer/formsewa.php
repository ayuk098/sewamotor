<?php
session_start();
include 'koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['id_customer'])) {
    header("Location: login.php?pesan=belum_login");
    exit();
}

$id_customer = $_SESSION['id_customer'];
$id_kendaraan = isset($_GET['id']) ? mysqli_real_escape_string($connect, $_GET['id']) : '';

// Ambil data kendaraan
$query = "SELECT nama, id_kendaraan, merk FROM kendaraan WHERE id_kendaraan = '$id_kendaraan'";
$result = mysqli_query($connect, $query);
$motor = mysqli_fetch_assoc($result);

if (!$motor) {
    die('Error: Data motor tidak ditemukan');
}

// Ambil data customer dari session
$query_customer = "SELECT nama, no_telepon, alamat, NIK, jenis_kelamin FROM customer WHERE id_customer = '$id_customer'";
$result_customer = mysqli_query($connect, $query_customer);
$customer = mysqli_fetch_assoc($result_customer);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Data Pengambilan
    $tanggal_sewa = mysqli_real_escape_string($connect, $_POST['tanggal_sewa']);
    $batas_sewa = mysqli_real_escape_string($connect, $_POST['batas_sewa']);
    $waktu_ambil = mysqli_real_escape_string($connect, $_POST['waktu_ambil']);

    // Insert langsung ke tabel penyewaan menggunakan id_customer dari session
    $query_penyewaan = "INSERT INTO penyewaan (id_customer, id_kendaraan, tanggal_sewa, batas_sewa, waktu_ambil, status_penyewaan) 
                        VALUES ('$id_customer', '$id_kendaraan', '$tanggal_sewa', '$batas_sewa', '$waktu_ambil', 'Proses')";
    $query_penyewaan_result = mysqli_query($connect, $query_penyewaan);

    if (!$query_penyewaan_result) {
        die('Error: ' . mysqli_error($connect)); 
    }

    // Setelah data penyewaan berhasil dimasukkan
    $id_penyewaan = mysqli_insert_id($connect);
    header("Location: pembayaran.php?id_penyewaan=$id_penyewaan");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>JSRent - Form Penyewaan</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<style>
:root {
  --primary: #0F4181;
  --secondary: #ffc107;
  --light: #f8f9fa;
  --dark: #212529;
  --gray: #6c757d;
  --light-gray: #e9ecef;
  --danger: #dc3545;
}

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Poppins', sans-serif;
  background-color: #f8f9fa;
  color: var(--dark);
  line-height: 1.6;
}

header {
  background-color: var(--primary);
  color: white;
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.logo {
  font-size: 1.5rem;
  font-weight: 700;
  color: white;
  text-decoration: none;
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
  color: var(--secondary);
}

.profile {
  width: 40px;
  height: 40px;
  background-color: var(--light-gray);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--gray);
  cursor: pointer;
}

.container {
  max-width: 1200px;
  margin: 2rem auto;
  padding: 0 1rem;
}

.form-header {
  text-align: center;
  margin-bottom: 2rem;
}

.vehicle-info {
  margin-top: 1rem;
}

.vehicle-info h3 {
  font-size: 1.25rem;
  color: var(--primary);
  margin-bottom: 0.25rem;
}

.vehicle-info .plate {
  color: #1E90FF;
  padding: 0.25rem 0.75rem;
  border-radius: 4px;
  font-size: 1rem;
}

.form-container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
  margin-bottom: 2rem;
}

.form-card {
  background-color: white;
  border-radius: 10px;
  padding: 1.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  border: 1px solid var(--light-gray);
}

.form-card h4 {
  color: var(--primary);
  font-size: 1.125rem;
  margin-bottom: 1rem;
  padding-bottom: 0.5rem;
  border-bottom: 1px solid var(--light-gray);
}

.subtitle {
  text-align: center;
  font-size: 0.8125rem;
  color: var(--gray);
  margin-bottom: 1.5rem;
}

.customer-info {
  margin-bottom: 1rem;
}

.form-group {
  margin-bottom: 1.25rem;
}

.form-group label {
  display: block;
  font-size: 0.875rem;
  margin-bottom: 0.5rem;
  color: var(--dark);
  font-weight: 500;
}

.form-control {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid var(--light-gray);
  border-radius: 6px;
  font-size: 0.875rem;
  transition: border-color 0.3s, box-shadow 0.3s;
}

.form-control:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 3px rgba(0, 59, 139, 0.1);
}

.btn-container {
  grid-column: span 2;
  text-align: center;
  margin-top: 1rem;
}

.btn {
  background-color: var(--secondary);
  color: white;
  border: none;
  padding: 0.75rem 1.5rem;
  font-size: 1rem;
  font-weight: 600;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.2s, box-shadow 0.3s;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn:hover {
  background-color: #e0a800;
  transform: translateY(-2px);
  box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

.btn:active {
  transform: translateY(0);
}

@media (max-width: 768px) {
  .form-container {
    grid-template-columns: 1fr;
  }
  
  .btn-container {
    grid-column: span 1;
  }
  
  header {
    padding: 1rem;
  }
  
  .nav-right {
    gap: 1rem;
  }
}
</style>
<body>
<header>
  <a href="#" class="logo">JSRent</a>
  <div class="nav-right">
    <a href="index.php"><i class="fas fa-home"></i> Home</a>
    <a href="daftarmotor.php"><i class="fas fa-motorcycle"></i> Sewa Motor</a>
    <a href="profil_customer.php" class="profile">
      <i class="fas fa-user"></i>
    </a>
  </div>
</header>

<div class="container">
  <div class="form-header">
    <div class="vehicle-info">
      <h3><?= htmlspecialchars($motor['merk']) ?> <?= htmlspecialchars($motor['nama']) ?></h3>
      <span class="plate">XY <?= htmlspecialchars($motor['id_kendaraan']) ?></span>
    </div>
  </div>

  <form action="" method="POST">
    <div class="form-container">
      <!-- Card Data Penyewa -->
      <div class="form-card">
  <h4><i class="fas fa-user"></i> Data Penyewa</h4>
  <p class="subtitle">Informasi mengenai profil kamu</p>
  
  <div class="customer-info">
    <table style="width: 100%; border-collapse: collapse;">
      <tr>
        <td style="font-weight: bold; padding: 0.5rem; width: 30%;">Nama Lengkap</td>
        <td style="padding: 0.5rem;"><?= htmlspecialchars($customer['nama']) ?></td>
      </tr>
      <tr>
        <td style="font-weight: bold; padding: 0.5rem;">NIK</td>
        <td style="padding: 0.5rem;"><?= htmlspecialchars($customer['NIK']) ?></td>
      </tr>
      <tr>
        <td style="font-weight: bold; padding: 0.5rem;">Alamat</td>
        <td style="padding: 0.5rem;"><?= htmlspecialchars($customer['alamat']) ?></td>
      </tr>
      <tr>
        <td style="font-weight: bold; padding: 0.5rem;">No Telepon</td>
        <td style="padding: 0.5rem;"><?= htmlspecialchars($customer['no_telepon']) ?></td>
      </tr>
      <tr>
        <td style="font-weight: bold; padding: 0.5rem;">Jenis Kelamin</td>
        <td style="padding: 0.5rem;"><?= htmlspecialchars($customer['jenis_kelamin']) ?></td>
      </tr>
    </table>
  </div>
</div>

      <!-- Card Data Pengambilan -->
      <div class="form-card">
        <h4><i class="fas fa-calendar-alt"></i> Data Pengambilan</h4>
        <p class="subtitle">Pilih tanggal rental anda</p>

        <div class="form-group">
          <label for="tanggal_sewa">Tanggal Pengambilan</label>
          <input type="date" id="tanggal_sewa" name="tanggal_sewa" class="form-control" required />
        </div>

        <div class="form-group">
          <label for="waktu_ambil">Jam Pengambilan</label>
          <select id="waktu_ambil" name="waktu_ambil" class="form-control" required>
            <option value="" disabled selected>Pilih waktu pengambilan</option>
            <option>08:00 WIB</option>
            <option>09:00 WIB</option>
            <option>10:00 WIB</option>
            <option>11:00 WIB</option>
            <option>12:00 WIB</option>
            <option>13:00 WIB</option>
          </select>
        </div>

        <div class="form-group">
          <label for="batas_sewa">Tanggal Pengembalian</label>
          <input type="date" id="batas_sewa" name="batas_sewa" class="form-control" required />
        </div>
      </div>
    </div>

    <div class="btn-container">
      <button type="submit" class="btn">
        <i class="fas fa-arrow-right"></i> Lanjutkan
      </button>
    </div>
  </form>
</div>
</body>
</html>
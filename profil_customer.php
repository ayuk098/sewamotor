<?php
session_start();
include 'koneksi.php';

// Pastikan pengguna telah login
if (!isset($_SESSION['id_customer'])) {
    header("Location: login.html?pesan=belum_login");
    exit();
}

// Ambil ID customer dari sesi login
$id_customer = $_SESSION['id_customer'];

// Query untuk mengambil data customer dari database
$query_customer = "SELECT nama, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, kota, kabupaten, no_telepon, email, NIK, foto_ktp
                   FROM customer WHERE id_customer = '$id_customer'";
$result_customer = mysqli_query($connect, $query_customer);

if (!$result_customer) {
    die('Error: ' . mysqli_error($connect));
}

$customer = mysqli_fetch_assoc($result_customer);

if (!$customer) {
    die('Error: Data customer tidak ditemukan.');
}

// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($connect, $_POST['nama']);
    $tempat_lahir = mysqli_real_escape_string($connect, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($connect, $_POST['tanggal_lahir']);
    $jenis_kelamin = mysqli_real_escape_string($connect, $_POST['jenis_kelamin']);
    $alamat = mysqli_real_escape_string($connect, $_POST['alamat']);
    $kota = mysqli_real_escape_string($connect, $_POST['kota']);
    $kabupaten = mysqli_real_escape_string($connect, $_POST['kabupaten']);
    $no_telepon = mysqli_real_escape_string($connect, $_POST['no_telepon']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $NIK = mysqli_real_escape_string($connect, $_POST['NIK']);

    // Proses upload foto KTP
    $foto_ktp = $customer['foto_ktp']; // Default foto KTP
    if (!empty($_FILES['foto_ktp']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES["foto_ktp"]["name"]);
        if (move_uploaded_file($_FILES["foto_ktp"]["tmp_name"], $target_file)) {
            $foto_ktp = $_FILES["foto_ktp"]["name"];
        } else {
            die('Error: Gagal mengunggah foto KTP.');
        }
    }

    // Query untuk memperbarui data customer
    $query_update = "UPDATE customer 
                     SET nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', 
                         jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', kota = '$kota', 
                         kabupaten = '$kabupaten', no_telepon = '$no_telepon', email = '$email', NIK = '$NIK', foto_ktp = '$foto_ktp'
                     WHERE id_customer = '$id_customer'";
    $result_update = mysqli_query($connect, $query_update);

    if (!$result_update) {
        die('Error: ' . mysqli_error($connect));
    }

    header("Location: profil_customer.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Customer - JSRent</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    :root {
      --primary: #003b8b;
      --secondary: #ffc107;
      --light: #f8f9fa;
      --dark: #212529;
      --gray: #6c757d;
      --light-gray: #e9ecef;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa ;
      color: var(--dark);
      line-height: 1.6;
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
      border: 1px solid var(--primary);
    }

    .sidebar h2 {
      color: var(--primary);
      font-size: 1.25rem;
      margin-bottom: 1.5rem;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid var(--light-gray);
    }

    .sidebar ul {
      list-style: none;
    }

    .sidebar li {
      margin-bottom: 1rem;
    }

    .sidebar a {
      color: var(--dark);
      text-decoration: none;
      font-weight: 500;
      display: block;
      padding: 0.5rem 0;
      transition: color 0.3s;
    }

    .sidebar a:hover {
      color: var(--secondary);
    }

    .main-content {
      flex: 1;
      background-color: white;
      border-radius: 10px;
      padding: 2rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      border: 1px solid var(--primary);
    }

    .welcome-section {
      margin-bottom: 2rem;
    }

    .welcome-section h1 {
      color: var(--secondary);
      font-size: 1.5rem;
      margin-bottom: 0.5rem;
    }

    .welcome-section p {
      color: var(--gray);
      font-size: 0.875rem;
    }

    .profile-section {
      margin-bottom: 2rem;
    }

    .profile-section h3 {
      color: var(--primary);
      font-size: 1.125rem;
      margin-bottom: 1.5rem;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid var(--light-gray);
    }

    .form-group {
      display: flex;
      margin-bottom: 1.5rem;
    }

    .form-group label {
      width: 200px;
      font-weight: 500;
      padding: 0.5rem 0;
    }

    .form-control {
      flex: 1;
      padding: 0.5rem;
      border: 1px solid var(--light-gray);
      border-radius: 6px;
      font-size: 0.875rem;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--primary);
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
      transition: background-color 0.3s;
    }

    .btn:hover {
      background-color: #e0a800;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }
      header {
      padding: 1rem; 
      }
      .nav-right {
      gap: 1rem;
    }
      .sidebar {
        width: 100%;
      }
      
      .form-group {
        flex-direction: column;
      }
      
      .form-group label {
        width: 100%;
        margin-bottom: 0.5rem;
      }
    }
    </style>
</head>
<body>
<header>
  <a class="logo">JSRent</a>
  <div class="nav-right">
    <a href="index.html"><i class="fas fa-home"></i> Home</a>
    <a href="daftarmotor.php"><i class="fas fa-motorcycle"></i> Sewa Motor</a>
    <a href="logout.php"><i class="fas fa-user"></i> Logout</a>
  </div>
</header>

<div class="container">
  <!-- Sidebar Navigation -->
  <div class="sidebar">
    <h2>Navigasi Profil</h2>
    <ul>
      <li><a href="profil_customer.php">Profil Saya</a></li>
      <li><a href="riwayat_transaksi.php">Riwayat Transaksi</a></li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="welcome-section">
      <h1>Welcome, <?= htmlspecialchars($customer['nama']) ?></h1>
      <p>Informasi mengenai profil kamu di seluruh layanan JSRent.</p>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">
      <div class="profile-section">
        <h3>Informasi Pribadi</h3>
        
        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($customer['nama']) ?>" required>
        </div>

        <div class="form-group">
          <label>Tempat, tanggal lahir</label>
          <div style="display: flex; gap: 1rem; flex: 1;">
            <input type="text" class="form-control" name="tempat_lahir" value="<?= htmlspecialchars($customer['tempat_lahir']) ?>" placeholder="Tempat" required>
            <input type="date" class="form-control" name="tanggal_lahir" value="<?= htmlspecialchars($customer['tanggal_lahir']) ?>" required>
          </div>
        </div>

        <div class="form-group">
          <label>Jenis Kelamin</label>
          <select class="form-control" name="jenis_kelamin" required>
            <option value="Laki-laki" <?= $customer['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
            <option value="Perempuan" <?= $customer['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
          </select>
        </div>

        <div class="form-group">
          <label>Nomor Telepon</label>
          <input type="tel" class="form-control" name="no_telepon" value="<?= htmlspecialchars($customer['no_telepon']) ?>" required>
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($customer['email']) ?>" required>
        </div>
      </div>
      <div class="form-group">
        <label>NIK</label>
        <input type="text" class="form-control" name="NIK" value="<?= htmlspecialchars($customer['NIK']) ?>" required>
    </div>
    <div class="form-group">
      <label>Foto KTP</label>
      <?php if (!empty($customer['foto_ktp'])): ?>
        <img src="uploads/<?= htmlspecialchars($customer['foto_ktp']) ?>" alt="Foto KTP" style="max-width: 200px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 1rem;">
      <?php endif; ?>
      <input type="file" class="form-control" name="foto_ktp" accept="image/*">
    </div>
      <div class="profile-section">
        <h3>Domisili</h3>
        
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" class="form-control" name="alamat" value="<?= htmlspecialchars($customer['alamat']) ?>" required>
        </div>
    
        <div class="form-group">
          <label>Kota</label>
          <input type="text" class="form-control" name="kota" value="<?= htmlspecialchars($customer['kota']) ?>" required>
        </div>

        <div class="form-group">
          <label>Kabupaten</label>
          <input type="text" class="form-control" name="kabupaten" value="<?= htmlspecialchars($customer['kabupaten']) ?>" required>
        </div>
      </div>

      <button type="submit" class="btn">Simpan Perubahan</button>
    </form>
  </div>
</div>
</body>
</html>
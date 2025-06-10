<?php
include 'koneksi.php'; 

$search = isset($_GET['search']) ? trim($_GET['search']) : '';


$query = "SELECT id_kendaraan, nama, gambar_kendaraan, merk, harga_sewa, status FROM kendaraan";
if ($search !== '') {
    $query .= " WHERE nama LIKE '%" . mysqli_real_escape_string($connect, $search) . "%'";
}
$result = mysqli_query($connect, $query);

?>
<?php
session_start();
if (empty($_SESSION['id_customer'])) {
    header("Location: login.php?pesan=belum_login");
    exit();
}


$nama = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JSRent - Daftar Motor</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }
    body {
      background-color: #f5f5f5;
      padding-bottom: 40px;
    }
    header {
  background-color: #0F4181;
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
  color: #ffc107;
}
  .profile {
  width: 40px;
  height: 40px;
  background-color: #e9ecef;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #6c757d;
  cursor: pointer;
}
    .motor-section {
      margin: 40px;
    }
    .motor-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #003b8b;
      text-align: center;
      text-transform: uppercase;
      letter-spacing: 2px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }
    .search-form {
      margin-bottom: 20px;
      text-align: center;
    }
    .search-form input[type="text"] {
      padding: 8px;
      width: 300px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .search-form button {
      padding: 8px 16px;
      background-color: #0F4181;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .search-form button:hover {
      background-color: #0F4181;
    }
    .motor-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr); 
      gap: 24px; 
    }
    .motor-card {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background: white;
      border: 2px solid #0F4181; 
      border-radius: 10px;
      padding: 16px;
      text-align: center;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease; 
    }
    .motor-card:hover {
      transform: translateY(-5px); 
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); 
    }
    .motor-card img {
      width: 100%;
      height: 130px;
      object-fit: contain; 
      margin-bottom: 10px;
    }
    .motor-card .nama {
      font-size: 18px;
      font-weight: bold;
      color: #0F4181; 
      margin-bottom: 8px;
    }
    .motor-card .merk {
      color: #1E90FF; 
      font-size: 14px;
      margin: 4px 0;
    }
    .motor-card .harga {
      font-weight: bold;
      color: #000; 
      font-size: 16px;
    }
    .motor-card .waktu {
      color: #0F4181; 
      font-size: 14px;
      font-weight: bold;
    }
    .motor-card .info-bottom {
      display: flex; 
      justify-content: space-between; 
      align-items: center; 
      margin-top: auto; 
    }
    .motor-card .info-bottom div {
      flex: 1; 
      text-align: left; 
    }
    .motor-card .status {
      font-size: 14px;
      font-weight: bold;
      margin-top: 4px;
    }
    .motor-card .status.tersedia {
      color: green; 
    }
    .motor-card .status.tidak-tersedia {
      color: red; 
    }
    .motor-card .sewa-button {
      display: inline-block;
      background-color: #ffc107;
      color: #000;
      text-decoration: none;
      padding: 8px 16px;
      border-radius: 20px;
      cursor: pointer;
      font-weight: 500;
      text-align: center;
      width: auto; 
    }
    .motor-card .sewa-button:hover {
      background-color: #e0b806; 
    }
  </style>
</head>
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
  <div class="motor-section">
    <div class="motor-title">Daftar Motor</div>
    <form class="search-form" method="GET" action="">
      <input type="text" name="search" placeholder="Cari motor berdasarkan nama" value="<?= htmlspecialchars($search) ?>">
      <button type="submit">Cari</button>
    </form>
    <div class="motor-grid">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="motor-card">
        <h3 class="nama"><?= htmlspecialchars($row['nama']) ?></h3>
        <img src="gambar/<?= htmlspecialchars($row['gambar_kendaraan']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>">
        <div class="info-bottom">
          <div>
            <p class="merk"> XY <?= htmlspecialchars($row['id_kendaraan']) ?></p>
            <p class="harga">Rp <?= number_format($row['harga_sewa'], 0, ',', '.') ?></p>
            <p class="waktu">24 JAM</p>
            <p class="status <?= trim($row['status']) === 'Tersedia' ? 'tersedia' : 'tidak-tersedia' ?>">
              <?= trim($row['status']) === 'Tersedia' ? 'Tersedia' : 'Tidak Tersedia' ?>
            </p>
          </div>
          <?php if (trim($row['status']) === 'Tersedia') { ?>
            <a href="formsewa.php?id=<?= $row['id_kendaraan'] ?>" class="sewa-button">Sewa</a>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</body>
</html>

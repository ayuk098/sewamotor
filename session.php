<?php
session_start();
if (empty($_SESSION['id_customer'])) {
    header("Location: login.php?pesan=belum_login");
    exit();
}

// Data pelanggan
$nama = $_SESSION['nama'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
</head>
<body>
  <h1>Selamat datang, <?= htmlspecialchars($nama) ?>!</h1>
  <a href="logout.php">Logout</a>
</body>
</html>
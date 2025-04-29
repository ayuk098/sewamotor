<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JSRent - Daftar Motor</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
    }
    body {
      background-color: #f5f5f5;
      padding-bottom: 40px;
    }
    header {
      background-color: #003b8b;
      color: white;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .nav-right {
      display: flex;
      align-items: center;
      gap: 24px;
    }
    .nav-right a {
      color: white;
      text-decoration: none;
      font-weight: 600;
    }
    .profile {
      width: 40px;
      height: 40px;
      background-color: #e0e0e0;
      border-radius: 50%;
    }
    .motor-section {
      margin: 40px;
    }
    .motor-title {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .motor-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 24px;
    }
    .motor-card {
      background: white;
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      padding: 16px;
      text-align: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .motor-card img {
      width: 100%;
      height: 130px;
      object-fit: contain;
    }
    .motor-card h3 {
      font-size: 16px;
      font-weight: 600;
      margin-top: 10px;
    }
    .motor-card p {
      margin: 6px 0;
      color: #333;
      font-size: 14px;
    }
    .motor-card .harga {
      font-weight: bold;
      color: #003b8b;
    }
    .motor-card .merk {
      font-style: italic;
      color: #555;
    }
    .motor-card .status {
      font-size: 13px;
      font-weight: bold;
      margin-top: 4px;
    }
    .motor-card .status.tersedia {
      color: green;
    }
    .motor-card .status.tidak-tersedia {
      color: red;
    }
    .motor-card button {
      margin-top: 10px;
      background-color: #ffc107;
      border: none;
      padding: 8px 16px;
      border-radius: 20px;
      cursor: pointer;
      font-weight: 600;
    }
    .sewa-button {
  display: inline-block;
  margin-top: 10px;
  background-color: #ffc107;
  color: #000;
  text-decoration: none;
  padding: 8px 16px;
  border-radius: 20px;
  cursor: pointer;
  font-weight: 600;
  text-align: center;
}
.sewa-button:hover {
  background-color: #e0b806;
}
  </style>
</head>
<body>
  <header>
    <div><strong>JSRent</strong></div>
    <div class="nav-right">
      <a href="#">Home</a>
      <a href="#">Sewa Motor</a>
      <div class="profile"></div>
    </div>
  </header>
  <div class="motor-section">
    <div class="motor-title">Daftar Motor</div>
    <div class="motor-grid">
      <div class="motor-card">
        <img src="https://i.ibb.co/qNK5Py5/vario.png" alt="Honda Vario 125">
        <h3>Honda Vario 125</h3>
        <p class="merk">Merk: Honda</p>
        <p>XZ 1247 YY</p>
        <p class="harga">Rp 80.000</p>
        <p>24 JAM</p>
        <p class="status tersedia">Tersedia</p>
        <a href="formsewa.php" class="sewa-button">Sewa</a>
      </div>
      <div class="motor-card">
        <img src="https://i.ibb.co/Mnf0GqM/aerox.png" alt="Yamaha AEROX 155">
        <h3>Yamaha AEROX 155</h3>
        <p class="merk">Merk: Yamaha</p>
        <p>XZ 1248 QY</p>
        <p class="harga">Rp 100.000</p>
        <p>24 JAM</p>
        <p class="status tidak-tersedia">Tidak Tersedia</p>
        <a href="formsewa.php" class="sewa-button">Sewa</a>
      </div>
      <div class="motor-card">
        <img src="https://i.ibb.co/Vm3KhS1/scoopy.png" alt="Honda Scoopy 2024">
        <h3>Honda Scoopy 2024</h3>
        <p class="merk">Merk: Honda</p>
        <p>XZ 1249 ZZ</p>
        <p class="harga">Rp 80.000</p>
        <p>24 JAM</p>
        <p class="status tersedia">Tersedia</p>
        <a href="formsewa.php" class="sewa-button">Sewa</a>
      </div>
      <div class="motor-card">
        <img src="https://i.ibb.co/zPWKVyd/filano.png" alt="Yamaha GRAND FILANO">
        <h3>Yamaha GRAND FILANO</h3>
        <p class="merk">Merk: Yamaha</p>
        <p>XZ 1250 IJ</p>
        <p class="harga">Rp 70.000</p>
        <p>24 JAM</p>
        <p class="status tersedia">Tersedia</p>
        <a href="formsewa.php" class="sewa-button">Sewa</a>
      </div>
      <div class="motor-card">
        <img src="https://i.ibb.co/qNK5Py5/vario.png" alt="Honda Vario 125">
        <h3>Honda Vario 125</h3>
        <p class="merk">Merk: Honda</p>
        <p>XZ 1251 GB</p>
        <p class="harga">Rp 80.000</p>
        <p>24 JAM</p>
        <p class="status tidak-tersedia">Tidak Tersedia</p>
        <a href="formsewa.php" class="sewa-button">Sewa</a>
      </div>
      <div class="motor-card">
        <img src="https://i.ibb.co/XjLhfBb/ninja.png" alt="Kawasaki Ninja H2">
        <h3>Kawasaki Ninja H2</h3>
        <p class="merk">Merk: Kawasaki</p>
        <p>XZ 1252 AG</p>
        <p class="harga">Rp 150.000</p>
        <p>24 JAM</p>
        <p class="status tersedia">Tersedia</p>
        <a href="formsewa.php" class="sewa-button">Sewa</a>
      </div>
      <div class="motor-card">
        <img src="https://i.ibb.co/Vm3KhS1/scoopy.png" alt="Honda Scoopy 2024">
        <h3>Honda Scoopy 2024</h3>
        <p class="merk">Merk: Honda</p>
        <p>XZ 1253 GB</p>
        <p class="harga">Rp 80.000</p>
        <p>24 JAM</p>
        <p class="status tersedia">Tersedia</p>
        <a href="formsewa.php" class="sewa-button">Sewa</a>
      </div>
      <div class="motor-card">
        <img src="https://i.ibb.co/Mnf0GqM/aerox.png" alt="Yamaha AEROX 155">
        <h3>Yamaha AEROX 155</h3>
        <p class="merk">Merk: Yamaha</p>
        <p>XZ 1254 YU</p>
        <p class="harga">Rp 100.000</p>
        <p>24 JAM</p>
        <p class="status tidak-tersedia">Tidak Tersedia</p>
        <a href="formsewa.php" class="sewa-button">Sewa</a>
      </div>
    </div>
  </div>
</body>
</html>

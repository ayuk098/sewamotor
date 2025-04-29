<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Rental & Pembayaran</title>
  <style>
    body {
        font-family: 'Segoe UI', sans-serif;
  background-color: #f7f7f7;
  margin: 0;
    }
    header {
  background-color: #003b8b;
  color: white;
  padding: 20px 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
  width: 100vw;
  box-sizing: border-box;
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
    .container {
    display: flex;
  gap: 40px;
  justify-content: center;
  flex-wrap: wrap;
  padding: 40px;
}

    .card {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      padding: 20px;
      width: 320px;
    }

    .card img {
      width: 120px;
      height: auto;
      margin-bottom: 10px;
    }

    .card h3 {
      margin: 0;
      font-size: 16px;
      color: #333;
    }

    .card .plat {
      color: #4f46e5;
      font-weight: bold;
      font-size: 14px;
    }

    .card .brand {
      font-size: 12px;
      color: #888;
    }

    .card .harga {
      margin-top: 20px;
    }

    .card .harga label {
      font-size: 12px;
      color: #888;
    }

    .card .harga strong {
      font-size: 16px;
      color: #000;
    }

    .sewa-btn {
      margin-top: 20px;
      padding: 8px 18px;
      background-color: #FFD700;
      border: none;
      border-radius: 20px;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 0 3px 5px rgba(0,0,0,0.1);
    }

    .pembayaran {
      flex: 1;
      min-width: 320px;
    }

    .pembayaran h4 {
      color: #1e3a8a;
      margin-bottom: 4px;
    }

    .pembayaran p {
      margin: 0 0 16px 0;
      color: #555;
      font-size: 14px;
    }

    .metode {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }

    .option-box {
      display: flex;
      align-items: center;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 8px 12px;
      gap: 10px;
      background-color: #f9f9f9;
    }

    .option-box input {
      margin-right: 8px;
    }

    .option-box img {
      width: 40px;
    }

    .upload-section {
      margin-top: 20px;
    }

    .upload-section input[type="file"] {
      width: 100%;
      padding: 8px;
      border-radius: 8px;
      border: 1px solid #aaa;
    }

    .note {
      font-size: 12px;
      color: #888;
      margin-top: 4px;
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
<div class="container">

  <!-- Detail Rental -->
  <div class="card">
    <h3>Detail Rental</h3>
    <p style="font-size: 12px; color: #4b5563;">Harga bisa berubah sesuai ketentuan</p>
    <img src="https://i.imgur.com/XfF3mZB.png" alt="Motor">
    <h3>Honda Vario 125</h3>
    <div class="plat">XZ 1247 YY</div>
    <div class="brand">Honda</div>
    <div class="harga">
      <label>Subtotal</label> <strong style="color: #dc2626;">Rp 80.000</strong><br>
      <label>Total harga</label> <strong>Rp 80.000</strong>
    </div>
    <a href="#" class="sewa-btn">Sewa</a>
  </div>

  <!-- Metode Pembayaran -->
  <div class="card pembayaran">
    <h4>Metode Pembayaran</h4>
    <p>Pilih metode pembayaran</p>
    <div class="metode">
      <label class="option-box"><input type="radio" name="metode"> OVO <span>No: 08123456789</span> <img src="https://seeklogo.com/images/O/ovo-logo-F75390E5C2-seeklogo.com.png" alt="OVO"></label>
      <label class="option-box"><input type="radio" name="metode"> DANA <span>No: 08123456789</span> <img src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Dana_Logo.png" alt="DANA"></label>
      <label class="option-box"><input type="radio" name="metode"> Bank BCA <span>No: 1234567890</span> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/Bank_Central_Asia.svg/512px-Bank_Central_Asia.svg.png" alt="BCA"></label>
      <label class="option-box"><input type="radio" name="metode"> BANK BNI <span>No: 1234567890</span> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/Logo_Bank_BNI.svg/512px-Logo_Bank_BNI.svg.png" alt="BNI"></label>
      <label class="option-box"><input type="radio" name="metode"> Bank BRI <span>No: 1234567890</span> <img src="https://upload.wikimedia.org/wikipedia/id/3/35/Logo_BRI.png" alt="BRI"></label>
      <label class="option-box"><input type="radio" name="metode"> BANK Mandiri <span>No: 1234567890</span> <img src="https://upload.wikimedia.org/wikipedia/id/b/bd/Bank_Mandiri_logo.svg" alt="Mandiri"></label>
    </div>

    <div class="upload-section">
      <h4>Upload Bukti Pembayaran</h4>
      <p class="note">Upload 1 file yang didukung. Maks 100 MB.</p>
      <input type="file" name="bukti" accept="image/*,.pdf">
    </div>
  </div>

</div>

</body>
</html>

<?php
include 'koneksi.php';

// Ambil data penyewaan berdasarkan ID penyewaan dari halaman sebelumnya
$id_penyewaan = isset($_GET['id_penyewaan']) ? mysqli_real_escape_string($connect, $_GET['id_penyewaan']) : '';

if (empty($id_penyewaan)) {
    die('Error: ID penyewaan tidak ditemukan.');
}

$query_penyewaan = "SELECT p.id_penyewaan, p.tanggal_sewa, p.batas_sewa, k.nama AS nama_motor, k.merk, k.harga_sewa, k.id_kendaraan, k.gambar_kendaraan 
                    FROM penyewaan p 
                    JOIN kendaraan k ON p.id_kendaraan = k.id_kendaraan 
                    WHERE p.id_penyewaan = '$id_penyewaan'";
$result_penyewaan = mysqli_query($connect, $query_penyewaan);

if (!$result_penyewaan) {
    die('Error: ' . mysqli_error($connect)); // Tampilkan error jika query gagal
}

$penyewaan = mysqli_fetch_assoc($result_penyewaan);

if (!$penyewaan) {
    die('Error: Data penyewaan tidak ditemukan.');
}
// Hitung total harga
$tanggal_sewa = new DateTime($penyewaan['tanggal_sewa']);
$batas_sewa = new DateTime($penyewaan['batas_sewa']);
$selisih_hari = $tanggal_sewa->diff($batas_sewa)->days;
$total_harga = $selisih_hari * $penyewaan['harga_sewa'];

$show_popup = false; // Variabel untuk menentukan apakah pop-up harus ditampilkan

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $metode_bayar = mysqli_real_escape_string($connect, $_POST['metode']);
    $jumlah_pembayaran = mysqli_real_escape_string($connect, $_POST['jumlah_pembayaran']);
    $tanggal_bayar = mysqli_real_escape_string($connect, $_POST['tanggal_bayar']);
    $bukti_bayar = isset($_FILES['bukti']['name']) ? $_FILES['bukti']['name'] : null;

    // Upload bukti pembayaran jika ada
    if ($bukti_bayar) {
        $target_dir = "buktibayar/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Buat folder uploads jika belum ada
        }
        $target_file = $target_dir . basename($_FILES["bukti"]["name"]);
        if (!move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_file)) {
            die('Error: Gagal mengunggah bukti pembayaran.');
        }
    }
 // Insert ke tabel pembayaran
 $query_pembayaran = "INSERT INTO pembayaran (id_penyewaan, jumlah_pembayaran, tanggal_bayar, metode_bayar, bukti_bayar) 
 VALUES ('$id_penyewaan', '$jumlah_pembayaran', '$tanggal_bayar', '$metode_bayar', '$bukti_bayar')";
$query_pembayaran_result = mysqli_query($connect, $query_pembayaran);

if (!$query_pembayaran_result) {
die('Error: ' . mysqli_error($connect)); // Hentikan eksekusi jika query gagal
}

$show_popup = true; // Set variabel untuk menampilkan pop-up
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Rental & Pembayaran - JSRent</title>
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
      --danger: #dc3545;
      --success: #28a745;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--light);
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

    .container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 0 1rem;
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
    }
    .popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      text-align: center;
      z-index: 1000;
    }
    .popup.active {
      display: block;
    }
    .popup h2 {
      color: var(--primary);
      margin-bottom: 1rem;
    }
    .popup p {
      margin-bottom: 1.5rem;
      color: var(--gray);
    }
    .popup button {
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
    .popup button:hover {
      background-color: #e0a800;
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

    .container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 0 1rem;
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
    }

    .card {
      background-color: white;
      border-radius: 10px;
      padding: 1.5rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      flex: 1;
      min-width: 300px;
    }

    .card.detail {
      max-width: 400px;
    }

    .card.pembayaran {
      flex: 2;
    }

    h3 {
      color: var(--primary);
      margin-bottom: 1rem;
    }

    .subtitle {
      font-size: 0.875rem;
      color: var(--gray);
      margin-bottom: 1.5rem;
    }

    .vehicle-info {
      text-align: center;
      margin: 1.5rem 0;
    }

    .vehicle-info img {
      max-width: 100%;
      height: auto;
      max-height: 150px;
      margin-bottom: 1rem;
      border-radius: 5px;
    }

    .vehicle-name {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 0.25rem;
    }

    .vehicle-plate {
      display: inline-block;
      background-color: var(--primary);
      color: white;
      padding: 0.25rem 0.75rem;
      border-radius: 4px;
      font-size: 0.875rem;
      margin-bottom: 0.5rem;
    }

    .vehicle-brand {
      font-size: 0.875rem;
      color: var(--gray);
    }

    .price-section {
      margin-top: 1.5rem;
      padding-top: 1rem;
      border-top: 1px dashed var(--light-gray);
    }

    .price-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 0.5rem;
    }

    .price-label {
      font-size: 0.875rem;
      color: var(--gray);
    }

    .price-value {
      font-size: 0.875rem;
      font-weight: 500;
    }

    .total-price {
      color: var(--danger);
      font-weight: 600;
    }

    .payment-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 1rem;
      margin: 1.5rem 0;
    }

    .payment-option {
      display: flex;
      align-items: center;
      padding: 0.75rem;
      border: 1px solid var(--light-gray);
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .payment-option:hover {
      border-color: var(--primary);
      background-color: rgba(0, 59, 139, 0.05);
    }

    .payment-option input {
      margin-right: 0.75rem;
    }

    .payment-option img {
      width: 30px;
      height: 30px;
      object-fit: contain;
      margin-right: 0.75rem;
    }

    .payment-details {
      font-size: 0.875rem;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    .form-label {
      display: block;
      margin-bottom: 0.5rem;
      font-size: 0.875rem;
      font-weight: 500;
    }

    .form-control {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid var(--light-gray);
      border-radius: 6px;
      font-size: 0.875rem;
      transition: border-color 0.3s;
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
      width: 100%;
      transition: background-color 0.3s;
    }

    .btn:hover {
      background-color: #e0a800;
    }

    .text-muted {
      font-size: 0.75rem;
      color: var(--gray);
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }
      
      .card {
        width: 100%;
        max-width: none;
      }
      
      .payment-grid {
        grid-template-columns: 1fr;
      }
      
    }
  </style>
</head>
<body>
<header>
  <a href="#" class="logo">JSRent</a>
  <div class="nav-right">
    <a href="index.html"><i class="fas fa-home"></i> Home</a>
    <a href="sewamotor.php"><i class="fas fa-motorcycle"></i> Sewa Motor</a>
    <a href="profil_customer.php" class="profile">
      <i class="fas fa-user"></i>
    </a>
  </div>
</header>

<div class="container">
  <!-- Rental Details Card -->
  <div class="card detail">
    <h3>Detail Rental</h3>
    <p class="subtitle">*Harga bisa berubah sesuai ketentuan</p>
    
    <div class="vehicle-info">
      <img src="gambar/<?= htmlspecialchars($penyewaan['gambar_kendaraan']) ?>" 
           alt="<?= htmlspecialchars($penyewaan['nama_motor']) ?>">
      <div class="vehicle-name"><?= htmlspecialchars($penyewaan['nama_motor']) ?></div>
      <div class="vehicle-plate"> XY <?= htmlspecialchars($penyewaan['id_kendaraan']) ?></div>
      <div class="vehicle-brand"><?= htmlspecialchars($penyewaan['merk']) ?></div>
    </div>

    <div class="price-section">
      <div class="price-row">
        <span class="price-label">Subtotal</span>
        <span class="price-value">Rp <?= number_format($penyewaan['harga_sewa'], 0, ',', '.') ?></span>
      </div>
      <div class="price-row">
        <span class="price-label">Total harga</span>
        <span class="price-value total-price">Rp <?= number_format($total_harga, 0, ',', '.') ?></span>
      </div>
    </div>
  </div>

  <!-- Payment Form -->
  <form action="" method="POST" enctype="multipart/form-data" class="card pembayaran">
    <h3>Form Pembayaran</h3>
    
    <div class="form-group">
      <label class="form-label">Metode Pembayaran</label>
      <div class="payment-grid">
        <label class="payment-option">
          <input type="radio" name="metode" value="OVO" required>
          <img src="logobayar/ovo.jpg" alt="OVO">
          <div class="payment-details">OVO - No: 08123456789</div>
        </label>
        <label class="payment-option">
          <input type="radio" name="metode" value="DANA" required>
          <img src="logobayar/dana.jpg" alt="DANA">
          <div class="payment-details">DANA - No: 08123456789</div>
        </label>
        <label class="payment-option">
          <input type="radio" name="metode" value="Bank BCA" required>
          <img src="logobayar/bca.jpg" alt="BCA">
          <div class="payment-details">Bank BCA - No: 1234567890</div>
        </label>
        <label class="payment-option">
          <input type="radio" name="metode" value="Bank BRI" required>
          <img src="logobayar/bri.jpg" alt="BRI">
          <div class="payment-details">Bank BRI - No: 1234567890</div>
        </label>
        <label class="payment-option">
          <input type="radio" name="metode" value="Bank BNI" required>
          <img src="logobayar/bni.jpg" alt="BNI">
          <div class="payment-details">Bank BNI - No: 1234567890</div>
        </label>
        <label class="payment-option">
          <input type="radio" name="metode" value="Bank Mandiri" required>
          <img src="logobayar/mandiri.jpg" alt="Mandiri">
          <div class="payment-details">Bank Mandiri - No: 1234567890</div>
        </label>
      </div>
    </div>

    <div class="form-group">
      <label for="jumlahPembayaran" class="form-label">Jumlah Pembayaran</label>
      <input type="number" class="form-control" id="jumlahPembayaran" 
             name="jumlah_pembayaran" value="<?= $total_harga ?>" readonly>
    </div>

    <div class="form-group">
      <label for="tanggalBayar" class="form-label">Tanggal Bayar</label>
      <input type="date" class="form-control" id="tanggalBayar" 
             name="tanggal_bayar" required>
    </div>

    <div class="form-group">
      <label for="buktiPembayaran" class="form-label">Upload Bukti Pembayaran</label>
      <input type="file" class="form-control" id="buktiPembayaran" 
             name="bukti" accept="image/*,.pdf" required>
      <small class="text-muted">Upload 1 file yang didukung. Maks 100 MB.</small>
    </div>

    <button type="submit" class="btn">Bayar</button>
  </form>
</div>
<!-- Pop-up -->
<div class="popup <?= $show_popup ? 'active' : '' ?>" id="popup">
  <h2>Berhasil Melakukan Transaksi</h2>
  <p>Silakan tunggu konfirmasi yang akan kami kirimkan melalui WhatsApp ke nomor Anda. Proses pengiriman konfirmasi memerlukan waktu maksimal 1 jam setelah transaksi berhasil dilakukan.</p>
  <button onclick="closePopup()">Close</button>
</div>

<script>
  function closePopup() {
    document.getElementById('popup').classList.remove('active');
    window.location.href = 'index.html'; 
  }
</script>
<script>
  // Set today's date as default for payment date
  document.getElementById('tanggalBayar').valueAsDate = new Date();
</script>
</body>
</html>

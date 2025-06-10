<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Utama Admin</title>
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

      .logo {
        text-align: center;
        margin-bottom: 30px;
      }

      .logo img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
      }

      .logo span {
        display: block;
        margin-top: 10px;
        font-size: 1.2rem;
        font-weight: 600;
        color: #0F4181;
      }

      .main-content {
        flex-grow: 1;
        padding: 40px;
      }

      .page-title {
        font-size: 2rem;
        font-weight: bold;
        color: orange;
      }

      .table-custom {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
      }

      .table-custom thead {
        background-color: white;
        font-weight: bold;
      }

      .table-custom th, .table-custom td {
        padding: 14px 16px;
        text-align: left;
      }

      .table-custom tbody tr {
        border-bottom: 1px solid #eee;
      }

      .table-custom tbody tr:last-child {
        border-bottom: none;
      }

      .link-id {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
      }

      .btn-edit {
        background-color: #5bc0de;
        color: white;
        border: none;
        padding: 6px 10px;
        font-size: 14px;
        border-radius: 5px;
        margin-right: 5px;
        text-decoration: none;
      }

      .btn-delete {
        background-color: #d9534f;
        color: white;
        border: none;
        padding: 6px 10px;
        font-size: 14px;
        border-radius: 5px;
        text-decoration: none;
      }

      .btn-edit:hover {
        background-color: #31b0d5;
      }

      .btn-delete:hover {
        background-color: #c9302c;
      }

      .search-box {
        margin-bottom: 20px;
      }
      
      .info-box {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        border-left: 4px solid #0F4181;
      }
      .admin-profile {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
      }

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
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  </head>
  <body>
    <div class="d-flex">
      <!-- Sidebar -->
      <div class="sidebar d-flex flex-column">
      <div class="logo d-flex align-items-center px-3 mb-4">
         <img src="../logo.png" alt="JSRent Logo" style="width: 60px; height: 60px; border-radius: 50%; margin-right: 10px;">
         <span style="font-size: 1.5rem; font-weight: 700; color: #0F4181;">JSRent</span>
      </div>
      <a href="../halamanutama.php"><i class="fas fa-home"></i> Dashboard</a>
      <a href="../customer/halamanutama.php" ><i class="fas fa-user"></i> Customer</a>
      <a href="#" class="active"><i class="fas fa-money-bill-wave"></i> Pembayaran</a>
      <a href="../penyewaan/halutpenyewaan.php"><i class="fas fa-file-invoice"></i> Penyewaan</a>
      <a href="../kendaraan/halutkendaraan.php"><i class="fas fa-tools"></i> Kendaraan</a>
      </div>

      <div class="admin-profile">
        <a href="../biodata_admin.php">
          <img src="../admin.jpg" alt="Admin Profile" title="Profil Admin">
        </a>
      </div>
      <div class="main-content">
        <h1 class="page-title">Pembayaran</h1>
        <div class="row mb-3 align-items-center">
      <div class="col-md-6">
          <form class="d-flex" method="GET" action="">
            <input type="text" name="search" class="form-control me-2" placeholder="Id Penyewaan atau Metode bayar " value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
          </form>
    </div>
  <!-- Tombol Tambah Data di kanan -->
  <div class="col-md-6 text-end">
    <button class="btn btn-primary" style="background-color: #0a3b7e;" data-bs-toggle="modal" data-bs-target="#modalTambahPembayaran">
      + Tambah Data
    </button>
  </div>
</div>
        
        <table class="table-custom">
  <thead>
    <tr>
      <th>ID Pembayaran</th>
      <th>ID Penyewaan</th>
      <th>Jumlah Pembayaran</th>
      <th>Tanggal Pembayaran</th>
      <th>Metode Pembayaran</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
  <?php
              include '../koneksi.php';

              $search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';
              if ($search != '') {
                $query = mysqli_query($connect, "SELECT * FROM pembayaran WHERE id_penyewaan LIKE '%$search%' OR metode_bayar LIKE '%$search%'");
              } else {
                $query = mysqli_query($connect, "SELECT * FROM pembayaran");
              }

              while($data = mysqli_fetch_array($query)) {
            ?>
    <tr>
      <td><a class="link-id" href="#"><?= '#PEM' . $data['id_pembayaran']; ?></a></td>
      <td><a class="link-id" href="#"><?= '#PEN' . $data['id_penyewaan']; ?></a></td>
      <td>Rp <?= number_format($data['jumlah_pembayaran'], 0, ',', '.'); ?></td>
      <td><?= date('d/m/Y', strtotime($data['tanggal_bayar'])); ?></td>
      <td><?= $data['metode_bayar']; ?></td>

      <td>
      <button 
          class="btn-edit" 
              data-bs-toggle="modal" 
              data-bs-target="#modalEditPembayaran"
              data-idpembayaran="<?= $data['id_pembayaran']; ?>"
              data-idpenyewaan="<?= $data['id_penyewaan']; ?>"
              data-jumlahpembayaran="<?= $data['jumlah_pembayaran']; ?>"
              data-tanggalbayar="<?= $data['tanggal_bayar']; ?>"
              data-metodebayar="<?= $data['metode_bayar']; ?>"
            >✏ Edit</button>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>
</div>
<!-- Modal Edit Data -->
<div class="modal fade" id="modalEditPembayaran" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-4">
    <div class="modal-header text-white" style="background-color: #0F4181;">
        <h5 class="modal-title">Edit Data Pembayaran</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="proses_update.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="id_pembayaran" id="editidpembayaran">
          <div class="row g-3">
            <div class="col-md-6">
              <label>ID Penyewaan</label>
              <input type="text" class="form-control border-warning" name="id_penyewaan" id="editidpenyewaan" class="form-control" readonly>
            </div>
            <div class="col-md-6">
              <label>Jumlah Pembayaran</label>
              <input type="number" class="form-control border-warning" name="jumlah_pembayaran" id="editjumlahpembayaran" class="form-control">
            </div>
            <div class="col-md-6">
              <label>Tanggal Pembayaran</label>
              <input type="date" class="form-control border-warning" name="tanggal_bayar" id="edittanggalbayar" class="form-control">
            </div>
            <div class="col-md-6">
              <label>Metode Pembayaran</label>
              <select name="metode_bayar" class="form-control border-warning"  id="editmetodebayar" class="form-select">
                <option value="Dana">Dana</option>
                <option value="OVO">OVO</option>
                <option value="Bank BCA">Bank BCA</option>
                <option value="Bank BNI">Bank BNI</option>
                <option value="Bank BRI">Bank BRI</option>
                <option value="Bank Mandiri">Bank Mandiri</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-end">
          <button type="submit" class="btn btn-warning text-white">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
      <!-- Modal Tambah Data -->
    <div class="modal fade" id="modalTambahPembayaran" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4">
          <div class="modal-header" style="background-color: #0a3b7e; color: white;">
            <h5 class="modal-title" id="modalTambahLabel">Tambah Data Pembayaran</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="proses_create.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Id Pembayaran</label>
                  <input type="text" class="form-control border-primary" name="id_pembayaran" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Id Penyewaan</label>
                  <select class="form-select border-primary" name="id_penyewaan" id="selectPenyewaan" required onchange="hitungPembayaran()">
                    <option value="" selected disabled>Pilih Penyewaan</option>
                    <?php
                      $penyewaan = mysqli_query($connect, 
                        "SELECT p.id_penyewaan, c.nama, k.nama as nama_kendaraan, k.harga_sewa, 
                         p.tanggal_sewa, p.batas_sewa, DATEDIFF(p.batas_sewa, p.tanggal_sewa) as durasi
                         FROM penyewaan p
                         JOIN customer c ON p.id_customer = c.id_customer
                         JOIN kendaraan k ON p.id_kendaraan = k.id_kendaraan
                         WHERE p.status_penyewaan = 'Selesai' 
                         AND NOT EXISTS (SELECT 1 FROM pembayaran WHERE id_penyewaan = p.id_penyewaan)");
                      
                      while ($p = mysqli_fetch_array($penyewaan)) {
                        $durasi = $p['durasi'] + 1; // +1 karena minimal 1 hari
                        $total = $p['harga_sewa'] * $durasi;
                        echo "<option 
                          value='{$p['id_penyewaan']}' 
                          data-harga='{$p['harga_sewa']}'
                          data-durasi='{$durasi}'
                          data-total='{$total}'
                          data-kendaraan='{$p['nama_kendaraan']}'
                          data-customer='{$p['nama']}'
                          data-tanggal='".date('d/m/Y', strtotime($p['tanggal_sewa']))." s/d ".date('d/m/Y', strtotime($p['batas_sewa']))."'>
                          #PEN{$p['id_penyewaan']} - {$p['nama']} ({$p['nama_kendaraan']})
                        </option>";
                      }
                    ?>
                  </select>
                </div>
                
                <!-- Info Penyewaan -->
                <div class="col-12 info-box" id="infoPenyewaan" style="display: none;">
                  <div class="row">
                    <div class="col-md-4">
                      <strong>Customer:</strong><br>
                      <span id="infoCustomer"></span>
                    </div>
                    <div class="col-md-4">
                      <strong>Kendaraan:</strong><br>
                      <span id="infoKendaraan"></span>
                    </div>
                    <div class="col-md-4">
                      <strong>Periode:</strong><br>
                      <span id="infoTanggal"></span>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-4">
                      <strong>Harga Sewa/hari:</strong><br>
                      Rp <span id="infoHarga"></span>
                    </div>
                    <div class="col-md-4">
                      <strong>Durasi:</strong><br>
                      <span id="infoDurasi"></span> hari
                    </div>
                    <div class="col-md-4">
                      <strong>Total Pembayaran:</strong><br>
                      Rp <span id="infoTotal"></span>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Jumlah Pembayaran</label>
                  <input type="number" class="form-control border-primary" name="jumlah_pembayaran" id="jumlahPembayaran" required readonly>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Tanggal Pembayaran</label>
                  <input type="date" class="form-control border-primary" name="tanggal_bayar" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Metode Pembayaran</label>
                  <select name="metode_bayar" class="form-control border-primary" required>
                    <option value="" selected disabled>Pilih metode pembayaran</option>
                    <option value="Dana">Dana</option>
                    <option value="OVO">OVO</option>
                    <option value="Bank BCA">Bank BCA</option>
                    <option value="Bank BNI">Bank BNI</option>
                    <option value="Bank BRI">Bank BRI</option>
                    <option value="Bank Mandiri">Bank Mandiri</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Bukti Pembayaran</label>
                  <input type="file" class="form-control border-primary" name="bukti_bayar">
                </div>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-end">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Fungsi untuk edit modal
      const modalEdit = document.getElementById('modalEditPembayaran');
      modalEdit.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        document.getElementById('editidpembayaran').value = button.getAttribute('data-idpembayaran');
        document.getElementById('editidpenyewaan').value = button.getAttribute('data-idpenyewaan');
        document.getElementById('editjumlahpembayaran').value = button.getAttribute('data-jumlahpembayaran');
        document.getElementById('edittanggalbayar').value = button.getAttribute('data-tanggalbayar');
        document.getElementById('editmetodebayar').value = button.getAttribute('data-metodebayar');
      });
      
      // Fungsi untuk menghitung pembayaran otomatis
      function hitungPembayaran() {
        const select = document.getElementById('selectPenyewaan');
        const selectedOption = select.options[select.selectedIndex];
        const infoBox = document.getElementById('infoPenyewaan');
        
        if (selectedOption.value) {
          // Tampilkan info penyewaan
          infoBox.style.display = 'block';
          document.getElementById('infoCustomer').textContent = selectedOption.getAttribute('data-customer');
          document.getElementById('infoKendaraan').textContent = selectedOption.getAttribute('data-kendaraan');
          document.getElementById('infoTanggal').textContent = selectedOption.getAttribute('data-tanggal');
          
          // Format angka dengan separator ribuan
          const harga = parseInt(selectedOption.getAttribute('data-harga'));
          const durasi = selectedOption.getAttribute('data-durasi');
          const total = parseInt(selectedOption.getAttribute('data-total'));
          
          document.getElementById('infoHarga').textContent = harga.toLocaleString('id-ID');
          document.getElementById('infoDurasi').textContent = durasi;
          document.getElementById('infoTotal').textContent = total.toLocaleString('id-ID');
          
          // Set nilai jumlah pembayaran
          document.getElementById('jumlahPembayaran').value = total;
        } else {
          infoBox.style.display = 'none';
          document.getElementById('jumlahPembayaran').value = '';
        }
      }
      
      // Panggil fungsi saat modal dibuka untuk reset form
      document.getElementById('modalTambahPembayaran').addEventListener('show.bs.modal', function() {
        document.getElementById('infoPenyewaan').style.display = 'none';
        document.getElementById('jumlahPembayaran').value = '';
      });
    </script>
  </body>
</html>
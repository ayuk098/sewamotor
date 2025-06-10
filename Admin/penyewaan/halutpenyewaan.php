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

      .btn-edit:hover {
        background-color: #31b0d5;
      }

      .search-box {
        margin-bottom: 20px;
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
      <a href="../pembayaran/halutpembayaran.php"><i class="fas fa-money-bill-wave"></i> Pembayaran</a>
      <a href="#" class="active"><i class="fas fa-file-invoice"></i> Penyewaan</a>
      <a href="../kendaraan/halutkendaraan.php"><i class="fas fa-tools"></i> Kendaraan</a>
      </div>

      <div class="admin-profile">
      <a href="../biodata_admin.php">
        <img src="../admin.jpg" alt="Admin Profile" title="Profil Admin">
      </a>
      </div>
      <div class="main-content">
        <h1 class="page-title">Penyewaan</h1>
        <div class="row mb-3 align-items-center">
    <div class="col-md-6">
    <form class="d-flex" method="GET" action="">
      <input type="text" name="search" class="form-control me-2" placeholder="Cari id_customer atau status sewa..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
      <button class="btn btn-outline-primary" type="submit">Cari</button>
    </form>
   </div>

  <div class="col-md-6 text-end">
    <button class="btn btn-primary" style="background-color: #0a3b7e;" data-bs-toggle="modal" data-bs-target="#modalTambahKendaraan">
    + Tambah Data
    </button>
  </div>
</div>
        <table class="table-custom">
  <thead>
    <tr>
      <th>ID Penyewaan</th>
      <th>ID Customer</th>
      <th>ID Kendaraan</th>
      <th>Tanggal Sewa</th>
      <th>Batas Sewa</th>
      <th>Status</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php
          include '../koneksi.php';

          $search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';
          if ($search != '') {
              $query = mysqli_query($connect, "SELECT * FROM penyewaan WHERE id_customer LIKE '%$search%' OR status_penyewaan LIKE '%$search%'");
          } else {
              $query = mysqli_query($connect, "SELECT * FROM penyewaan");
            }
          while($data = mysqli_fetch_array($query)) {
      ?>
    <tr>
      <td><a class="link-id" href="#"><?= '#PEN' . $data['id_penyewaan']; ?></a></td>
      <td><a class="link-id" href="#"><?= '#AHGA' . $data['id_customer']; ?></a></td>
      <td><a class="link-id" href="#"><?= '#XZ ' . $data['id_kendaraan']; ?></a></td>
      <td><?= $data['tanggal_sewa']; ?></td>
      <td><?= $data['batas_sewa']; ?></td>
      <td><?= $data['status_penyewaan']; ?></td>
      <td>
      <button 
  class="btn-edit" 
  data-bs-toggle="modal" 
  data-bs-target="#modalEditPenyewaan"
  data-id="<?= $data['id_penyewaan']; ?>"
  data-idcustomer="<?= $data['id_customer']; ?>"
  data-idkendaraan="<?= $data['id_kendaraan']; ?>"
  data-tanggalsewa="<?= $data['tanggal_sewa']; ?>"
  data-batassewa="<?= $data['batas_sewa']; ?>"
  data-status="<?= $data['status_penyewaan']; ?>"
>✏ Edit</button>

      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>
</div>
  <div class="modal fade" id="modalEditPenyewaan" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-4">
    <div class="modal-header text-white" style="background-color: #0F4181;">
        <h5 class="modal-title" id="modalEditLabel">Edit Data Penyewaan</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="proses_update.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="id_penyewaan" id="editIdPenyewaan">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-semibold">ID Customer</label>
              <input type="text" class="form-control border-warning" name="id_customer" id="editIdCustomer" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">ID Kendaraan</label>
              <input type="text" class="form-control border-warning" name="id_kendaraan" id="editIdKendaraan">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Tanggal Sewa</label>
              <input type="date" class="form-control border-warning" name="tanggal_sewa" id="editTanggalSewa">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Batas Sewa</label>
              <input type="date" class="form-control border-warning" name="batas_sewa" id="editBatasSewa">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Status</label>
              <select class="form-select border-warning" name="status_penyewaan" id="editStatus">
                <option value="Disewa">Disewa</option>
                <option value="Selesai">Selesai</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-end">
          <button type="submit" class="btn btn-warning text-white">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
    <div class="modal fade" id="modalTambahKendaraan" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4">
          <div class="modal-header" style="background-color: #0a3b7e; color: white;">
            <h5 class="modal-title" id="modalTambahLabel">Tambah Data Penyewaan</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="proses_create.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Id Penyewaan</label>
                  <input type="text" class="form-control border-primary" name="id_penyewaan" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Id Custommer</label>
                     <select class="form-select border-primary" name="id_customer" required>
                        <option value="" selected disabled>Pilih Customer</option>
                            <?php
                              $customer = mysqli_query($connect, "SELECT id_customer, nama FROM customer");
                              while ($c = mysqli_fetch_array($customer)) {
                              echo "<option value='{$c['id_customer']}'>#AHGA{$c['id_customer']} - {$c['nama']}</option>";
                            }
                            ?>
                      </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kondisi Kendaraan</label>
                        <select class="form-select border-primary" id="kondisiKendaraan" required>
                        <option value="" selected disabled>Pilih Kondisi</option>
                        <option value="semua">Semua</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="disewa">Disewa</option>
                        </select>
                </div>
                  <div class="col-md-6">
                  <label class="form-label fw-semibold">Pilih Kendaraan</label>
                  <select class="form-select border-primary" name="id_kendaraan" id="dropdownKendaraan" required>
                  <option value="" selected disabled>Pilih Kendaraan</option>
                  </select>
              </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Tanggal Sewa</label>
                  <input type="date" class="form-control border-primary" name="tanggal_sewa" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Batas Sewa</label>
                  <input type="date" class="form-control border-primary" name="batas_sewa" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Status</label>
                      <select class="form-select border-primary" name="status_penyewaan"id="status_penyewaan" required>
                        <option value="" selected disabled>pilih status</option>
                        <option value="Disewa">Disewa</option>
                        <option value="Selesai">Selesai</option>
                      </select>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
  document.addEventListener('DOMContentLoaded', function () {
    const kondisiSelect = document.getElementById('kondisiKendaraan');
    const kendaraanSelect = document.getElementById('dropdownKendaraan');

    kondisiSelect.addEventListener('change', function () {
      const kondisi = this.value;

      fetch(`get_kendaraan.php?kondisi=${kondisi}`)
        .then(res => res.json())
        .then(data => {
          kendaraanSelect.innerHTML = '<option value="" disabled selected>Pilih Kendaraan</option>';
          data.forEach(kendaraan => {
            kendaraanSelect.innerHTML += `<option value="${kendaraan.id_kendaraan}">#XZ${kendaraan.id_kendaraan} - ${kendaraan.nama}</option>`;
          });
        });
    });
  });
  </script>
  <script>
  const editModal = document.getElementById('modalEditPenyewaan');
  editModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    const id = button.getAttribute('data-id');
    const idCustomer = button.getAttribute('data-idcustomer');
    const idKendaraan = button.getAttribute('data-idkendaraan');
    const tanggalSewa = button.getAttribute('data-tanggalsewa');
    const batasSewa = button.getAttribute('data-batassewa');
    const status = button.getAttribute('data-status');

    document.getElementById('editIdPenyewaan').value = id;
    document.getElementById('editIdCustomer').value = idCustomer;
    document.getElementById('editIdKendaraan').value = idKendaraan;
    document.getElementById('editTanggalSewa').value = tanggalSewa;
    document.getElementById('editBatasSewa').value = batasSewa;
    document.getElementById('editStatus').value = status;
  });
</script>
</body>
</html>
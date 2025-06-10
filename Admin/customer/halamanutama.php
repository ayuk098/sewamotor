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
      <a href="#" class="active"><i class="fas fa-user"></i> Customer</a>
      <a href="../pembayaran/halutpembayaran.php"><i class="fas fa-money-bill-wave"></i> Pembayaran</a>
      <a href="../penyewaan/halutpenyewaan.php"><i class="fas fa-file-invoice"></i> Penyewaan</a>
      <a href="../kendaraan/halutkendaraan.php"><i class="fas fa-tools"></i> Kendaraan</a>
      </div>

    <div class="admin-profile">
      <a href="../biodata_admin.php">
        <img src="../admin.jpg" alt="Admin Profile" title="Profil Admin">
      </a>
      </div>
    <div class="main-content">
        <h1 class="page-title">Customer</h1>
      <div class="row mb-3 align-items-center">
    <div class="col-md-6">
          <form class="d-flex" method="GET" action="">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari nama atau alamat " value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
          </form>
    </div>  
  <div class="col-md-6 text-end">
    <button class="btn btn-primary" style="background-color: #0a3b7e;" data-bs-toggle="modal" data-bs-target="#modalTambahKendaraan">
      + Tambah Data
    </button>
  </div>
</div>
<?php
if (isset($_GET['msg'])) {
  if ($_GET['msg'] == 'gagal') {
    echo '<div class="alert alert-warning">Customer tidak dapat dihapus karena masih digunakan dalam penyewaan.</div>';
  } elseif ($_GET['msg'] == 'sukses') {
    echo '<div class="alert alert-success">Customer berhasil dihapus.</div>';
  } elseif ($_GET['msg'] == 'error') {
    echo '<div class="alert alert-danger">Terjadi kesalahan saat menghapus customer.</div>';
  }
}
?>
<table class="table-custom">
  <thead>
    <tr>
      <th>ID Customer</th>
      <th>Nama</th>
      <th>No Telepon</th>
      <th>Alamat</th>
      <th>Jenis Kelamin</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
        <?php
              include '../koneksi.php';

              $search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';
              if ($search != '') {
                $query = mysqli_query($connect, "SELECT * FROM customer WHERE nama LIKE '%$search%' OR alamat LIKE '%$search%'");
              } else {
                $query = mysqli_query($connect, "SELECT * FROM customer");
              }

              while($data = mysqli_fetch_array($query)) {
            ?>
    <tr>
      <td><a class="link-id" href="#"><?= '#AHGA' . $data['id_customer']; ?></a></td>
      <td><?= $data['nama']; ?></td>
      <td><?= $data['no_telepon']; ?></td>
      <td><?= $data['alamat']; ?></td>
      <td><?= $data['jenis_kelamin']; ?></td>
      <td>
      <button 
          class="btn-edit" 
              data-bs-toggle="modal" 
              data-bs-target="#modalEditCustomer"
              data-idcustomer="<?= $data['id_customer']; ?>"
              data-nama="<?= $data['nama']; ?>"
              data-notelepon="<?= $data['no_telepon']; ?>"
              data-alamat="<?= $data['alamat']; ?>"
              data-jeniskelamin="<?= $data['jenis_kelamin']; ?>"
            >✏ Edit</button>
      <button 
          class="btn-delete"
                data-bs-toggle="modal" 
                data-bs-target="#deleteModal"
                data-id="<?= $data['id_customer']; ?>">
            🗑 Delete </button>   
    </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-4">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="hapus.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="id_customer" id="deleteIdCustomer">
          <p>Apakah Anda yakin ingin menghapus data Customer ini?</p>
        </div>
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modalEditCustomer" tabindex="-1" ...>
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-4">
    <div class="modal-header text-white" style="background-color: #0F4181;">
        <h5 class="modal-title">Edit Data Customer</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="proses_update.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" class="form-control border-warning" name="id_customer" id="editidcustomer">
          <div class="row g-3">
            <div class="col-md-6">
              <label>Nama</label>
              <input type="text" class="form-control border-warning" name="nama" id="editnama" class="form-control">
            </div>
            <div class="col-md-6">
              <label>No Telepon</label>
              <input type="text" class="form-control border-warning" name="no_telepon" id="editnotelepon" class="form-control">
            </div>
            <div class="col-md-6">
              <label>Alamat</label>
              <input type="text" class="form-control border-warning" name="alamat" id="editalamat" class="form-control">
            </div>
            <div class="col-md-6">
              <label>Jenis Kelamin</label>
              <select name="jenis_kelamin" class="form-control border-warning" id="editjeniskelamin" class="form-select">
                      <option value="">pilih jenis kelamin</option>
                      <option value="Laki-laki">Laki-laki</option>
                      <option value="Perempuan">Perempuan</option>
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
    <div class="modal fade" id="modalTambahKendaraan" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4">
          <div class="modal-header" style="background-color: #0a3b7e; color: white;">
            <h5 class="modal-title" id="modalTambahLabel">Tambah Data Customer</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="proses_create.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Id Customer</label>
                  <input type="text" class="form-control border-primary" name="id_customer" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Nama</label>
                  <input type="text" class="form-control border-primary" name="nama" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Alamat</label>
                  <input type="text" class="form-control border-primary" name="alamat" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">No Telepon</label>
                  <input type="text" class="form-control border-primary" name="no_telepon" pattern="[0-9]{10,13}" maxlength="13" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Jenis Kelamin</label>
                  <select name="jenis_kelamin" class="form-control border-primary" required>
                      <option value="">Pilih jenis kelamin</option>
                      <option value="Laki-laki">Laki-laki</option>
                      <option value="Perempuan">Perempuan</option>
                  </select>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const editModal = document.getElementById('modalEditCustomer');
  editModal.addEventListener('show.bs.modal', function (event) {
    const btn = event.relatedTarget;
    const idcustomer = btn.dataset.idcustomer;
    const nama = btn.dataset.nama;
    const notelepon = btn.dataset.notelepon;
    const alamat = btn.dataset.alamat;
    const jeniskelamin = btn.dataset.jeniskelamin;

    document.getElementById('editidcustomer').value = idcustomer;
    document.getElementById('editnama').value = nama;
    document.getElementById('editnotelepon').value = notelepon;
    document.getElementById('editalamat').value = alamat;
    document.getElementById('editjeniskelamin').value = jeniskelamin;
  });
</script>
<script>
  const deleteModal = document.getElementById('deleteModal');
  deleteModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    document.getElementById('deleteIdCustomer').value = id;
  });
</script>
  </body>
</html>

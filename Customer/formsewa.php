<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>JSRent - Form Penyewaan</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<style>
    body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  background-color: #f7f7f7;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #0a3b7e;
  color: white;
  padding: 15px 30px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.logo {
  font-weight: bold;
  font-size: 18px;
}

.menu a {
  color: white;
  margin-left: 20px;
  text-decoration: none;
  font-size: 14px;
}

.avatar {
  width: 32px;
  height: 32px;
  background-image: url('https://cdn-icons-png.flaticon.com/512/921/921347.png');
  background-size: cover;
  border-radius: 50%;
  margin-left: 15px;
  display: inline-block;
}

.form-header {
  text-align: center;
  margin: 40px 0 20px;
}

.form-box {
  background-color: #ddd;
  padding: 10px 25px;
  border-radius: 50px;
  display: inline-block;
  font-size: 14px;
  color: #333;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.nopol {
  display: block;
  color: #0044cc;
  margin-top: 5px;
  font-size: 14px;
  text-decoration: none;
  font-weight: bold;
}

.form-container {
  display: flex;
  justify-content: center;
  gap: 40px;
  padding: 0 40px;
}

.form-card {
  background-color: white;
  border: 1px solid #0F4181;
  padding: 20px;
  width: 400px;
  border-radius: 10px;
  box-shadow: 0 1px 5px #0F4181;
}

.form-card h4 {
  margin: 0;
  color: #0F4181;
  font-weight: bold;
  text-align: center;
}

.subtitle {
  text-align: center;
  font-size: 13px;
  color: gray;
  margin-bottom: 20px;
}

form {
  display: flex;
  flex-direction: column;
}

label {
  margin-bottom: 4px;
  font-size: 14px;
  color: #333;
  margin-top: 10px;
}

input, select {
  padding: 8px;
  border-radius: 6px;
  border: 1px solid #ccc;
  font-size: 14px;
}

select {
  appearance: none;
  background: url("data:image/svg+xml;utf8,<svg fill='black' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>") no-repeat right 10px center/12px 12px;
  background-color: #f4f4f4;
}

.button-container {
  text-align: right;
  padding: 20px 50px 50px;
}

.btn-lanjut {
  background-color: #ffc107;
  color: white;
  border: none;
  padding: 10px 18px;
  font-weight: bold;
  border-radius: 10px;
  cursor: pointer;
  box-shadow: 0 4px 5px rgba(0,0,0,0.2);
}
</style>
<body>
  <header class="navbar">
    <div class="logo">JSRent</div>
    <nav class="menu">
      <a href="#">Home</a>
      <a href="#">Sewa Motor</a>
      <div class="avatar"></div>
    </nav>
  </header>

  <div class="form-header">
    <div class="form-box">Form Penyewaan</div>
    <h3>Honda Vario 125</h3>
    <a href="#" class="nopol">XZ 1247 YY</a>
  </div>

  <main class="form-container">
    <div class="form-card">
      <h4>Data Penyewa</h4>
      <p class="subtitle">Masukkan data anda</p>
      <form>
        <label>Nama Lengkap</label>
        <input type="text" />

        <label>Nomor Induk Kependudukan (NIK)</label>
        <input type="text" />

        <label>Alamat</label>
        <input type="text" />

        <label>No Telepon</label>
        <input type="text" />

        <label>Jenis Kelamin</label>
        <input type="text" />

        <label>Upload KTP</label>
        <input type="file" />
      </form>
    </div>

    <div class="form-card">
  <h4>Data Pengambilan</h4>
  <p class="subtitle">Pilih tanggal rental anda</p>
  <form>
    <label>Tanggal Pengambilan</label>
    <input type="date" />

    <label>Jam Pengambilan</label>
    <select>
      <option selected disabled></option>
      <option>08:00</option>
      <option>09:00</option>
      <option>10:00</option>
      <!-- Tambahkan opsi lainnya -->
    </select>

    <label>Tanggal Pengembalian</label>
    <input type="date" />
  </form>
</div>

  </main>

  <div class="button-container">
    <button class="btn-lanjut">Lanjutkan</button>
  </div>
</body>
</html>


<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    // Validasi input
    if (empty($nama) || empty($email) || empty($password) || empty($konfirmasi)) {
        echo "<script>alert('Semua field harus diisi!'); window.history.back();</script>";
        exit();
    }

    // Validasi konfirmasi password
    if ($password !== $konfirmasi) {
        echo "<script>alert('Password dan konfirmasi tidak sama!'); window.history.back();</script>";
        exit();
    }

    // Enkripsi password dengan cost yang lebih tinggi
    $options = [
        'cost' => 12,
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    // Debug: Tampilkan password sebelum dan sesudah hash
    error_log("Original password: " . $password);
    error_log("Hashed password: " . $hashedPassword);

    // Simpan ke database
    $query = "INSERT INTO customer (nama, email, password) VALUES (?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("sss", $nama, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location.href='login.html';</script>";
    } else {
        error_log("Registration error: " . $stmt->error);
        echo "<script>alert('Terjadi kesalahan saat pendaftaran'); window.history.back();</script>";
    }

    $stmt->close();
    $connect->close();
}
?>

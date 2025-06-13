<?php
session_start();
include 'koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Validasi input
if (empty($email) || empty($password)) {
    echo '<div class="alert">Email dan password harus diisi!</div>';
    exit();
}

// Query untuk mengambil data pelanggan
$query = "SELECT id_admin, nama, email, password FROM admin WHERE email = ?";
$stmt = $connect->prepare($query);

if (!$stmt) {
    echo '<div class="alert">Terjadi kesalahan pada server.</div>';
    exit();
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo '<div class="alert">Email tidak ditemukan!</div>';
    exit();
}

$user = $result->fetch_assoc();

// Verifikasi password
if ($password === $user['password']) {
    $_SESSION['id_admin'] = $user['id_admin'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['email'] = $user['email'];

    echo '<script>window.location.href = "halamanutama.php";</script>';
} else {
    echo '<div class="alert">Password salah!</div>';
}

$stmt->close();
$connect->close();
?>
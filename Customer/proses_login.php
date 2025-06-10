<?php
session_start();
include 'koneksi.php';

// Debug: Tampilkan input
error_log("Login Attempt - Email: " . $_POST['email'] . ", Password: " . $_POST['password']);

$email = $_POST['email'];
$password = $_POST['password'];

// Validasi input
if (empty($email) || empty($password)) {
    header("Location: login.php?pesan=empty");
    exit();
}

// Query untuk mengambil data pelanggan
$query = "SELECT id_customer, nama, email, password FROM customer WHERE email = ?";
$stmt = $connect->prepare($query);

if (!$stmt) {
    error_log("Prepare error: " . $connect->error);
    header("Location: login.php?pesan=error");
    exit();
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    error_log("Email not found: " . $email);
    header("Location: login.php?pesan=email_not_found");
    exit();
}

$user = $result->fetch_assoc();

// Debug: Tampilkan data user dari database
error_log("User Data: " . print_r($user, true));

// Perbaiki format password jika diperlukan
$db_password = $user['password'];
if (substr($db_password, 0, 7) === '$2y$10S') {
    $db_password = '$2y$10$' . substr($db_password, 7);
    error_log("Fixed password format: " . $db_password);
}

// Verifikasi password
if (password_verify($password, $db_password)) {
    // Login berhasil
    $_SESSION['id_customer'] = $user['id_customer'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['email'] = $user['email'];
    
    error_log("Login successful for: " . $email);
    header("Location: daftarmotor.php");
    exit();
} else {
    // Debug: Tampilkan perbandingan password
    error_log("Password verification failed");
    error_log("Input password: " . $password);
    error_log("Hashed input: " . password_hash($password, PASSWORD_BCRYPT));
    error_log("DB password: " . $db_password);
    
    header("Location: login.php?pesan=wrong_password");
    exit();
}

$stmt->close();
$connect->close();
?>
<?php
include '../koneksi.php';

$id_customer = $_POST['id_customer'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];
$jenis_kelamin = $_POST['jenis_kelamin'];

// Simpan ke database
$query = mysqli_query($connect, "INSERT INTO customer (id_customer, nama, alamat, no_telepon, jenis_kelamin)
                                 VALUES ('$id_customer', '$nama', '$alamat', '$no_telepon', '$jenis_kelamin')");

// Jika berhasil, redirect ke halaman utama
if ($query) {
    header("Location: halamanutama.php");
    exit();
} else {
    echo "Gagal menyimpan data. <a href='halamanutama.php'>Kembali</a>";
}
?>

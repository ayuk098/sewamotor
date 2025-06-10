<?php
include '../koneksi.php';

$id_kendaraan = $_POST['id_kendaraan'];
$nama = $_POST['nama'];
$merk = $_POST['merk'];
$harga_sewa = $_POST['harga_sewa'];
$status = $_POST['status'];
$gambar_name = $_FILES['gambar_kendaraan']['name'];
$tmp_name = $_FILES['gambar_kendaraan']['tmp_name'];
$folder = "../gambar/";

// Simpan ke database
$query = mysqli_query($connect, "INSERT INTO kendaraan (id_kendaraan, nama, merk, harga_sewa, status, gambar_kendaraan)
                                 VALUES ('$id_kendaraan', '$nama', '$merk', '$harga_sewa', '$status', '$gambar_name')");

// Jika berhasil, redirect ke halaman utama
if ($query) {
    header("Location: halutkendaraan.php");
    exit();
} else {
    echo "Gagal menyimpan data. <a href='halutkendaraan.php'>Kembali</a>";
}
?>




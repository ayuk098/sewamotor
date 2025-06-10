<?php
include '../koneksi.php';

$id_penyewaan = $_POST['id_penyewaan'];
$id_customer = $_POST['id_customer'];
$id_kendaraan = $_POST['id_kendaraan'];
$tanggal_sewa = $_POST['tanggal_sewa'];
$batas_sewa = $_POST['batas_sewa'];
$status_penyewaan = $_POST['status_penyewaan'];

// Cek kendaraan
$cekKendaraan = mysqli_query($connect, "SELECT * FROM penyewaan WHERE id_kendaraan = '$id_kendaraan' AND status_penyewaan != 'selesai'");
if (mysqli_num_rows($cekKendaraan) > 0) {
    echo "<script>alert('Kendaraan masih dalam masa penyewaan!'); window.location.href='halutpenyewaan.php';</script>";
    exit();
}

// Cek customer 
$cekCustomer = mysqli_query($connect, "SELECT * FROM penyewaan WHERE id_customer = '$id_customer' AND status_penyewaan != 'selesai'");
if (mysqli_num_rows($cekCustomer) > 0) {
    echo "<script>alert('Customer masih memiliki penyewaan yang belum selesai!'); window.location.href='halutpenyewaan.php';</script>";
    exit();
}

// Simpan penyewaan
$query = mysqli_query($connect, "INSERT INTO penyewaan (id_penyewaan, id_customer, id_kendaraan, tanggal_sewa, batas_sewa, status_penyewaan)
                                 VALUES ('$id_penyewaan', '$id_customer', '$id_kendaraan', '$tanggal_sewa', '$batas_sewa', '$status_penyewaan')");

if ($query) {
    // Jika penyewaan berhasil disimpan, update status kendaraan
    mysqli_query($connect, "UPDATE kendaraan SET status='Tidak tersedia' WHERE id_kendaraan='$id_kendaraan'");
    
    header("Location: halutpenyewaan.php");
    exit();
} else {
    echo "Gagal menyimpan penyewaan. <a href='halutpenyewaan.php'>Kembali</a>";
}
?>


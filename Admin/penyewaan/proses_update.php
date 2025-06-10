<?php
include '../koneksi.php';

$id = $_POST['id_penyewaan'];
$id_customer = $_POST['id_customer'];
$id_kendaraan = $_POST['id_kendaraan'];
$tanggal = $_POST['tanggal_sewa'];
$batas = $_POST['batas_sewa'];
$status = $_POST['status_penyewaan'];

$query = "UPDATE penyewaan SET 
            id_kendaraan = '$id_kendaraan',
            tanggal_sewa = '$tanggal',
            batas_sewa = '$batas',
            status_penyewaan = '$status' 
          WHERE id_penyewaan = '$id'";

if (mysqli_query($connect, $query)) {
    header("Location: halutpenyewaan.php");
} else {
    echo "Gagal update data: " . mysqli_error($connect);
}
?>


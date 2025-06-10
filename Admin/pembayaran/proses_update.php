<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pembayaran = $_POST['id_pembayaran'];
    $id_penyewaan = $_POST['id_penyewaan'];
    $jumlah_pembayaran = $_POST['jumlah_pembayaran'];
    $tanggal_bayar = $_POST['tanggal_bayar'];
    $metode_bayar = $_POST['metode_bayar'];

    
    $query = "UPDATE pembayaran 
              SET id_penyewaan = '$id_penyewaan',
                  jumlah_pembayaran = '$jumlah_pembayaran',
                  tanggal_bayar = '$tanggal_bayar',
                  metode_bayar = '$metode_bayar'
              WHERE id_pembayaran = '$id_pembayaran'";

if (mysqli_query($connect, $query)) {
    header("Location: halutpembayaran.php");
} else {
    echo "Gagal update data: " . mysqli_error($connect);
} } 
?>

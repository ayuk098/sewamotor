<?php
include '../koneksi.php';

$id_pembayaran = $_POST['id_pembayaran'];
$id_penyewaan = $_POST['id_penyewaan'];
$jumlah_pembayaran = $_POST['jumlah_pembayaran'];
$tanggal_bayar = $_POST['tanggal_bayar'];
$metode_bayar = $_POST['metode_bayar'];

// Simpan ke database
$query = mysqli_query($connect, "INSERT INTO pembayaran (id_pembayaran, id_penyewaan, jumlah_pembayaran, tanggal_bayar, metode_bayar)
                                 VALUES ('$id_pembayaran', '$id_penyewaan', '$jumlah_pembayaran', '$tanggal_bayar', '$metode_bayar')");

if ($query) {
    header("Location: halutpembayaran.php");
    exit();
} else {
    echo "Gagal menyimpan data. <a href='halutpembayaran.php'>Kembali</a>";
}
?>

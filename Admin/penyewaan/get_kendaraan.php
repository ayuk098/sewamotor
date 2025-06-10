<?php
include '../koneksi.php';

$kondisi = $_GET['kondisi'];

if ($kondisi == 'tersedia') {
  $query = "
    SELECT id_kendaraan, nama FROM kendaraan
    WHERE id_kendaraan NOT IN (
      SELECT id_kendaraan FROM penyewaan WHERE status_penyewaan != 'selesai'
    )
  ";
} elseif ($kondisi == 'disewa') {
  $query = "
    SELECT k.id_kendaraan, k.nama FROM kendaraan k
    JOIN penyewaan p ON k.id_kendaraan = p.id_kendaraan
    WHERE p.status_penyewaan != 'selesai'
  ";
} else {
  $query = "SELECT id_kendaraan, nama FROM kendaraan";
}

$result = mysqli_query($connect, $query);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);

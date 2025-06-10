<?php
include '../koneksi.php';

$id = $_POST['id_kendaraan']; 

$cek = mysqli_query($connect, "SELECT * FROM penyewaan WHERE id_kendaraan='$id'");

if (mysqli_num_rows($cek) > 0) {
  header("Location: halutkendaraan.php?msg=gagal");
  exit;
} else {
  $delete = mysqli_query($connect, "DELETE FROM kendaraan WHERE id_kendaraan='$id'");
  if ($delete) {
    header("Location: halutkendaraan.php?msg=sukses");
  } else {
    header("Location: halutkendaraan.php?msg=error");
  }
}


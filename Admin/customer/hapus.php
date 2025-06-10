<?php
include '../koneksi.php';

$id = $_POST['id_customer'];

$cek = mysqli_query($connect, "SELECT * FROM penyewaan WHERE id_customer='$id'");

if (mysqli_num_rows($cek) > 0) {
  header("Location: halamanutama.php?msg=gagal");
  exit;
} else {
  $delete = mysqli_query($connect, "DELETE FROM customer WHERE id_customer='$id'");
  if ($delete) {
    header("Location: halamanutama.php?msg=sukses");
  } else {
    header("Location: halamanutama.php?msg=error");
  }
}
<?php
include '../koneksi.php';

$id_customer = $_POST['id_customer'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];
$jenis_kelamin = $_POST['jenis_kelamin'];


$query = "UPDATE customer SET 
            nama = '$nama',
            alamat = '$alamat',
            no_telepon = '$no_telepon',
            jenis_kelamin = '$jenis_kelamin'
          WHERE id_customer = '$id_customer'";

if (mysqli_query($connect, $query)) {
    header("Location: halamanutama.php");
} else {
    echo "Gagal update data: " . mysqli_error($connect);
}
?>


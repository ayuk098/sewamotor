<?php
include '../koneksi.php';

$id_kendaraan      = $_POST['id_kendaraan'];
$nama              = mysqli_real_escape_string($connect, $_POST['nama']);
$merk              = mysqli_real_escape_string($connect, $_POST['merk']);
$harga_sewa        = (int) $_POST['harga_sewa'];
$status            = mysqli_real_escape_string($connect, $_POST['status']);

$updateGambarSQL = '';
if (isset($_FILES['gambar_kendaraan']) && $_FILES['gambar_kendaraan']['error'] === UPLOAD_ERR_OK) {
    $uploadDir  = __DIR__ . '/gambar/';
    $tmpName    = $_FILES['gambar_kendaraan']['tmp_name'];
    $fileName   = basename($_FILES['gambar_kendaraan']['name']);
    $targetFile = $uploadDir . $fileName;

    
    if (move_uploaded_file($tmpName, $targetFile)) {
        $updateGambarSQL = ", gambar_kendaraan = '" . mysqli_real_escape_string($connect, $fileName) . "'";
    } else {
        echo "Gagal mengunggah gambar."; 
        exit;
    }
}

$query = "
    UPDATE kendaraan SET
        nama           = '$nama',
        merk           = '$merk',
        harga_sewa     = $harga_sewa
        $updateGambarSQL,
        status         = '$status'
    WHERE id_kendaraan = '$id_kendaraan'
";

if (mysqli_query($connect, $query)) {
    header("Location: halutkendaraan.php");
    exit;
} else {
    echo "Gagal update data: " . mysqli_error($connect);
}


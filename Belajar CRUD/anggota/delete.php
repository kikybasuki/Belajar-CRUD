<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['kd_Anggota'])) {
    $kd_Anggota = $_GET['kd_Anggota'];

    $sql = "DELETE FROM Anggota WHERE kd_Anggota=$kd_Anggota";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        header('Location: read.php');
        exit();
    } else {
        $error = "Terjadi kesalahan saat menghapus data.";
    }

    mysqli_close($koneksi);
} else {
    header('Location: read.php');
    exit();
}
?>

<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM login WHERE id=$id";
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

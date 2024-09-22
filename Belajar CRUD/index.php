<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .login-title {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }
    ?>

    <div class="container">
        <div class="login-box">
            <h1 class="login-title">APLIKASI Perpustakaan</h1>
            <div class="container">
                <div class="row">
                    <?php if ($_SESSION['level'] == 'admin') : ?>
                        <a href="anggota/read.php" class="btn btn-block btn-primary">Data anggota</a>
                    <?php endif; ?>
                    <a href="data_buku/read.php" class="btn btn-block btn-primary">Data Buku</a>
                    <a href="pesanan/read.php" class="btn btn-block btn-primary">Transaksi
                    </a>
                    <?php if ($_SESSION['level'] == 'admin') : ?>
                        
                    <?php endif; ?>
                    <a href="user/read.php" class="btn btn-block btn-primary">User</a>
                    <a href="logout.php" class="btn btn-block btn-primary">Keluar</a>
                </div>
            </div>

        </div>
    </div>

    <!-- Tambahkan script JavaScript Bootstrap di sini -->
</body>

</html>
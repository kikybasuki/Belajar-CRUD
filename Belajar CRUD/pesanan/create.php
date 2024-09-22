<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $pesanan = $_POST['pesanan'];
    $jenis = $_POST['jenis'];
    $jumlah = $_POST['jumlah'];
    $tgl_peminjaman = $_POST['tgl_peminjaman'];
    $tgl_pengembalian = $_POST['tgl_pengembalian'];



    $sql = "INSERT INTO pesanan (nama, alamat, tgl_peminjaman, tgl_pengembalian, pesanan, jenis, jumlah) VALUES ('$nama', '$alamat', '$tgl_peminjaman', '$tgl_pengembalian', '$pesanan', '$jenis', '$jumlah')";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        header('Location: read.php');
        exit();
    } else {
        $error = "Terjadi kesalahan saat menambahkan data.";
    }

    mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pesanan</title>
    <style>
        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-primary,
        .btn-secondary {
            display: inline-block;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: #ffffff;
            background-color: #007bff;
        }

        .btn-secondary {
            background-color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Tambah Data</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="pesanan">nama buku</label>
                <input type="text" class="form-control" name="pesanan" required>
            </div>
            <div class="form-group">
                <label for="jenis">jenis buku</label>
                <input type="text" class="form-control" name="jenis" required>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" name="jumlah" required>
            </div>
            <div class="form-group">
                <label for="tgl_peminjaman">tgl peminjaman</label>
                <input type="date" class="form-control" name="tgl_peminjaman" required>
            </div>
            <div class="form-group">
                <label for="tgl_pengembalian">tgl pengembalian</label>
                <input type="date" class="form-control" name="tgl_pengembalian" required>
            </div>
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
            <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>

<?php
session_start();
include '../koneksi.php';

if (isset($_SESSION['username'])) {
    // Pengguna sudah login, lanjutkan dengan tampilan CRUD
} else {
    // Pengguna belum login, redirect ke halaman login
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpus App</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Data Peminjaman</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>nama buku</th>
                    <th>Jenis Buku</th>
                    <th>Jumlah</th>
                    <th>tgl peminjaman</th>
                    <th>tgl pengembalian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM pesanan";
                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["alamat"] . "</td>";
                        echo "<td>" . $row["pesanan"] . "</td>";
                        echo "<td>" . $row["jenis"] . "</td>";
                        echo "<td>" . $row["jumlah"] . "</td>";
                        echo "<td>" . $row["tgl_peminjaman"] . "</td>";
                        echo "<td>" . $row["tgl_pengembalian"] . "</td>";
                        echo "<td>";
                        echo "<a href='update.php?id=" . $row["id"] . "' class='btn btn-primary'>Edit</a>";
                        echo "<a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='4'>Tidak ada data.</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-success">Tambah Data</a>
        <a href="../index.php" class="btn btn-secondary">Kembali</a>
    </div>

    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
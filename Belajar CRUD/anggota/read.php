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

if ($_SESSION['level'] != 'admin') {
    echo "<script>
    alert('anda tidak mempunyai akses');
    document.location.href = '../index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Data Anggota</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM anggota";
                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row["namaAnggota"] . "</td>";
                        echo "<td>" . $row["alamatAnggota"] . "</td>";
                        echo "<td>" . $row["notlp"] . "</td>";
                        echo "<td>";
                        echo "<a href='update.php?kd_Anggota=" . $row["kd_Anggota"] . "' class='btn btn-primary'>Edit</a>";
                        echo "<a href='delete.php?kd_Anggota=" . $row["kd_Anggota"] . "' class='btn btn-danger'>Hapus</a>";
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
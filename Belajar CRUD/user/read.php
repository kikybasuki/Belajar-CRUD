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
    <title>CRUD App</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Data User</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM login";
                $result = mysqli_query($koneksi, $sql);
                $id = $_SESSION['id'];
                $data = mysqli_query($koneksi, "SELECT * FROM login WHERE id = $id");

                if (mysqli_num_rows($result) > 0) {
                    if ($_SESSION['level'] == 'admin') {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["password"] . "</td>";
                            echo "<td>" . $row["level"] . "</td>";
                            echo "<td>";
                            echo "<a href='update.php?id=" . $row["id"] . "' class='btn btn-primary'>Edit</a>";
                            echo "<a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger'>Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($data)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["password"] . "</td>";
                            echo "<td>" . $row["level"] . "</td>";
                            echo "<td>";
                            echo "<a href='update.php?id=" . $row["id"] . "' class='btn btn-primary'>Edit</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='4'>Tidak ada data.</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php if ($_SESSION['level'] == 'admin') : ?>
            <a href="create.php" class="btn btn-success">Tambah Data</a>
        <?php endif; ?>
        <a href="../index.php" class="btn btn-secondary">Kembali</a>
    </div>

    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
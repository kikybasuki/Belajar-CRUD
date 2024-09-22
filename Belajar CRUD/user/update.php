<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Memeriksa apakah form telah disubmit
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "UPDATE login SET username='$username', password='$password' WHERE id=$id";
        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            header('Location: read.php');
            exit();
        } else {
            $error = "Terjadi kesalahan saat mengedit data.";
        }

        mysqli_close($koneksi);
    }

    // Mengambil data yang akan di-edit
    $sql = "SELECT * FROM login WHERE id=$id";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $password = $row['password'];
    } else {
        header('Location: read.php');
        exit();
    }
} else {
    header('Location: read.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        .shadow-box {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="shadow-box">
            <h1>Edit Data User</h1>
            <form method="POST" action="update.php?id=<?php echo $id; ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" name="password" value="<?php echo $password; ?>" required>
                </div>
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>
                <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                <a href="read.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
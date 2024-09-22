<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['kd_Anggota'])) {
    $kd_Anggota = $_GET['kd_Anggota'];

    // Memeriksa apakah form telah disubmit
    if (isset($_POST['submit'])) {
        $nama = $_POST['namaAnggota'];
        $alamat = $_POST['alamatAnggota'];
        $notlp = $_POST['notlp'];

        $sql = "UPDATE Anggota SET namaAnggota='$nama', alamatAnggota='$alamat', notlp='$notlp' WHERE kd_Anggota=$kd_Anggota";
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
    $sql = "SELECT * FROM Anggota WHERE kd_Anggota=$kd_Anggota";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nama = $row['namaAnggota'];
        $alamat = $row['alamatAnggota'];
        $notlp = $row['notlp'];
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
            <h1>Edit Data Anggota</h1>
            <form method="POST" action="update.php?kd_Anggota=<?php echo $kd_Anggota; ?>">
                <div class="form-group">
                    <label for="namaAnggota">Nama</label>
                    <input type="text" class="form-control" name="namaAnggota" value="<?php echo $nama; ?>" required>
                </div>
                <div class="form-group">
                    <label for="alamatAnggota">Alamat</label>
                    <textarea class="form-control" name="alamatAnggota" required cols="30" rows="10"><?php echo $alamat; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="notlp">No HP</label>
                    <input type="number" class="form-control" name="notlp" value="<?php echo $notlp; ?>" required>
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

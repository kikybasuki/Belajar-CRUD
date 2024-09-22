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
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $tgl_peminjaman = $_POST['tgl_peminjaman'];
        $tgl_pengembalian = $_POST['tgl_pengembalian'];
        $pesanan = $_POST['pesanan'];
        $jenis = $_POST['jenis'];
        $jumlah = $_POST['jumlah'];

        $sql = "UPDATE pesanan SET nama='$nama', alamat='$alamat', tgl_peminjaman='$tgl_peminjaman', tgl_pengembalian='$tgl_pengembalian', pesanan='$pesanan', jenis='$jenis', jumlah='$jumlah' WHERE id=$id";
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
    $sql = "SELECT * FROM pesanan WHERE id=$id";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nama = $row['nama'];
        $alamat = $row['alamat'];
        $tgl_peminjaman = $row['tgl_peminjaman'];
        $tgl_pengembalian = $row['tgl_pengembalian'];
        $pesanan = $row['pesanan'];
        $jenis = $row['jenis'];
        $pesanan_exp = explode(', ', $row['pesanan']);
        $jenis_exp = explode(', ', $row['jenis']);
        $jumlah = $row['jumlah'];
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
            /* Menambahkan efek shadow */
            padding: 20px;
            /* Menambahkan ruang padding agar isi konten tidak terlalu dekat dengan shadow */
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="shadow-box">

            <h1>Edit Data Pesanan</h1>
            <form method="POST" action="update.php?id=<?php echo $id; ?>">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" name="alamat" required cols="30" rows="10"><?php echo $alamat; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="pesanan">Pesanan</label>
                    <input type="text" class="form-control" name="pesanan" value="<?php echo $pesanan; ?>" required>
                </div>
                <div class="form-group">
                    <label for="jenis">jenis</label>
                    <input type="text" class="form-control" name="jenis" value="<?php echo $jenis; ?>" required>
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" value="<?php echo $jumlah; ?>" required>
                </div>
                <div class="form-group">
                    <label for="tgl_peminjaman">tgl peminjaman</label>
                    <input type="date" class="form-control" name="tgl_peminjaman" value="<?php echo $tgl_peminjaman; ?>" required>
                </div>
                <div class="form-group">
                    <label for="tgl_pengembalian">tgl_pengembalian</label>
                    <input type="date" class="form-control" name="tgl_pengembalian" value="<?php echo $tgl_pengembalian; ?>" required>
                </div>
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>
                <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                <a href="read.php" class="btn btn-secondary">Batal</a>
            </form>

        </div>
    </div>



    <!-- Tambahkan script JavaScript Bootstrap di sini -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
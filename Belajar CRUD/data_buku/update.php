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
    $kd_buku = $_POST['kd_buku'];
    $nama_buku = $_POST['nama_buku'];
    $jenis_buku = $_POST['jenis_buku'];

    $sql = "UPDATE buku SET kd_buku='$kd_buku', nama_buku='$nama_buku', jenis_buku='$jenis_buku', WHERE id=$id";
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
  $sql = "SELECT * FROM buku WHERE id=$id";
  $result = mysqli_query($koneksi, $sql);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $kd_buku = $row['kd_buku'];
    $nama_buku = $row['nama_buku'];
    $jenis_buku = $row['jenis_buku'];
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
      <h1>Edit Data buku</h1>
      <form method="POST" action="update.php?id=<?php echo $id; ?>">
        <div class="form-group">
          <label>Kode buku</label>
          <input type="text" class="form-control" name="kd_buku" value="<?= $kd_buku; ?>" required>
        </div>
        <div class="form-group">
          <label>Nama buku</label>
          <input type="text" class="form-control" name="nama_buku" value="<?= $nama_buku; ?>" required>
        </div>
        <div class="form-group">
          <label>Jenis buku</label>
          <input type="text" class="form-control" name="jenis_buku" value="<?= $jenis_buku; ?>" required>
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
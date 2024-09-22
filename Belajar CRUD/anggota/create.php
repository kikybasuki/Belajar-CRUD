<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['submit'])) {
    $nama = $_POST['namaAnggota'];
    $alamat = $_POST['alamatAnggota'];
    $nohp = $_POST['notlp'];

    $sql = "INSERT INTO anggota (namaAnggota, alamatAnggota, notlp) VALUES ('$nama', '$alamat', '$nohp')";
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
    <title>Tambah Data Anggota</title>
     <style>
           body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%; /* Atur lebar kotak di sini */
            max-width: 700px;
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

        /* Tambahkan style untuk box dan shadow di sini */
        .container {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Tambah Data</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="namaAnggota">Nama</label>
                <input type="text" class="form-control" name="namaAnggota" required>
            </div>
            <div class="form-group">
                <label for="alamatAnggota">Alamat</label>
                <textarea name="alamatAnggota" class="form-control" id="alamatAnggota" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="nohp">No HP</label>
                <input type="number" class="form-control" name="notlp" required>
            </div>
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
            <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
            <a href="read.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>

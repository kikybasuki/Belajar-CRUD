<?php
session_start(); // Memulai session
session_unset(); // Menghapus semua variabel session
session_destroy(); // Menghapus session
header('Location: login.php');
exit();
?>

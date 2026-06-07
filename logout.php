<?php
session_start();

// Hapus semua session
$_SESSION = array();
session_destroy();

// Arahkan ke halaman login
header("Location: login.php");
exit;
?>
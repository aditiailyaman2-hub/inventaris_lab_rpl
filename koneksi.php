<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "inventaris_lab_rpl";

$connect = new mysqli($host, $user, $pass, $db);

if ($connect->connect_error) {
    die("Koneksi Gagal: " . $connect->connect_error);
}
?>
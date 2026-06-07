<?php
session_start();
include 'koneksi.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $kode_barang = $connect->real_escape_string($_POST['kode_barang']);
    $nama_barang = $connect->real_escape_string($_POST['nama_barang']);
    $kategori = $connect->real_escape_string($_POST['kategori']);
    $jumlah = (int) $_POST['jumlah'];
    $kondisi = $connect->real_escape_string($_POST['kondisi']);
    $lokasi = $connect->real_escape_string($_POST['lokasi']);
    $tanggal = date('Y-m-d');

    $query = "INSERT INTO barang (user_id, kode_barang, nama_barang, kategori, jumlah, kondisi, lokasi, tanggal_input) 
              VALUES ('$user_id', '$kode_barang', '$nama_barang', '$kategori', '$jumlah', '$kondisi', '$lokasi', '$tanggal')";

    if($connect->query($query)) {
        $_SESSION['msg_success'] = "Data barang berhasil ditambahkan!";
        header("Location: index.php");
    } else {
        echo "Error: " . $connect->error;
    }
} else {
    header("Location: tambah.php");
}
?>
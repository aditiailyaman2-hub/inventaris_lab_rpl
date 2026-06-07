<?php
session_start();
include 'koneksi.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $id = (int) $_POST['id'];
    $kode_barang = $connect->real_escape_string($_POST['kode_barang']);
    $nama_barang = $connect->real_escape_string($_POST['nama_barang']);
    $kategori = $connect->real_escape_string($_POST['kategori']);
    $jumlah = (int) $_POST['jumlah'];
    $kondisi = $connect->real_escape_string($_POST['kondisi']);
    $lokasi = $connect->real_escape_string($_POST['lokasi']);

    $query = "UPDATE barang SET 
              kode_barang='$kode_barang', 
              nama_barang='$nama_barang', 
              kategori='$kategori', 
              jumlah='$jumlah', 
              kondisi='$kondisi', 
              lokasi='$lokasi' 
              WHERE id='$id' AND user_id='$user_id'";

    if($connect->query($query)) {
        $_SESSION['msg_success'] = "Data berhasil diperbarui!";
        header("Location: index.php");
    } else {
        echo "Error: " . $connect->error;
    }
} else {
    header("Location: index.php");
}
?>
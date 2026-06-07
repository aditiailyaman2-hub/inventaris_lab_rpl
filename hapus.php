<?php
session_start();
include 'koneksi.php';

if(isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Hapus data dengan filter user_id (Keamanan Multi-Tenancy)
    $query = "DELETE FROM barang WHERE id='$id' AND user_id='$user_id'";

    if($connect->query($query)) {
        $_SESSION['msg_success'] = "Data berhasil dihapus!";
    }
}

header("Location: index.php");
exit;
?>
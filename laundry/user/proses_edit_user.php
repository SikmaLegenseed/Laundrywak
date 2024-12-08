<?php

require_once "../koneksi.php"; //seolah-olah semua code di koneksi.php bisa kita gunakan

// die('test');
$id = $_POST['id'];
$nama_user = $_POST['nama_user'];
$username = $_POST['username'];
$outlet = $_POST['outlet'];
$role = $_POST['role'];

$hash = password_hash($password, PASSWORD_DEFAULT);
$query = mysqli_query($koneksi, "UPDATE tb_user set name='$nama_user', username='$username', id_outlet='$outlet', role='$role' WHERE id='$id'");
// var_dump($query);
if(!$query){
    echo "Gagal Memasukkan Data User ".mysqli_error($koneksi);
} else{
    // header('Location:view_obat.php');
    // exit;
    echo "<script>location.href='../dashboard/dashboard.php?page=user';</script>"; 
}
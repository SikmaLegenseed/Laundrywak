<?php

// die('test');
include "../koneksi.php";
$outlet = $_POST['outlet'];
$password = $_POST['password'];
$nama_user = $_POST['nama_user'];
$username = $_POST['username'];
$role = $_POST['role'];

$hash = password_hash($password, PASSWORD_DEFAULT);
$query = mysqli_query($koneksi, "INSERT INTO tb_user VALUES (NULL, '$nama_user', '$username', '$hash', '$outlet', '$role')");

// var_dump($query);
if(!$query){
    echo "Gagal Memasukkan Data User ".mysqli_error($koneksi);
}else{
    // header('Location:../select/view_obat.php');
    // exit;

    echo "<script>location.href='../dashboard/dashboard.php?page=user';</script>"; //pindah ke halaman obat jika berhasil
}

echo "berhasil";
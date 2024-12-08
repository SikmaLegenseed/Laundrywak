<?php
include "koneksi.php";
session_start();
$user = $_POST['username'];
$pass = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$user'");
$baris_level = mysqli_fetch_assoc($query);
$cek = password_verify($pass, $baris_level['password']);

if($cek){
    $_SESSION['username'] = $user;
    $_SESSION['level'] = $baris_level['role'];
    $_SESSION['id_user'] = $baris_level['id'];
    $_SESSION['id_outlet'] = $baris_level['id_outlet'];
    echo "<script>alert('Berhasil Login');window.location.href='dashboard/dashboard.php'</script>";
    // echo "<script>alert('Berhasil Login');window.location.href='tb_pelanggan/select/view_pelanggan.php'</script>";
}else{
    echo "<script>alert('Gagal Login');window.location.href='logins.php'</script>";
}
?>
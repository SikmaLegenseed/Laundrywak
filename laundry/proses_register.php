<?php
include "koneksi.php";

$nama = $_POST['nama'];
$outlet = $_POST['outlet'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['roles'];
$pass_hash = password_hash($password, PASSWORD_DEFAULT);


$query_username = mysqli_query($koneksi, "SELECT COUNT(*) FROM tb_user WHERE username='$username'");
$cek_username = mysqli_fetch_row($query_username);

if($cek_username['0'] != 0){
    echo "<script>alert('Username sudah ada, silahkan menggunakan username yang lain');window.location.href='register.php'</script>";
} else {
    $query = "INSERT INTO tb_user VALUES (NULL, '$nama', '$username', '$pass_hash','$outlet', '$role')";
    $hasil = mysqli_query($koneksi, $query);

    if(!$hasil){
        echo "Gagal Register : ". mysqli_error($koneksi);
    } else {
        header('Location:logins.php');
        exit;
    }
}
?>
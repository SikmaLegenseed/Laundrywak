<?php

// die('test');
include "../koneksi.php";
// $id_obat = $_POST['id_obat'];
// $id = $_POST ['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tlp = $_POST['tlp'];
$query = mysqli_query($koneksi, "INSERT INTO tb_member VALUES (NULL, '$nama', '$alamat', '$jenis_kelamin', '$tlp')");

// var_dump($query);
if(!$query){
    echo "Gagal Memasukkan Data Pelanggan ".mysqli_error($koneksi);
}else{
    // header('Location:../select/view_obat.php');
    // exit;

    echo "<script>location.href='../dashboard/dashboard.php?page=register_pelanggan';</script>"; //pindah ke halaman pelanggan jika berhasil
}

echo "berhasil";
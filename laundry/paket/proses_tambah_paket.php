<?php

// die('test');
include "../koneksi.php";
// $id_obat = $_POST['id_obat'];
$id_outlet = $_POST['id_outlet'];
$jenis = $_POST['jenis'];
$nama_paket = $_POST['nama_paket'];
$harga = $_POST['harga'];
$query = mysqli_query($koneksi, "INSERT INTO tb_paket VALUES (NULL,'$id_outlet','$jenis','$nama_paket', '$harga')");

// var_dump($query);
if(!$query){
    echo "Gagal Memasukkan Data Outlet ".mysqli_error($koneksi);
}else{
    // header('Location:../select/view_obat.php');
    // exit;

    echo "<script>location.href='../dashboard/dashboard.php?page=paket';</script>"; //pindah ke halaman obat jika berhasil
}

echo "berhasil";
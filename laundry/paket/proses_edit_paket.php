<?php

require_once "../koneksi.php"; //seolah-olah semua code di koneksi.php bisa kita gunakan

// die('test');
$id = $_POST ['id'];
$id_outlet = $_POST['id_outlet'];
$jenis = $_POST['jenis'];
$nama_paket = $_POST['nama_paket'];
$harga = $_POST['harga'];

$sql = "UPDATE tb_paket SET id_outlet='$id_outlet', jenis='$jenis', nama_paket='$nama_paket', harga='$harga' WHERE id='$id'";
$query = mysqli_query($koneksi, $sql);

if(!$query){
    echo "Gagal Memasukkan Data Paket ".mysqli_error($koneksi);
} else{
    // header('Location:view_obat.php');
    // exit;
    echo "<script>location.href='../dashboard/dashboard.php?page=paket';</script>"; 
}
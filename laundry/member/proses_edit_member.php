<?php

require_once "../koneksi.php"; //seolah-olah semua code di koneksi.php bisa kita gunakan

// die('test');
$id = $_POST ['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tlp = $_POST['tlp'];

$query = mysqli_query($koneksi, "UPDATE tb_member SET id='$id', nama='$nama', alamat='$alamat', jenis_kelamin='$jenis_kelamin', tlp='$tlp' WHERE id='$id'");

// var_dump($query);
if(!$query){
    echo "Gagal Memasukkan Data Member ".mysqli_error($koneksi);
} else{
    // header('Location:view_obat.php');
    // exit;
    echo "<script>location.href='../dashboard/dashboard.php?page=member';</script>"; 
}
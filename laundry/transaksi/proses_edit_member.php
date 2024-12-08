<?php

require_once "../koneksi.php"; //seolah-olah semua code di koneksi.php bisa kita gunakan

// die('test');
$id = $_POST ['id'];
$id_outlet = $_POST['id_outlet'];
$kode_invoice = $_POST['kode_invoice'];
$id_member = $_POST['id_member'];
$tgl = $_POST['tgl'];
$batas_waktu = $_POST['batas_waktu'];
$tgl_bayar = $_POST['tgl_bayar'];
$biaya_tambahan = $_POST['biaya_tambahan'];
$diskon = $_POST['diskon'];
$pajak = $_POST['pajak'];
$status = $_POST['status'];
$dibayar = $_POST['dibayar'];
$id_user = $_POST['id_user'];


$query = mysqli_query($koneksi, "UPDATE tb_transaksi SET id='$id', id_outlet='$id_outlet', kode_invoice='$kode_invoice', jenis_kelamin='$jenis_kelamin', tlp='$tlp' WHERE id='$id'");

// var_dump($query);
if(!$query){
    echo "Gagal Memasukkan Data Member ".mysqli_error($koneksi);
} else{
    // header('Location:view_obat.php');
    // exit;
    echo "<script>location.href='../dashboard/dashboard.php?page=user';</script>"; 
}
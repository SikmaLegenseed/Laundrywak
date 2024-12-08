<?php
    include "../koneksi.php";
    $id = $_GET['id_member'];
    
    $query_delete = mysqli_query($koneksi, "DELETE FROM tb_transaksi WHERE id_member=$id");

    if(!$query_delete){
        echo "Gagal delete".mysqli_error($koneksi);
    }else{
        header('Location:../dashboard/dashboard.php?page=transaksi');
    }
?>
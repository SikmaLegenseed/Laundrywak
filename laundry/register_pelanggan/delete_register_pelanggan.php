<?php
    include "../koneksi.php";
    $id = $_GET['id'];
    
    $query_delete = mysqli_query($koneksi, "DELETE FROM tb_member WHERE id=$id");

    if(!$query_delete){
        echo "Gagal delete".mysqli_error($koneksi);
    }else{
        header('Location:../dashboard/dashboard.php?page=register_pelanggan');
    }
?>
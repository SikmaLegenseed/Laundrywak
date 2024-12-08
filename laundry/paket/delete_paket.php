<?php
    include "../koneksi.php";
    $id_outlet = $_GET['id'];
    
    $query_delete = mysqli_query($koneksi, "DELETE FROM tb_paket WHERE id=$id_outlet");

    if(!$query_delete){
        echo "Gagal delete".mysqli_error($koneksi);
    }else{
        header('Location:../dashboard/dashboard.php?page=paket');
    }
?>
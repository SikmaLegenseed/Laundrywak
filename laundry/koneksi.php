<?php
    $host = "localhost:3306";
    $username = "root";
    $password = "";
    $database_name = "laundry";
    $koneksi = mysqli_connect($host,$username,$password,$database_name);
    

    if(!$koneksi){
        die ("Koneksi ke Database Gagal ".mysqli_connect_error());
    }
?>
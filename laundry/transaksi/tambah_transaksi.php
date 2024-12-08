<?php
if (@$_POST['selanjutnya']){
    echo "<br><br><br>";
    $id_outlet = $_SESSION['id_outlet'];
    // echo $kode_invoice = $_SESSION['kode_invoice'];
    // echo $id_member = $_SESSION['id_member'];
    // echo $tanggal = $_SESSION['tgl'];
    // echo $batas_waktu = $_SESSION['batas_waktu'];
    // echo $tgl_bayar = $_SESSION['tgl_bayar'];
    // echo $biaya_tambahan = $_SESSION['biaya_tambahan'];
    // echo $diskon = $_SESSION['diskon'];
    // echo $pajak = $_SESSION['pajak'];
    // echo $status = $_SESSION['status'];
    // echo $dibayar = $_SESSION['dibayar'];
    // echo $id_user = $_SESSION['id_user'];
    // $id_outlet = $_SESSION['id_outlet'];
    @$kode_invoice_terakhir = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT kode_invoice FROM tb_transaksi ORDER BY id DESC LIMIT 1 "));
    if(!$kode_invoice_terakhir){
        $kode_invoice = "INV/".date("Y/m/d")."/1";
    }else{
        $pecah_string = explode("/", $kode_invoice_terakhir['kode_invoice']);
        $bulan_sebelum = $pecah_string[2];
        $bulan_saat_ini = date('m');

        if($bulan_saat_ini != $bulan_sebelum){
            $number_urut = 1;
        }else{
            $number_urut = $pecah_string[4];
            $number_urut++;
        }
        $kode_invoice = "INV/".date("Y/m/d")."/".$number_urut;
    }

    $nama_member = $_POST['nama_member'];
    $cari_id_member = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id FROM tb_member WHERE nama='$nama_member'"));
    $id_member = $cari_id_member['id'];

    date_default_timezone_set('Asia/Makassar');
    $tanggal = date("Y-m-d H:i:s");

    $batas_waktu = date("Y-m-d H:i:s", strtotime($tanggal . " +3 days"));
    // $dibayar = $_POST['dibayar'];
    $dibayar = "belum_dibayar";

    // if($dibayar == 'dibayar'){
    //     $tgl_bayar = $tanggal;
    // }else{
        $tgl_bayar = "0000-00-00 00:00:00";
    // }

    // if(@$_POST['biaya_tambahan']){
    //     $biaya_tambahan = $_POST['biaya_tambahan'];
    // }else{
        $biaya_tambahan = 0;
    // }

    $cari_transaksi = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_member FROM tb_transaksi WHERE id_member='$id_member'"));
    if ($cari_transaksi % 3 ==  0 && $cari_transaksi != 0){
        $diskon = 0.1;
    }else{
        $diskon = 0;
    }

    $pajak = 0.0075;

    $status = "baru";

    $id_user = $_SESSION['id_user'];

    $hasil = mysqli_query($koneksi, "INSERT INTO tb_transaksi VALUES(NULL, '$id_outlet', '$kode_invoice', '$id_member', '$tanggal', '$batas_waktu', '$tgl_bayar', '$biaya_tambahan', '$diskon', '$pajak', '$status', '$dibayar', '$id_user')");
    // var_dump($hasil); //sangat penting
    $id_transaksi = mysqli_fetch_row(mysqli_query($koneksi, "SELECT LAST_INSERT_ID()"));
    $_SESSION['idtransaksi'] = $id_transaksi[0];
    if(!$hasil){
        echo "Gagal Tambah Data Transaksi : ". mysqli_error($koneksi);
    }else{
        header('Location:dashboard.php?page=detail_transaksi');
        exit;
    }
    mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id FROM tb_member"));
}
?>
    <div id="all">
        <h1 id="title">Tambah Transaksi</h1>
        <form action="dashboard.php?page=tambah_transaksi" method="post" id="form">
            <input type="text" list="nama_pelanggan" name="nama_member" autocomplete="off" placeholder="Cari Nama Pelanggan">
            <datalist id="nama_pelanggan">
                <?php
                $query_member = mysqli_query($koneksi, "SELECT nama FROM tb_member");
                    while($data_pelanggan = mysqli_fetch_assoc($query_member)){
                ?>
                    <option value="<?=$data_pelanggan['nama']?>">
                <?php
                    }
                ?>
            </datalist>
            <!-- <input type="number" name="biaya_tambahan" placeholder="Biaya Tambahan">
            <select name="dibayar" id="">
                <option value="belum_dibayar">Belum Bayar</option>
                <option value="dibayar">Sudah Bayar</option>
            </select> -->

            <center><input type="submit" value="Simpan Data Transaksi" name="selanjutnya"></center>
        </form>
    </div>


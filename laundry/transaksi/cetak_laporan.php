<style>
    body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .align-center {
            text-align: center;
        }

        .outlet {
            font-weight: bold;
            text-align: center;
        }

        .total-row {
            font-weight: bold;
            text-align: center;
        }
</style>

<?php
include "../koneksi.php";
session_start();
$tgl_awal = @$_POST['masukkan_tgl_awal'];
$tgl_akhir = @$_POST['masukkan_tgl_akhir'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <style>

    </style>
</head>
<body>
    <h2 class="align-center">LAPORAN TRANSAKSI LAUNDRY</h2>
    <h3>Periode : <?=$tgl_awal." sampai ".$tgl_akhir;?></h3>

    <!-- algoritma mencari data nama paket yang sering dipilih -->
    <?php
    if(@$_SESSION['level']=='admin' OR @$_SESSION['role']=='owner'){
        $nama_paket = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_paket, COUNT(nama_paket) AS jumlah_penggunaan FROM tb_transaksi INNER JOIN tb_detail_transaksi ON tb_transaksi.id=tb_detail_transaksi.id_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' GROUP BY nama_paket ORDER BY jumlah_penggunaan DESC"));
    }else{
        $id_outlet = $_SESSION['id_outlet'];
        $nama_paket = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_paket, COUNT(nama_paket) AS jumlah_penggunaan FROM tb_transaksi INNER JOIN tb_detail_transaksi ON tb_transaksi.id=tb_detail_transaksi.id_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id='$id_outlet' GROUP BY nama_paket ORDER BY jumlah_penggunaan DESC"));
    }
    echo "Paket yang sering dipilih pelanggan : <b>".$nama_paket['nama_paket']."</b>";
    ?>
    <!-- algoritma mencari data nama paket yang sering dipilih -->



    <hr style="width:100%", size="3", color="black">

    <?php
    if(@$_SESSION['level']=='admin' OR @$_SESSION['level']=='owner'){
        $query_outlet = mysqli_query($koneksi, "SELECT tb_outlet.id AS id_outlet, tb_outlet.nama AS nama_outlet FROM tb_detail_transaksi INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' GROUP BY tb_outlet.id");
    }else{
        $id_outlet = $_SESSION['id_outlet'];
        $query_outlet = mysqli_query($koneksi, "SELECT tb_outlet.id AS id_outlet, tb_outlet.nama AS nama_outlet FROM tb_detail_transaksi INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id='$id_outlet'");
    }
    ?>


    <center>
        <table border="1" cellspacing="10" cellspacing="0">
            <?php
            $total_semua=0;
            while($baris_outlet = mysqli_fetch_assoc($query_outlet)){
                if(@$_SESSION['level']=='admin' OR @$_SESSION['level']=='owner'){
                    $id_outlet = $baris_outlet['id_outlet'];
                    $query = mysqli_query($koneksi, "SELECT *, tb_outlet.id AS id_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id='$id_outlet' GROUP BY kode_invoice");
                }else{
                    $id_outlet = $_SESSION['id_outlet'];
                    $query = mysqli_query($koneksi, "SELECT *, tb_outlet.id AS id_outlet, tb_outlet_nama AS nama_outlet, tb_transaksi.id AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id='$id_outlet' GROUP BY kode_invoice");
                }
            ?>
            <tr>
                <td align="center" class="outlet" colspan="4">Nama Outlet : <b><?=$baris_outlet['nama_outlet']?></td>
            </tr>
            <?php
            $no = 1;
            while($baris = mysqli_fetch_assoc($query)){
            ?>
            <tr>
                <td><?=$no++?></td>
                <td><?="Pelanggan: ".$baris['nama_member']?></td>

                <td align="left">
                    <?php
                    $id_transaksi = $baris['id_transaksi'];
                    
                    $query_paket = mysqli_query($koneksi, "SELECT nama_paket FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE id_transaksi='$id_transaksi'");
                    while($data_paket = mysqli_fetch_assoc($query_paket)){
                        echo $data_paket['nama_paket'];
                        echo "<br>";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $grand_total = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(total_harga) FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE id_transaksi='$id_transaksi'"));
                    $pajak = array_sum($grand_total) * $baris['pajak'];
                    $diskon = array_sum($grand_total) * $baris['diskon'];
                    $total_keseluruhan = (array_sum($grand_total) + $baris['biaya_tambahan'] + $pajak) - $diskon;
                    $tampil_total = number_format($total_keseluruhan, 0, ',', '.');
                    echo "Total Harga : <b>Rp ".$tampil_total."</b>";
                    $total_semua += $tampil_total;
                    ?>
                </td>
            </tr>
            <?php
            } //line 106
        } //line 81
            ?>
            <tr align="right">
                <td colspan="3"><b>Total Pendapat</b>
                <br>
                <?php echo "Dari Tanggal : ".$tgl_awal." sampai ".$tgl_akhir?>
            </td>
            <td>
                <?php
                    echo "<h2>Rp ".number_format($total_semua, 3, '.', '.')."</h2>";
                    $pajak_semua = $total_semua*0.0075;
                    echo "Pajak : Rp ".number_format($pajak_semua, 3, '.', '.');
                ?>
            </td>
            </tr>
        </table>
    </center>

    <script>
        window.print(); //auto ngeprint
    </script>
</body>
</html>
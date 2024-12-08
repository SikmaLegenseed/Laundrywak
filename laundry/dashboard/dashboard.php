<?php
session_start();
include "../koneksi.php";

// Klo belum login harus login
if (!@$_SESSION["username"]) {
    exit(header("Location: ../logins.php"));
}

//dari laporan.php
if(@$_GET['status'] == 'baru') {
    $status = "WHERE status='baru'";
} elseif(@$_GET['status'] == 'proses') {
    $status = "WHERE status='proses'";
} elseif(@$_GET['status'] == 'selesai') {
    $status = "WHERE status='selesai'";
} elseif(@$_GET['status'] == 'diambil') {
    $status = "WHERE status='diambil'";
} else {
    $status = "";
}

if(@$_SESSION['level'] == 'admin' or @$_SESSION['level'] == 'owner') {
    $query = mysqli_query($koneksi, "SELECT *, tb_outlet.id AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id $status GROUP BY kode_invoice");
} else {
    $id_outlet = $_SESSION['id_outlet'];
    if($status != "") {
        $outlet = "AND tb_outlet.id='$id_outlet'";
    } else {
        $outlet = "WHERE tb_outlet.id='$id_outlet'";
    }
    $query = mysqli_query($koneksi, "SELECT *, tb_outlet.id AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id $status $outlet GROUP BY kode_invoice");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>LaundryWak</title>
    <link rel="stylesheet" href="style.css">
    <script src="javascript" href="button.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* overflow-y: hidden; */
        }

        .gambar {
            text-align: center;
            margin-top: 20px;
        }

        .gambar img {
            height: 200px;
            width: 200px;
        }

        .welcome-message {
            text-align: center;
            margin-top: 20px;
        }

        .welcome-message h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .hide{
            display: none;
        }

        .report-table{
        margin-bottom: 20px;
        }

        .report-table h3{
            text-align: center;
        }

        .report-table table {
		width: 100%;
		border-collapse: collapse;
        }

        /* perlu */
        .report-table th,
        .report-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .report-table th {
            background-color: #f2f2f2;
        }


        /* width */
        ::-webkit-scrollbar {
        width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        /* box-shadow: inset 0 0 5px grey;  */
        border-radius: 10px;
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #BFD8AF; 
        border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #99BC85; 
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="header tidak_print">
        <a href="dashboard.php" class="logo">LaundryWak</a>

        <nav class="navbar">
            <?php if ($_SESSION['level'] == 'admin'): ?>
                <!-- <a href="#">Home</a> -->
                <a href="dashboard.php?page=paket">Paket</a>
                <a href="dashboard.php?page=outlet">Outlet</a>
                <a href="dashboard.php?page=register_pelanggan">Registrasi Pelanggan</a>
                <a href="dashboard.php?page=user">User</a>
                <a href="dashboard.php?page=transaksi">Transaksi</a>
            <?php elseif ($_SESSION['level'] == 'kasir'): ?>
                <a href="dashboard.php?page=register_pelanggan">Registrasi Pelanggan</a>
                <a href="dashboard.php?page=laporan">Transaksi</a>
            <?php elseif ($_SESSION['level'] == 'owner'): ?>
                <!-- <a href="#">Home</a> -->
                <a href="dashboard.php?page=laporan">Transaksi</a>
            <?php endif; ?>

            <div class="nav-group">
                <a href="#" style="position: relative;">
                    <span><?=$_SESSION['username']?><span>
                    <i class="fa fa-angle-down"></i>
                    <sup class="badge bg-secondary" style="font-size: .7rem; position: absolute; top: -.5rem; pointer-events: none;"><?= $_SESSION['level'] ?></sup> 
                </a>

                <div class="drop-nav">
                    <a href="../logins.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <?php
    if (@$_GET['page'] == ""){?>
    <div class="welcome-message">
        <h2>Selamat Datang Kembali <b><?=$_SESSION['username']?></h2>
        <p>Role kamu adalah <b><?= $_SESSION['level'] ?></p>
    </div>
    <?php } ?>

    <?php

    if (@$_GET['page'] == "") { ?>
    <!-- Gambar -->
    <div class="gambar">
        <img src="../../laundrywak.png" alt="">
    </div>
    <?php } ?>
    <br>
    <?php
    
    if (@$_GET['page'] == ""){ ?>
    <center>
    <div class="container">
    <div class="report-table">
        <table border="1" cellspacing="0">
            <thead>
            <h3 style="display: flex;">Transaksi Terakhir</h3>
                <tr>
                <th>Kode Invoice</th>
						<th>Nama Pelanggan</th>
						<th class="paket">Nama Paket</th>
						<th>
							<script>
								function pilihStatus(value) {
									window.location.href = 'dashboard.php?page=laporan&status=' + this.options[this.selectedIndex].value;
								}
							</script>
						</th>
					</tr>
				</thead>
				<!-- judul kolom -->


				<tbody>
					<?php
                while($baris = mysqli_fetch_assoc($query)) {
                    if(@$_SESSION['role'] == 'admin' or @$_SESSION['role'] == 'owner') {
                        ?>
					<tr>
						<td align="left">Nama Outlet :
							<b><?=$baris['nama_outlet']?></b>
						</td>
					</tr>
					<?php
                    }
                    ?>
					<tr>
						<td align="left">
							<?php
                            $pecah_string_tanggal = explode(" ", $baris['batas_waktu']);
                    $pecah_string_hari = explode("-", $pecah_string_tanggal['0']);
                    $pecah_string_jam = explode(":", $pecah_string_tanggal['1']);

                    echo "Batas Pengambilan : ".$pecah_string_hari['2']."-".$pecah_string_hari['1']."-".$pecah_string_hari['0'];
                    echo "<br>";
                    echo "Jam : ".$pecah_string_jam['0'].":".$pecah_string_jam['1'];
                    echo "<br><br>";

                    echo "<b>".$baris['kode_invoice']."<b>";
                    ?>
						</td>

						<td><?=$baris['nama_member']?>
						</td>

						<td align="left">
							<?php
                    $id_transaksi = $baris['id_transaksi'];
                    $query_paket = mysqli_query($koneksi, "SELECT nama_paket, qty FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE id_transaksi='$id_transaksi'");
                    while($data_paket = mysqli_fetch_assoc($query_paket)) {
                        echo $data_paket['nama_paket'];
                        echo "<br>";
                    }

                    echo "<br>";

                    $grand_total = mysqli_fetch_row(mysqli_query($koneksi, "SELECT SUM(total_harga) FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE id_transaksi='$id_transaksi'"));
                    $pajak = $grand_total['0'] * $baris['pajak'];
                    $diskon = $grand_total['0'] * $baris['diskon'];
                    $total_keseluruhan = ($grand_total['0'] + $baris['biaya_tambahan'] + $pajak) - $diskon;
                    echo "Total Harga : <br>Rp. ".number_format($total_keseluruhan, 0, ',', '.')."</b>";
                    ?>
						</td>

						<td>
							<script>
								function editStatus(value, id) {
									window.location.href = '../transaksi/proses_edit_status_laporan.php?status=' + value + '&id=' + id;
								}
							</script>

							<?php
                            if($baris['dibayar'] == 'belum_dibayar') {
                                $warna = "#ffbc00";
                            } else {
                                $warna = "#60dd60";
                            }
                    ?>
							<br>
						</td>
					</tr>
					<?php
                }
                ?>
				</tbody>
                </tr>
            </thead>
        </table>
    </div>
    </div>
</center>
    <?php } ?>
    

    <!-- konten -->
    <?php
        switch(@$_GET['page']){
            case 'outlet':
                include_once "../view/view_outlet.php";   
                break;
            case 'tambah_outlet':
                include_once "../tambah/tambah_outlet.php";
                break;
            case 'edit_outlet':
                include_once "../edit/edit_outlet.php";
                break; 

            case 'paket':
                include_once "../paket/paket.php";
                break;
            case 'tambah_paket':
                include_once "../paket/tambah_paket.php";
                break;
            case 'edit_paket':
                include_once "../paket/edit_paket.php";
                break;

            case 'member':
                include_once "../member/member.php";
                break;
            case 'tambah_member':
                include_once "../member/tambah_member.php";
                break;
            case 'edit_member':
                include_once "../member/edit_member.php";
                break;

            case 'register_pelanggan':
                include_once "../register_pelanggan/register_pelanggan.php";
                break;
            case 'tambah_register_pelanggan':
                include_once "../register_pelanggan/tambah_register_pelanggan.php";
                break;
            case 'edit_register_pelanggan':
                include_once "../register_pelanggan/edit_register_pelanggan.php";
                break;

            case 'user':
                include_once "../user/user.php";
                break;
            case 'tambah_user':
                include_once "../user/tambah_user.php";
                break;
            case 'edit_user':
                include_once "../user/edit_user.php";
                break;

            case 'transaksi':
                include_once "../transaksi/laporan.php";
                break;
            case 'laporan':
                include_once "../transaksi/laporan.php";
                break;
            case 'tambah_transaksi':
                include_once "../transaksi/tambah_transaksi.php";
                break;
            case 'detail_transaksi':
                include_once "../transaksi/detail_transaksi.php";
                break;
            case 'cetak_laporan':
                include_once "../transaksi/cetak_laporan.php";
                break;
        }
    ?>

    <!-- Tombol Tambah Outlet -->
</body>
</html>

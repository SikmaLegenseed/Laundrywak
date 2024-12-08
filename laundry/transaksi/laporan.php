
<?php

    if (@$_GET['page'] == "") { ?>
    <!-- Gambar -->
    <div class="gambar">
        <img src="../../laundrywak.png" alt="">
    </div>
    <?php } ?>

<?php if (@$_GET['page'] == false) { ?>
    <div class="welcome-message">
        <h2>Selamat Datang Kembali User!</h2>
        <p>Role Kamu Adalah Admin!</p>
        <p>Saya Miaw</p>
    </div>
    <!-- Gambar -->
    <div class="gambar">
        <img src="../../laundrywak.png" alt="">
    </div>
    <?php } ?>

<style>
	/* perlu */
	.container {
		max-width: 800px;
		margin: 0 auto;
		padding: 20px;
    }
	/* perlu */
	.container {
		max-width: 800px;
		margin: 0 auto;
		padding: 20px;
	}

	.report-options {
		margin-bottom: 20px;
	}

	/* perlu kyknya */
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

	/* .paket{
    width: 150px;
} */

	/* perlu */
	.report-table select {
		margin-top: 5px;
		padding: 5px;
		border-radius: 5px;
		width: 150px
	}

	.report-table a {
		text-decoration: none;
	}

	.report-table a:hover {
		text-decoration: underline;
	}

	a:link {
		text-decoration: none;
	}

	a:visited {
		text-decoration: none;
	}

	a:hover {
		text-decoration: none;
	}

	a:active {
		text-decoration: none;
	}
</style>

<?php
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
<center style="padding-bottom: 3rem;">
	<br>
	<div class="container">
		<div class="report-options">
			<form action="../transaksi/cetak_laporan.php" target="_blank" method="POST">
				<span>Tanggal Awal</span>
				<input type="date" name="masukkan_tgl_awal" required
					style="margin-top: 5px; padding: 8px; border-radius: 5px; border: 1px solid #ccc; width: 150px;">
				<span>Tanggal Akhir</span>
				<input type="date" name="masukkan_tgl_akhir" required
					style="margin-top: 5px; padding: 8px; border-radius: 5px; border: 1px solid #ccc; width: 150px;">
				<button type="submit" name="tombol_cetak_laporan"
					style="margin-top: 5px; padding: 8px 20px; border: none; border-radius: 5px; background-color: #4CAF50; color: white; font-size: 16px; cursor: pointer;">Generate
					Laporan</button>
			</form>
		</div>
		<?php if(@$_SESSION['level'] == 'admin' or @$_SESSION['level'] == 'kasir') { ?>
        <div style="margin-bottom: 25px;">
            <a href="?page=tambah_transaksi"
                style="margin-top: 5px; padding: 8px 20px; border: none; border-radius: 5px; background-color: #4CAF50; color: white; font-size: 16px; cursor: pointer;">+ Tambah
                Transaksi</a>
        </div>
        <?php } ?>
		<div class="report-table">
			<table border="1" cellspacing="0">
				<!-- judul kolom -->
				<thead>
					<tr>
						<th>Kode Invoice</th>
						<th>Nama Pelanggan</th>
						<th class="paket">Nama Paket</th>
						<th>
							<select name="pilih_status" onchange="pilihStatus.apply(this)">
								<option value="">Semua Status</option>
								<option value="baru" <?php if(@$_GET['status'] == 'baru') {
								    echo "selected";
								}?>>Baru
								</option>
								<option value="proses" <?php if(@$_GET['status'] == 'proses') {
								    echo "selected";
								}?>>Proses
								</option>
								<option value="selesai" <?php if(@$_GET['status'] == 'selesai') {
								    echo "selected";
								}?>>Selesai
								</option>
								<option value="diambil" <?php if(@$_GET['status'] == 'diambil') {
								    echo "selected";
								}?>>Diambil
								</option>
							</select>
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
							<select name=""
								onchange="editStatus(this.options[this.selectedIndex].value, <?=$baris['id_transaksi']?>)"
								id="">
								<option value="baru" <?php if($baris['status'] == 'baru') {
								    echo "selected";
								}?>>Baru
								</option>
								<option value="proses" <?php if($baris['status'] == 'proses') {
								    echo "selected";
								}?>>Proses
								</option>
								<option value="selesai" <?php if($baris['status'] == 'selesai') {
								    echo "selected";
								}?>>Selesai
								</option>
								<option value="diambil" <?php if($baris['status'] == 'diambil') {
								    echo "selected";
								}?>>Diambil
								</option>
							</select>
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
							<a style="color : <?=$warna?>"
								href="dashboard.php?page=detail_transaksi&idtransaksi=<?=$baris['id_transaksi']?>">Lihat
								Detail</a>

						</td>
					</tr>
					<?php
                }
?>
				</tbody>
			</table>
		</div>
	</div>
</center>

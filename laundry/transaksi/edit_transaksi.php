<?php
$id = $_GET['id_member'];

$query = mysqli_query($koneksi, "SELECT * FROM tb_transaksi WHERE id_member='$id'");
$row = mysqli_fetch_assoc($query);

?>
    <div id="all">
        <h1 id="title">Edit Transaksi</h1>
        <form action="../member/proses_edit_transaksi.php" method="post" id="form">
            <input type="text" hidden id="id" name="id" value="<?=$row['id']?>">

            <label for="id_outlet">Id Outlet</label>
            <input type="number" id="id_outlet" name="id_outlet" value="<?=$row['id_outlet']?>"> 

            <label for="kode_invoice">Kode Invoice</label>
            <input type="text" id="kode_invoice" name="kode_invoice" value="<?=$row['kode_invoice']?>">

            <label for="id_member">Id Member</label>
            <input type="text" id="id_member" name="id_member" value="<?=$row['id_member']?>">

            <label for="tgl">Tgl</label>
            <input type="date" id="tgl" name="tgl" value="<?=$row['tgl']?>">

            <label for="batas_waktu">Batas Waktu</label>
            <input type="date" id="batas_waktu" name="batas_waktu" value="<?=$row['batas_waktu']?>">

            <label for="tgl_bayar">Tgl Bayar</label>
            <input type="date" id="tgl_bayar" name="tgl_bayar" value="<?=$row['tgl_bayar']?>">

            <label for="biaya_tambahan">Biaya Tambahan</label>
            <input type="number" id="biaya_tambahan" name="biaya_tambahan" value="<?=$row['biaya_tambahan']?>">

            <label for="diskon">Diskon</label>
            <input type="number" id="diskon" name="diskon" value="<?=$row['diskon']?>">

            <label for="pajak">Pajak</label>
            <input type="number" id="pajak" name="pajak" value="<?=$row['pajak']?>">

            <label for="status">Status</label>
            <input type="text" id="status" name="status" value="<?=$row['status']?>">

            <label for="dibayar">Dibayar</label>
            <input type="text" id="dibayar" name="dibayar" value="<?=$row['dibayar']?>">

            <label for="id_user">Id User</label>
            <input type="number" id="id_user" name="id_user" value="<?=$row['id_user']?>">

            <center><input type="submit" value="Simpan Data Transaksi"></center>
        </form>
    </div>

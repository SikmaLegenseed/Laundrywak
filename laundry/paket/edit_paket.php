<style>
    .btn-save {
        padding: 8px 20px;
        border: none;
        border-radius: 5px;
        background-color: #4CAF50;
        color: white;
        font-size: 16px;
        cursor: pointer;
        margin-top: 5px;
        display: flex; /* Membuat ikon dan teks sejajar */
        align-items: center; /* Mengatur vertikal terpusat */
}

    .btn-save span {
        margin-right: 5px; /* Jarak antara teks dan ikon */
}
</style>
<?php
$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM tb_paket WHERE id = '$id'");
$outlets = mysqli_query($koneksi, "SELECT id, nama FROM tb_outlet");
$row = mysqli_fetch_assoc($query);

?>
    <div id="all">
        <h1 id="title">Edit Paket</h1>
        <form action="../paket/proses_edit_paket.php" method="post" id="form">
            <input type="text" hidden id="id" name="id" value="<?=$row['id']?>">

            <label for="nama_Outlet">Nama Outlet</label>
            <select name="id_outlet" id="nama_outlet" required>
                <option value="">-- Nama Outlet --</option>
                <?php 
                    while($r = mysqli_fetch_assoc($outlets)) {
                        $selected = $r["id"] == $row["id_outlet"] ? "selected" : "";
                        echo "<option $selected value='{$r['id']}' >{$r['nama']}</option>";
                    }
                ?>
            </select>

            <label for="alamat">Jenis Paket
            <select name="jenis" id="" placeholder="-- JENIS PAKET --" require>
                <option value="selimut">Selimut</option>
                <option value="bed_cover">Bed Cover</option>
                <option value="kaos">Kaos</option>
                <option value="lain">Lain-lainnya</option>
            </select>
            </label>
            
            <label for="nama_paket">Nama Paket</label>
            <input value="<?= $row["nama_paket"]; ?>" type="text" id="nama_paket" name="nama_paket">

            <label for="tlp">Harga</label>
            <input type="text" id="harga" name="harga" value="<?=$row['harga']?>">

            <center>
                    <button type="submit" class="btn-save">
                        <i class="fa-regular fa-floppy-disk"></i>
                        <span style="margin-left: 5px;">Simpan</span>
                    </button>
            </center>
        </form>
    </div>

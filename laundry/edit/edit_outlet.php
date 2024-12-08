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
$id_outlet = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM tb_outlet WHERE id='$id_outlet'");
$row = mysqli_fetch_assoc($query);
?>
<div class="container">
    <div class="report-table">
        <div id="all">
            <h1 id="title">Edit Outlet</h1>
            <form action="../edit/proses_edit_outlet.php" method="post" id="form">
                <input type="text" hidden id="id_outlet" name="id" value="<?=$row['id']?>">
                <label for="nama_Outlet">Nama Outlet</label>
                <input type="text" id="nama_outlet" name="nama_outlet" value="<?=$row['nama']?>"> 
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" value="<?=$row['alamat']?>">
                <label for="tlp">No Telp</label>
                <input type="text" id="tlp" name="tlp" value="<?=$row['tlp']?>">
                <center>
                    <button type="submit" class="btn-save">
                        <i class="fa-regular fa-floppy-disk"></i>
                        <span style="margin-left: 5px;">Simpan</span>
                    </button>
                </center>
            </form>
        </div>
    </div>
</div>

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
    <div id="all">
        <h1 id="title">Tambah Paket</h1>
        <form action="../paket/proses_tambah_paket.php" method="post" id="form">
            <!-- <label for="id_obat">ID Obat:</label>
            <input type="text" id="id_obat" name="id_obat" required> -->

            <label for="nama_outlet">Nama Outlet</label>

            <select name="id_outlet" id="">
                <?php
                
                $query = mysqli_query($koneksi, "SELECT id, nama FROM tb_outlet");
                while($baris = mysqli_fetch_assoc($query)){
                    ?>
                <option value="<?=$baris['id']?>"><?=$baris['nama']?></option>
                    <?php
                }
                ?>
            </select>
            <label for="jenis">Jenis Paket</label>
            <select name="jenis" id="jenis">
                <option value="kiloan">Kiloan</option>
                <option value="selimut">Selimut</option>
                <option value="bed_cover">Bed Cover</option>
                <option value="kaos">kaos</option>
                <option value="lain">Lain</option>
            </select>

            <label for="nama_paket">Nama Paket</label>
            <input type="text" id="nama_paket" name="nama_paket">

            <label for="tlp">Harga</label>
            <input type="text" id="harga" name="harga">

            <center>
                <button type="submit" class="btn-save">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span style="margin-left: 5px;">Simpan</span>
                </button>
            </center>
        </form>
    </div>


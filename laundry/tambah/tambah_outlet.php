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
        <h1 id="title">Tambah Outlet</h1>
        <form action="../tambah/proses_tambah_outlet.php" method="post" id="form">
            <!-- <label for="id_obat">ID Obat:</label>
            <input type="text" id="id_obat" name="id_obat" required> -->

            <label for="nama_outlet">Nama Outlet</label>
            <input type="text" id="nama_outlet" name="nama_outlet">

            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat">

            <label for="tlp">No Telp</label>
            <input type="number" id="tlp" name="tlp">

            <center>
                <button type="submit" class="btn-save">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span style="margin-left: 5px;">Simpan</span>
                </button>
            </center>
        </form>
    </div>

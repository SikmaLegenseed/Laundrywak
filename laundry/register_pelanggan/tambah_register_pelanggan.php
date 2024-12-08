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
        <h1 id="title">Tambah Pelanggan</h1>
        <form action="../register_pelanggan/proses_tambah_register_pelanggan.php" method="post" id="form">

            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama">

            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat">

            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            <!-- <input type="text" id="jenis_kelamin" name="jenis_kelamin" placeholder=""> -->

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


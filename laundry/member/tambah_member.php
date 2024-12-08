
    <div id="all">
        <h1 id="title">Tambah Member</h1>
        <form action="../member/proses_tambah_member.php" method="post" id="form">

            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama">

            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat">

            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin">
                <option value="laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
            </select>

            <label for="tlp">No Telp</label>
            <input type="number" id="tlp" name="tlp">

            <center><input type="submit" value="Simpan Data Member"></center>
        </form>
    </div>


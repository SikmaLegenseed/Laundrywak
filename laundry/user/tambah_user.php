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
    <h1 id="title">Tambah User</h1>
    <form action="../user/proses_tambah_user.php" method="post" id="form">
        <label for="id_outlet">Nama Outlet</label>
        <select required name="outlet" id="nama_outlet">
            <?php
                $outlet = mysqli_query($koneksi, 'SELECT * FROM tb_outlet');
                while($row = mysqli_fetch_assoc($outlet)){
                    echo "<option value='{$row['id']}'>{$row['nama']}</option>";
                }
            ?>
        </select>

        <label for="nama_user">Nama User</label>
        <input type="text" id="nama_user" name="nama_user">

        <label for="username">Username</label>
        <input type="text" id="username" name="username">

        <label for="pw">Password</label>
        <input type="password" id="pw" name="password">

        <label for="role">Role</label>
        <select name="role" id="role">
            <option value="admin">Admin</option>
            <option value="kasir">Kasir</option>
            <option value="owner">Owner</option>
        </select>

        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin">
            <option value="laki">Laki-laki</option>
            <option value="perempuan">Perempuan</option>
        </select>

        <center>
                <button type="submit" class="btn-save">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span style="margin-left: 5px;">Simpan</span>
                </button>
        </center>
    </form>
</div>


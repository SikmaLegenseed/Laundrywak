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

$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id='$id'");
$row = mysqli_fetch_assoc($query);

?>
    <div id="all">
        <h1 id="title">Edit User</h1>
        <form action="../user/proses_edit_user.php" method="post" id="form">
            <input type="text" hidden id="id" name="id" value="<?=$row['id']?>">

            <label for="nama_outlet">Nama Outlet</label>
            <select required name="outlet" id="nama_outlet">
                <?php
                    $outlet = mysqli_query($koneksi, 'SELECT * FROM tb_outlet');
                    while($outlet_row = mysqli_fetch_assoc($outlet)){
                        $selected = $outlet_row["id"] == $row["id_outlet"] ? "selected" : ""; 
                        echo "<option $selected value='{$outlet_row['id']}'>{$outlet_row['nama']}</option>";
                    }
                ?>
            </select> 

            <label for="nama_user">Nama User</label>
            <input type="text" id="nama_user" name="nama_user" value="<?=$row['name']?>">

            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?=$row['username']?>">

            <label for="pw">Password</label>
            <input type="password" id="pw" name="password">

            <label for="role">Role</label>
            <select name="role" id="role">
                <option value="admin">Admin</option>
                <option value="kasir">Kasir</option>
                <option value="owner">Owner</option>
            </select>
            <center>
                    <button type="submit" class="btn-save">
                        <i class="fa-regular fa-floppy-disk"></i>
                        <span style="margin-left: 5px;">Simpan</span>
                    </button>
                </center>
        </form>
    </div>

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

$query = mysqli_query($koneksi, "SELECT * FROM tb_member WHERE id='$id'");
$row = mysqli_fetch_assoc($query);

?>
    <div id="all">
        <h1 id="title">Edit Member</h1>
        <form action="../member/proses_edit_member.php" method="post" id="form">
            <input type="text" hidden id="id" name="id" value="<?=$row['id']?>">

            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?=$row['nama']?>"> 

            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" value="<?=$row['alamat']?>">

            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin">
                <option value="<?=$row['jenis_kelamin']?>">P</option>
                <option value="<?=$row['jenis_kelamin']?>">L</option>
            </select>
        
            <label for="tlp ">No Telp</label>
            <input type="text" id="telp" name="tlp" value="<?=$row['tlp']?>">

                <center>
                    <button type="submit" class="btn-save">
                        <i class="fa-regular fa-floppy-disk"></i>
                        <span style="margin-left: 5px;">Simpan</span>
                    </button>
                </center>
        </form>
    </div>

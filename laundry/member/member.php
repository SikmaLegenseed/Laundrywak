
    <!-- Tabel Paket -->

    <div class="container mt-4">
        <div class="container d-flex">
            <div class="nigga">
                <a class="btn btn-success" href="dashboard.php?page=tambah_member"><i class="fa-solid fa-plus"></i>Tambah Data Member</a>
            </div>
        </div>

        <!-- Tabel Data -->

        <div class="container mt-4">
            <table class="table table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Telp</th>
                    <th colspan="2">Aksi</th>
                </tr>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM tb_member");
                echo mysqli_error($koneksi);
                while($baris = mysqli_fetch_assoc($query)){
                ?>
                <tr>
                    <td><?= $baris['id']; ?></td>
                    <td><?= $baris['nama']; ?></td>
                    <td><?= $baris['alamat']; ?></td>
                    <td><?= $baris['jenis_kelamin']; ?></td>
                    <td><?= $baris['tlp']; ?></td>
                    <td>
                        <a class="btn btn-warning" onclick="return confirm('apakah ingin mengedit data member?')" href="dashboard.php?page=edit_member&id=<?= $baris['id'];?>">Edit</a>
                    </td>
                    <?php
                    $id = $baris['id'];
                    $hide_delete1 = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_member INNER JOIN tb_transaksi ON tb_member.id=tb_transaksi.id_member WHERE tb_member.id='$id'"));
                    if($hide_delete1[0]=='0'){
                    ?>
                    <td>
                        <a class="btn btn-danger" onclick="return confirm('apakah ingin menghapus data member?')" href="../member/delete_member.php?id=<?=$baris['id']?>">Delete</a>
                    </td>
                    <?php
                    }else{
                        echo "<td></td>";
                    }
                    ?>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>

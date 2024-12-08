
    <!-- Tabel Paket -->

    <div class="container mt-4">
        <div class="container d-flex">
            <div class="nigga">
                <a class="btn btn-success" href="dashboard.php?page=tambah_register_pelanggan">+ Tambah Data Pelanggan</a>
            </div>
        </div>

        <!-- Tabel Data -->

        <div class="container mt-4" style="text-align: center;">
            <table class="table table-bordered">
                <!-- Pake isi di tb_member -->
                <tr>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis kelamin</th>
                    <th>No Telp</th>
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
                        <a class="btn btn-warning" onclick="return confirm('apakah ingin mengedit data pelanggan?')" href="dashboard.php?page=edit_register_pelanggan&id=<?= $baris['id'];?>"><i class="fa-solid fa-gear" style="margin-right: 5px;"></i>Edit</a>
                    </td>
                    <?php
                        $id = $baris['id'];
                        $result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_transaksi ON tb_outlet.id = tb_transaksi.id_outlet WHERE tb_transaksi.id_member = '$id'");
                        if ($result) {
                            $hide_delete = mysqli_fetch_row($result);
                            if ($hide_delete['0'] == 0) {
                        ?>
                        <td class="text-center">
                            <a class="btn btn-danger btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" href="../register_pelanggan/delete_register_pelanggan.php?id=<?= $baris['id']; ?>" ><i class="fa-regular fa-trash-can" style="margin-right: 5px;"></i>Hapus</a>
                        </td>
                        <?php
                            } else {
                                echo "<td></td>";
                            }
                        } else {
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

<!-- Tabel Paket -->

<div class="container mt-4">
    <div class="container d-flex">
        <div class="nigga">
            <a class="btn btn-success" href="dashboard.php?page=tambah_paket">+ Tambah Data Paket</a>
        </div>
    </div>

    <!-- Tabel Data -->

    <div class="container mt-4">
        <table class="table table-bordered">
            <tr style="text-align: center;">
                <th>Id</th>
                <th>Nama Outlet</th>
                <th>Jenis</th>
                <th>Nama Paket</th>
                <th>Harga</th>
                <th colspan="2" style="width: 100px;">Aksi</th>
            </tr>
            <?php
            $no = 1;
            include "../koneksi.php";
            $query = mysqli_query($koneksi, "SELECT tb_paket.id as id_paket, tb_outlet.nama as nama_outlet, nama, jenis, nama_paket, harga FROM tb_paket INNER JOIN tb_outlet ON tb_paket.id_outlet=tb_outlet.id ORDER BY tb_paket.id");
            
            echo mysqli_error($koneksi);
            while($baris = mysqli_fetch_assoc($query)){
            ?>
            <tr style="text-align: center;">
                <td><?= $baris['id_paket']?></td>
                <td><?= $baris['nama_outlet']; ?></td>
                <td><?= $baris['jenis']; ?></td>
                <td><?= $baris['nama_paket']; ?></td>
                <td><?= $baris['harga']; ?></td>
                <td>
                    <a class="btn btn-warning" onclick="return confirm('apakah ingin mengedit data paket?')" href="dashboard.php?page=edit_paket&id=<?= $baris['id_paket'];?>"><i class="fa-solid fa-gear" style="margin-right: 2px;"></i> Edit</a>
                </td>
                <?php
                $id = $baris['id_paket'];

                // Check for dependent transactions in `tb_detail_transaksi`
                $has_transactions = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_detail_transaksi WHERE id_paket='$id'"));

                // Check for dependent outlet references in `tb_outlet` and `tb_user`
                $has_outlet_references = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_user ON tb_outlet.id=tb_user.id_outlet WHERE tb_outlet.id='$id'"));

                // Check for dependent outlet references in `tb_outlet` and `tb_transaksi`
                $has_transaksi_references = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_transaksi ON tb_outlet.id=tb_transaksi.id_outlet WHERE tb_outlet.id='$id'"));

                // Conditionally display the delete button based on foreign key constraints
                if (!$has_transactions[0] && !$has_outlet_references[0] && !$has_transaksi_references[0]) {
                ?>
            <td>
                <a class="btn btn-danger" onclick="return confirm('apakah ingin menghapus data paket?')" href="../paket/delete_paket.php?id=<?=$baris['id_paket']?>"><i class="fa-regular fa-trash-can" style="margin-right: 5px;"></i> Delete</a>
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


    <!-- Tabel Paket -->

    <div class="container mt-4">
        <div class="container d-flex">
            <div class="nigga">
                <a class="btn btn-success" href="dashboard.php?page=tambah_transaksi">+ Tambah Data Transaksi</a>
            </div>
        </div>

        <!-- Tabel Data -->

        <div class="container mt-4">
            <table class="table table-bordered">
                <tr>
                    <th>Kode Invoice</th>
                    <th>Nama Member</th>
                    <th>Nama Outlet</th>
                    <th>Tgl</th>
                    <th>Batas Waktu</th>
                    <th>Tgl Bayar</th>
                    <th>Status</th>
                    <th>Dibayar</th>
                    <th colspan="2">Aksi</th>
                </tr>
                <?php
                $query = mysqli_query($koneksi, "SELECT tb_outlet.nama as nama_outlet, tb_member.nama as nama_member, tb_user.name as nama_user, tb_outlet.id as id_outlet, tb_transaksi.id as id_transaksi, kode_invoice, tb_member.id as id_member, tgl, batas_waktu, tgl_bayar, biaya_tambahan, diskon, pajak, status, dibayar, tb_user.id as id_user FROM tb_transaksi INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id INNER JOIN tb_member on tb_transaksi.id_member=tb_member.id INNER JOIN tb_user on tb_transaksi.id_user=tb_user.id");

                echo mysqli_error($koneksi);
                while($baris = mysqli_fetch_assoc($query)){
                ?>
                <tr>
                    <td><?= $baris['kode_invoice']; ?></td>
                    <td><?= $baris['nama_member']; ?></td>
                    <td><?= $baris['nama_outlet']; ?></td>
                    <td><?= $baris['tgl']; ?></td>
                    <td><?= $baris['batas_waktu']; ?></td>
                    <td><?= $baris['tgl_bayar']; ?></td>
                    <td><?= $baris['status']; ?></td>
                    <td><?= $baris['dibayar']; ?></td>
                    <td>
                    <a class="btn btn-success" href="dashboard.php?page=detail_transaksi&id=<?= $baris['id_transaksi'];?>">Detail Transaksi</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>

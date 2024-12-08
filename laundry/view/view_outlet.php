
        <!-- Navbar -->

        <!-- konten -->
        <?php
            switch(@$_GET['page']){
                case 'outlet':
                include_once "view_outlet.php";   
                break;
            }
        ?>

        <!-- Tombol Tambah Outlet -->

    <div class="container mt-4">
        <div class="container d-flex">
            <div class="nigga">
                <a class="btn btn-success" href="dashboard.php?page=tambah_outlet">+ Tambah Data Outlet</a>
            </div>
        </div>

        <!-- Tabel Data -->

        <div class="container mt-4">
            <table class="table table-bordered">
                <tr style="text-align: center;">
                    <th href="dashboard.php">Id</th>
                    <th>Nama Outlet</th>
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th colspan="2" style="width: 100px">Aksi</th>
                </tr>
                <?php
                include "../koneksi.php";
                $query = mysqli_query($koneksi, "SELECT * FROM tb_outlet");
                echo mysqli_error($koneksi);
                while($baris = mysqli_fetch_assoc($query)){
                ?>
                <tr style="text-align: center;">
                    <td><?= $baris['id']; ?></td>
                    <td><?= $baris['nama']; ?></td>
                    <td><?= $baris['alamat']; ?></td>
                    <td><?= $baris['tlp']; ?></td>
                    <td>
                        <a class="btn btn-warning" onclick="return confirm('apakah ingin mengedit data outlet?')" href="dashboard.php?page=edit_outlet&id=<?= $baris['id'];?>"><i class="fa-solid fa-gear" style="margin-right: 5px;"></i>Edit</a>
                        
                    </td>
                    <?php
                    $id = $baris['id'];
                    $hide_delete1 = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_user ON tb_outlet.id=tb_user.id_outlet WHERE tb_outlet.id='$id'"));
                    $hide_delete2 = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_paket ON tb_outlet.id=tb_paket.id_outlet WHERE tb_outlet.id='$id'"));
                    $hide_delete3 = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_transaksi ON tb_outlet.id=tb_transaksi.id_outlet WHERE tb_outlet.id='$id'"));
                
                    if($hide_delete1[0]=='0' && $hide_delete2[0]=='0' && $hide_delete3[0]=='0'){
                    ?>
                    <td>
                        <a class="btn btn-danger" onclick="return confirm('apakah ingin menghapus data outlet?')" href="../delete/delete_outlet.php?id=<?=$baris['id']?>"><i class="fa-regular fa-trash-can" style="margin-right: 5px;"></i>Delete</a>
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

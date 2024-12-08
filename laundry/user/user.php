<?php
// Establish connection to the database
include "../koneksi.php";

// Check if the user is an admin
$isAdmin = true;  // Assume $isAdmin is determined earlier in the script

?>

<div class="container mt-4">
    <div class="container d-flex">
        <div class="nigga">
            <a class="btn btn-success" href="dashboard.php?page=tambah_user"><i class="fa-solid fa-plus"></i> Tambah Data User</a>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="container mt-4">
        <table class="table table-bordered" style="text-align: center;">
            <tr>
                <th>Id Outlet</th>
                <th>Nama Outlet</th>
                <th>Nama User</th>
                <th>Username</th>
                <th>Role</th>
                <th colspan="2">Aksi</th>
            </tr>
            <?php
            $query = mysqli_query($koneksi, "SELECT tb_outlet.id as id_outlet, tb_outlet.nama as nama_outlet, tb_user.name as nama_user, username, role, tb_user.id as user_id FROM tb_user INNER JOIN tb_outlet ON tb_user.id_outlet = tb_outlet.id");

            // $query_user = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_transaksi WHERE id_user = '".$baris['user_id']."'");
            
            if (!$query) {
                echo "<tr><td colspan='7'>Error in query: " . mysqli_error($koneksi) . "</td></tr>";
            } else if (mysqli_num_rows($query) > 0) {
                while ($baris = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($baris['id_outlet']); ?></td>
                        <td><?= htmlspecialchars($baris['nama_outlet']); ?></td>
                        <td><?= htmlspecialchars($baris['nama_user']); ?></td>
                        <td><?= htmlspecialchars($baris['username']); ?></td>
                        <td><?= htmlspecialchars($baris['role']); ?></td>
                        <td>
                            <a class="btn btn-warning" onclick="return confirm('Apakah Anda ingin mengedit data user?')" href="dashboard.php?page=edit_user&id=<?= $baris['user_id']; ?>"><i class="fa-solid fa-gear" style="margin-right: 5px;"></i>Edit</a>
                        </td>
                        <?php
                        $id = $baris['id_outlet'];
                        $hide_delete1 = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_transaksi WHERE id_user = '".$baris['user_id']."'"));
                        if($hide_delete1['total']=='0'&&$_SESSION['username']!=$baris['username']){
                        ?>
                    <td>
                    <a class="btn btn-danger" onclick="return confirm('apakah ingin menghapus data user?')" href="../user/delete_user.php?id=<?=$baris['user_id']?>"><i class="fa-regular fa-trash-can" style="margin-right: 5px;"></i> Delete</a>
                    </td>
                    <?php
                        }else{
                            echo "<td></td>";
                        }
                        ?>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='7'>No records found.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

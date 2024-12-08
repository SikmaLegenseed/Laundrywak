<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style.css">
    <style>
        select {
        width: 100%;
        padding: 15px;
        margin-bottom: 20px;
        font-size: 16px;
        border: none;
        border-bottom: 1px solid #333;
        outline: none;
        background: transparent; /* Warna latar belakang */
        color: #fff;
    }

    select:focus {
        border-bottom: 1px solid #53bd84;
    }

    select::placeholder {
        color: transparent;
    }

    select + i {
        position: absolute;
        bottom: 20px;
        left: 0;
        font-size: 24px;
        color: #fff;

    }

    select, option{
        border-radius: 10px;
        border: 2px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(20px);
        background: #333;
    }
    </style>
</head>
<body>
    <center>
        <form action="proses_register.php" method="POST">
        <div class="wrapper">
            <h1>REGISTER</h1>
            <form action="">
                <div class="input-box">
                    <input type="text" placeholder="Nama" name="nama" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Username" name="username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="password" required>
                    <i class='bx bxs-lock' ></i>
                </div>
                <div class="input-box">
                    <select name="outlet" id="">
                        <?php
                        include "koneksi.php";
                        $query2 = mysqli_query($koneksi, "SELECT * FROM tb_outlet");
                        while($baris = mysqli_fetch_assoc($query2)){
                        ?>
                        <option value="<?=$baris['id']?>"><?=$baris['nama']?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <i class='bx bx-current-location' ></i>
                </div>
                <div class="input-box">
                    <select name="roles" id="">
                        <option>admin</option>
                        <option>kasir</option>
                        <option>owner</option>
                    </select>
                    <i class='bx bxs-crown'></i>
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
        </div>
        </form>
    </center>
</body>

</html>
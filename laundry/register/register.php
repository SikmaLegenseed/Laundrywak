<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f0f0f0;
        /* Background color for the entire page */
    }

    h1 {
        margin-bottom: 20px;
    }

    #all {
        width: 95%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    #title {
        color: #007BFF;
        /* Blue as the primary color */
    }

    #form {
        width: 50%;
        padding: 20px;
        border-radius: 10px;
        background-color: #ffffff;
        /* White background */
        box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.2), -4px -4px 8px rgba(255, 255, 255, 0.5);
        /* Neumorphism shadow */
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-family: 'Poppins';
        font-weight: bold;
        color: #007BFF;
        /* Blue as the label color */
    }

    input[type="text"],
    input[type="number"],
    select,
    textarea {
        width: 95%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
        background-color: #f0f0f0;
        /* Light gray background for input fields */
    }

    textarea {
        resize: vertical;
    }

    input[type="submit"] {
        background-color: #007BFF;
        /* Blue as the submit button background color */
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease;
        /* Smooth transition */
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
        /* Darker blue on hover */
    }
    </style>
</head>

<body>
    <div id="all">
        <h1 id="title">Register</h1>
        <form action="proses_register_enkripsi.php" method="post" id="form">
            <!-- <label for="id_obat">ID Obat:</label>
            <input type="text" id="id_obat" name="id_obat" required> -->
         <tr>
            <td>Nama Lengkap</td>
            <td><input type="text" name="nama_lengkap"></td>
         </tr>
         <tr>
            <td>Username</td>
            <td><input type="text" name="username"></td>
         </tr>
         <tr>
            <td>Password</td>
            <td><input type="text" name="password"></td>
         </tr>
         <tr>
            <td>Outlet</td>
            <td>
                <select name="id_outlet" id="">
                    <?php
                    include_once "../koneksi.php";
                    $query = mysqli_query($koneksi, "SELECT * FROM tb_outlet");
                    while($hasil = mysqli_fetch_assoc($query)){ 
                    ?>
                <option value="<?=$hasil['id'];?>"><?=$hasil['nama'];?></option>
                <?php
                    }
                ?>
              </select> 
            </td>
         </tr>
         <tr>
            <td>Level User</td>
            <td>
                <select name="role" id="">
                <option value="admin">Admin</option>
                <option value="kasir">Kasir</option>
                <option value="owner">Owner</option>

              </select> 
            </td>
         </tr>
         <tr>
            <td></td>
            <center>
            <td><input type="submit" value="Register"></td>
            </center>
         </tr>
        </form>
    </div>
</body>

</html>
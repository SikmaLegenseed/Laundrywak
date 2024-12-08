<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <center>
        <form action="proses_login_dekripsi.php" method="POST">
        <div class="wrapper">
            <h1>LOGIN</h1>
            <form action="">
                <div class="input-box">
                    <input type="text" placeholder="Username" name="username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="password" required>
                    <i class='bx bxs-lock' ></i>
                </div>

                <!-- <div class="remember-forgot">
                    <a href="#">Forgot Password?</a>
                </div> -->

                <button type="submit" class="btn">Login</button>
                <!-- <div class="register-link">
                    <p>Don't have an account?<a href="register.php"> Register</a></p>
                </div> -->
            </form>
        </div>
        </form>
    </center>
</body>

</html>
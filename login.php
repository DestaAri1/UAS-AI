<?php
    session_start();
    include "Saw.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style_login.css">
</head>
<body>
    <div id="main">
        <img src="../Pemweb/pic/user.png">
        <h1>LOGIN</h1>

    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="password" name="password" placeholder="Password" minlength="6" max="32"><br>
        <button type="submit" name="login">Login</button><br>
        <a type="submit" href="buat_akun.php">Buat Akun</a>
    </form><br> 

    <?php
        if(isset($_POST['login'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $qry = mysqli_query($koneksi,"SELECT * FROM buat_akun WHERE username = '$username' AND 
            password = '$password'");
            $cek = mysqli_num_rows($qry);
            if ($cek==1) {
                $_SESSION['userweb']=$username;
                header("location:index.php");
                exit;
            } else {
                echo "<h1>Maaf username dan/atau password anda salah<h1>";
            }
    }
    ?>
    </div>
</body>
</html>
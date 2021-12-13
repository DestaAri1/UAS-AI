<?php
    session_start();
    include "Saw.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Buat Akun</title>
        <link rel="stylesheet" type="text/css" href="css/buat_akun.css">
    </head>
    <body>
        <div id="main">
            <h1>Buat Akun</h1>
               
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><input type="text" name="nama"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><input type="text" name="username"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><input type="password" name="password" minlength="6" max="32"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Simpan" name="proses"></td>
                        <td><input type="submit" value="Kembali" name="kembali"></td>
                    </tr>
                </table>
            </form>
                <?php
                if(isset($_POST['proses'])) {
                    $nama = $_POST['nama'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    mysqli_query($koneksi, "INSERT INTO buat_akun VALUES (
                        '$nama','$username','$password')") or die(mysqli_error($koneksi));

                        echo "<div align='center'><h2> Silahkan Tunggu... <h2><div>";
                        echo "<meta http-equiv='refresh' content='3;url=http://localhost/Pemweb/login.php'>";
                }else if(isset($_POST['kembali'])) {
                    echo "<div align='center'><h2> Silahkan Tunggu... <h2><div>";
                    echo "<meta http-equiv='refresh' content='3;url=http://localhost/Pemweb/login.php'>";
                }
                ?>
        </div>
    </body>
</html>
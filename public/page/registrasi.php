<?php

require '../../src/functions/functions.php';

if(isset($_POST["registrasi"])) {
    if(registrasi($_POST) > 0) {
        echo "<script> 
                alert('user baru di tambahkan');
            </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../src/style/login.css">
    <style>
        .to-login {
            color:blue;
        }
    </style>
    <title>Registrasi</title>
</head>
<body class="flex justify-center items-center flex-col h-screen">
    <h1 class="text-xl font-bold">Registrasi</h1>
    <form action="" method="post" class="regis-form">
        <ul class="flex flex-col gap-5">
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="username">
            </li>
            <li>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="email">
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="password">
            </li>
            <li>
                <label for="confirm">Konfirmasi Password</label>
                <input type="password" name="confirm" id="confirm" placeholder="confirm">
            </li>
            <li class="mt-2">
                <button type="submit" name="registrasi" class="py-3 px-5 bg-green-500 text-white">Registrasi</button>
            </li>
            <li>
                <p>Jika sudah punya akun 
                    <a href="./login.php" class="text-blue-500 to-login">login disini !</a> 
                </p>
            </li>
        </ul>
    </form>
</body>
</html>
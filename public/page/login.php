<?php
session_start();

require '../../src/functions/functions.php';


if( isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username id nya
    $result = mysqli_query($conn, "SELECT username FROM user_db WHERE id = $id");

    $word = mysqli_fetch_assoc($result);

    // cek cookie dengan username
    if($key === hash('sha256', $word['username'])){
        $_SESSION['login'] = true;
    }
}


if(isset($_SESSION["login"])) {
    header("Location: ./index.php");
    exit;
}


if(isset($_POST["login"])) {
    global $conn;

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user_db where username = '$username' ");

    if(mysqli_num_rows($result) === 1 ) {

        $word = mysqli_fetch_assoc($result);

        if (password_verify($password, $word["password"])) {

            $_SESSION["login"] = true;

            // cek remember me
            $expiryTime = time() + 60;
            if(isset($_POST["remember"])) {
                setcookie('id', $word['id'], $expiryTime);
                setcookie('key', hash('sha256', $word['username']), $expiryTime);
            }

            header("Location: ./index.php");
            exit;
        }
    }

    $error = true;

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
        .to-registrasi{
            color:blue;
        }
    </style>
    <title>Login</title>
</head>
<body class="flex justify-center items-center flex-col h-screen">
    <h1 class="text-xl font-bold">Login</h1>
    <?php if (isset($error)) : ?>
        <p>jangan asal masukkan kua di sanan kenapa rupanya</p>
    <?php endif ; ?>
    <form action="" method="post" class="regis-form">
        <ul class="flex flex-col gap-4 justify-center items-center">
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="username" class="input-log">
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="password" class="input-log">
            </li>
            <div class="pt-3 flex items-center" style="padding-top:5px;">
                <label for="remember" style="margin-right:10px;">Remember me</label>
                <input type="checkbox" name="remember" id="remeber"> 
            </div>
            <li class="mt-2">
                <button type="submit" name="login" class="py-3 px-5 bg-green-500 text-white">Login</button>
            </li>
        </ul>
    </form>
    <p class="pt-5" >Jika belum punya akun 
        <a href="./registrasi.php" class="to-registrasi text-blue-500">registrasi disini !</a> 
    </p>
</body>
</html>
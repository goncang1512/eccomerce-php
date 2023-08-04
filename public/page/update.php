
<?php

session_start();

if(!isset($_SESSION["login"])) {
  header("Location: ./login.php");
  exit;
}

require '../../src/functions/functions.php';

$id = $_GET["id"];

$product = query("SELECT  * FROM products_db WHERE id = $id")[0];

if(isset($_POST["submit"])) {
    // cek apakah data sudah berhasil di ubah
    if (update($_POST) > 0 ) {
        echo "
        <script>
            alert('data berhasil di update');
            document.location.href = './dasboard.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal di update');
            document.location.href = './dasboard.php';
        </script>
        ";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="icon"
      type="image/svg+xml"
      href="../assets/shopping-bag.svg"
    />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../src/style/index.css">
    <link rel="stylesheet" href="../../src/style/upload.css">
    <title>Document</title>
</head>
<body>

 <!-- NAVIGATION BAR -->
 <nav
      class="flex bg-green-500 items-center text-zinc-50 justify-between px-9 h-14 sticky top-0 z-50"
    >
      <ul class="navbar-menu flex w-screen justify-evenly">
        <li class="hover:text-zinc-500">
          <a class="cursor-pointer p-2" href="">Home</a>
        </li>
        <li class="hover:text-zinc-500">
          <a
            class="hover:text-zinc-500"
            href="../../index.php"
            >Store</a
          >
        </li>
        <li class="hover:text-zinc-500">
          <a class="text-base" href="">Profil</a>
        </li>
        <li class="text-base bg-amber-400 py-1 px-5 rounded-lg text-green-600">
          <a class="text-base" href="">Dasboard</a>
        </li>
      </ul>

      <div class="hum-toggle">
        <input type="checkbox" class="checkbox" id="checkbox" />
        <label for="checkbox" class="toggle-list">
          <div class="bars" id="bar1"></div>
          <div class="bars" id="bar2"></div>
          <div class="bars" id="bar3"></div>
        </label>
      </div>
    </nav>

    <!-- LEft navigation -->
    <nav class="h-screen border-r flex w-56 flex justify-center items-center fixed">
        <ul class="h-full  flex justify-center items-center flex-col gap-10 text-3xl">
            <li class="hover:bg-stone-100 py-3 px-5 rounded-lg"><a href="./dasboard.php">Daftar</a>
            </li>
            <li class="hover:bg-stone-100 py-3 px-5 rounded-lg"><a href="./upload.php">Upload</a>
            </li>
            <li class="hover:bg-stone-100 py-3 px-5 rounded-lg"><a href="">Pesanan</a>
            </li>
            <li class="hover:bg-stone-100 py-3 px-5 rounded-lg"><a href="../../src/functions/logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <section class="ml-64 pt-5">
        <form action="" method="post" class="flex" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product["id"]?>">
        <input type="hidden" name="imageOld" value="<?= $product["image"]?>">
            <div class="mr-20">
            <img src="../img/<?= $product["image"];?>" alt="" id="previewImage" class="w-56 h-72 object-cover">
            </div>
            <ul class="form-upload">
                <li>
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Title" value="<?= $product["title"]?>">
                </li>
                <li>
                    <label for="category">Category</label>
                    <input type="text" name="category" id="category" placeholder="Category" value="<?= $product["category"]?>">
                </li>
                <li>
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" placeholder="Description" value="<?= $product["description"]?>">
                </li>
                <li>
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" placeholder="Price" value="<?= $product["price"]?>">
                </li>
                <li>
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" placeholder="Image" value="<?= $product["image"]?>">
                </li>
                <li>
                    <label for="stock">Stock</label>
                    <input type="text" name="stock" id="stock" placeholder="Stock" value="<?= $product["stock"]?>" onchange="imgPreview(event)">
                </li>
                <li>
                    <button class="bg-green-500 py-2 rounded-lg text-white hover:bg-green-600" type="submit" name="submit">Upload</button>
                </li>
            </ul>
        </form>
    </section>

    <script src="../../src/script/index.js"></script>
    <script src="../../src/script/dasboard.js"></script>
</body>
</html>
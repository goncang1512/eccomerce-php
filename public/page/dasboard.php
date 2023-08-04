<?php

session_start();

if(!isset($_SESSION["login"])) {
  header("Location: ./login.php");
  exit;
}

require '../../src/functions/functions.php';

$products = query("SELECT * FROM products_db ORDER BY id DESC");

// tombol cari di klik
if(isset($_POST["search"])){
  $products = searchDas($_POST["keyword"]);
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../src/style/index.css">
    <title>Dasboard</title>
    <style>
      .input-dasboard {
          padding-left:20px;
      }
    </style>
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
            href="./index.php"
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


    <!-- left navigation -->
    <div class="h-screen border-r flex-col flex w-60 flex justify-center items-center fixed">
      <div class="w-full flex justify-center items-center">
        <form action="" method="post" class="flex flex-col justify-center items-center w-60 relative">
          <input type="text" placeholder="search" class="input-dasboard w-60 py-2 border relative outline-none" name="keyword"
            autofocus autocomplete="off">
          <label
                for="search"
                class="flex items-center justify-center"
                id="search"
            >
                <button class="absolute right-3 top-2" id="searchButton" type="submit" name="search">
                <span class="material-symbols-outlined"> search </span>
                </button>
            </label>
        </form>
      </div>
        <ul class="h-full  flex justify-center items-start flex-col gap-10 text-3xl">
            <li class="hover:bg-stone-100 py-3 px-5 rounded-lg"><a href="">Daftar</a>
            </li>
            <li class="hover:bg-stone-100 py-3 px-5 rounded-lg"><a href="./upload.php">Upload</a>
            </li>
            <li class="hover:bg-stone-100 py-3 px-5 rounded-lg"><a href="">Pesanan</a>
            </li>
            <li class="hover:bg-stone-100 py-3 px-5 rounded-lg"><a href="../../src/functions/logout.php">Logout</a>
            </li>
        </ul>
      </div>

    <section class="ml-64 pt-5">
        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
                </thead>
                <tbody class="h-full">
                <?php $i = 1;?>
                <?php foreach($products as $product) : ?>
                <tr>
                    <th><?= $i;?></th>
                    <td> 
                        <img src="../img/<?= $product["image"];?>" alt="gak bisa di lihat" class="w-24 h-24" />
                    </td>
                    <td><?= $product["title"];?></td>
                    <td><?= $product["category"];?></td>
                    <td>Rp. <?= number_format($product["price"], 0, ',', '.');?></td>
                    <td><?= $product["stock"];?></td>
                    <td class="flex flex-col justify-center mt-2">
                        <a class="hover:text-blue-500 w-16 bg-amber-400 w-full text-center rounded-lg py-2 px-3 text-white" href="./update.php?id=<?= $product["id"];?>">Update</a> <br>
                        <a class="hover:text-blue-500 w-16 bg-red-500 w-full text-center rounded-lg py-2 px-3 text-white" href="../../src/functions/delete.php?id=<?= $product["id"]?>" onclick="return confirm('yakin?');">Delete</a>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach ; ?>
                </tbody>
            </table>
        </div>
    </section>

    <script src="../../src/script/index.js"></script>
</body>
</html>
<?php
session_start();

if( !isset($_SESSION["login"])) {
  header("Location: ./login.php");
  exit;
}

require '../../src/functions/functions.php';

$products = query("SELECT * FROM products_db ORDER BY id DESC");

// tombol cari di klik
if(isset($_POST["search"])){
  $products = search($_POST["keyword"]); 
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
    <link rel="stylesheet" href="../../src/style/store.css">
    <title>Store</title>
</head>
<body>

    <!-- header search -->
    <nav class="flex justify-between items-center gap-5 h-24 bg-green-600">
        <div class="flex justify-between mx-12 md:w-2/4 w-1/6">
            <h1 class="items-center text-3xl text-zinc-50 md:flex hidden">
            Goncang samudera
            </h1>
            <div class="flex items-center">
            <a href=""
                ><button class="relative">
                <img
                    src="../assets/cart.svg"
                    alt=""
                    class="w-14 object-cover"
                />
                </a>
            </div>
        </div>

        <!-- input search -->
        <form
            class="flex justify-center md:w-2/4 w-10/12 rounded-lg overflow-hidden md:mx-12 mx-0 items-center pr-5 bg-white relative mr-5"
            action=""
            method="post"
        >
            <input
            class="h-11 px-5 text-lg w-full outline-none text-black bg-white"
            type="text"
            placeholder="Search"
            id="searchInput"
            name="keyword"
            autofocus autocomplete="off"
            />
            <div class="bg-transparent mr-4">
            <label
                for="search"
                class="flex items-center justify-center"
                id="search"
            >
                <button class="absolute right-3" id="searchButton" type="submit" name="search">
                <span class="material-symbols-outlined"> search </span>
                </button>
            </label>
            </div>
          </form>
    </nav>

    <!-- navigation -->
    <nav
      class="flex bg-green-500 items-center text-zinc-50 justify-between px-9 h-14 sticky top-0 z-50"
    >
      <ul class="navbar-menu  flex w-screen justify-evenly">
        <li class="hover:text-zinc-500">
          <a class="cursor-pointer p-2" href="">Home</a>
        </li>
        <li class="hover:text-zinc-500">
          <a
            class="text-base bg-amber-400 py-1 px-5 rounded-lg text-green-600"
            href=""
            >Store</a
          >
        </li>
        <li class="hover:text-zinc-500">
          <a class="text-base" href="">Profil</a>
        </li>
        <li class="hover:text-zinc-500">
          <a class="text-base" href="./dasboard.php">Dasboard</a>
        </li>
        <li class="hover:text-zinc-500">
          <a class="text-base" href="../../src/functions/logout.php">Logout</a>
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


    <!-- SECTION PRODUCT -->
    <section class="py-5 md:px-28 px-5 flex items-center justify-center gap-5 flex-wrap bg-green-600" >
        <?php foreach($products as $product) : ?>
            <div class="card md:w-80 w-full shadow-xl bg-base-100 shadow-xl">
                <figure>
                    <img src="../img/<?= $product["image"];?>" alt="<?= $product["title"];?>" class="w-full h-96 object-cover object-center" />
                </figure>
                <div class="card-body flex">
                    <h2 class="card-title"><?= $product["title"];?></h2>
                    <p class="card-text"><?= $product["description"];?></p>
                    <div class="card-actions justify-between items-center py-5">
                        <p class="text-md">Rp. <?= number_format($product["price"], 0, ',', '.');?></p>
                        <button class="btn btn-warning text-white">Buy Now</button>
                    </div>
                </div>
            </div>
        <?php endforeach ; ?>
    </section>

    <script src="../../src/script/index.js"></script>
    <script src="../../src/script/store.js"></script>
</body>
</html>
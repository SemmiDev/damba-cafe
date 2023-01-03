<?php error_reporting(0); ?>

<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <link href="./style.css" rel="stylesheet">
</head>

<body>
  <main class="min-h-screen px-24 pb-12 mx-auto bg-gradient-to-b from-red-100 to-white">

    <!-- navbar -->
    <div class="text-red-500 bg-transparent navbar">
      <div class="flex-1">
        <a href="index.php">
          <img src="images/logo.png" class="w-20">
        </a>
      </div>
      <div class="flex-none">
        <ul class="px-1 font-semibold menu menu-horizontal">
          <li><a href="index.php">Home</a></li>
          <li><a href="index.php#about" class="text-gray-500">About</a></li>
          <li><a href="menu.php" class="text-gray-500">Menu</a></li>
          <li><a href="index.php#footer" class="text-gray-500">Contact</a></li>
        </ul>
      </div>
    </div>
    <!-- end navbar -->

    <!-- hero -->
    <section class="grid grid-cols-2 mt-12 place-items-center">
      <div class="">
        <h1 class="max-w-lg my-3 text-5xl font-semibold">Enjoy Your Day With Our Speciality</h1>
        <p class="max-w-lg mb-5 font-semibold text-gray-400">Get a special menu to enjoy your day with your friends and end the day with our best food and drink dishes</p>
        <a href="menu.php" class="max-w-lg px-3 py-2 text-white bg-red-600 rounded-full shadow-lg shadow-red-500/50">Order Now</a>
      </div>
      <div class="flex justify-center">
        <img src="./images/drink.png" class="w-[80%]">
      </div>
    </section>
    <!-- end hero -->

    <!-- About -->
    <section class="grid grid-cols-2 mt-12 place-items-center" id="about">

      <div class="flex justify-center">
        <img src="./images/about.png" class="w-[70%]">
      </div>
      <div class="">
        <h1 class="max-w-lg my-3 text-5xl font-semibold">About Damba Cafe</h1>
        <p class="max-w-lg mb-5 font-semibold text-gray-400">Damba Cafe adalah tempat yang cocok untuk kamu habiskan waktu dengan bersantai menyantap menu special yang akan kami sajikan dari ahli chef terbaik kami</p>
      </div>
    </section>
    <!-- end About -->


    <?php

    include 'config.php';

    $sql = "SELECT * FROM menu LIMIT 8";
    $result = mysqli_query($conn, $sql);
    $menu = mysqli_fetch_all($result, MYSQLI_ASSOC);

    ?>

    <!-- special menu -->
    <section>
      <h1 class="my-12 mb-32 text-5xl font-semibold text-center">Our Speciality Menu</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-24 place-items-center">
        <?php foreach ($menu as $key => $value) { ?>
          <div class="relative p-5 border border-red-500 shadow-2xl w-72 border-1 rounded-2xl shadow-red-500/70">
            <div class="absolute top-[-64px] left-0 right-0  mx-auto flex items-center justify-center w-32 h-32 bg-red-500 rounded-full">
              <img src="./upload/<?= $value['image'] ?>" class="w-40 p-2">
            </div>
            <h2 class="mt-12 font-semibold text-center text-black"><?= $value['name'] ?></h2>
            <p class="mb-3 text-sm text-center text-gray-400 break-all"><?= $value['description'] ?></p>
            <div class="flex items-center justify-evenly">
              <div class="p-1 text-sm border rounded-full border-1 ">
                <p class="text-xs text-center text-gray-400">IDR</p>
                <p class="text-sm font-semibold text-center text-red-500"><?= $value['price'] ?></p>
              </div>
              <div>
                <a href="menu.php" class="max-w-lg px-4 py-3 text-xs text-white bg-red-600 rounded-full">Order Now</a>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>


    </section>
    <!-- end special menu -->

    <section class="flex items-center justify-center my-12">
      <a href="menu.php" class="mx-auto text-xs rounded-full btn btn-outline btn-sm">Show All Menu</a>
    </section>

    <section id="footer">
      <?php include 'footer.php' ?>
    </section>
  </main>
</body>

</html>

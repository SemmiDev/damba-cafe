<?php

include 'config.php';

$filter = $_GET['filter'] ?? 'All';

$coffeeList = [];
$juiceList = [];
$nonCoffeeList = [];
$foodList = [];
$snackList = [];

if ($filter == 'Coffee' || $filter == 'All') {
    $sql = "SELECT * FROM menu WHERE category = 'Coffee'";
    $result = mysqli_query($conn, $sql);
    $coffeeList = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

if ($filter == 'Juice'  || $filter == 'All') {
    $sql = "SELECT * FROM menu WHERE category = 'Juice'";
    $result = mysqli_query($conn, $sql);
    $juiceList = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

if ($filter == 'Non Coffee'  || $filter == 'All') {
    $sql = "SELECT * FROM menu WHERE category = 'Non Coffee'";
    $result = mysqli_query($conn, $sql);
    $nonCoffeeList = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

if ($filter == 'Food'  || $filter == 'All') {
    $sql = "SELECT * FROM menu WHERE category = 'Food'";
    $result = mysqli_query($conn, $sql);
    $foodList = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

if ($filter == 'Snack'  || $filter == 'All') {
    $sql = "SELECT * FROM menu WHERE category = 'Snack'";
    $result = mysqli_query($conn, $sql);
    $snackList = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

$nonActive = "flex items-center gap-1 px-2 py-1 text-xs font-semibold text-red-500 bg-white border-2 border-red-500 rounded-xl btn-error";
$active = "flex items-center gap-1 px-2 py-1 text-xs text-white bg-red-500 border-2 border-red-500 rounded-xl btn-error";

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <link href="./style.css" rel="stylesheet">
    <script src="cart.js"></script>
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
                    <li><a href="index.php" class="text-gray-500">Home</a></li>
                    <li><a href="index.php#about" class="text-gray-500">About</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="index.php#footer" class="text-gray-500">Contact</a></li>
                </ul>
            </div>
        </div>
        <!-- end navbar -->

        <!-- hero -->
        <section class="flex flex-col w-24 gap-3 mt-8 md:w-full lg:w-full md:flex-row">
            <a href="menu.php" class="<?php echo $filter == 'All' ? $active : $nonActive ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill class="w-5 h-5"="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                All</a>

            <a href="menu.php?filter=Coffee" class="<?php echo $filter == 'Coffee' ? $active : $nonActive ?>">
                <img src="./images/coffee.png" alt="" class="w-5 h-5">
                Coffee</a>


            <a href="menu.php?filter=Juice" class="<?php echo $filter == 'Juice' ? $active : $nonActive ?>">
                <img src="./images/juice.png" alt="" class="w-5 h-5">
                Juice</a>


            <a href="menu.php?filter=Non Coffee" class="<?php echo $filter == 'Non Coffee' ? $active : $nonActive ?>">
                <img src="./images/non-coffee.png" alt="" class="w-5 h-5">
                Non Coffee</a>


            <a href="menu.php?filter=Food" class="<?php echo $filter == 'Food' ? $active : $nonActive ?>">
                <img src="./images/food.png" alt="" class="w-5 h-5">
                Food</a>

            <a href="menu.php?filter=Snack" class="<?php echo $filter == 'Snack' ? $active : $nonActive ?>">
                <img src="./images/snack.png" alt="" class="w-5 h-5">
                Snack</a>
        </section>
        <!-- end hero -->

        <!--  menu -->
        <!-- hidden if not coffe or all -->
        <section class="<?php if ($filter == 'Coffee' || $filter == 'All') {
                            echo 'block';
                        } else {
                            echo 'hidden';
                        } ?>">
            <h1 class="px-12 my-12 mb-32 text-5xl font-semibold">Choose Coffee</h1>
            <div class="flex flex-col gap-12 md:flex-row justify-evenly">
                <div class="grid w-[60%] md:grid-cols-2 grid-cols-1 gap-x-12 gap-y-24 place-items-center">
                    <?php foreach ($coffeeList as $key => $value) { ?>
                        <div class="relative w-64 p-5 border border-red-500 shadow-2xl border-1 rounded-2xl shadow-red-500/70">
                            <div class="absolute top-[-64px] left-0 right-0  mx-auto flex items-center justify-center w-32 h-32 bg-red-500 rounded-full overflow-hidden">
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
                                    <a href="menu.php" class="max-w-lg px-4 py-3 text-xs text-white bg-red-600 rounded-full" onclick="addToCart(<?= $value['id'] ?>, <?= "'" . $value['name'] . "'" ?> ,<?= $value['price'] ?>, 1)">Order Now</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="w-full max-w-xs">
                    <div class="p-5 bg-red-500 rounded-t-xl">
                        <h1 class="mb-3 font-bold text-white">Current Orders</h1>

                        <script>
                            // load from localstorage = cart
                            // if cart is empty, show empty message
                            // if cart is not empty, show cart items

                            let cart = localStorage.getItem('cart');
                            if (cart == null) {
                                cart = [];
                            } else {
                                cart = JSON.parse(cart);
                            }

                            if (cart.length == 0) {
                                document.write(`<p class="text-white">Your cart is empty</p>`);
                            } else {
                                cart.forEach((item) => {
                                    document.write(`
                                    <div class="w-full p-3 my-3 bg-white rounded-lg">
                                        <h1 class="text-xl font-bold text-black">${item.productName}</h1>
                                        <h1 class="text-xl font-semibold text-gray-400">IDR <span class="text-red-500">${item.productPrice}</span></h1>
                                        <div class="flex items-center gap-3 mt-4">
                                            <svg
                                            onClick="decreaseQty(${item.productId})"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>

                                            <p class="font-semibold">${item.qty}</p>

                                            <svg
                                            onClick="increaseQty(${item.productId})"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>

                                            <p class='text-xs text-slate-900'>Total : Rp. <span class="font-bold">${item.totalPrice}</span></p>
                                        </div>
                                    </div>
                                    `);
                                });
                            }
                        </script>
                    </div>

                    <div class="w-full text-sm bg-white shadow-2xl shadow-red-500/50 rounded-b-xl">
                        <div class="flex w-full p-3 text-sm bg-white justify-evenly">
                            <h1>Items
                                (<script>
                                    document.write(totalItem());
                                </script>)
                            </h1>
                            <h1>Total <span class="font-bold">IDR
                                    <script>
                                        document.write(totalPrice());
                                    </script>
                                </span></h1>
                        </div>
                        <div class="flex justify-center">
                            <a href="checkout.php" class="block w-1/2 px-3 py-2 m-3 text-center text-white bg-red-500 rounded-lg place-items-center">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end  menu -->

        <!--  menu -->
        <section class="<?php if ($filter == 'Juice' || $filter == 'All') {
                            echo 'block';
                        } else {
                            echo 'hidden';
                        } ?>">
            <h1 class="px-12 my-12 mb-32 text-5xl font-semibold">Choose Juice</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:md:grid-cols-3 gap-y-24 place-items-center">
                <?php foreach ($juiceList as $key => $value) { ?>
                    <div class="relative w-64 p-5 border border-red-500 shadow-2xl border-1 rounded-2xl shadow-red-500/70">
                        <div class="absolute top-[-64px] left-0 right-0  mx-auto flex items-center justify-center w-32 h-32 bg-red-500 rounded-full overflow-hidden">
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
                                <a href="menu.php" class="max-w-lg px-4 py-3 text-xs text-white bg-red-600 rounded-full" onclick="addToCart(<?= $value['id'] ?>, <?= "'" . $value['name'] . "'" ?>,<?= $value['price'] ?>, 1)">Order Now</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>


        </section>
        <!-- end  menu -->

        <!--  menu -->
        <section class="<?php if ($filter == 'Non Coffee' || $filter == 'All') {
                            echo 'block';
                        } else {
                            echo 'hidden';
                        } ?>">
            <h1 class="px-12 my-12 mb-32 text-5xl font-semibold">Choose Non Coffee</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:md:grid-cols-3 gap-y-24 place-items-center">
                <?php foreach ($nonCoffeeList as $key => $value) { ?>
                    <div class="relative w-64 p-5 border border-red-500 shadow-2xl border-1 rounded-2xl shadow-red-500/70">
                        <div class="absolute top-[-64px] left-0 right-0  mx-auto flex items-center justify-center w-32 h-32 bg-red-500 rounded-full overflow-hidden">
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
                                <a href="menu.php" class="max-w-lg px-4 py-3 text-xs text-white bg-red-600 rounded-full" onclick="addToCart(<?= $value['id'] ?>, <?= "'" . $value['name'] . "'" ?>,<?= $value['price'] ?>, 1)">Order Now</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>


        </section>
        <!-- end  menu -->


        <!--  menu -->
        <section class="<?php if ($filter == 'Food' || $filter == 'All') {
                            echo 'block';
                        } else {
                            echo 'hidden';
                        } ?>">
            <h1 class="px-12 my-12 mb-32 text-5xl font-semibold">Choose Food</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:md:grid-cols-3 gap-y-24 place-items-center">
                <?php foreach ($foodList as $key => $value) { ?>
                    <div class="relative w-64 p-5 border border-red-500 shadow-2xl border-1 rounded-2xl shadow-red-500/70">
                        <div class="absolute top-[-64px] left-0 right-0  mx-auto flex items-center justify-center w-32 h-32 bg-red-500 rounded-full overflow-hidden">
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
                                <a href="menu.php" class="max-w-lg px-4 py-3 text-xs text-white bg-red-600 rounded-full" onclick="addToCart(<?= $value['id'] ?>, <?= "'" . $value['name'] . "'" ?>,<?= $value['price'] ?>, 1)">Order Now</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>


        </section>
        <!-- end  menu -->

        <!--  menu -->
        <section class="<?php if ($filter == 'Snack' || $filter == 'All') {
                            echo 'block';
                        } else {
                            echo 'hidden';
                        } ?>">
            <h1 class="px-12 my-12 mb-32 text-5xl font-semibold">Choose Snack</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:md:grid-cols-3 gap-y-24 place-items-center">
                <?php foreach ($snackList as $key => $value) { ?>
                    <div class="relative w-64 p-5 border border-red-500 shadow-2xl border-1 rounded-2xl shadow-red-500/70">
                        <div class="absolute top-[-64px] left-0 right-0  mx-auto flex items-center justify-center w-32 h-32 bg-red-500 rounded-full overflow-hidden">
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
                                <a href="menu.php" class="max-w-lg px-4 py-3 text-xs text-white bg-red-600 rounded-full" onclick="addToCart(<?= $value['id'] ?>, <?= "'" . $value['name'] . "'" ?>,<?= $value['price'] ?>, 1)">Order Now</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </section>
        <!-- end  menu -->

        <?php include 'footer.php' ?>
    </main>
</body>

</html>

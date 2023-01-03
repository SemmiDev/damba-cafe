<?php error_reporting(0); ?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <link href="./style.css" rel="stylesheet">
    <script>
        localStorage.removeItem('cart');
    </script>
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
                    <li><a href="menu.php" class="text-gray-500">Menu</a></li>
                    <li><a href="index.php#footer" class="text-gray-500">Contact</a></li>
                </ul>
            </div>
        </div>
        <!-- end navbar -->

        <div class="flex flex-col items-center justify-center gap-3 ">
            <img src="./images/checkout-success.png">
            <h1 class="text-4xl font-bold text-black">Pesanan Berhasil</h1>
            <p class="text-sm font-semibold text-gray-500">Pesanan sedang disiapkan oleh koki</p>
            <a href="menu.php" class="px-5 py-3 text-white bg-red-700 rounded-xl">Kembali Ke Halaman Beranda</a>
        </div>

        <!-- end billing -->
        <?php include 'footer.php' ?>
    </main>
</body>

</html>

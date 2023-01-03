<?php error_reporting(0); ?>

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

    <?php $date = date('m/d/Y') ?>

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

        <!-- billing -->
        <form action="checkout-proccess.php" method="post" class="grid grid-cols-1 gap-3 mt-5 md:grid-cols-2 place-items-center">
            <div class="w-7/12 p-5 text-white bg-red-500 rounded-3xl">
                <h1 class="mb-5 text-xl font-semibold">Detail Penagihan</h1>
                <input type="text" name="customer_name" required placeholder="Nama Pemesan" class="w-full my-2 text-black bg-white hover:bg-red-300 input"><br>
                <input type="number" name="phone_number" required placeholder="Nomor Handphone" class="w-full my-2 text-black bg-white hover:bg-red-300 input"><br>
                <input type="number" name="table_number" required placeholder="Nomor Meja" class="w-full my-2 text-black bg-white hover:bg-red-300 input"><br>
                <input type="date" id="today-date" name="order_date" required placeholder="Tanggal Order" class="w-full my-2 text-black bg-white input hover:bg-red-300"><br>
                <input type="time" id="today-time" name="order_time" required placeholder="Tanggal Order" class="w-full my-2 text-black bg-white input hover:bg-red-300"><br>
                <input type="hidden" name="order_details" id="order_details">
                <input type="hidden" name="total_price" id="total_price">
            </div>
            <div class="w-full p-5 text-white bg-red-500 rounded-3xl">
                <h1 class="mb-5 text-xl font-semibold">Pesanan Anda</h1>
                <div class="p-3 overflow-x-auto bg-white rounded-xl">
                    <table class="table w-full bg-white rounded-lg table-compact">
                        <thead>
                            <tr class="border-b border-gray-500">
                                <th class="text-black bg-white">Produk</th>
                                <th class="text-black bg-white">Qty</th>
                                <th class="text-black bg-white">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <script>
                                let cart = localStorage.getItem('cart');
                                if (cart == null) {
                                    cart = [];
                                    window.location.href = "menu.php";
                                } else {
                                    cart = JSON.parse(cart);
                                }

                                cart.forEach((item) => {
                                    document.write(`
                                        <tr>
                                            <td class="text-black bg-white">${item.productName}</td>
                                            <td class="text-black bg-white">x${item.qty}</td>
                                            <td class="text-black bg-white">IDR ${item.totalPrice}</td>
                                        </tr>
                                    `)
                                })
                            </script>
                    </table>
                    <div class="flex justify-between w-full p-3 my-3 rounded-lg bg-red-100/80">
                        <h1 class="font-bold text-black">Total</h1>
                        <h1 class="font-bold text-red-700">IDR <script>
                                document.write(totalPrice())
                            </script>
                        </h1>
                    </div>


                    <div class="flex items-center my-1">
                        <input type="radio" name="billing_type" value="Tunai" class="radio radio-sm radio-secondary" checked /> <span class="ml-2 text-xs text-black">Tunai</span>
                    </div>

                    <div class="flex items-center">
                        <input type="radio" name="billing_type" value="Dana" class="radio radio-sm radio-secondary" /> <span class="ml-2 text-xs text-black">Via Dana</span>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" name="submit" class="px-16 py-2 text-white bg-red-500 rounded-xl">Pesan</button>
                    </div>

                </div>
            </div>
        </form>
        <!-- end billing -->
        <?php include 'footer.php' ?>
    </main>

    <script>
        document.getElementById('today-date').valueAsDate = new Date();
        document.getElementById('today-time').value = new Date().toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });

        let order_details = document.getElementById('order_details');
        order_details.value = localStorage.getItem('cart');

        let total_price = document.getElementById('total_price');
        total_price.value = totalPrice();
    </script>
</body>

</html>

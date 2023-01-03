<?php error_reporting(0); ?>

<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}


include 'config.php';

$id = $_GET['id'];

$sql = "SELECT * FROM orders WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$details = json_decode($row['orders_details'], true);

?>

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
        <?php include 'sidebar.php' ?>
        <div class="ml-[280px] p-5">

            <h1 class="mb-16 text-4xl font-bold text-black">Detail Pesanan</h1>
            <!-- billing -->
            <form action="checkout-proccess.php" method="post" class="grid grid-cols-2 mt-5 place-items-baseline">
                <div class="w-7/12 p-5 text-white bg-red-500 rounded-3xl">
                    <h1 class="mb-5 text-xl font-semibold">Detail Penagihan</h1>
                    <input type="text" disabled value="<?= $row['customer_name'] ?>" name="customer_name" required class="w-full my-2 text-black bg-white disabled:bg-white disabled:text-black hover:bg-red-300 input"><br>
                    <input type="text" disabled name="phone_number" required value="<?= $row['phone_number'] ?>" class="w-full my-2 text-black bg-white hover:bg-red-300 disabled:bg-white disabled:text-black input"><br>
                    <input type="number" disabled name="table_number" required value="<?= $row['table_number'] ?>" class="w-full my-2 text-black bg-white hover:bg-red-300 disabled:bg-white disabled:text-black input"><br>
                    <input type="text" disabled name="order_date" required value="<?= $row['order_date'] ?>" class="w-full my-2 text-black bg-white input disabled:bg-white disabled:text-black hover:bg-red-300"><br>
                    <input type="text" disabled name="order_time" required value="<?= $row['order_time'] ?>" class="w-full my-2 text-black bg-white input disabled:bg-white disabled:text-black hover:bg-red-300"><br>
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
                                <?php foreach ($details as $key => $value) : ?>
                                    <tr>
                                        <td class="text-black bg-white"><?= $value['productName'] ?></td>
                                        <td class="text-black bg-white">x<?= $value['qty'] ?></td>
                                        <td class="text-black bg-white">IDR <?= $row['total_price'] ?></td>
                                    </tr>
                                <?php endforeach; ?>

                        </table>
                        <div class="flex justify-between w-full p-3 my-3 rounded-lg bg-red-100/80">
                            <h1 class="font-bold text-black">Total</h1>
                            <h1 class="font-bold text-red-700">IDR <?= $row['total_price'] ?>
                            </h1>
                        </div>


                        <div class="flex items-center my-1">
                            <input type="radio" name="billing_type" value="Tunai" class="radio radio-sm radio-secondary" <?php if ($row['billing_type'] == 'Tunai') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?> /> <span class="ml-2 text-xs text-black">Tunai</span>
                        </div>

                        <div class="flex items-center">
                            <input type="radio" name="billing_type" value="Dana" class="radio radio-sm radio-secondary" <?php if ($row['billing_type'] == 'Dana') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?> /> <span class="ml-2 text-xs text-black">Via Dana</span>
                        </div>
                    </div>
                </div>
            </form>

            <p class="text-gray-500 text-end">Pelanggan membayar pesanan</p>
            <div class="flex justify-end w-full mt-3">
                <a href="completed-order.php?id=<?= $row['id'] ?>" class="px-8 py-2 text-white bg-red-500 rounded-xl">Pembayaran Selesai</a>
            </div>
        </div>
    </main>
</body>

</html>

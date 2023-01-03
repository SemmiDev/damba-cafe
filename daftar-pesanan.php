<?php error_reporting(0); ?>

<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

include 'config.php';

class Order
{
    public $conn;
    public function allOrders()
    {
        $query = "SELECT * FROM orders";
        $result = mysqli_query($this->conn, $query);
        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $orders;
    }
}

$o = new Order();
$o->conn = $conn;
$orders = $o->allOrders();

if (isset($_POST['q'])) {
    $q = $_POST['q'];
    $query = "SELECT * FROM orders WHERE customer_name LIKE '%$q%' OR table_number LIKE '%$q%' OR phone_number LIKE '%$q%' OR order_status LIKE '%$q%'";
    $result = mysqli_query($conn, $query);
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
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
    <div class="flex flex-col flex-auto flex-shrink-0 min-h-screen antialiased text-gray-800 bg-gradient-to-b from-red-200 to-white">
        <?php include 'sidebar.php' ?>
        <div class="ml-[280px] p-5">
            <h1 class="mb-16 text-4xl font-bold text-black">Daftar Pesanan</h1>

            <div class="w-full h-full p-5 bg-white border border-gray-600 rounded-xl">
                <form action="daftar-pesanan.php" method="POST" class="flex justify-end">
                    <input type="text" name="q" class="text-black bg-white border border-gray-500 input input-bordered input-sm border-1" placeholder="Search...">
                    <input type="submit" hidden />
                </form>
                <div class="w-full p-3">
                    <div class="p-3 overflow-x-auto bg-white rounded-xl">

                        <table class="table w-full bg-white rounded-lg table-compact">
                            <thead>
                                <tr class="border-b border-gray-500">
                                    <th class="text-black bg-white">Order Date</th>
                                    <th class="text-black bg-white">Nomor Meja</th>
                                    <th class="text-black bg-white">Nama Pemesan</th>
                                    <th class="text-black bg-white">Nomor Handphone</th>
                                    <th class="text-black bg-white">Status Pembayaran</th>
                                    <th class="text-black bg-white ">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $key => $value) { ?>
                                    <tr>
                                        <td class="text-black bg-white">
                                            <span class="block"><?= $value['order_date'] ?></span>
                                            <span><?= $value['order_time'] ?></span>
                                        </td>
                                        </td>
                                        <td class="text-black bg-white"><?= $value['table_number'] ?></td>
                                        <td class="text-black bg-white"><?= $value['customer_name'] ?></td>
                                        <td class="text-black bg-white"><?= $value['phone_number'] ?></td>
                                        <td class="text-black bg-white"><?= $value['order_status'] ?></td>
                                        <td class="text-black bg-white">
                                            <a href="detail-pesanan.php?id=<?= $value['id'] ?>" class="text-xs text-white btn btn-sm btn-error">Lihat Detail</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

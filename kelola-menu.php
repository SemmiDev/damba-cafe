<?php error_reporting(0); ?>

<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

class ListMenu
{
    public $conn;

    public function listMenu()
    {
        $sql = "SELECT * FROM menu";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }
}

include 'config.php';

$listMenu = new ListMenu();
$listMenu->conn = $conn;
$menus = $listMenu->listMenu();

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
            <h1 class="mb-16 text-4xl font-bold text-black">Kelola Menu</h1>

            <div class="w-full h-full bg-white border border-gray-600 rounded-xl">
                <div class="w-full p-3 border-b border-gray-600">
                    <a href="tambah-menu.php" class="px-5 py-1 text-white bg-red-700 rounded-lg">Add</a>
                </div>
                <div class="w-full p-3">
                    <div class="p-3 overflow-x-auto bg-white rounded-xl">
                        <table class="table w-full bg-white rounded-lg table-compact">
                            <thead>
                                <tr class="border-b border-gray-500">
                                    <th class="text-black bg-white">No</th>
                                    <th class="text-black bg-white">Nama Menu</th>
                                    <th class="text-black bg-white">Deskripsi</th>
                                    <th class="text-black bg-white">Harga</th>
                                    <th class="text-black bg-white">Image</th>
                                    <th class="text-black bg-white">Category</th>
                                    <th class="text-black bg-white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($menus as $key => $value) : ?>
                                    <tr>
                                        <td class="text-black bg-white"><?= $no++ ?></td>
                                        <td class="text-black bg-white"><?= $value['name'] ?></td>
                                        <td class="text-black bg-white"><?= $value['description'] ?></td>
                                        <td class="text-black bg-white">IDR <?= $value['price'] ?></td>
                                        <td class="text-black bg-white"><?= $value['image'] ?></td>
                                        <td class="text-black bg-white"><?= $value['category'] ?></td>
                                        <td class="text-black bg-white">
                                            <a href="edit-menu.php?id=<?= $value['id'] ?>" class="text-xs text-white btn btn-sm btn-info">Edit</a>
                                            <a href="hapus-menu.php?id=<?= $value['id'] ?>" class="text-xs text-white btn btn-sm btn-error">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

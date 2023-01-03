<?php error_reporting(0); ?>

<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}


include 'config.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // convert price to float
    $price = floatval($price);

    // Assume that the image file is stored in a temporary location on the server
    $image = $_FILES['image']['tmp_name'];

    // Get the original file name of the image
    $imageName = $_FILES['image']['name'];

    // check if image is empty
    if ($imageName == '') {
        $query = "SELECT * FROM menu WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $imageName = $row['image'];
    } else {
        // Set the target directory for the image
        $targetDir = "upload/";

        // Generate a new file name for the image (optional)
        $imageName = time() . "-" . $imageName;

        // Set the target path for the image (i.e., the path to save the image)
        $targetPath = $targetDir . $imageName;

        // Save the image to the specified path
        move_uploaded_file($image, $targetPath);
    }


    // update query
    $query = "UPDATE menu SET name = '$name', price = '$price', category = '$category', description = '$description', image = '$imageName' WHERE id = $id";
    $result = mysqli_query($conn, $query);

    header('Location: kelola-menu.php');
}

$id = $_GET['id'];
$query = "SELECT * FROM menu WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($result);

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
            <h1 class="mb-16 text-4xl font-bold text-black">Edit Menu</h1>

            <div class="w-full h-full p-5 bg-white border border-gray-600 rounded-xl">
                <h1 class="p-5 text-xl font-semibold">Form Mengedit Menu</h1>
                <div class="p-5 border border-gray-500 rounded-xl">
                    <form action="edit-menu.php" enctype="multipart/form-data" method="post" class="grid grid-cols-2 gap-2">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="w-full max-w-xs">
                            <div class="flex flex-col gap-2 my-3">
                                <span class="font-semibold">Nama Menu</span>
                                <input type="text" name="name" value="<?= $result['name'] ?>" id="nama_menu" required placeholder="Nama Menu" class="p-2 text-black bg-white border border-gray-500 rounded-md border-1">
                            </div>
                            <div class="flex flex-col gap-2 my-3">
                                <span class="font-semibold">Deskripsi</span>
                                <textarea name="description" id="" cols="30" rows="10" required placeholder="Deskripsi" class="p-2 text-black bg-white border border-gray-500 rounded-md"><?= $result['description'] ?></textarea>
                            </div>
                        </div>

                        <div class="w-full max-w-xs">
                            <div class="flex flex-col gap-2 my-3">
                                <span class="font-semibold">Harga Menu</span>
                                <input type="text" name="price" value="<?= $result['price'] ?>" id="nama_menu" required placeholder="Harga Menu" class="p-2 text-black bg-white border border-gray-500 rounded-md border-1">
                            </div>
                            <div class="flex flex-col gap-2 my-3">
                                <span class="font-semibold">Image</span>
                                <input type="file" accept="image/*" name="image" id="nama_menu" placeholder="Harga Menu" class="w-full max-w-xs bg-white file-input file-input-sm file-input-bordered file-input-secondary">
                            </div>
                            <div class="flex flex-col gap-2 my-3">
                                <span class="font-semibold">Category</span>
                                <select class="bg-white border-gray-500 select" name="category" required>
                                    <option value="Coffee" <?= $result['category'] == 'Coffee' ? 'selected' : '' ?>>Coffee</option>
                                    <option value="Juice" <?= $result['category'] == 'Juice' ? 'selected' : '' ?>>Juice</option>
                                    <option value="Non Coffee" <?= $result['category'] == 'Non Coffee' ? 'selected' : '' ?>>Non Coffee</option>
                                    <option value="Food" <?= $result['category'] == 'Food' ? 'selected' : '' ?>>Food</option>
                                    <option value="Snack" <?= $result['category'] == 'Snack' ? 'selected' : '' ?>>Snack</option>
                                </select>
                            </div>
                            <div class="flex justify-end w-full">
                                <button type="submit" name="submit" class="px-4 py-2 mt-5 font-semibold text-white bg-red-500 rounded-md hover:bg-red-600">
                                    Edit Perubahan
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

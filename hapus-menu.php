<?php error_reporting(0); ?>

<?php

include 'config.php';

$id = $_GET['id'];

// get data
$query = "SELECT * FROM menu WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$imagName = $row['image'];

$targetDir = "upload/";

// Set the target path for the image (i.e., the path to the image)
$targetPath = $targetDir . $imageName;

// Delete the image from the specified path
unlink($targetPath);

$query = "DELETE FROM menu WHERE id = $id";
$result = mysqli_query($conn, $query);

header('Location: kelola-menu.php');

<?php

error_reporting(0);

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}


include 'config.php';

$id = $_GET['id'];

// change order_status to Paid
$sql = "UPDATE orders SET order_status = 'Paid' WHERE id = $id";
$result = mysqli_query($conn, $sql);

header('Location: daftar-pesanan.php');

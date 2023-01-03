<?php

error_reporting(0);

$server = "localhost";
$user = "root";
$pass = "";
$database = "webdamba";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}

<?php error_reporting(0); ?>

<?php

class UserLoginRequest
{
    public $username;
    public $password;
    public $conn;

    public function login()
    {
        $sql = "SELECT * FROM users WHERE username='$this->username' AND password='$this->password'";
        $result = mysqli_query($this->conn, $sql);
        if ($result->num_rows > 0) {
            var_dump("test");
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php");
        } else {
            header("Location: login.php");
        }
    }
}

include 'config.php';

session_start();

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
}

if (isset($_POST['submit'])) {

    $userLoginRequest = new UserLoginRequest();
    $userLoginRequest->username = $_POST['username'];
    $userLoginRequest->password = $_POST['password'];
    $userLoginRequest->conn = $conn;
    $userLoginRequest->login();
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
    <main class="min-h-screen px-24 pb-12 mx-auto bg-gradient-to-b from-red-100 to-white">

        <!-- navbar -->
        <div class="text-red-500 bg-transparent navbar">
            <div class="flex-1">
                <a href="index.php">
                    <img src="images/logo.png" class="w-20">
                </a>
            </div>
        </div>
        <!-- end navbar -->

        <!-- hero -->
        <section class="grid grid-cols-2 mt-12">
            <div>
                <img src="./images/kasir.png" class="w-[80%]">
            </div>
            <div class="flex flex-col justify-center">
                <h1 class="text-4xl font-semibold text-red-800">KASIR DAMBA CAFE</h1>
                <h1 class="mt-5 text-sm font-semibold text-black">Silahkan Masuk ke Akun Anda</h1>
                <form action="login.php" method="post" class="w-full max-w-sm">
                    <div class="mt-5">
                        <input type="text" name="username" id="username" autofocus autocomplete="username" required placeholder="Username" class="block w-full px-3 py-2 mt-1 text-black bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                    </div>
                    <div class="mt-3">
                        <input type="password" name="password" id="password" autocomplete="current-password" required placeholder="Password" class="block w-full px-3 py-2 mt-1 text-black bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                    </div>
                    <div class="mt-5">
                        <button type="submit" name="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-500 border border-transparent rounded-md shadow-lg shadow-red-500/70 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Masuk
                        </button>
                    </div>
                </form>
            </div>
        </section>
        <!-- end hero -->

        <p class="absolute bottom-0 left-0 right-0 my-5 text-center text-gray-400">Copyright &copy; 2022 • All rights reserved • DambaCafe</p>
    </main>
</body>

</html>

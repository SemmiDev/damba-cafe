<?php error_reporting(0); ?>

<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

include 'config.php';

// query for get total menu = SELECT COUNT(*) as total FROM menu;
// query for get total orders = SELECT COUNT(*) as total FROM orders;
// query for get total transaction = SELECT COUNT(*) as total FROM transaction;

$totalMenuSql = "SELECT COUNT(*) as total FROM menu";
$totalMenuQuery = mysqli_query($conn, $totalMenuSql);
$totalMenu = mysqli_fetch_assoc($totalMenuQuery);
$totalMenu = $totalMenu['total'];

$totalOrdersSql = "SELECT COUNT(*) as total FROM orders WHERE order_status = 'Pending'";
$totalOrdersQuery = mysqli_query($conn, $totalOrdersSql);
$totalOrders = mysqli_fetch_assoc($totalOrdersQuery);
$totalOrders = $totalOrders['total'];

$totalTransactionSql = "SELECT COUNT(*) as total FROM orders WHERE order_status = 'Paid'";
$totalTransactionQuery = mysqli_query($conn, $totalTransactionSql);
$totalTransaction = mysqli_fetch_assoc($totalTransactionQuery);
$totalTransaction = $totalTransaction['total'];

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
            <h1 class="text-4xl font-bold text-black">Welcome back Mira</h1>
            <h1 class="mt-12 mb-5 text-4xl font-bold text-black">Dashboard</h1>

            <div class="flex gap-5">

                <div class="w-full max-w-[250px] relative overflow-hidden shadow-lg bg-[#99D24F] shadow-[#99D24F] text-white rounded-lg">
                    <div class="grid grid-cols-2 gap-2 p-5 mb-8 ">
                        <div>
                            <h1 class="mb-2 text-4xl font-bold"><?= $totalMenu ?></h1>
                            <h1>Total Menu</h1>
                        </div>
                        <div>
                            <svg class="w-16 h-16" viewBox="0 0 89 89" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.70801 81.5833C3.70801 83.5858 5.37676 85.2917 7.41634 85.2917H55.6247C57.7013 85.2917 59.333 83.5858 59.333 81.5833V77.875H3.70801V81.5833ZM31.5205 33.375C17.6143 33.375 3.70801 40.7917 3.70801 55.625H59.333C59.333 40.7917 45.4268 33.375 31.5205 33.375ZM13.4238 48.2083C17.5401 42.4604 26.2918 40.7917 31.5205 40.7917C36.7493 40.7917 45.5009 42.4604 49.6172 48.2083H13.4238ZM3.70801 63.0417H59.333V70.4583H3.70801V63.0417ZM66.7497 18.5417V3.70833H59.333V18.5417H40.7913L41.6443 25.9583H77.0959L71.9043 77.875H66.7497V85.2917H73.128C76.243 85.2917 78.8018 82.8812 79.1726 79.8404L85.2913 18.5417H66.7497Z" fill="#6B6868" />
                            </svg>
                        </div>
                    </div>
                    <div class="w-full bg-[#6CB51E] absolute bottom-0  items-center flex justify-center py-2 gap-2">
                        <a href="kelola-menu.php">More Info</a>
                        <svg class="w-5 h-5" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5625 12.5C1.5625 14.6632 2.20397 16.7779 3.4058 18.5765C4.60763 20.3752 6.31583 21.7771 8.3144 22.6049C10.313 23.4328 12.5121 23.6494 14.6338 23.2273C16.7555 22.8053 18.7043 21.7636 20.234 20.234C21.7636 18.7043 22.8053 16.7555 23.2273 14.6338C23.6494 12.5121 23.4328 10.313 22.6049 8.3144C21.7771 6.31583 20.3752 4.60763 18.5765 3.4058C16.7779 2.20397 14.6632 1.5625 12.5 1.5625C9.59919 1.5625 6.8172 2.71484 4.76602 4.76602C2.71484 6.8172 1.5625 9.59919 1.5625 12.5ZM6.25 11.7188H15.7422L11.3828 7.33828L12.5 6.25L18.75 12.5L12.5 18.75L11.3828 17.6352L15.7422 13.2812H6.25V11.7188Z" fill="white" />
                        </svg>
                    </div>
                </div>

                <div class="w-full max-w-[250px] relative overflow-hidden shadow-lg bg-[#38E0E0] shadow-[#38E0E0] text-white rounded-lg">
                    <div class="grid grid-cols-2 gap-2 p-5 mb-8 ">
                        <div>
                            <h1 class="mb-2 text-4xl font-bold"><?= $totalOrders ?></h1>
                            <h1>Daftar Pesanan</h1>
                        </div>
                        <div>
                            <svg class="w-16 h-16" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_88_160)">
                                    <g clip-path="url(#clip1_88_160)">
                                        <path d="M71.25 18.75V71.25H18.75V18.75H71.25ZM75.375 11.25H14.625C12.75 11.25 11.25 12.75 11.25 14.625V75.375C11.25 76.875 12.75 78.75 14.625 78.75H75.375C76.875 78.75 78.75 76.875 78.75 75.375V14.625C78.75 12.75 76.875 11.25 75.375 11.25ZM41.25 26.25H63.75V33.75H41.25V26.25ZM41.25 41.25H63.75V48.75H41.25V41.25ZM41.25 56.25H63.75V63.75H41.25V56.25ZM26.25 26.25H33.75V33.75H26.25V26.25ZM26.25 41.25H33.75V48.75H26.25V41.25ZM26.25 56.25H33.75V63.75H26.25V56.25Z" fill="#6B6868" />
                                    </g>
                                </g>
                                <defs>
                                    <clipPath id="clip0_88_160">
                                        <rect width="90" height="90" fill="white" />
                                    </clipPath>
                                    <clipPath id="clip1_88_160">
                                        <rect width="90" height="90" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>

                        </div>
                    </div>
                    <div class="w-full bg-[#00BBCC] absolute bottom-0  items-center flex justify-center py-2 gap-2">
                        <a href="daftar-pesanan.php">More Info</a>
                        <svg class="w-5 h-5" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5625 12.5C1.5625 14.6632 2.20397 16.7779 3.4058 18.5765C4.60763 20.3752 6.31583 21.7771 8.3144 22.6049C10.313 23.4328 12.5121 23.6494 14.6338 23.2273C16.7555 22.8053 18.7043 21.7636 20.234 20.234C21.7636 18.7043 22.8053 16.7555 23.2273 14.6338C23.6494 12.5121 23.4328 10.313 22.6049 8.3144C21.7771 6.31583 20.3752 4.60763 18.5765 3.4058C16.7779 2.20397 14.6632 1.5625 12.5 1.5625C9.59919 1.5625 6.8172 2.71484 4.76602 4.76602C2.71484 6.8172 1.5625 9.59919 1.5625 12.5ZM6.25 11.7188H15.7422L11.3828 7.33828L12.5 6.25L18.75 12.5L12.5 18.75L11.3828 17.6352L15.7422 13.2812H6.25V11.7188Z" fill="white" />
                        </svg>
                    </div>
                </div>

                <div class="w-full max-w-[250px] relative overflow-hidden shadow-lg bg-[#F78455] shadow-[#F78455] text-white rounded-lg">
                    <div class="grid grid-cols-2 gap-2 p-5 mb-8 ">
                        <div>
                            <h1 class="mb-2 text-4xl font-bold"><?= $totalTransaction ?></h1>
                            <h1>Transaksi</h1>
                        </div>
                        <div>
                            <svg class="w-16 h-16" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_88_172)">
                                    <g clip-path="url(#clip1_88_172)">
                                        <g opacity="0.2">
                                            <path d="M45 56.25C51.2132 56.25 56.25 51.2132 56.25 45C56.25 38.7868 51.2132 33.75 45 33.75C38.7868 33.75 33.75 38.7868 33.75 45C33.75 51.2132 38.7868 56.25 45 56.25Z" fill="#6B6868" />
                                            <path d="M81.5625 22.5H61.875L84.375 42.1875V25.3125C84.375 24.5666 84.0787 23.8512 83.5512 23.3238C83.0238 22.7963 82.3084 22.5 81.5625 22.5ZM81.5625 67.5C82.3084 67.5 83.0238 67.2037 83.5512 66.6762C84.0787 66.1488 84.375 65.4334 84.375 64.6875V47.8125L61.875 67.5H81.5625ZM5.625 25.3125V42.1875L28.125 22.5H8.4375C7.69158 22.5 6.97621 22.7963 6.44876 23.3238C5.92132 23.8512 5.625 24.5666 5.625 25.3125ZM5.625 64.6875C5.625 65.4334 5.92132 66.1488 6.44876 66.6762C6.97621 67.2037 7.69158 67.5 8.4375 67.5H28.125L5.625 47.8125V64.6875Z" fill="#6B6868" />
                                        </g>
                                        <path d="M81.5625 19.6875H8.4375C6.94566 19.6875 5.51492 20.2801 4.46002 21.335C3.40513 22.3899 2.8125 23.8207 2.8125 25.3125V64.6875C2.8125 66.1793 3.40513 67.6101 4.46002 68.665C5.51492 69.7199 6.94566 70.3125 8.4375 70.3125H81.5625C83.0543 70.3125 84.4851 69.7199 85.54 68.665C86.5949 67.6101 87.1875 66.1793 87.1875 64.6875V25.3125C87.1875 23.8207 86.5949 22.3899 85.54 21.335C84.4851 20.2801 83.0543 19.6875 81.5625 19.6875ZM29.1797 64.6875L8.4375 46.5469V43.4531L29.1797 25.3125H60.8203L81.5625 43.4531V46.5469L60.8203 64.6875H29.1797ZM81.5625 36L69.3633 25.3125H81.5625V36ZM20.6367 25.3125L8.4375 36V25.3125H20.6367ZM8.4375 54L20.6367 64.6875H8.4375V54ZM81.5625 64.6875H69.3633L81.5625 54V64.6875ZM45 30.9375C42.2187 30.9375 39.4999 31.7623 37.1873 33.3075C34.8747 34.8527 33.0723 37.0489 32.0079 39.6185C30.9436 42.1881 30.6651 45.0156 31.2077 47.7435C31.7503 50.4713 33.0896 52.977 35.0563 54.9437C37.023 56.9104 39.5287 58.2497 42.2565 58.7923C44.9844 59.3349 47.8119 59.0564 50.3815 57.9921C52.9511 56.9277 55.1473 55.1253 56.6925 52.8127C58.2378 50.5001 59.0625 47.7813 59.0625 45C59.0625 41.2704 57.5809 37.6935 54.9437 35.0563C52.3065 32.4191 48.7296 30.9375 45 30.9375ZM45 53.4375C43.3312 53.4375 41.6999 52.9426 40.3124 52.0155C38.9248 51.0884 37.8434 49.7706 37.2048 48.2289C36.5662 46.6871 36.3991 44.9906 36.7246 43.3539C37.0502 41.7172 37.8538 40.2138 39.0338 39.0338C40.2138 37.8538 41.7172 37.0502 43.3539 36.7246C44.9906 36.3991 46.6871 36.5662 48.2289 37.2048C49.7706 37.8434 51.0884 38.9248 52.0155 40.3124C52.9426 41.6999 53.4375 43.3312 53.4375 45C53.4282 47.2349 52.5363 49.3757 50.956 50.956C49.3757 52.5363 47.2349 53.4282 45 53.4375Z" fill="#6B6868" />
                                    </g>
                                </g>
                                <defs>
                                    <clipPath id="clip0_88_172">
                                        <rect width="90" height="90" fill="white" />
                                    </clipPath>
                                    <clipPath id="clip1_88_172">
                                        <rect width="90" height="90" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>


                        </div>
                    </div>
                    <div class="w-full bg-[#F24D1F] absolute bottom-0  items-center flex justify-center py-2 gap-2">
                        <a href="daftar-pesanan.php">More Info</a>
                        <svg class="w-5 h-5" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5625 12.5C1.5625 14.6632 2.20397 16.7779 3.4058 18.5765C4.60763 20.3752 6.31583 21.7771 8.3144 22.6049C10.313 23.4328 12.5121 23.6494 14.6338 23.2273C16.7555 22.8053 18.7043 21.7636 20.234 20.234C21.7636 18.7043 22.8053 16.7555 23.2273 14.6338C23.6494 12.5121 23.4328 10.313 22.6049 8.3144C21.7771 6.31583 20.3752 4.60763 18.5765 3.4058C16.7779 2.20397 14.6632 1.5625 12.5 1.5625C9.59919 1.5625 6.8172 2.71484 4.76602 4.76602C2.71484 6.8172 1.5625 9.59919 1.5625 12.5ZM6.25 11.7188H15.7422L11.3828 7.33828L12.5 6.25L18.75 12.5L12.5 18.75L11.3828 17.6352L15.7422 13.2812H6.25V11.7188Z" fill="white" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>

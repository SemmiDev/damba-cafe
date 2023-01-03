<?php error_reporting(0); ?>

<?php

class Customer
{
    public $conn;
    public $customerName;
    public  $phoneNumber;
    public  $table_number;
    public  $orderDate;
    public  $orderTime;
    public  $orderDetails;
    public  $orderPrice;
    public  $billingType;

    public function insert()
    {
        $sql = "
            INSERT INTO orders (
                customer_name,
                phone_number,
                table_number,
                order_date,
                order_time,
                orders_details,
                total_price,
                billing_type)
            VALUES
            ('$this->customerName',
            '$this->phoneNumber',
            '$this->table_number',
            '$this->orderDate',
            '$this->orderTime',
            '$this->orderDetails',
            '$this->orderPrice',
            '$this->billingType')";

        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            header('Location: checkout-success.php');
        }
    }
}


include 'config.php';

if (isset($_POST['submit'])) {
    $customer = new Customer();
    $customer->conn = $conn;
    $customer->customerName = $_POST['customer_name'];
    $customer->phoneNumber = $_POST['phone_number'];
    $customer->table_number = $_POST['table_number'];
    $customer->orderDate = $_POST['order_date'];
    $customer->orderTime = $_POST['order_time'];
    $customer->orderDetails = $_POST['order_details'];
    $customer->orderPrice = $_POST['total_price'];
    $customer->billingType = $_POST['billing_type'];

    $customer->insert();
}

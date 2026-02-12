<?php
require("connection.php");

// Get raw JSON data
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo "No data received";
    exit;
}

// Optional: create order first (recommended)
$order_sql = "INSERT INTO orders (order_date) VALUES (NOW())";
mysqli_query($conn, $order_sql);

$order_id = mysqli_insert_id($conn); // get last inserted order id

// Insert each item
foreach ($data as $item) {
    $name = mysqli_real_escape_string($conn, $item['name']);
    $price = $item['price'];
    $quantity = $item['quantity'];
    $total = $item['total'];

    $sql = "INSERT INTO order_items (order_id, item_name, price, quantity, total)
            VALUES ('$order_id', '$name', '$price', '$quantity', '$total')";

    mysqli_query($conn, $sql);
}

echo $order_id;
exit
?>

<?php
require("connection.php");
session_start();

if (!isset($_SESSION['user_logged_in'])) {
    die("Unauthorized access");
}

$user_id = $_SESSION['user_id'];

// Get cart JSON data
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || count($data) == 0) {
    die("Cart is empty");
}

// Calculate total from cart (secure way)
$grand_total = 0;

foreach ($data as $item) {
    $price = floatval($item['price']);
    $quantity = intval($item['quantity']);
    $grand_total += ($price * $quantity);
}

// 1️⃣ Get current balance
$sql = "SELECT balance FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found");
}

$current_balance = floatval($user['balance']);

// 2️⃣ Check balance
if ($current_balance < $grand_total) {
    die("❌ Insufficient Balance!");
}

// 3️⃣ Deduct balance
$new_balance = $current_balance - $grand_total;

$update_sql = "UPDATE users 
               SET balance = '$new_balance' 
               WHERE id = '$user_id'";
mysqli_query($conn, $update_sql);

// 4️⃣ Insert into orders table
$order_sql = "INSERT INTO orders (user_id, total_amount, order_date)
              VALUES ('$user_id', '$grand_total', NOW())";
mysqli_query($conn, $order_sql);

$order_id = mysqli_insert_id($conn);

// 5️⃣ Insert order items
foreach ($data as $item) {

    $name = mysqli_real_escape_string($conn, $item['name']);
    $price = floatval($item['price']);
    $quantity = intval($item['quantity']);
    $total = $price * $quantity;

    $item_sql = "INSERT INTO order_items 
                 (order_id, item_name, price, quantity, total)
                 VALUES 
                 ('$order_id', '$name', '$price', '$quantity', '$total')";

    mysqli_query($conn, $item_sql);
}

echo $order_id;
exit;
?>

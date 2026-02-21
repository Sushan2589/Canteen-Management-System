<?php
require("connection.php");
session_start();

if (!isset($_SESSION['user_logged_in'])) {
    die("Unauthorized access");
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['order_id'])) {
    die("No order found");
}

$order_id = intval($_GET['order_id']);

// Check if order belongs to this user
$check_sql = "SELECT * FROM orders 
              WHERE id = '$order_id' 
              AND user_id = '$user_id'";

$check_result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($check_result) == 0) {
    die("Invalid order");
}

// Get order items
$sql = "SELECT * FROM order_items WHERE order_id = '$order_id'";
$result = mysqli_query($conn, $sql);

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>

    <style>
        body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #eef2f3, #dfe9f3);
    display: flex;
    justify-content: center;
    padding: 40px;
}

.receipt-box {
    background: #ffffff;
    padding: 35px;
    width: 420px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    position: relative;
}

/* Header */
.receipt-header {
    text-align: center;
    margin-bottom: 20px;
}

.receipt-header h2 {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    letter-spacing: 1px;
}

.receipt-header p {
    font-size: 13px;
    color: #777;
}

/* Order Info */
.order-info {
    font-size: 14px;
    margin-bottom: 15px;
    color: #555;
}

/* Item Row */
.item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    font-size: 14px;
    border-bottom: 1px dashed #eee;
}

.item span:first-child {
    color: #444;
}

.item span:last-child {
    font-weight: 600;
}

/* Total Section */
.total {
    margin-top: 18px;
    padding-top: 12px;
    border-top: 2px solid #333;
    display: flex;
    justify-content: space-between;
    font-size: 16px;
    font-weight: 700;
}

/* Buttons */
.btn-group {
    margin-top: 25px;
    text-align: center;
}

.btn {
    padding: 10px 18px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin: 5px;
    font-size: 14px;
    font-weight: 600;
    transition: 0.3s ease;
}

.back-btn {
    background: #2ecc71;
    color: white;
}

.back-btn:hover {
    background: #27ae60;
}

.download-btn {
    background: #3498db;
    color: white;
}

.download-btn:hover {
    background: #2980b9;
}

/* Print Styling */
@media print {
    body {
        background: white;
    }

    .btn-group {
        display: none;
    }

    .receipt-box {
        box-shadow: none;
        border-radius: 0;
        width: 100%;
    }
}
    </style>
</head>

<body>

<div class="receipt-box" id="receipt">
    <div class="receipt-header">
    <h2>Smart Bhansa</h2>
    <p>Canteen Receipt</p>
</div>

<div class="order-info">
    <strong>Order ID:</strong> <?php echo $order_id; ?>
</div>

<hr>

    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="item">
            <span><?php echo $row['item_name']; ?> x <?php echo $row['quantity']; ?></span>
            <span>Rs. <?php echo $row['total']; ?></span>
        </div>
        <?php
        $total += $row['total'];
    }
    ?>

    <div class="total">
        <span>Total</span>
        <span>Rs. <?php echo $total; ?></span>
    </div>

    <div class="btn-group">
        <a href="customer.php">
            <button class="btn back-btn">Back to Menu</button>
        </a>

        <button class="btn download-btn" onclick="downloadReceipt()">
            Download Receipt
        </button>
    </div>
</div>

<script>
function downloadReceipt() {
    window.print();
}
</script>

</body>
</html>

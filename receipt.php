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
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .receipt-box {
            background: white;
            padding: 30px;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .total {
            border-top: 2px solid #ddd;
            margin-top: 15px;
            padding-top: 10px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }

        .btn-group {
            margin-top: 20px;
            text-align: center;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            font-size: 14px;
        }

        .back-btn {
            background: #28a745;
            color: white;
        }

        .download-btn {
            background: #007bff;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        @media print {
            .btn-group {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="receipt-box" id="receipt">
    <h2>Canteen Receipt</h2>
    <p><strong>Order ID:</strong> <?php echo $order_id; ?></p>
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

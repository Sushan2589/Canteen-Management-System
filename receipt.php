<?php
require("connection.php");

if (!isset($_GET['order_id'])) {
    echo "No order found";
    exit;
}

$order_id = $_GET['order_id'];

$sql = "SELECT * FROM order_items WHERE order_id = '$order_id'";
$result = mysqli_query($conn, $sql);

$total = 0;
?>

<h2>Receipt</h2>

<?php
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['item_name'] . " - Rs." . $row['price'] . " x " . $row['quantity'] . "<br>";
    $total += $row['total'];
}
?>

<h3>Total: Rs. <?php echo $total; ?></h3>

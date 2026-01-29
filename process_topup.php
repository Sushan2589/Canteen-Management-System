<?php
require("connection.php");

session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.html");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $customer_id = trim($_POST['customer_id']);
    $amount = $_POST['amount'];
}


function getBalance($conn)
{
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $customer_id = trim($_POST['customer_id']);
    $amount = $_POST['amount'];
}
    $sql = "SELECT Balance FROM users WHERE id = '$customer_id'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

return $row['Balance'];
}


if($customer_id && $amount) 
{
    $balance = getBalance($conn);
    $sql = "UPDATE users
SET Balance = '$balance'+ '$amount'
WHERE id = '$customer_id';
   ";

    if(mysqli_query($conn,$sql)){
        header("Refresh: 2; URL=adminDashboard.php");
        echo("Successful");
    


    }
    
}


?>
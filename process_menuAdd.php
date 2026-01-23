<?php
require("connection.php");

session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.html");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $item_name = trim($_POST['item_name']);
    $price = $_POST['price'];
}

if($item_name && $price)
{
    $sql = "INSERT INTO menu_items(item_name,price)
    VALUES ('$item_name','$price')";

    if(mysqli_query($conn,$sql)){
        header("Refresh: 2; URL=adminDashboard.php");
        echo("Successful");
    


    }
    
}


?>
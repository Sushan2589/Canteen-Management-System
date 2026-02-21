<?php
require("connection.php");

session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.html");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_name = trim($_POST['user_name']);
    $contact = $_POST['ph'];
    $balance = $_POST['balance'];
    $password = $_POST['password'];
}

if($user_name && $contact && $balance && $password)
{
    $sql = "INSERT INTO users(Name,contact,Balance,pass)
    VALUES ('$user_name','$contact','$balance','$password')";

    if(mysqli_query($conn,$sql)){
        header("Refresh: 2; URL=adminDashboard.php");
        echo("Successful");
    


    }
    
}


?>
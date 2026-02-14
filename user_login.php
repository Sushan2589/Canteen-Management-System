<?php
session_start();
require "connection.php";

/* Stop direct access */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.html");
    exit();
}

/* Check inputs exist */
if (!isset($_POST['id'], $_POST['pass'])) {
    header("Location: index.html");
    exit();
}

$id = $_POST['id'];
$password = $_POST['pass'];


$sql = "SELECT * FROM users WHERE id='$id' AND pass='$password'";
$record = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($record)) {

    $_SESSION['user_logged_in'] = true;
    $_SESSION['user_id'] = $row['id'];

    header("Location: customer.php");
    exit();

} else {
    header("Location: index.html");
    exit();
}

?>

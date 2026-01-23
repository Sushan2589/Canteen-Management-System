<?php
session_start();
require "connection.php";

/* Stop direct access */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.html");
    exit();
}

/* Check inputs exist */
if (!isset($_POST['username'], $_POST['pass'])) {
    header("Location: index.html");
    exit();
}

$username = $_POST['username'];
$password = $_POST['pass'];

$sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
$record = mysqli_query($conn, $sql);

if (mysqli_num_rows($record) === 1) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $username;
    header("Location: adminDashboard.php");
    exit();
} else {
    header("Location: index.html");
    exit();
}
?>

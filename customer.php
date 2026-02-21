<?php
require("connection.php");
session_start();

if (!isset($_SESSION['user_logged_in'])) {
    header("Location: index.html");
    exit();
}

$user_id = $_SESSION['user_id'];

$user_sql = "SELECT id, name, balance FROM users WHERE id='$user_id'";
$user_result = mysqli_query($conn, $user_sql);
$user = mysqli_fetch_assoc($user_result);


$sql = "SELECT * FROM menu_items";
$records = mysqli_query($conn, $sql);


?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Customer Menu</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link rel="stylesheet" href="css/customer.css" />
</head>

<body>
  

 <nav id="navbar">
    <h2 class="logo"><img src="assests/SmartBhansa.png"></h2>

    <div class="nav-right">

        <div class="user-info">
            <span class="user-pill">ID: <?php echo $user['id']; ?></span>
            <span class="user-pill">👤 <?php echo $user['name']; ?></span>
            <span class="balance-pill">💰 Rs. <?php echo $user['balance']; ?></span>
        </div>

        <a href="process_logout.php" class="logout-link">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </div>
</nav>



  <div id="main-layout">

    <div id="menu-section">
      <h1 class="section-title">Today's Menu</h1>

      <div id="menu-grid">
        <?php
        foreach ($records as $record) {
          ?>
          <div class="food-card">
            <div class="card-icon"><i class="fa-solid fa-drumstick-bite"></i></div>
            <div class="card-info">
              <h3 class="card-info-header"><?php echo $record['item_name'] ?></h3>
              <p class="price">Rs. <?php echo $record['price'] ?></p>
              <button class="add-btn"><i class="fa-solid fa-plus"></i> Add</button>
            </div>
          </div>

          <?php
        }
        ?>

      </div>
    </div>

    <div id="sidebar-wrapper">
      <div id="order-sidebar">
        <div id="side-header">
          <h3>Your Order</h3>
          <span id="badge"></span>
        </div>

        <div class="order-list">

          <!-- Dynamically added -->


        </div>

        <div class="checkout-section">
          <div class="total-row">
            <span>Total</span>
            <span class="total"></span>
          </div>
          <button type="button" id="place-order">Place Order</button>
        </div>

      </div>
    </div>
  </div>

  <script src="js/customer.js"></script>
</body>


</html>
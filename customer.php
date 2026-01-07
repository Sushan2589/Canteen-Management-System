<?php
require("connection.php");
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
    <h2>Canteen Connect</h2>
    <a href="index.html" class="logout-link"><i class="fa-solid fa-arrow-left"></i> Logout</a>
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
          <button id="place-order">Place Order</button>
        </div>

      </div>
    </div>
  </div>

  <script src="js/customer.js"></script>
</body>

</html>
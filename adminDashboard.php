<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --bg: #f3f4f6;
            --text: #1f2937;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg);
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 500px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            width: 100%;
        }

        .card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.2s;
            text-decoration: none;
            color: var(--text);
            border: 1px solid transparent;
        }

        .card:hover {
            transform: translateY(-3px);
            border-color: var(--primary);
        }

        .card i {
            font-size: 1.5rem;
            color: var(--primary);
            background: #e0e7ff;
            padding: 12px;
            border-radius: 10px;
        }

        .card h3 { margin: 0; font-size: 1.1rem; }

        .logout-btn {
            color: #ef4444;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Admin Panel</h2>
            <a href="process_logout.php" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>

        <a href="add-menu.php" class="card">
            <i class="fa-solid fa-plus"></i>
            <div>
                <h3>Add Menu Item</h3>
            </div>
        </a>

        <a href="topup.php" class="card">
            <i class="fa-solid fa-wallet"></i>
            <div>
                <h3>User Topup</h3>
            </div>
        </a>

        <a href="add_new_user.php" class="card">
            <i class="fa-solid fa-plus"></i>
            <div>
                <h3>Add New User</h3>
            </div>
        </a>
    </div>

</body>
</html>
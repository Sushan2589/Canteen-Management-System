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
    <title>Add Menu Item | Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --bg-color: #f9fafb;
            --text-color: #111827;
            --border-color: #d1d5db;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-top: 0;
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
            color: var(--primary-color);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        label {
            font-size: 0.875rem;
            font-weight: 600;
        }

        input {
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        input[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            cursor: pointer;
            border: none;
            margin-top: 0.5rem;
        }

        input[type="submit"]:hover {
            background-color: var(--primary-hover);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: #6b7280;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Topup</h2>
        
        <form action="process_topup.php" method="POST">
            <div class="form-group">
                <label for="customer_id">Customer Id</label>
                <input type="text" id="customer_id" name="customer_id" placeholder="e.g. 1" required>
            </div>

            <div class="form-group">
                <label for="amount">amount (Rs.)</label>
                <input type="number" id="amount" name="amount" step="0.01" placeholder="0.00" required>
            </div>

            <input type="submit" value="Add Balance">
        </form>

        <a href="adminDashboard.php" class="back-link">← Back to Dashboard</a>
    </div>

</body>
</html>
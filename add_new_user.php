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
    <title>Add New User | Admin</title>
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
    min-height: 100vh;
    margin: 0;
}

.form-container {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    width: 100%;
    max-width: 420px;
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
    gap: 8px; 
}

label {
    font-size: 0.9rem;
    font-weight: 600;
    
}

input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 1rem;
    box-sizing: border-box;
    transition: 0.2s ease;
}

input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
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
        <h2>Add New User</h2>
        
        <form action="process_userAdd.php" method="POST">
            <div class="form-group">
                <label for="user_name">Name</label>
                <input type="text" id="user_name" name="user_name" placeholder="e.g. Ram" required>
            </div>

            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="number" id="ph" name="ph" placeholder="98XXXXXXXX" required>
            </div>

            <div class="form-group">
                <label for="balance">Initial Balance</label>
                <input type="number" id="balance" name="balance" placeholder="1000" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="*******" required>
            </div>

            <input type="submit" value="Add New User">
        </form>

        <a href="adminDashboard.php" class="back-link">← Back to Dashboard</a>
    </div>

</body>
</html>
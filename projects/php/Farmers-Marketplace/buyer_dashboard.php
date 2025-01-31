<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'buyer') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard</title>
    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 350px;
    transition: transform 0.3s ease-in-out;
}

.container:hover {
    transform: scale(1.02);
}

h2 {
    color: #2e7d32;
}

p {
    color: #555;
}

/* Buttons and Links */
a, button {
    display: inline-block;
    text-decoration: none;
    color: white;
    background: linear-gradient(135deg, #4caf50, #2e7d32);
    padding: 12px 20px;
    margin: 10px 0;
    border-radius: 25px;
    transition: all 0.3s ease-in-out;
    font-weight: bold;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: none;
    cursor: pointer;
}

a:hover, button:hover {
    background: linear-gradient(135deg, #388e3c, #1b5e20);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
}

/* Form Styles */
form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    padding: 20px;
}

label {
    font-weight: bold;
    color: #2e7d32;
}

input {
    width: 100%;
    padding: 12px;
    margin: 5px 0;
    border-radius: 20px;
    border: 1px solid #ccc;
    box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        width: 90%;
        padding: 15px;
    }
}

@media (max-width: 480px) {
    body {
        display: block;
        padding: 20px;
    }
    .container {
        width: 100%;
        padding: 10px;
    }
    a, input, button {
        font-size: 14px;
        padding: 10px;
    }
}

/* Buyer Dashboard Styles */
.buyer-container {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 350px;
    transition: transform 0.3s ease-in-out;
}

.buyer-container:hover {
    transform: scale(1.02);
}

.buyer-container a {
    background: linear-gradient(135deg, #007bff, #0056b3);
}

.buyer-container a:hover {
    background: linear-gradient(135deg, #0056b3, #004080);
}
</style>
</head>
<body>
    <div class="container">
        <h2>Welcome, Buyer!</h2>
        <p>Browse farm products below.</p>
        
        <a href="marketplace.php">Browse Marketplace</a>  
        <a href="logout.php">Logout</a>  
    </div>
</body>
</html>
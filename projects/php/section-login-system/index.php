<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .login-form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

    <?php 
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $_SESSION['username'] = $username;
            echo "WELCOME: ". $_SESSION['username'] . "!"; 
        }
    ?>

</head>
<body>

    <div class="login-form">
        <h2>Login</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <!-- <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div> -->
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>

</body>
</html>
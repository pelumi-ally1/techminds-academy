<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login-secure</title>
</head>
<body>
<?php
//   include 'connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Using prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Login successful!";
        } else {
            echo "Invalid username or password.";
        }

        $stmt->close();
    }
?>

    <form action="" method="POST">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
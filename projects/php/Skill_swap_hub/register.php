<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'skill_swap_hub');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password

        // SQL query to insert user data into the users table
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "Registration successful! <a href='index.html'>Login</a>";
        } else {
            echo "Error: " . $conn->error;
        }

        // Close the connection
        $stmt->close();
        $conn->close();
    }
?>
</head>
<body>
    <div class="container"><br><br><br>
        <h1>Register for Skill Swap Hub</h1>
        <form action="register.php" method="POST">
            <label for="name">Full Name:</label>
            <input type="text" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br>

            <button type="submit">Register</button>
        </form>

        <div class="message">
            <p>Already have an account? <a href="index.html" style="text-decoration: none;">Login here</a></p>
        </div>
    </div>
</body>
</html>
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'farmer') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "farmers_market");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg = ""; // Message variable
$alertClass = ""; // Alert class for styling

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $farmer_id = $_SESSION['user_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    // Handle image upload
    $target_dir = "uploads/";

// Check if the uploads directory exists, if not, create it
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true); // Creates the directory with full permissions
}

    $image = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $target_dir . basename($_FILES["image"]["name"]);
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
            // File uploaded successfully
            }else {
                die("❌ Error: Unable to upload file.");
            }
        }


    $sql = "INSERT INTO products (farmer_id, product_name, price, quantity, image) 
            VALUES ('$farmer_id', '$product_name', '$price', '$quantity', '$image')";

    if ($conn->query($sql) === TRUE) {
        $msg = "✅ Product added successfully! You can now view it in your dashboard.";
        $alertClass = "success";
    } else {
        $msg = "❌ Error adding product: " . $conn->error;
        $alertClass = "error";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 350px;
}

h2 {
    color: #2e7d32;
}

p {
    color: #555;
}

/* Buttons and Links */
a {
    display: block;
    text-decoration: none;
    color: white;
    background-color: #2e7d32;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    transition: background 0.3s;
}

a:hover {
    background-color: #1b5e20;
}

/* Form Styles */
form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    padding: 20px;
}

label {
    font-weight: bold;
    color: #2e7d32;
}

input, button {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
}

a, button {
    display: inline-block;
    text-decoration: none;
    color: white;
    background: linear-gradient(135deg, #4caf50, #2e7d32);
    padding: 12px 20px;
    margin: 10px 0;b
    border-radius: 25px;
    transition: all 0.3s ease-in-out;
    font-weight: bold;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: none;
    cursor: pointer;
}

a:hover, button:hover {
    background: linear-gradient(135deg,rgb(39, 171, 66),rgb(2, 217, 2));
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
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
        padding: 8px;
    }
}

</style>
</head>
<body><br><br><br><br>
    <div class="container">

        <h2>Add a New Product</h2>    
        <?php if (!empty($msg)): ?>
            <div class="message-box <?php echo $alertClass; ?>">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>

        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <label>Product Name:</label>
            <input type="text" name="product_name" required>

            <label>Price (₦):</label>
            <input type="number" name="price" required>

            <label>Quantity:</label>
            <input type="number" name="quantity" required>

            <label>Product Image:</label>
            <input type="file" name="image">

            <button type="submit">Add Product</button>
        </form>

        <a href="farmer_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
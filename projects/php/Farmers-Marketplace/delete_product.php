<?php
include('db_connection.php');

if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']); // Ensure it's an integer

    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Product not found.");
    }
} else {
    die("No product ID provided.");
}

if (isset($_POST['delete'])) {
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        echo "Product deleted successfully!";
        exit;
    } else {
        echo "Error deleting product: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Product</title>
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
a, button, input[type="submit"] {
    display: inline-block;
    text-decoration: none;
    color: white;
    background: linear-gradient(135deg, #ff4b2b, #ff416c);
    padding: 12px 20px;
    margin: 10px 0;
    border-radius: 25px;
    transition: all 0.3s ease-in-out;
    font-weight: bold;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: none;
    cursor: pointer;
}

a:hover, button:hover, input[type="submit"]:hover {
    background: linear-gradient(135deg, #d61a3c, #c4124e);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
}

/* Delete Confirmation Box */
.delete-container {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 400px;
    transition: transform 0.3s ease-in-out;
}

.delete-container:hover {
    transform: scale(1.02);
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
    .container, .delete-container {
        width: 90%;
        padding: 15px;
    }
}

@media (max-width: 480px) {
    body {
        display: block;
        padding: 20px;
    }
    .container, .delete-container {
        width: 100%;
        padding: 10px;
    }
    a, input, button {
        font-size: 14px;
        padding: 10px;
    }
}
    </style>
</head>
<body>
<h2>Are you sure you want to delete this product?</h2>
<p>Product: <?php echo htmlspecialchars($product['name']); ?></p>

<form action="delete_product.php?product_id=<?php echo $product_id; ?>" method="POST">
    <input type="submit" name="delete" value="Yes, Delete">
    <a href="view_my_products.php">Cancel</a>
</form>
</body>
</html>
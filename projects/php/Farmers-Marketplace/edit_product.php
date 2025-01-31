<?php
include('db_connection.php');

if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']); // Ensure it's an integer

    // Use a prepared statement to fetch product details
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

if (isset($_POST['submit'])) {
    $product_name = htmlspecialchars($_POST['product_name']); // Prevent XSS
    $price = floatval($_POST['price']); // Ensure it's a float
    $description = htmlspecialchars($_POST['description']); // Prevent XSS

    $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?");
    $stmt->bind_param("sdsi", $product_name, $price, $description, $product_id);

    if ($stmt->execute()) {
        echo "Product updated successfully!";
    } else {
        echo "Error updating product: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
<h2>Edit Product</h2>
<form action="edit_product.php?product_id=<?php echo $product_id; ?>" method="POST">
    <label for="product_name">Product Name:</label>
    <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br>

    <label for="price">Price:</label>
    <input type="number" step="0.01" id="price" name="price" value="<?php echo $product['price']; ?>" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea><br>

    <input type="submit" name="submit" value="Update Product">
</form>
</body>
</html>
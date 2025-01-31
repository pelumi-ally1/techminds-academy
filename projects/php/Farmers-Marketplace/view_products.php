<?php
// view_product.php

// Include database connection
include('db_connection.php');

// Check if a product ID is provided in the URL
if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']); // Ensure it's an integer

    // Use prepared statement to fetch the product details
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the product exists
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Product not found.");
    }
} else {
    die("No product ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        .product-container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
        }
        .back-button {
            background-color: #28a745;
        }
        .buy-button {
            background-color: #007bff;
        }
    </style>
</head>
<body>

<div class="product-container">
    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
    
    <?php if (!empty($product['image'])): ?>
        <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
    <?php else: ?>
        <p>No image available.</p>
    <?php endif; ?>

    <p><strong>Price:</strong> ₦<?php echo number_format($product['price'], 2); ?></p>
    <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($product['description'])); ?></p>

    <!-- Buy Now button -->
    <a href="checkout.php?product_id=<?php echo $product_id; ?>" class="button buy-button">Buy Now</a>
    <a href="view_my_products.php" class="button back-button">Back to Products</a>
</div>

</body>
</html>
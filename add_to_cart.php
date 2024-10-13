<?php
session_start();
include('admin/database/db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Check if the product_id is passed in the URL
if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']); // Get the product ID

    // Fetch product details from the database
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Create the cart if it doesn't exist
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$product_id])) {
            // If the product is already in the cart, increment the quantity
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } else {
            // Add new product to the cart with a quantity of 1
            $_SESSION['cart'][$product_id] = [
                'name' => $row['name'],
                'price' => $row['price'],
                'image' => $row['image'],
                'quantity' => 1
            ];
        }

        // Redirect to the cart page or show a success message
        header('Location: cart.php'); // Redirect to the cart page
        exit;
    } else {
        // If product not found, redirect back to the products page
        header('Location: index.php');
        exit;
    }
} else {
    // If no product ID is passed, redirect to the home page
    header('Location: index.php');
    exit;
}
?>

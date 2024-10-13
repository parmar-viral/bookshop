<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch the cart items from session
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart_items = $_SESSION['cart'];
} else {
    $cart_items = [];
    header('Location: cart.php');
    exit; // Redirect to cart if it's empty
}

// Process the checkout if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // You would typically process payment and shipping here
    // For now, we'll just simulate by clearing the cart

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect to thank you page
    header('Location: thank_you.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Online Book Shop</title>
    <!-- Include your CSS file -->
    <?php include 'css.php'; ?>
</head>
<body>
    <!-- Include the navigation menu -->
    <?php include 'menu.php'; ?>

    <div class="container mt-4">
        <h2>Checkout</h2>

        <h4>Your Cart Summary</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price = 0;
                foreach ($cart_items as $item):
                    $total_item_price = $item['price'] * $item['quantity'];
                    $total_price += $total_item_price;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo number_format($total_item_price, 2); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-right">
            <h4>Total Price: $<?php echo number_format($total_price, 2); ?></h4>
        </div>

        <h4>Shipping and Payment Information</h4>
        <form method="POST" action="checkout.php">
            <div class="form-group">
                <label for="shipping_address">Shipping Address</label>
                <textarea name="shipping_address" id="shipping_address" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Complete Purchase</button>
        </form>
    </div>

    <!-- Include the footer -->
    <?php include 'footer.php'; ?>
    <!-- Include your JavaScript files -->
    <?php include 'js.php'; ?>
</body>
</html>

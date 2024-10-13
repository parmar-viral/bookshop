<?php
session_start();

// Check if the user is logged in
if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch user cart items from session or database
$user_id = $_SESSION['user_id'];

// Assuming cart is stored in the session as an array
// You can also fetch the cart from the database using $user_id
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart_items = $_SESSION['cart'];
} else {
    $cart_items = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - Online Book Shop</title>
    <?php include 'css.php'; ?>
</head>
<body>
<?php include 'menu.php'; ?>
    <div class="container mt-4">
        <h2>My Cart</h2>

        <?php if(!empty($cart_items)): ?>
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
                    foreach($cart_items as $item):
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
                <h3>Total: <?php echo number_format($total_price, 2); ?></h3>
                <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
            </div>
        <?php else: ?>
            <p class="text-center">Your cart is empty.</p>
        <?php endif; ?>
    </div>

  <?php include 'footer.php'; ?>
  <?php include 'js.php'; ?>
</body>
</html>

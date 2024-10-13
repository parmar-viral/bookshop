<?php
 session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Online Book Shop</title>
    <!-- Custom CSS -->
    <?php include 'css.php'; ?>
</head>
<body>
    <!-- Navbar -->
    <?php include 'menu.php'; ?>

    <div class="container about-section">
        <h2>About Us</h2>
        <p>Welcome to <strong>Online Book Shop</strong>, your number one source for all books ranging from fiction, non-fiction, educational, and many more categories. We're dedicated to giving you the very best of books with a focus on three characteristics: dependability, customer service, and uniqueness.</p>
        <p>Founded in 2024, <strong>Online Book Shop</strong> has come a long way from its beginnings. When we first started out, our passion for providing a variety of quality books drove us to do intense research, so that <strong>Online Book Shop</strong> can offer you the best online book shopping experience.</p>
        <p>We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact us.</p>
        <h2>Our Mission</h2>
        <p>Our mission is to provide a wide range of books to readers of all ages, foster a love for reading, and make books easily accessible to everyone.</p>
        <h2>Why Choose Us?</h2>
        <ul>
            <li>Vast collection of books across various genres</li>
            <li>Affordable prices and discounts</li>
            <li>Free and fast shipping for premium members</li>
            <li>Excellent customer support</li>
        </ul>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <?php include 'css.php'; ?>
</body>
</html>

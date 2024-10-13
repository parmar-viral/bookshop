<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

// Include necessary files
include('admin/database/db.php'); // Include the database connection
include('menu.php'); // Include the menu

// Fetch products for the home page
$sql = "SELECT * FROM books";
$res = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Book Shop</title>
    <?php include 'css.php'; ?>
</head>

<body>
    <div class="container">
        <h2>Our Products</h2>
        <div class="row">
            <?php 
            if (mysqli_num_rows($res) > 0) {
                // Fetch and display each product
                while ($row = mysqli_fetch_assoc($res)) { ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="admin/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top"
                        alt="<?php echo htmlspecialchars($row['name'] ?? 'Product Image'); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['name'] ?? 'Untitled'); ?></h5>
                        <p class="card-text">
                            <?php echo htmlspecialchars($row['description'] ?? 'No description available.'); ?></p>
                        <p class="card-text">$<?php echo number_format($row['price'] ?? 0, 2); ?></p>
                        <?php if (isset($_SESSION['user_id'])) { ?>
                        <a href="add_to_cart.php?product_id=<?php echo $row['id']; ?>" class="btn btn-warning mb-2">Add to
                            Cart</a>
                        <a href="checkout.php?product_id=<?php echo $row['id']; ?>" class="btn btn-success">Buy Now</a>
                        <?php } else { ?>
                        <p><a href="login.php" class="btn btn-primary">Login to Add to Cart or Buy</a></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } 
            } else {
                echo '<p class="text-center">No products available.</p>';
            }
            ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <!-- Include the footer -->
    <?php include 'js.php'; ?>
    <!-- Include the JavaScript for the responsive menu -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.getElementById('navbarToggle');
        const navbarCollapse = document.getElementById('navbarNav');

        toggleButton.addEventListener('click', function() {
            navbarCollapse.classList.toggle('show'); // Toggle the 'show' class
        });
    });
    </script>
</body>

</html>
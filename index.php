<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
    <?php
    session_start();
    include('menu.php');
    include('admin/database/db.php'); // Include the database connection

    // Fetch products for the home page
    $sql = "SELECT * FROM books LIMIT 3"; // Fetch 3 records from the products table
    $res = mysqli_query($con, $sql);
    ?>

    <div class="container text-center">
        <h2>Welcome to the Online Book Shop</h2>
        <p>Explore our collection of books!</p>
    </div>

    <div class="container">
        <h2>Featured Products</h2>
        <div class="row">
            <?php 
            if (mysqli_num_rows($res) > 0) {
                // Fetch and display each product
                while ($row = mysqli_fetch_assoc($res)) { ?>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
                <div class="glass-card text-center p-3">
                    <img src="admin/<?php echo $row['image']; ?>" class="card-img-top img-fluid mb-3"
                        alt="Product Image">
                    <p><?php echo htmlspecialchars($row['name']); ?></p>
                    <p>$<?php echo number_format($row['price'], 2); ?></p>
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <a href="add_to_cart.php?product_id=<?php echo $row['id']; ?>" class="btn btn-warning mb-2">Add to
                            Cart</a>
                        <a href="checkout.php?product_id=<?php echo $row['id']; ?>" class="btn btn-success">Buy Now</a>
                        <?php } else { ?>
                        <p><a href="login.php" class="btn btn-primary">Login to Add to Cart or Buy</a></p>
                        <?php } ?>
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
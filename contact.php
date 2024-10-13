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
    <title>Contact Us</title>
    <?php include 'css.php'; ?>
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div class="container">
        <h2>Contact Us</h2>
        <form action="contact_submit.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary col-3">Send Message</button>
            </div>
        </form>
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

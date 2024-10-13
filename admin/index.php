<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include 'css.php'; ?>
</head>

<body>
    <?php
    session_start();
    include('../db.php'); // Include database connection

    // Check if the user is an admin
    if (!isset($_SESSION['user_id']) || $_SESSION['priority'] != 1) {
        echo "<div class='container'><h2>You do not have permission to access this page.</h2></div>";
        exit;
    }
    ?> 
    

    <div class="d-flex" id="wrapper">
    <?php include 'sidebar.php'; ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1 class="mt-4">Welcome to the Admin Dashboard</h1>
                <p>Use the sidebar to navigate.</p>
            </div>
        </div>
    </div>

    <?php include('../js.php'); ?>
</body>

</html>
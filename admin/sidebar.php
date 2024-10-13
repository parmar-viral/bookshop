<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">Admin Dashboard</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="add_book.php" class="list-group-item list-group-item-action">Add Books</a>
                <a href="view_book.php" class="list-group-item list-group-item-action">View Books</a>
                <a href="users.php" class="list-group-item list-group-item-action">Users</a>
                <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
            </div>
        </div>
    
    <?php include 'js.php'; ?>
</body>

</html>
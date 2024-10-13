<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookshop";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br>";

// Fetch users
$sql = "SELECT * FROM users";
$result = $con->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Users</title>
    <?php include 'css.php'; ?>
</head>
<body>
<?php include 'sidebar.php'; ?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <h3>User List</h3>

        <?php
        if ($result->num_rows > 0) {
            echo '<div class="row">';
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-lg-4 col-md-6">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["fname"] . ' ' . $row["lname"] . '</h5>';
                echo '<p class="card-text"><strong>Email:</strong> ' . $row["email"] . '</p>';
                echo '<p class="card-text"><strong>Username:</strong> ' . $row["username"] . '</p>';
                echo '<p class="card-text"><strong>Mobile:</strong> ' . $row["mobile"] . '</p>';
                echo '<p class="card-text"><strong>Address:</strong> ' . $row["address"] . '</p>';
                echo '<p class="card-text"><strong>Priority:</strong> ' . ($row["priority"] ? 'Admin' : 'User') . '</p>';
                echo '</div>'; // Close card-body
                echo '</div>'; // Close card
                echo '</div>'; // Close col
            }
            echo '</div>'; // Close row
        } else {
            echo '<p class="alert">No users found</p>';
        }

        // Close connection
        $con->close();
        ?>

    </div>
</div>

<?php include 'js.php'; ?>
</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookshop";

$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Handle form submission for adding a new product
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $file=$_FILES['image']['name'];
    $tname=$_FILES['image']['tmp_name'];

    $folder="../design/image/".$file;

    // Validate image upload
    if (move_uploaded_file($tname, $folder)) {
        // Insert the product into the database
        if (!empty($name) && !empty($price)) {
            $sql = "INSERT INTO books (`name`, `description`, `price`, `image`) VALUES ('$name','$description','$price','$folder')";
            if (mysqli_query($con, $sql)) {
                $message = "Book added successfully.";
            } else {
                $message = "Error: " . mysqli_error($con);
            }
        } else {
            $message = "Please fill in all required fields.";
        }
    } else {
        $message = "Failed to upload image.";
    }
}

// Fetch all books from the products table
$sql = "SELECT * FROM books";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Management</title>
    <?php include 'css.php'; ?>
</head>

<body>
    <div id="wrapper">
    <div id="sidebar-wrapper">
            <?php include 'sidebar.php'; ?>
        </div>

        <div id="page-content-wrapper">
          

            <?php if (isset($message)) { echo "<p class='alert'>$message</p>"; } ?>

            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card mb-5 border border-dark">
                            <div class="card-header text-center">
                            <h3 class="text-center">Book Management</h3>
                            </div>
                            <div class="card-body bg-info-subtle">
                                <form method="POST" action="" class="m-4" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control my-2 border border-dark" placeholder="Enter book name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" id="description" name="description" class="form-control my-2 border border-dark" placeholder="Enter description" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" id="price" name="price" class="form-control my-2 border border-dark" placeholder="Enter price" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" id="image" name="image" class="form-control my-2 border border-dark" required>
                                    </div>

                                    <div class="mb-3 text-center">
                                        <button type="submit" name="submit" class="btn btn-primary mt-3">Add Book</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'js.php'; ?>
</body>

</html>

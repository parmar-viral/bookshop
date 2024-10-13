<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'database/db.php'; // Ensure this path is correct

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['priority'] != 1) {
    echo "Unauthorized access!";
    exit;
}

// SQL query to select all books
$query = "SELECT * FROM books";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Delete logic
if (isset($_POST['delete'])) {
    $book_id = intval($_POST['book_id']);
    $delete_query = "DELETE FROM books WHERE id = $book_id";
    $delete_result = mysqli_query($con, $delete_query);
    
    if ($delete_result) {
        $message = "Book deleted successfully!";
        header("Location: view_book.php"); // Refresh page after deletion
    } else {
        $message = "Failed to delete the book: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <?php include 'css.php'; ?> <!-- Ensure Bootstrap is included here -->
</head>

<body>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <?php include 'sidebar.php'; ?>
        </div>

        <div id="page-content-wrapper">
            <?php if (isset($message)) { echo "<p class='alert'>$message</p>"; } ?>

            <div class="container mt-5">
                <h3 class="text-center">Existing Books</h3>
                <div class="row mt-3">
                    <?php if (mysqli_num_rows($result) > 0) { ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex align-items-stretch">
                                <div class="card h-100">
                                    <img src="<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="Book Image">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                                        <p class="card-text"><strong>Price: </strong><?php echo htmlspecialchars($row['price']); ?></p>
                                        <!-- Update and Delete buttons -->
                                        <div class="mt-3">
                                            <!-- Update button -->
                                            <a href="update_book.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Update</a>
                                            
                                            <!-- Delete button -->
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <p class="text-center">No books available.</p>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>

    <?php include 'js.php'; ?>
</body>

</html>

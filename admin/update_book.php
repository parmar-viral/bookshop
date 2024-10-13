<?php
session_start();
include 'database/db.php'; // Ensure this path is correct

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['priority'] != 1) {
    echo "Unauthorized access!";
    exit;
}

// Check if a book ID is provided
if (isset($_GET['id'])) {
    $book_id = intval($_GET['id']);

    // Fetch book details
    $query = "SELECT * FROM books WHERE id = $book_id";
    $result = mysqli_query($con, $query);
    $book = mysqli_fetch_assoc($result);

    if (!$book) {
        die("Book not found.");
    }

    // Update logic
    if (isset($_POST['update'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $price = floatval($_POST['price']);

        $update_query = "UPDATE books SET name = '$name', description = '$description', price = $price WHERE id = $book_id";
        if (mysqli_query($con, $update_query)) {
            $message = "Book updated successfully!";
            header("Location: view_book.php");
        } else {
            $message = "Failed to update book: " . mysqli_error($con);
        }
    }
} else {
    die("Invalid book ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <?php include 'css.php'; ?>
</head>
<body>
    <div class="container mt-5">
        <h2>Update Book</h2>
        <?php if (isset($message)) { echo "<p class='alert'>$message</p>"; } ?>
        <form method="POST">
            <div class="form-group">
                <label for="name">Book Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($book['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($book['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($book['price']); ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="view_book.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <?php include 'js.php'; ?>
</body>
</html>

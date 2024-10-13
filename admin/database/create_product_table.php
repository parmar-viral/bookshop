<?php
// Include database connection
include 'db.php';

// SQL query to create the product table
$sql = "CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Execute the query
if ($con->query($sql) === TRUE) {
    echo "Table 'books' created successfully";
} else {
    echo "Error creating table: " . $con->error;
}

// Close the connection
$con->close();
?>
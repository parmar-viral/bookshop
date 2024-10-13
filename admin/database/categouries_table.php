<?php
//  Include database connection
include 'db.php';

// SQL query to create the product table
$sql = "CREATE TABLE category(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255)
   
)";

// Execute the query
if ($con->query($sql) === TRUE) {
    echo "Table 'category' created successfully";
} else {
    echo "Error creating table: " . $con->error;
}

// Close the connection
$con->close();
?>

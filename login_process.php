<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('admin/database/db.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username, email, and password from the form
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Prepare and execute the SQL query to check user credentials
    $stmt = $con->prepare("SELECT * FROM users WHERE username = ? AND email = ?");
    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['priority'] = $user['priority']; // Use priority for admin check

            // Redirect based on priority
            if ($user['priority'] == 1) { // Assuming priority 1 indicates admin
                header("Location:admin/index.php"); // Redirect to admin dashboard
            } else {
                header("Location: index.php"); // Redirect to user home page
            }
            exit();
        } else {
            $_SESSION['error'] = "Invalid password.";
        }
    } else {
        $_SESSION['error'] = "Invalid username or email.";
    }
}

// Redirect back to the login page if there are errors
header("Location: login.php");
exit();
?>

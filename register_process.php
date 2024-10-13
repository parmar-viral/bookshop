<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include('admin/database/db.php'); // Include your database connection

// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $fname = sanitizeInput($_POST['fname']);
    $lname = sanitizeInput($_POST['lname']);
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password']; // This can be removed if not needed
    $mobile = sanitizeInput($_POST['mobile']);
    $address = sanitizeInput($_POST['address']);

    // Validate inputs
    if (empty($fname) || empty($lname) || empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($mobile) || empty($address)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: register.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: register.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: register.php");
        exit();
    }

    if (!preg_match('/^[0-9]{10}$/', $mobile)) {
        $_SESSION['error'] = "Mobile number must be a valid 10-digit number.";
        header("Location: register.php");
        exit();
    }

    // Check if the email or username already exists
    $stmt = $con->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email or Username is already registered.";
        header("Location: register.php");
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert the user data into the database using a prepared statement
    $stmt = $con->prepare("INSERT INTO users (fname, lname, username, email, password, mobile, address, priority) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $role = 0; // User role (0 for user, 1 for admin)

    // Bind parameters and execute the prepared statement
    $stmt->bind_param("ssssssss", $fname, $lname, $username, $email, $hashed_password, $mobile, $address, $role);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Registration successful
        $_SESSION['success'] = "Registration successful! You can now log in.";
        header("Location: login.php"); // Redirect to user side login page
        exit();
    } else {
        // Registration failed
        $_SESSION['error'] = "Error occurred while registering. Please try again.";
        header("Location: register.php"); // Redirect back to registration page
        exit();
    }
}
?>

<?php
session_start(); // Start the session

// Destroy the session
session_destroy();

// Redirect to the home page
header("Location: index.php");
exit();
?>

<?php
session_start();

// Destroy the session, logging out the user
session_unset();
session_destroy();

// Redirect to the login page (or any page you want after logout)
header("Location: ../index.php");
exit();
?>

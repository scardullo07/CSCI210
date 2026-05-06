<?php
session_start(); // Start the session to access session variables
session_destroy(); // Destroy the session
header("Location: index.php"); // Redirect to the home page
exit(); // Stop processing after redirecting
?>
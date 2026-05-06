<?php
//  Start a session so we can use session variables
session_start();

// Session variable set on the previous page can 
// be displayed on any page
echo "Welcome " . $_SESSION['username'] . "!<br>";
?>
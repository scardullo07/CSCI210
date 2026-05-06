<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">American Store</a>

            <div class="user-info">
                <?php
                // Check if the user is logged in and display a welcome message
                if (isset($_SESSION["username"])) {
                    echo "Welcome, " . ($_SESSION["username"]) . "!";
                } else {
                    echo "Welcome, Guest!";
                }
                ?>
            </div>

            <ul class="nav-links">
                <!-- Navigation links (bulleted list) -->
                <li><a href="index.php">Home</a></li>
                <li><a href="catalog.php">Catalog</a></li>

                <!-- Show "Login" or "Logout" link based on user's login status -->
                <?php if (isset($_SESSION["username"])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                     <li><a href="login.php">Login</a></li>
                <?php endif; ?>

                <li><a href="checkout.php" class="cart-btn">Cart</a></li>
            </ul>
        </div>
    </nav>
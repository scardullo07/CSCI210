<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                padding-top: 0 !important; <!-- Remove the default padding from the body element 
            }
        </style>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body class= "remove-padding">
        <div>
            <div class="login-header">
                <h1>Login to Your Account</h1>
            </div>
        </div>

        // If the url contains the error message "invalid_credentials"
        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials'): ?>
            <p class="error-message">
                Invalid username or password. Please try again.
            </p>
        <?php endif; ?>

        <!-- Login form with fields for username and password -->
        <form class="login-form" action="login_target.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button class="login-button" type="submit">Login</button>
        <a href="registration.php">
            <button class="register-button" type="button">Register</button>
        </a>
        </form>
        <!-- Button to return to the homepage -->
        <div class="return-home">
            <a href="index.php">
            <button class="home-button" type="button">Return to Homepage</button>
            </a>
        </div>
<?php include 'footer.php'; ?>
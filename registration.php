<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                /* Remove the default padding from the body element so registration-header is flush with the top of the page */
                padding-top: 0 !important; 
            }
        </style>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div class="registration-header">
            <h1>Create Your Account</h1>
        </div>
        <!-- Registration form with fields for username, email, and password -->
        <form class="registration-form" action="registration_target.php" method="POST">
            <label for="CustName">Name:</label><br>
            <input type="text" name="custname"><br>
            <label for="CustEmail">Email:</label><br>
            <input type="text" name="custemail"><br>
            <label for="CustPhone">Phone:</label><br>
            <input type="text" name="custphone"><br>
            <label for="Username">Username:</label><br>
            <input type="text" name="username"><br>
            <label for="Password">Password:</label><br>
            <input type="text" id="password" name="password"><br><br>
            <button class="register-button" type="submit">Register</button>
        </form>
        <!-- Button to return to the homepage -->
        <div class="return-home">
            <a href="index.php">
            <button class="home-button" type="button">Return to Homepage</button>
            </a>
        </div>
<?php include 'footer.php'; ?>
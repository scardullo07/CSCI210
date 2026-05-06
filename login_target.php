<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'connect.php'; ?>
</head>
    <body>
        <?php
            // get values from $_POST superglobal, set local variables
            $username = $_POST["username"];
            $password = $_POST["password"];
        ?>
        
        <h2>Login Target Page</h2>

        <?php 
        
        // SQL query to check if the username and password match a record in the authentication table
        $sql = "SELECT * FROM authentication WHERE username = '" . $username . "' AND password = '" . $password . "';";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "You are logged in!<br>";
            // copy dataset into a PHP array called $row
            $row = $result->fetch_assoc();
            $custusername = $row["username"];
            $customer_id = $row["CustID"];

            // the next line sets the session variable.  Now this value will be
            // available to use on any of the pages during this browsing session.
            $_SESSION["username"] = $custusername;
            $_SESSION["customer_id"] = $customer_id;
            
            header("Location: index.php"); // Redirect to the home page after successful login
            exit(); // Stop processing after redirecting
        }
        else {
            header("Location: login.php?error=invalid_credentials"); // Redirect back to login page with error message
            exit(); // Stop processing after redirecting
        }
        $conn->close();
    
    ?>
</body>
</html>
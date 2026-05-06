<!DOCTYPE html>
<html lang="en">	
<head>
	
<?php include 'connect.php'; ?>

</head>
<body>
	<?php
	
		$custusername = trim($_POST["username"]);
		$custpassword = trim($_POST["password"]);
		$custname = trim($_POST["custname"]);
		$custphone = trim($_POST["custphone"]);
		$custemail = trim($_POST["custemail"]);

//----------------------------------------------------------------------------	
	// insert form data into customers table

	$sqlcust = "INSERT INTO customers (CustName, email, phone) VALUES('" 
    . $custname . "','" 
    . $custemail . "','" 
    . $custphone . "')";

	$conn->query($sqlcust);

    $newcustID = $conn->insert_id; // Get the auto-generated customer ID from the authentication table

    $sqlauth = "INSERT INTO authentication (CustID, username, password) 
	VALUES (" . $newcustID . ", '" . $custusername . "', '" . $custpassword . "')";
	
	$conn->query($sqlauth);

	$conn->close();

	header("Location: login.php");
	?>
	
</body>

</html>
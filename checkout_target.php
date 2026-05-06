<?php
session_start();
include 'connect.php';

// Verify that the user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php?"); // Redirect to login page if not logged in  
    exit();
}

$customer_id = $_SESSION['customer_id']; // Get the customer ID from the session variable
$order_number = rand(100000, 999999); // Generate a unique order number

// Shipping and payment info
$name = $_POST['name'];
$address = $_POST['address'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$card = $_POST['card'];

// Orders table insert statement
$sql_transfer = "INSERT INTO orders (customer_id, product_id, order_date, order_number)
                SELECT customer_id, product_id, NOW(), ? FROM cart
                WHERE customer_id = ?";

$stmt = $conn->prepare($sql_transfer); // Sends to blank command
$stmt->bind_param("ii", $order_number, $customer_id); // Send parameters
$stmt->execute(); // Run command

// Shipping table insert statement
$sql_shipping = "INSERT INTO shipping (name, address, city, zip, card_number, order_number) VALUES (?, ?, ?, ?, ?, ?)";

$stmt_shipping = $conn->prepare($sql_shipping);
$stmt_shipping->bind_param("sssssi",$name, $address, $city, $zip, $card, $order_number);
$stmt_shipping->execute();

// Clear the cart after transferring the items to the orders table
$sql_clear_cart = "DELETE FROM cart WHERE customer_id = ?";

$stmt_clear = $conn->prepare($sql_clear_cart);
$stmt_clear->bind_param("i", $customer_id);
$stmt_clear->execute();

header("Location: receipt_page.php?id=" . $order_number); // Include the order number in the receipt page url
exit();

$stmt->close();
$conn->close();
?>
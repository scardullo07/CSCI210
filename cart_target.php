<?php
session_start();
include 'connect.php';

// Check if user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php?"); // Redirect to login page if not logged in  
    exit();
}

// Get data from the URL
$customer_id = $_SESSION['customer_id'];
$product_id  = $_GET['id'];
$quantity    = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1;

if (!empty($product_id)) {
    // Insert into the Cart database table
    $cart_sql = $conn->prepare("INSERT INTO cart (customer_id, product_id) VALUES (?, ?)");
    
    for ($i = 0; $i < $quantity; $i++) {
        $cart_sql->bind_param("ii", $customer_id, $product_id); // Inserting two integers for the values
        $cart_sql->execute();
    }
    
    $cart_sql->close();
}

// Redirect to the catalog page
header("Location: catalog.php"); 
exit();
?>
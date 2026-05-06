<?php
include 'header.php';
include 'connect.php';

$order_number = $_GET['id']; // Get the order number from the URL
$customer_id = $_SESSION['customer_id']; // Get the customer ID from the session variable

// Find the product_id in the order and check the products with the same product_id to get name and price of the products
$sql = "SELECT o.order_number, o.order_date, p.product_name, p.price 
        FROM orders o
        JOIN products p ON o.product_id = p.product_id
        WHERE o.customer_id = ? AND o.order_number = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $customer_id, $order_number);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class='login-form'>
<?php
if ($result->num_rows > 0) {
    echo "<h2>Order Receipt</h2>";
    $total = 0; // Initialize total variable to keep track of the total cost of the order
   
    $first_row = true; // Flag to check if it's the first row of the order details

    while ($row = $result->fetch_assoc()) {
        
        if ($first_row) {
            echo "<p>Order Number: " . $row['order_number'] . "</p>";
            echo "<p>Order Date: " . $row['order_date'] . "</p>";
            $first_row = false; // Set the flag to false after processing the first row
        }
        echo "<p>Product Name: " . $row['product_name'] . "</p>";
        echo "<p>Price: $" . $row['price'] . "</p>";
        echo "<hr>";
        $total += $row['price']; // Add the price of each item to the total
    }
    echo "<h3>Total: $" . $total . "</h3>"; // Display the total cost of the order
    ?>
    <a href="catalog.php"><button class="continue-shopping-btn">Continue Shopping</button></a> <!-- Button to continue shopping -->
    <?php
} else {
    echo "<p>No order details found.</p>"; // Display a message if no order details are found
}
$stmt->close();
$conn->close();
?>
</div>
<?php include 'footer.php'; ?>

<?php include 'header.php';
include 'connect.php';
?>
<div class="checkout-header">
    <h2>Checkout</h2>
</div>
<div class="checkout-wrapper">
    <div class="checkout-left">
        <div class="shipping-info">
            <h2>
                Shipping Information
            </h2>
        </div>
        <div class="checkout-form">
            <!-- Checkout form with fields for name, address, city, zip code, and payment information (still need to add payment information fields) -->
            <form action="checkout_target.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <br>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
                <br>
                <label for ="City">City:</label>
                <input type="text" id="city" name="city" required>
                <br>
                <label for="Zip">Zip Code:</label>
                <input type="text" id="zip" name="zip" required>
                <br>
                <h2>Payment Information</h2>
                <br>
                <label for="card">Card Number:</label>
                <input type="text" id="card" name="card" required>
                <button class="checkout-button" type="submit">Place Order</button>
            </form>
        </div>
    </div>
                <!-- Order summary section -->
                <div class="checkout-right">
                    <h2>Order Summary</h2>
                    <?php

                    $total = 0; // Initialize total variable to keep track of the total cost of the order
                   
                    $customer_id = $_SESSION['customer_id']; // Get the customer ID from the session variable

                    // Find the customer_id in the cart table and use it to select the name and price for the corresponding products in the products table
                    $sql = "SELECT p.product_name, p.price FROM cart c
                            JOIN products p ON c.product_id = p.product_id
                            WHERE c.customer_id = '$customer_id'"; // SQL query to get the product names and prices for the items in the cart based on the customer ID

                    $result = $conn->query($sql); // Execute the query

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<p>" . $row['product_name'] . ": $" . $row['price'] . "</p>"; // Display the product name and price for each item in the cart
                            $total += $row['price']; // Add the price of each item to the total
                        }
                    echo "<h3>Total: $" . $total . "</h3>"; // Display the total cost of the order
                    } else {
                        echo "<p>Your cart is empty.</p>"; // Display a message if the cart is empty
                    }
                    $conn->close(); // Close the database connection
                    ?>
                </div>
</div>
<?php include 'footer.php'; ?>
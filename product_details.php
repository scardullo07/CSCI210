<?php 
include 'header.php';
include 'connect.php';

$productID = $_GET['id']; // Get the product ID from the URL

$sql = "SELECT * FROM products WHERE product_id = '$productID'"; // SQL query to fetch product details based on the product ID
$result = $conn->query($sql); // Execute the query

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Fetch the product details
} else {
    echo "Product not found."; // Display a message if the product is not found
    exit();
}
?>

<script>
function addToCart(productID) {
    var quantity = document.getElementById("quantity").value; // Get the quantity from the input field
    document.location.href = "cart_target.php?id=" + productID + "&quantity=" + quantity;
}
</script>

    <main class="product-details-container">
       <!-- Product image and alt text -->
        <div class="product-image">
            <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['product_name']; ?>">
        </div>
        <!-- Product information section with product name, price, description, and purchase options -->
        <div class="product-info">
            <h1><?php echo $row['product_name']; ?></h1>
            <p class="price">$<?php echo $row['price']; ?></p>
            <p class="description"><?php echo $row['description']; ?></p>
            <div class="purchase-options">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1"> <!-- Quantity input field for users to specify how many items they want to purchase -->
                <!-- Add to cart button -->
                <button class="add-to-cart-btn" onclick="addToCart('<?php echo $productID; ?>')">Add to Cart</button> 
            </div>
        </div>
    </main>
<?php include 'footer.php'; ?>
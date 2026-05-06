<?php 
include 'header.php';
include 'connect.php'; 

// Use post check if there is a search/price range and set it to a variable
$search_text = isset($_POST['search']) ? $_POST['search'] : '';
$price_ranges = isset($_POST['price']) ? $_POST['price'] : [];

// Create a true WHERE clause so every if statement can use AND without checking if where is already used
$sql = "SELECT * FROM products WHERE 1=1"; 

// If there is a search, grab products that have a similar name or description
if (!empty($search_text)) {
    $sql .= " AND (product_name LIKE '%$search_text%' OR description LIKE '%$search_text%')";
}
// If there are filters set, grab the corresponding products
if (!empty($price_ranges)) {
    if (in_array('under10', $price_ranges) && in_array('10-50', $price_ranges) ) {
        $sql .= " AND (price < 10" . " OR price BETWEEN 10 AND 50)";
    }
    else if (in_array('under10', $price_ranges)) {
        $sql .= " AND price < 10";
    }
    else if (in_array('10-50', $price_ranges)) {
        $sql .= " AND price BETWEEN 10 AND 50";
    }
}

$result = $conn->query($sql); // Send command to the database
?>

<div class="catalog-header">
    <div class="search-container">
        <h2>Search Catalog</h2>
        <!-- Search bar with placeholder text and search button -->
        <div class="search-box">
            <form action="catalog.php" method="post">
            <input type="text" name="search" placeholder="Search for products..." 
            class="search-input" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
            <button type="submit" class="search-btn">Search</button>
            </form>                
        </div>
    </div>
</div>

<div class="catalog-content">
    <div class="filter-form">
        <!-- Filter form with checkboxes for price ranges and apply filters button -->
        <form action="catalog.php" method="post">

        <h1>Filters:</h1>
        <ul>
        <li>
            <div>
                <input type="checkbox" name="price[]" value="under10" id="price_range1"  />
                <label for="price_range1">Under $10</label>
            </div>
        </li>
                <li>
            <div>
                <input type="checkbox" name="price[]" value="10-50" id="price_range2"  />
                <label for="price_range2">$10-$50</label>
            </div>
        </li>
        </ul>
        <button type="submit">Apply Filters</button>
        </form>
    </div>
    
    <div class="product-grid">

    <?php if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { // $row will update with each row and become null when it reaches the end
            ?>
            <div class="product-card">
                <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['product_name']; ?>">
                <h3><?php echo $row['product_name']; ?></h3>
                <p class="price">$<?php echo $row['price']; ?></p>
                <a href="product_details.php?id=<?php echo $row['product_id']; ?>" class="view-btn">View Details</a>
            </div>
            <?php
        }
    } else {
        echo "No products found.";
    }
    $conn->close();
    ?>
    </div>    
</div>
<?php include 'footer.php'; ?>
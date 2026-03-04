<?php
session_start(); // start session
include 'db/db.php'; // connect to database

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // get product id from url
$sql = "SELECT * FROM products WHERE id=$id"; // fetch product data
$result = $conn->query($sql);
if(!$result || $result->num_rows==0){
    echo "Product not found"; // check if product exists
    exit;
}
$row = $result->fetch_assoc(); // get product row
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/style.css"> <!-- link to styles -->
</head>
<body>
<div class="form-container"> <!-- styled form container -->
    <h2>Edit Product</h2>
    <form action="update_product.php" method="POST"> <!-- form to update product -->
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required> <!-- display current name safely -->
        <label>Price</label>
        <input type="text" name="price" value="<?php echo htmlspecialchars($row['price']); ?>"> <!-- display current price safely -->
        <label>Location</label>
        <input type="text" name="location" value="<?php echo htmlspecialchars($row['location']); ?>"> <!-- display current location safely -->
        <label>Description</label>
        <textarea name="description"><?php echo htmlspecialchars($row['description']); ?></textarea> <!-- display current description safely -->
        <label>Availability</label>
        <select name="available">
            <option value="1"<?php if($row['available']==1) echo ' selected'; ?>>Available</option>
            <option value="0"<?php if($row['available']==0) echo ' selected'; ?>>Sold Out</option>
        </select> <!-- select current availability -->
        <button type="submit">Update</button>
    </form>
</div>
</body>
</html>
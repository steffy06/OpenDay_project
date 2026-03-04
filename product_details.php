<?php
include 'db/db.php'; // connect to database

if(!isset($_GET['id'])){
    echo "Missing product ID"; // check for product id
    exit;
}

$id = (int)$_GET['id']; // sanitize id
$sql = "SELECT p.*, u.name AS vendor_name, u.contact AS vendor_contact
        FROM products p
        LEFT JOIN users u ON p.vendor_id = u.id
        WHERE p.id=$id"; // fetch product and vendor info

$result = $conn->query($sql);
if(!$result || $result->num_rows == 0){
    echo "Product not found"; // check if found
    exit;
}

$row = $result->fetch_assoc(); // get data
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['name']); ?> - Details</title>
    <link rel="stylesheet" href="css/style.css"> <!-- link to styles -->
</head>
<body>
<div class="product-detail"> <!-- styled detail container -->
    <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>"> <!-- show product image -->
    <h2><?php echo htmlspecialchars($row['name']); ?></h2> <!-- show product name -->
    <p><strong>Price:</strong> $<?php echo htmlspecialchars($row['price']); ?></p> <!-- show price -->
    <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($row['description'])); ?></p> <!-- show description -->
    <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p> <!-- show location -->
    <p><strong>Vendor:</strong> <?php echo htmlspecialchars($row['vendor_name']); ?> <!-- show vendor name -->
        (<?php echo htmlspecialchars($row['vendor_contact']); ?>)</p> <!-- show vendor contact -->
    <?php if($row['available']==1){ ?>
        <span class="badge available">Available</span> <!-- show availability badge -->
    <?php } else { ?>
        <span class="badge sold">Sold Out</span>
    <?php } ?>
    <p><a href="marketplace.php" class="details-btn">Back to Marketplace</a></p> <!-- back link -->
</div>
</body>
</html>
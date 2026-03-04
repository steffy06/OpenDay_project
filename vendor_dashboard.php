<?php
session_start();

if(!isset($_SESSION['vendor_id'])){
    header("Location: vendor_login.php");
}

$vendor_id = $_SESSION['vendor_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            margin-top: 0;
        }
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 30px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .product-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 4px;
        }
        .product-card h3 {
            margin: 10px 0;
            color: #333;
        }
        .product-card p {
            color: #4CAF50;
            font-size: 18px;
            font-weight: bold;
        }
        .product-card a {
            display: inline-block;
            margin: 5px;
            padding: 8px 12px;
            background-color: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .product-card a:last-child {
            background-color: #f44336;
        }
        .product-card a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
<h2>Vendor Dashboard</h2>

<form action="upload_product.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="vendor_id" value="<?php echo $vendor_id; ?>">

<input type="text" name="name" placeholder="Product Name" required>

<input type="text" name="price" placeholder="Price">

<textarea name="description" placeholder="Description"></textarea>

<input type="text" name="location" placeholder="Location">

<input type="file" name="image" required>

<select name="available">
<option value="1">Available</option>
<option value="0">Sold Out</option>
</select>

<button type="submit">Upload Product</button>

</form>
<?php
include 'db/db.php';

$sql = "SELECT * FROM products WHERE vendor_id = $vendor_id";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
?>

<div class="product-card">

<img src="uploads/<?php echo $row['image']; ?>">

<h3><?php echo $row['name']; ?></h3>

<p>$<?php echo $row['price']; ?></p>

<a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a>

<a href="delete_product.php?id=<?php echo $row['id']; ?>">Delete</a>

</div>

<?php
}
?>
    </div> <!-- close container -->
</body>
</html> <!-- close html structure -->
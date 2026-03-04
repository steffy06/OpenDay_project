<?php
include 'db/db.php';

$search = "";

if(isset($_GET['search'])){
$search = $_GET['search'];
}

$sql = "SELECT * FROM products
WHERE name LIKE '%$search%'";

$result = $conn->query($sql);
?>
<link rel="stylesheet" href="css/style.css">

<h2>Marketplace</h2>

<div class="search-bar">

<form method="GET">

<input type="text" name="search" placeholder="Search for products">

<button type="submit">Search</button>

</form>

</div>

<?php
while($row = $result->fetch_assoc()){
?>

<div class="products">

<?php
while($row = $result->fetch_assoc()){
?>

<div class="product-card">

<img src="uploads/<?php echo $row['image']; ?>">

<h3><?php echo $row['name']; ?></h3>

<p>$<?php echo $row['price']; ?></p>

<p><?php echo $row['description']; ?></p>

<p><?php echo $row['location']; ?></p>

<?php
if($row['available']==1){
echo "<span class='badge available'>Available</span>";
}else{
echo "<span class='badge sold'>Sold Out</span>";
}
?>

</div>

<?php } ?>

</div>

<?php
}
?>
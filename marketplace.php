<?php
session_start();                         // start session for customer login
// if(!isset($_SESSION['customer_id'])){
//     header('Location: customer_login.php');
//     exit;
// still working with this so dont mind bout it }
include 'db/db.php';

//testtt

$search = "";

if(isset($_GET['search'])){
    $search = $conn->real_escape_string($_GET['search']); // escape search input for safety
}

// fetch all products (optionally only available ones)
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
        <a href="product_details.php?id=<?php echo $row['id']; ?>" class="details-btn">View Details</a> 
    </div>
<?php
}
?>
</div>
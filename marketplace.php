<?php
session_start();                         
include 'db/db.php';

$search = "";
if(isset($_GET['search'])){
    $search = $conn->real_escape_string($_GET['search']); 
}

$sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
$result = $conn->query($sql);
?>
<link rel="stylesheet" href="css/style.css">

<!-- NAVBAR -->
<nav class="navbar">
    <div class="logo">Belize Local Market</div>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="marketplace.php" class="active">Marketplace</a></li>
        <li><a href="cart.php">Cart</a></li>
        <li><a href="profile.php">Profile</a></li>
    </ul>
</nav>

<!-- PAGE HEADER -->
<div class="page-header">
    <h2>Marketplace</h2>
</div>

<!-- SEARCH BAR -->
<div class="search-bar">
    <form method="GET">
        <input type="text" name="search" placeholder="Search for products" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
    </form>
</div>

<!-- PRODUCTS GRID -->
<div class="products">
<?php
while($row = $result->fetch_assoc()){
?>
    <div class="product-card">
        <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
        <h3><?php echo $row['name']; ?></h3>
        <p class="price">$<?php echo number_format($row['price'], 2); ?></p>
        <p class="description"><?php echo $row['description']; ?></p>
        <p class="location"><?php echo $row['location']; ?></p>
        <?php if($row['available']==1): ?>
            <span class='badge available'>Available</span>
        <?php else: ?>
            <span class='badge sold'>Sold Out</span>
        <?php endif; ?>
        <a href="product_details.php?id=<?php echo $row['id']; ?>" class="details-btn">View Details</a>
    </div>
<?php
}
?>
</div>

<!-- CSS (you can move this to style.css) -->
<style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}
.navbar {
    background-color: #004aad;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 50px;
}
.navbar .logo {
    font-size: 1.8rem;
    font-weight: bold;
}
.navbar .nav-links {
    list-style: none;
    display: flex;
    gap: 25px;
}
.navbar .nav-links li a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}
.navbar .nav-links li a:hover,
.navbar .nav-links li a.active {
    color: #ffd700;
}
.page-header {
    text-align: center;
    margin: 25px 0;
    color: #004aad;
}
.search-bar {
    text-align: center;
    margin-bottom: 30px;
}
.search-bar input[type="text"] {
    padding: 10px 15px;
    width: 300px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
.search-bar button {
    padding: 10px 20px;
    border: none;
    background-color: #004aad;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}
.search-bar button:hover {
    background-color: #003080;
}
.products {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 25px;
    padding: 0 50px 50px 50px;
}
.product-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    text-align: center;
    transition: transform 0.3s;
}
.product-card:hover {
    transform: translateY(-5px);
}
.product-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
}
.product-card h3 {
    margin: 15px 0 5px 0;
    color: #004aad;
}
.product-card .price {
    font-weight: bold;
    margin-bottom: 5px;
}
.product-card .description, .product-card .location {
    font-size: 0.9rem;
    color: #555;
    margin-bottom: 5px;
}
.badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 5px;
    margin-bottom: 10px;
    font-size: 0.8rem;
    font-weight: bold;
}
.badge.available { background-color: #28a745; color: #fff; }
.badge.sold { background-color: #dc3545; color: #fff; }
.details-btn {
    display: inline-block;
    padding: 8px 15px;
    background-color: #004aad;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s;
}
.details-btn:hover {
    background-color: #003080;
}
</style>
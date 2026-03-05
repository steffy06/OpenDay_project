<?php
session_start();
include 'db/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'vendor'){
    header("Location: login.php");
    exit;
}

$vendor_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>

<title>Vendor Dashboard</title>

<!-- NAVIGATION -->
<div style="background:#4CAF50;padding:15px;color:white;display:flex;justify-content:flex-end;align-items:center;border-radius:10px 10px 0 0;margin-bottom:20px;">
    <span style="margin-right:auto;font-weight:bold;">Vendor Dashboard</span>
    <a href="logout.php" style="color:white;text-decoration:none;font-weight:bold;">Logout</a>
</div>

<style>

body{
font-family:Arial;
background:#f4f6f9;
margin:0;
padding:30px;
}

.container{
max-width:1200px;
margin:auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

h2{
margin-top:0;
}

/* TABS */

.tabs{
display:flex;
gap:10px;
margin-bottom:20px;
}

.tab-btn{
padding:10px 20px;
background:#eee;
border:none;
cursor:pointer;
border-radius:5px;
}

.tab-btn.active{
background:#4CAF50;
color:white;
}

/* TAB CONTENT */

.tab-content{
display:none;
}

.tab-content.active{
display:block;
}

/* FORM */

form{
background:#f9f9f9;
padding:20px;
border-radius:8px;
margin-bottom:20px;
}

input,textarea,select{
width:100%;
padding:10px;
margin:10px 0;
border:1px solid #ddd;
border-radius:5px;
}

/* BUTTON */

button{
background:#4CAF50;
color:white;
padding:10px 20px;
border:none;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#45a049;
}

/* PRODUCTS GRID */

.products-grid{
display:grid;
grid-template-columns:repeat(auto-fill,minmax(250px,1fr));
gap:20px;
}

/* PRODUCT CARD */

.product-card{
background:white;
border-radius:10px;
overflow:hidden;
box-shadow:0 4px 15px rgba(0,0,0,0.08);
transition:0.3s;
position:relative;
}

.product-card:hover{
transform:translateY(-5px);
}

.product-card img{
width:100%;
height:200px;
object-fit:cover;
}

.product-info{
padding:15px;
}

.product-info h3{
margin:0;
}

.price{
color:#4CAF50;
font-weight:bold;
margin-top:5px;
}

.location{
font-size:14px;
color:#777;
}

/* BUTTONS */

.card-buttons{
margin-top:10px;
display:flex;
gap:10px;
}

.edit-btn{
background:#2196F3;
padding:5px 10px;
color:white;
text-decoration:none;
border-radius:4px;
}

.delete-btn{
background:#f44336;
padding:5px 10px;
color:white;
text-decoration:none;
border-radius:4px;
}

/* STATUS BADGE */

.status{
position:absolute;
top:10px;
left:10px;
padding:4px 10px;
border-radius:20px;
font-size:12px;
color:white;
}

.available{
background:#4CAF50;
}

.sold{
background:#f44336;
}

</style>

</head>


<body>

<div class="container">

<h2>Vendor Dashboard</h2>

<!-- TABS -->

<div class="tabs">

<button class="tab-btn active" onclick="openTab('upload')">Upload Product</button>

<button class="tab-btn" onclick="openTab('myproducts')">My Products</button>

<button class="tab-btn" onclick="openTab('market')">Market View</button>

</div>


<!-- UPLOAD PRODUCT TAB -->

<div id="upload" class="tab-content active">

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

</div>


<!-- MY PRODUCTS -->

<div id="myproducts" class="tab-content">

<div class="products-grid">

<?php

$sql = "SELECT * FROM products WHERE vendor_id = $vendor_id";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

?>

<div class="product-card">

<?php if($row['available']==1){ ?>

<div class="status available">Available</div>

<?php } else { ?>

<div class="status sold">Sold Out</div>

<?php } ?>

<img src="uploads/<?php echo $row['image']; ?>">

<div class="product-info">

<h3><?php echo $row['name']; ?></h3>

<div class="price">$<?php echo $row['price']; ?></div>

<div class="location"><?php echo $row['location']; ?></div>

<div class="card-buttons">

<a class="edit-btn" href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a>

<a class="delete-btn" href="delete_product.php?id=<?php echo $row['id']; ?>">Delete</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>


<!-- MARKET VIEW -->

<div id="market" class="tab-content">

<div class="products-grid">

<?php

$sql = "SELECT * FROM products WHERE vendor_id != $vendor_id";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

?>

<div class="product-card">

<?php if($row['available']==1){ ?>

<div class="status available">Available</div>

<?php } else { ?>

<div class="status sold">Sold Out</div>

<?php } ?>

<img src="uploads/<?php echo $row['image']; ?>">

<div class="product-info">

<h3><?php echo $row['name']; ?></h3>

<div class="price">$<?php echo $row['price']; ?></div>

<div class="location"><?php echo $row['location']; ?></div>

        <a href="product_detailsVD.php?id=<?php echo $row['id']; ?>" class="details-btn">View Details</a> 

</div>

</div>

<?php } ?>

</div>

</div>

</div>


<script>

function openTab(tab){

let contents=document.querySelectorAll(".tab-content");
let buttons=document.querySelectorAll(".tab-btn");

contents.forEach(c=>c.classList.remove("active"));
buttons.forEach(b=>b.classList.remove("active"));

document.getElementById(tab).classList.add("active");
event.target.classList.add("active");

}

</script>


</body>
</html>
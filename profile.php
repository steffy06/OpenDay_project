<?php
session_start();
include 'db/db.php';

// Check if vendor is logged in
if(!isset($_SESSION['vendor_id'])){
    header("Location: vendor_login.php");
    exit;
}

$vendor_id = $_SESSION['vendor_id'];

// Get vendor info from database
$sql = "SELECT * FROM vendors WHERE id = $vendor_id";
$result = $conn->query($sql);
$vendor = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vendor Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">Belize Local Market</div>
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="vendor_dashboard.php">Dashboard</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<div class="container">
    <h2>My Profile</h2>
    <p><strong>Name:</strong> <?php echo $vendor['name']; ?></p>
    <p><strong>Email:</strong> <?php echo $vendor['email']; ?></p>
    <p><strong>Phone:</strong> <?php echo $vendor['phone']; ?></p>
    <p><strong>Shop Name:</strong> <?php echo $vendor['shop_name']; ?></p>
</div>

</body>
</html>
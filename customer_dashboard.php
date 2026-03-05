<?php
session_start();
include 'db/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer'){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar">
    <div class="logo">Belize Local Market</div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="marketplace.php">Marketplace</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<div class="container">
    <h2>Welcome, Customer!</h2>
    <p>Here you can browse products and make purchases.</p>
</div>

</body>
</html>
<?php
include 'db/db.php'; // connect to database

$id = (int)$_POST['id']; // get product id, that real escape thing is to prevent errors from backslashes.
$name = $conn->real_escape_string($_POST['name']); // escape name
$price = $conn->real_escape_string($_POST['price']); // escape price
$location = $conn->real_escape_string($_POST['location']); // escape location
$description = $conn->real_escape_string($_POST['description']); // escape description
$available = isset($_POST['available']) ? (int)$_POST['available'] : 1; // get availability

$sql = "UPDATE products
SET name='$name',
    price='$price',
    location='$location',
    description='$description',
    available=$available
WHERE id=$id"; // update product in database

$conn->query($sql); // run update

header("Location: vendor_dashboard.php"); // redirect to dashboard
exit; // stop script
?>
<?php
session_start(); // start session
include 'db/db.php'; // connect to database

// require a logged-in vendor, use session id to avoid tampering
if(!isset($_SESSION['vendor_id'])){
    header('Location: vendor_login.php');
    exit;
}

$vendor_id = $_SESSION['vendor_id']; // get vendor id from session

// simple sanitization
$name = $conn->real_escape_string($_POST['name']); // escape name input
$price = $conn->real_escape_string($_POST['price']); // escape price input
$description = $conn->real_escape_string($_POST['description']); // escape description input
$location = $conn->real_escape_string($_POST['location']); // escape location input
$available = isset($_POST['available']) ? (int)$_POST['available'] : 1; // get availability

// handle file upload
$image = '';
if(isset($_FILES['image']) && $_FILES['image']['tmp_name'] !== ''){
    $image = basename($_FILES['image']['name']); // get image filename
    $temp  = $_FILES['image']['tmp_name'];
    move_uploaded_file($temp, "uploads/" . $image); // move uploaded file
}

$sql = "INSERT INTO products
    (vendor_id,name,price,description,location,image,available)
    VALUES
    ('$vendor_id','$name','$price','$description','$location','$image','$available')"; // insert product into database

if($conn->query($sql)){
    // redirect back to dashboard so form doesn't resubmit
    header('Location: vendor_dashboard.php');
    exit;
} else {
    echo "Error: " . $conn->error; // show error if failed
}
?>
<?php
session_start();
include '../db/db.php';

$contact = $_POST['contact'];
$password = $_POST['password'];

$sql = "SELECT * FROM users
WHERE contact='$contact' AND role='vendor'";

$result = $conn->query($sql);

if($result->num_rows > 0){

$user = $result->fetch_assoc();

if(password_verify($password,$user['password'])){

$_SESSION['vendor_id'] = $user['id'];

header("Location: ../vendor_dashboard.php");

}else{
echo "Incorrect password";
}

}else{
echo "Account not found";
}
?>
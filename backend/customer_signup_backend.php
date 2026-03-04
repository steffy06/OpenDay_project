<?php
session_start();
include '../db/db.php';

$name = $_POST['name'];
$contact = $_POST['contact'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$role = "customer";

$sql = "INSERT INTO users (name,contact,password,role)
VALUES ('$name','$contact','$password','$role')";

$conn->query($sql);

$_SESSION['customer_id'] = $conn->insert_id;

header("Location: ../marketplace.php");
?>
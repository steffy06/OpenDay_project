<?php
include 'db/db.php';

$id = $_GET['id'];

$sql = "DELETE FROM products WHERE id=$id";

$conn->query($sql);

header("Location: vendor_dashboard.php");
?>
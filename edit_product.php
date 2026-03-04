<?php
include 'db/db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE id=$id";

$result = $conn->query($sql);

$row = $result->fetch_assoc();
?>

<form action="update_product.php" method="POST">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<input type="text" name="name" value="<?php echo $row['name']; ?>">

<input type="text" name="price" value="<?php echo $row['price']; ?>">

<textarea name="description"><?php echo $row['description']; ?></textarea>

<button type="submit">Update</button>

</form>
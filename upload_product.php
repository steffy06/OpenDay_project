<!-- <?php
//include 'db/db.php';

$vendor_id = $_POST['vendor_id'];
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$location = $_POST['location'];
$available = $_POST['available'];

$image = $_FILES['image']['name'];
$temp = $_FILES['image']['tmp_name'];

move_uploaded_file($temp,"uploads/".$image);

$sql = "INSERT INTO products
(vendor_id,name,price,description,location,image,available)
VALUES
('$vendor_id','$name','$price','$description','$location','$image','$available')";

$conn->query($sql);

echo "Product Uploaded Successfully";
?> -->
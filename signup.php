<?php
session_start();
include 'db/db.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['name'];
    $contact = $_POST['contact']; // email or phone
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role']; // 'vendor' or 'customer'

    // Check if account exists
    $sql = "SELECT * FROM users WHERE contact=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$contact);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $error = "Account already exists!";
    } else {
        $sql = "INSERT INTO users (name, contact, password, role) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss",$name,$contact,$password,$role);
        $stmt->execute();
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['role'] = $role;
        header("Location: ".($role=='vendor'?'vendor_dashboard.php':'customer_dashboard.php'));
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="auth-container">
    <h2>Sign Up</h2>
    <form action="signup_backend.php" method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="contact" placeholder="Email or Phone" required>
        <select name="role" required>
            <option value="">I am a...</option>
            <option value="vendor">Vendor</option>
            <option value="customer">Customer</option>
        </select>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>

</body>
</html>
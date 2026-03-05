<?php
session_start();
include 'db/db.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $contact = $_POST['contact']; // user enters email or phone
    $password = $_POST['password'];

    // Use 'contact' column instead of email/phone
    $sql = "SELECT * FROM users WHERE contact=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$contact);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $user = $result->fetch_assoc();
        if(password_verify($password,$user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            // redirect based on role
            header("Location: ".($user['role']=='vendor'?'vendor_dashboard.php':'customer_dashboard.php'));
            exit;
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Account not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Belize Local Market</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="auth-container">
   <h2>Login</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="">
        <input type="text" name="contact" placeholder="Email or Phone" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
</div>

</body>
</html>



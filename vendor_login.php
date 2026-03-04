<!DOCTYPE html>
<html>
<head>
<title>Vendor Login</title>
<link rel="stylesheet" href="css/login.css">
</head>

<body>

<div class="login-container">

<!-- LEFT SIDE IMAGE -->

<div class="login-image">

<div class="overlay">
<h1>Belize Local Market</h1>
<p>Connecting local vendors and customers in one marketplace.</p>
</div>

</div>


<!-- RIGHT SIDE FORM -->

<div class="login-form">

<h2>Vendor Login</h2>

<form action="backend/vendor_login_backend.php" method="POST">

<input type="text" name="contact" placeholder="Email or Phone" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit">Login</button>

</form>

<p class="signup">
Don't have an account?
<a href="vendor_signup.php">Sign Up</a>
</p>

</div>

</div>

</body>
</html>
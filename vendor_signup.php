<link rel="stylesheet" href="css/style.css">

<div class="form-container">

<h2>Create Vendor Account</h2>

<form action="backend/vendor_signup_backend.php" method="POST">

<input type="text" name="name" placeholder="Full Name" required>

<input type="text" name="contact" placeholder="Email or Phone" required>

<input type="password" name="password" placeholder="Create Password" required>

<button type="submit">Sign Up</button>

</form>

<p style="text-align:center;margin-top:10px;">
Already have an account?
<a href="vendor_login.php">Login</a>
</p>

</div>
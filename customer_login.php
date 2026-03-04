<link rel="stylesheet" href="css/style.css">

<div class="form-container">

<h2>Customer Login</h2>

<form action="backend/customer_login_backend.php" method="POST">

<input type="text" name="contact" placeholder="Email or Phone" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit">Login</button>

</form>

<p style="text-align:center;margin-top:10px;">
Don't have an account?
<a href="customer_signup.php">Sign Up</a>
</p>

</div>
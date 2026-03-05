<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belize Local Market</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Dropdown navbar for logged-in users */
        .navbar ul li {
            position: relative;
        }
        .navbar .dropdown-menu {
            display: none;
            position: absolute;
            top: 40px;
            left: 0;
            background: #FFFFFF;
            color: #2C3E50;
            min-width: 150px;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            z-index: 10;
        }
        .navbar .dropdown-menu li {
            margin: 0;
        }
        .navbar .dropdown-menu li a {
            display: block;
            padding: 10px 15px;
            color: #2C3E50;
            text-decoration: none;
        }
        .navbar .dropdown-menu li a:hover {
            background: #ECF0F1;
        }
        .navbar .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="logo">Belize Local Market</div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="marketplace.php">Marketplace</a></li>

        <?php if(isset($_SESSION['user_id'])): ?>
            <li class="dropdown">
                <a href="#">Account ▾</a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $_SESSION['role']=='vendor'?'vendor_dashboard.php':'customer_dashboard.php'; ?>">Dashboard</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-text">
        <h1>Support Local Vendors in Belize</h1>
        <p>Connecting local vendors and customers in one simple, easy-to-use marketplace.</p>
        
        <?php if(!isset($_SESSION['user_id'])): ?>
            <a href="login.php" class="btn btn-primary">Login</a>
            <a href="signup.php" class="btn btn-secondary">Sign Up</a>
        <?php else: ?>
            <a href="<?php echo $_SESSION['role']=='vendor'?'vendor_dashboard.php':'customer_dashboard.php'; ?>" class="btn btn-primary">
                Go to Dashboard
            </a>
        <?php endif; ?>
    </div>

    <div class="hero-image">
        <img src="uploads/market.jpg" alt="Local Market">
    </div>
</section>

<!-- INFO CARDS -->
<section class="info-cards">
    <div class="card">
        <h3>Vendors</h3>
        <p>Create your shop, upload products, and reach local customers easily.</p>
    </div>
    <div class="card">
        <h3>Customers</h3>
        <p>Browse local products, support your community, and shop safely online.</p>
    </div>
    <div class="card">
        <h3>Secure & Easy</h3>
        <p>Safe transactions, simple interface, and fast access to your dashboard.</p>
    </div>
</section>

</body>
</html>
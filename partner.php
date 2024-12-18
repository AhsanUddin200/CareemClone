<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    // For demonstration, assume user_id = 1
    $_SESSION['user_id'] = 1; 
    // In a real app, you'd redirect to login.php if not logged in.
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Partners - Careem</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f0f4f8;
            text-align: center;
        }

        .header-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.logo {
    display: flex;
    align-items: center;
    font-size: 24px;
    color: #4a4a4a;
}

.logo-icon {
    margin-right: 8px;
}

.nav-links a {
    margin: 0 15px;
    text-decoration: none;
    color: #4a4a4a;
    font-weight: 500;
}

.nav-links a:hover {
    color: #007bff;
}

.sign-in {
    background: #00b894;
    color: #fff;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    transition: background 0.3s;
}

.sign-in:hover {
    background: #009b77;
}

.language-selector {
    margin-left: 20px;
    font-weight: 500;
}

        .container {
            padding: 30px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .benefits {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .benefit {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            width: 250px;
            text-align: center;
            transition: box-shadow 0.3s;
        }

        .benefit:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .benefit-icon {
            font-size: 40px;
            color: #00b894;
            margin-bottom: 10px;
        }

        .benefit h3 {
            margin: 10px 0;
            font-size: 20px;
        }
    </style>
</head>
<body>

<header>
    <div class="header-container">
        <div class="logo">
            <span class="logo-icon">🚖</span>
            <span class="logo-text">careem</span>
        </div>
        <nav class="nav-links">
            <a href="home.php">Book Now</a>
            <a href="services.php">Services</a>
        
            <a href="aboutus.php">About Us</a>
        </nav>
        <div>
        <a href="#" class="logout.php">logout</a>
            <span class="language-selector">English</span>
        </div>
    </div>
</header>

<div class="container">
    <h1>Careem Partners</h1>
    <p>Join us and enjoy the benefits of partnering with Careem.</p>
    <div class="benefits">
        <div class="benefit">
            <div class="benefit-icon">⏰</div>
            <h3>Reliability</h3>
            <p>Our Captains are always on time, and our call center is available 24/7.</p>
        </div>
        <div class="benefit">
            <div class="benefit-icon">🏠</div>
            <h3>Quality</h3>
            <p>Captains who will always make you feel at home in your city, or theirs.</p>
        </div>
        <div class="benefit">
            <div class="benefit-icon">🛡️</div>
            <h3>Safety</h3>
            <p>Your team’s safety is our top priority.</p>
        </div>
    </div>
</div>

</body>
</html>
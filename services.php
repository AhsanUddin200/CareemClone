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
    <title>Services - Careem</title>
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

        .service-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .service-button {
            background: #00b894;
            color: #fff;
            padding: 15px 25px;
            border-radius: 5px;
            text-decoration: none;
            margin: 0 10px;
            transition: background 0.3s;
        }

        .service-button:hover {
            background: #009b77;
        }

        .ride-options {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .ride-option {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            width: 150px;
            text-align: center;
            transition: box-shadow 0.3s;
        }

        .ride-option:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .ride-option img {
            width: 100%;
            height: auto;
        }

        .ride-option h3 {
            margin: 10px 0;
            font-size: 18px;
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
        <a href="home.php">Book Ride</a>
        <a href="partner.php">Partners</a>      
           
            <a href="aboutus.php">About Us</a>
        </nav>
        <div>
            <a href="#" class="logout.php">logout</a>
            <span class="language-selector">English</span>
        </div>
    </div>
</header>

<div class="container">
    <h1>Go</h1>
    <div class="service-buttons">
        <a href="services.php" class="service-button">Rides</a>
        <a href="#" class="service-button">Taxi</a>
        <a href="#" class="service-button">Bike</a>
        <a href="#" class="service-button">Car Rental</a>
        <a href="#" class="service-button">School Rides</a>
    </div>

    <h2>Rides</h2>
    <p>Order a ride with Careem, and go further, faster.</p>
    <div class="ride-options">
        <div class="ride-option">
            <img src="comfort.png" alt="Comfort">
            <h3>Comfort</h3>
        </div>
        <div class="ride-option">
            <img src="executive.png" alt="Executive">
            <h3>Executive</h3>
        </div>
        <div class="ride-option">
            <img src="max.png" alt="Max">
            <h3>Max</h3>
        </div>
        <div class="ride-option">
            <img src="kids.png" alt="Kids">
            <h3>Kids</h3>
        </div>
    </div>
</div>

</body>
</html>
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
    <title>About Us - Careem</title>
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
            max-width: 800px;
            margin: auto;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 36px;
        }

        h2 {
            margin-top: 30px;
            font-size: 28px;
        }

        p {
            line-height: 1.6;
            margin: 15px 0;
        }

        .video-container {
            margin-top: 30px;
        }

        .video-container iframe {
            width: 100%;
            height: 400px;
            border: none;
        }

        .about-section {
            background: #e0f7fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
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
        <a href="services.php">Services</a>
            <a href="partner.php">Partners</a>
           
        </nav>
        <div>
            <a href="#" class="logout.php">Logout</a>
            <span class="language-selector">English</span>
        </div>
    </div>
</header>

<div class="container">
    <h1>About Us</h1>
    <div class="about-section">
        <p>Careem is building the everything app for the greater Middle East, making it easier than ever to move around, order food and groceries, manage payments, and more. Careem is led by a powerful purpose to simplify and improve the lives of people and build an awesome organization that inspires.</p>
        <p>Since 2012, Careem has created earnings for over 2.5 million Captains, simplified the lives of over 50 million customers, and built a platform for the regions' best talent to thrive and for entrepreneurs to scale their businesses. Careem operates in over 70 cities across 10 countries, from Morocco to Pakistan.</p>
        <p>In 2019, we were acquired by Uber for $3.1 billion USD, solidifying our position as the biggest unicorn in the Middle East and providing new opportunities for startups in the region. This acquisition allowed us to bring some of the best talent into our organization, which was a critical part of our growth strategy.</p>
        <p>Now, we're excited to explore synergies with the global technology investors of old following their $400 million investment in the Careem Super App. With two strong partners in us and Uber, we're looking forward to building category-leading verticals and scaling the Super App across our key markets.</p>
    </div>

    <h2>A documentary about Careem</h2>
    <div class="video-container">
        <iframe src="https://www.youtube.com/embed/your_video_id" allowfullscreen></iframe>
    </div>
</div>

</body>
</html>
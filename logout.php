<?php
session_start();
session_destroy(); // Destroy the session to log out the user
header("Refresh: 3; URL=login.php"); // Redirect to login.php after 3 seconds
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out...</title>
    <style>
        /* CSS Code */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #28a745, #218838); /* Careem green colors */
            color: #ffffff;
        }

        .logout-container {
            text-align: center;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h1>You have been logged out</h1>
        <p>Redirecting to the login page...</p>
    </div>
</body>
</html>

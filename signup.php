<?php
include 'db.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($name && $email && $password) {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert user
        $stmt = $pdo->prepare("INSERT INTO careem_users (name, email, password) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$name, $email, $hashedPassword]);
            // Redirect to login.php after successful signup
            header("Location: login.php");
            exit; // Stop further execution
        } catch (PDOException $e) {
            $message = "Error creating account: " . $e->getMessage();
        }
    } else {
        $message = "Please fill all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Careem - Sign Up</title>
<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .container {
        width: 360px;
        padding: 30px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .logo {
        display: block;
        margin: 0 auto 20px auto;
        width: 100px;
        height: auto;
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 1.8rem;
        color: #28a745;
    }
    input[type="text"], input[type="email"], input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-sizing: border-box;
    }
    button {
        width: 100%;
        padding: 12px;
        background: #28a745;
        border: none;
        border-radius: 8px;
        color: #fff;
        font-size: 1rem;
        cursor: pointer;
        margin-top: 10px;
        transition: background 0.3s;
    }
    button:hover {
        background: #218838;
    }
    .message {
        margin-top: 15px;
        text-align: center;
        color: red;
        font-size: 0.9rem;
    }
    .message a {
        color: #28a745;
        text-decoration: none;
    }
    .message a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
<div class="container">
    <img src="data:image/png;base64,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" alt="Careem Logo" class="logo">
    <h1>Create Account</h1>
    <form method="post">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign Up</button>
    </form>
    <div class="message"><?php echo $message; ?></div>
</div>
</body>
</html>

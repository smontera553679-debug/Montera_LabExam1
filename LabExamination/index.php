<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === "admin" && $password === "admin123") {
        $_SESSION['loggedin'] = true;
        header("Location: home.php");
        exit();
    } else {
        $error = "Invalid Credentials. Please try again!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management System - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page"> <div class="login-container">
        <h1>Welcome to Student Management System</h1>
        <p>Enter your Credentials to Login!</p>

        <?php if (isset($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="index.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="login-btn">Login ➜</button>
        </form>
    </div>

</body>
</html>
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="welcome-container">
        <h1>Welcome, <?php echo $_SESSION['email']; ?>!</h1>
        <p>Your role: <?php echo $_SESSION['role']; ?></p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
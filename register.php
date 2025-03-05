<?php
session_start();
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $gender = $_POST['gender'];
    $birthDate = $_POST['birthDate'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password, gender, birthDate) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $password, $gender, $birthDate);

    if ($stmt->execute()) {
        echo "Registration successful!";
        // Optionally redirect to login page
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h1>Register</h1>
        <form method="POST" action="">
            <div class="form-group">
                <input type="text" name="firstName" placeholder="First Name" required>
            </div>
            <div class="form-group">
                <input type="text" name="lastName" placeholder="Last Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <select name="gender" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <input type="date" name="birthDate" required>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
        <div class="links">
            <p>Already have an account? <button class="btn" onclick="location.href='login.php'">Login</button></p>
        </div>
    </div>
</body>
</html>
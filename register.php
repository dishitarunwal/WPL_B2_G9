<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize user input
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $address  = trim($_POST['address']);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an insert statement
    $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $address);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!-- Sample HTML form for registration -->
<form method="post" action="register.php">
  <label>Username:</label>
  <input type="text" name="username" required>
  <br>
  <label>Email:</label>
  <input type="email" name="email" required>
  <br>
  <label>Password:</label>
  <input type="password" name="password" required>
  <br>
  <label>Address:</label>
  <input type="text" name="address">
  <br>
  <button type="submit">Register</button>
</form>

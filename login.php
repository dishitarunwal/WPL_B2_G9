<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Fetch user by email
    $stmt = $mysqli->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows == 1) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;
            header("location: profile.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that email.";
    }
    $stmt->close();
}
?>
<!-- Sample HTML form for login -->
<form method="post" action="login.php">
  <label>Email:</label>
  <input type="email" name="email" required>
  <br>
  <label>Password:</label>
  <input type="password" name="password" required>
  <br>
  <button type="submit">Login</button>
</form>

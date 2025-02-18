<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $age = htmlspecialchars($_POST['age']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Validate age
    if (!is_numeric($age) || $age <= 0) {
        echo "Invalid age";
        exit;
    }

    echo "<h2>Registration Details (POST Method):</h2>";
    echo "Name: $name<br>";
    echo "Email: $email<br>";
    echo "Age: $age<br>";
}
?>
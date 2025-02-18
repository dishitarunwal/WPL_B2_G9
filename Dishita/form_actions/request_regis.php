
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    $name = htmlspecialchars($_REQUEST['name']);
    $email = htmlspecialchars($_REQUEST['email']);
    $age = htmlspecialchars($_REQUEST['age']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    
    if (!is_numeric($age) || $age <= 0) {
        echo "Invalid age";
        exit;
    }

    echo "<h2>Registration Details (REQUEST Method):</h2>";
    echo "Name: $name<br>";
    echo "Email: $email<br>";
    echo "Age: $age<br>";
}
?>

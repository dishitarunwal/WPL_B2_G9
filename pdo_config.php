<?php
// pdo_config.php

$dsn = "mysql:host=localhost;dbname=foodiehub;charset=utf8mb4";
$username = 'your_username';   // replace with your DB username
$password = 'your_password';   // replace with your DB password

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

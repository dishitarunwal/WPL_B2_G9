<?php
// config.php

// Database configuration settings
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'your_username');   // replace with your DB username
define('DB_PASSWORD', 'your_password');   // replace with your DB password
define('DB_NAME', 'foodiehub');

// Create the MySQLi connection
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>

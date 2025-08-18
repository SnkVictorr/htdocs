<?php
// Database connection settings
define('DB_HOST', 'localhost'); // Database host
define('DB_USER', 'root'); // Database user
define('DB_PASS', 'root'); // Database password
define('DB_NAME', 'db_backend'); // Database name



try {
    // Create connection
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    http_response_code(500);
    // Handle connection error
    echo "Connection failed: " . $e->getMessage();
    exit;
}

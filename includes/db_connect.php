<?php
// Database credentials
$host = 'localhost';
$db   = 'childcare_db';
$user = 'root'; // Default for XAMPP
$pass = '';     // Default for XAMPP is empty
$charset = 'utf8mb4';

// Data Source Name
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Options for error handling and security
$options = [
    PDO::ATTR_ERRMODE            => PDO::ATTR_ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Create the connection
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // If connection fails, stop the script and show error
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>

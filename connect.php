<?php
$host = 'localhost:3307'; // Your database host
$dbname = 'user'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

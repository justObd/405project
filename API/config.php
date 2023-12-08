<?php

$servername = "your_mariadb_server";
$username = "root";
$password = "123";
$dbname = "event";

// Create connection
try {
    $dbConnection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

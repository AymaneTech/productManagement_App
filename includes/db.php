<?php
$dsn = "mysql:host=localhost; dbname=crud_app";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo "database connection problem :::: " . $e->getMessage();
}
?>
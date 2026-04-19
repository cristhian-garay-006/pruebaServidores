<?php
$host = '127.0.0.1';
$db   = 'dev_company_db';
$user = 'root';
$pass = ''; 
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Primero conectamos sin especificar base de datos para asegurarnos de que existe
    $pdo = new PDO("mysql:host=$host;charset=$charset", $user, $pass, $options);
    
    // Creamos la base de datos si no existe
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    
    // Ahora seleccionamos la base de datos
    $pdo->exec("USE `$db`");
    
    // Creamos la tabla si no existe
    $pdo->exec("CREATE TABLE IF NOT EXISTS contact_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

} catch (\PDOException $e) {
    throw new Exception("Error de base de datos: " . $e->getMessage());
}
?>

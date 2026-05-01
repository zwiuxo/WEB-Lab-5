<?php
$host = 'db';
$db   = 'lab5_db';
$user = 'lab5_user';
$pass = 'lab5_pass';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // штрафное задание
    $sql = "CREATE TABLE IF NOT EXISTS taxi_orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        passengers INT NOT NULL,
        tariff VARCHAR(50),
        baggage TINYINT(1),
        car_type VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    
} catch (\PDOException $e) {
    die("ошибка подклчения: " . $e->getMessage());
}

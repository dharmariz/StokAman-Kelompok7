<?php
header('Content-Type: application/json');

$host = getenv('DB_HOST') ?: 'db';
$db   = getenv('DB_DATABASE') ?: 'stokaman_db';
$user = getenv('DB_USERNAME') ?: 'stokaman_user';
$pass = getenv('DB_PASSWORD') ?: 'stokaman_pass';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    http_response_code(200);
    echo json_encode([
        'status' => 'healthy',
        'database' => 'connected'
    ]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'unhealthy',
        'error' => $e->getMessage()
    ]);
}
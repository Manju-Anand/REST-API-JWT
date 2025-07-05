<?php
require_once __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once 'config.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

if ($username === 'admin' && $password === 'password') {
    $payload = [
        'iss' => "localhost",
        'aud' => "localhost",
        'iat' => time(),
        'exp' => time() + 3600,
        'user' => $username
    ];
    $jwt = JWT::encode($payload, $jwt_secret, 'HS256');
    echo json_encode(['token' => $jwt]);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid credentials']);
}

?>

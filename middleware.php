<?php
require_once __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function validateJWT($jwt, $secret) {
    try {
        $decoded = JWT::decode($jwt, new Key($secret, 'HS256'));
        return $decoded;
    } catch (Exception $e) {
        return false;
    }
}


?>
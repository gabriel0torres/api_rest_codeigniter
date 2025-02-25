<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\HTTP\RequestInterface;
use App\Config\JwtConfig;

function generate_jwt($user_id, $email)
{

    $payload = [
        'iat' => time(), // Tempo em que o token foi gerado
        'exp' => time() + 3600, // Expiração do token (1 hora)
        'user_id' => $user_id,
        'email' => $email
    ];

    return JWT::encode($payload, JwtConfig::getSecretKey(), JwtConfig::getAlgorithm());
}

function validate_jwt($token)
{
    try {
        return JWT::decode($token, new Key(JwtConfig::getSecretKey(), JwtConfig::getAlgorithm()));
    } catch (Exception $e) {
        return false;

    }
}

function get_token_from_request(RequestInterface $request)
{
    $authHeader = $request->getHeaderLine('Authorization');
    if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        return false;
    }
    return $matches[1];
}

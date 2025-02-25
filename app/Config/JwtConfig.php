<?php

namespace App\Config;

class JwtConfig
{
    public static function getSecretKey()
    {
        return "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c"; // Alterar para uma chave segura
    }

    public static function getAlgorithm()
    {
        return "HS256"; // Algoritmo padrão do JWT
    }
}

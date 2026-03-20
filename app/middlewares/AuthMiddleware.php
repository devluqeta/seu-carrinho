<?php

class AuthMiddleware
{
    public static function handle($roles = [])
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }

        if (empty($roles)) {
            return;
        }

        $userRole = $_SESSION['user']['role'] ?? null;

        if (!in_array($userRole, $roles)) {
            http_response_code(403);
            die('Acesso negado');
        }
    }
}

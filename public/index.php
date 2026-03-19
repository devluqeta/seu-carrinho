<?php

session_start();

require_once __DIR__ . '/../app/bootstrap.php';

$router = new Router();

// ====================
// ROTAS PÚBLICAS
// ====================
$router->get('/', [HomeController::class, 'index']);

$router->dispatch();

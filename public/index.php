<?php

ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0);

session_start();

require_once __DIR__ . '/../app/bootstrap.php';

$router = new Router();

// ====================
// ROTAS PÚBLICAS GERAIS
// ====================
$router->get('/', [HomeController::class, 'index']);

// ====================
// SEU CARRINHO - PÚBLICAS
// ====================
$router->get('/seucarrinho', [HomeController::class, 'seucarrinho']);

$router->get('/seucarrinho/login', [AuthController::class, 'loginForm']);
$router->post('/seucarrinho/login', [AuthController::class, 'login']);

$router->get('/seucarrinho/register', [AuthController::class, 'registerForm']);
$router->post('/seucarrinho/register', [AuthController::class, 'register']);


// =========================
// SEU CARRINHO - PRIVADAS
// =========================
$router->group(function ($router) {

    // Página principal e logout
    $router->get('/seucarrinho/home', [CartController::class, 'index']);
    $router->get('/seucarrinho/logout', [AuthController::class, 'logout']);

    // Listas
    $router->get('/seucarrinho/lists', [ListController::class, 'index']);
    $router->post('/seucarrinho/lists/store', [ListController::class, 'store']);
    $router->post('/seucarrinho/lists/update', [ListController::class, 'update']);
    $router->post('/seucarrinho/lists/delete', [ListController::class, 'delete']);

    // NOVO: Página individual da lista e gerenciamento de itens
    $router->get('/seucarrinho/list/view', [ListController::class, 'show']);
    $router->post('/seucarrinho/list/view', [ListController::class, 'show']);
    $router->post('/seucarrinho/list/items/store', [ListController::class, 'storeItem']); // criar item
    $router->post('/seucarrinho/list/items/delete', [ListController::class, 'deleteItem']); // deletar item
});

// ====================
// DISPATCH
// ====================
$router->dispatch();

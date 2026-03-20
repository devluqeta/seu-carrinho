<?php

ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

session_start();

require_once __DIR__ . '/../app/bootstrap.php';

$router = new Router();

// =====================
// PÚBLICO
// =====================
$router->get('/', [AuthController::class, 'loginForm']);
$router->get('/register', [AuthController::class, 'registerForm']);

$router->post('/login', [AuthController::class, 'login']);
$router->post('/register', [AuthController::class, 'register']);


// =====================
// USER + ADMIN
// =====================
$router->group(['middleware' => 'role:admin,user'], function ($router) {

    // HOME
    $router->get('/home', [HomeController::class, 'index']);
    
    // LISTAS
    $router->post('/lists/store', [ListController::class, 'store']);
    $router->post('/lists/delete', [ListController::class, 'delete']);
    $router->get('/list', [ListController::class, 'show']);

    // ITENS
    $router->get('/items', [ItemController::class, 'index']);
    $router->post('/items/store', [ItemController::class, 'store']);
    $router->post('/items/check', [ItemController::class, 'check']);
    $router->post('/items/delete', [ItemController::class, 'delete']);

    // SUGESTÃO
    $router->post('/suggestion/store', [SuggestionController::class, 'store']);

    // AUTOCOMPLETE
    $router->get('/foods', [ItemController::class, 'foods']);
});


// =====================
// ADMIN
// =====================
$router->group(['middleware' => 'role:admin'], function ($router) {

    $router->get('/admin', [AdminController::class, 'index']);

    // AUTOCOMPLETE ADMIN
    $router->get('/admin/foods', [AdminController::class, 'foods']);
    $router->post('/admin/foods/store', [AdminController::class, 'storeFood']);

    // SUGESTÕES
    $router->get('/admin/suggestions', [AdminController::class, 'suggestions']);
    $router->post('/admin/suggestions/approve', [AdminController::class, 'approveSuggestion']);
    $router->post('/admin/suggestions/deny', [AdminController::class, 'denySuggestion']);
});


// =====================
// LOGOUT
// =====================
$router->get('/logout', [AuthController::class, 'logout']);


// =====================
// DISPATCH
// =====================
$router->dispatch();

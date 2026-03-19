<?php
// ==============================================
// COLOCAR QUALQUER ROTA DE NOVOS ARQUIVOS AQUI
// ==============================================
date_default_timezone_set('America/Sao_Paulo');

// ===================
// DATABASE
// ===================
require_once __DIR__ . '/../config/database.php';

// ===================
// CORE / MIDDLEWARE
// ===================
require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/middleware/AuthMiddleware.php';

// ==============
// CONTROLLERS
// ==============
require_once __DIR__ . '/controllers/HomeController.php';


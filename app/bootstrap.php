<?php

date_default_timezone_set('America/Sao_Paulo');

// AUTOLOAD
spl_autoload_register(function ($class) {

    $folders = [
        __DIR__ . '/core/',
        __DIR__ . '/models/',
        __DIR__ . '/controllers/',
        __DIR__ . '/middlewares/',
    ];

    foreach ($folders as $folder) {
        $file = $folder . $class . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// DATABASE CONFIG
require_once __DIR__ . '/../config/database.php';


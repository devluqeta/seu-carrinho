<?php

class Router
{
    private $routes = [];
    private $currentMiddleware = [];

    // =====================
    // GROUP COM MIDDLEWARE
    // =====================
    public function group($options, $callback)
    {
        $previousMiddleware = $this->currentMiddleware;

        if (isset($options['middleware'])) {
            $this->currentMiddleware = array_merge(
                $this->currentMiddleware,
                (array) $options['middleware']
            );
        }

        $callback($this);

        // volta estado anterior
        $this->currentMiddleware = $previousMiddleware;
    }

    // =====================
    // REGISTRO DE ROTAS
    // =====================
    public function get($uri, $action, $middleware = [])
    {
        $this->addRoute('GET', $uri, $action, $middleware);
    }

    public function post($uri, $action, $middleware = [])
    {
        $this->addRoute('POST', $uri, $action, $middleware);
    }

    private function addRoute($method, $uri, $action, $middleware)
    {
        $this->routes[$method][$uri] = [
            'action' => $action,
            'middleware' => array_merge(
                $this->currentMiddleware,
                (array) $middleware
            )
        ];
    }

    // =====================
    // DISPATCH
    // =====================
    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = str_replace('/public', '', $uri);
        $uri = rtrim($uri, '/');

        if ($uri === '') {
            $uri = '/';
        }

        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            require __DIR__ . '/../views/error_pages/404.php';
            exit;
        }

        $route = $this->routes[$method][$uri];

        // =====================
        // EXECUTA MIDDLEWARES
        // =====================
        foreach ($route['middleware'] as $middleware) {
            $this->runMiddleware($middleware);
        }

        return $this->run($route['action']);
    }

    // =====================
    // EXECUTA CONTROLLER
    // =====================
    private function run($action)
    {
        if (is_callable($action)) {
            return $action();
        }

        [$controller, $method] = $action;
        return call_user_func([new $controller, $method]);
    }

    // =====================
    // MIDDLEWARE SYSTEM
    // =====================
    private function runMiddleware($middleware)
    {
        // auth simples
        if ($middleware === 'auth') {
            AuthMiddleware::handle();
            return;
        }

        // role:admin ou role:user
        if (str_starts_with($middleware, 'role:')) {
            $roles = explode(',', str_replace('role:', '', $middleware));
            AuthMiddleware::handle($roles);
            return;
        }
    }
}

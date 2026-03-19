<?php

class Router
{
    private $routes = [];
    private $protectedRoutes = [];
    private $inGroup = false;

    public function group($callback)
    {
        $this->inGroup = true;
        $callback($this);
        $this->inGroup = false;
    }

    public function get($uri, $action)
    {
        if ($this->inGroup) {
            $this->protectedRoutes['GET'][$uri] = $action;
        } else {
            $this->routes['GET'][$uri] = $action;
        }
    }

    public function post($uri, $action)
    {
        if ($this->inGroup) {
            $this->protectedRoutes['POST'][$uri] = $action;
        } else {
            $this->routes['POST'][$uri] = $action;
        }
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        // pega somente o caminho da URL
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // remove /public se existir
        $uri = str_replace('/public', '', $uri);

        // remove barra no final
        $uri = rtrim($uri, '/');

        // garante que raiz continue sendo /
        if ($uri === '') {
            $uri = '/';
        }

        // =================
        // ROTAS PÚBLICAS
        // =================
        if (isset($this->routes[$method][$uri])) {
            return $this->run($this->routes[$method][$uri]);
        }

        // =================
        // ROTAS PROTEGIDAS
        // =================
        if (isset($this->protectedRoutes[$method][$uri])) {

            if (!isset($_SESSION['user'])) {
                http_response_code(403);
                require __DIR__ . '/../views/error_pages/403.php';
                exit;
            }

            return $this->run($this->protectedRoutes[$method][$uri]);
        }

        // =================
        // 404
        // =================
        http_response_code(404);
        require __DIR__ . '/../views/error_pages/404.php';
        exit;
    }

    private function run($action)
    {
        [$controller, $method] = $action;
        return call_user_func([new $controller, $method]);
    }
}

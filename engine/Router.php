<?php

namespace Engine;

class Router
{
    private static $routes = [];

    public static function get($uri, $action)
    {
        self::$routes['GET'][$uri] = $action;
    }

    public static function post($uri, $action)
    {
        self::$routes['POST'][$uri] = $action;
    }

    public function dispatch()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        // Remove trailing slash except for root
        if ($uri !== '/' && substr($uri, -1) === '/') {
            $uri = rtrim($uri, '/');
        }

        if (self::isPublicAsset($uri)) {
             return false; // Let web server handle it or return 404
        }
        
        if (isset(self::$routes[$method][$uri])) {
            $action = self::$routes[$method][$uri];
            $this->executeAction($action);
        } else {
            // Magic Routing (Auto Discovery)
            // /dashboard/index -> DashboardController->index()
            if ($this->attemptAutoRoute($uri)) {
                return;
            }

            $this->abort(404);
        }
    }

    private function attemptAutoRoute($uri)
    {
        // Clean URI
        $parts = array_values(array_filter(explode('/', $uri)));
        
        // Default to Home if empty
        if (empty($parts)) return false;

        $controllerName = ucfirst($parts[0]) . 'Controller';
        $methodName = $parts[1] ?? 'index';

        $fullController = "Projects\\Controllers\\$controllerName";

        if (class_exists($fullController)) {
            $controller = new $fullController();
            if (method_exists($controller, $methodName)) {
                // Determine parameters (e.g. /users/edit/1 -> method($id))
                $params = array_slice($parts, 2);
                echo call_user_func_array([$controller, $methodName], $params);
                return true;
            }
        }

        return false;
    }

    private function executeAction($action)
    {
        // Check if closure
        if (is_callable($action)) {
            echo call_user_func($action);
            return;
        }

        // Check Controller@method
        if (is_string($action)) {
            $parts = explode('@', $action);
            $controllerName = "Projects\\Controllers\\" . $parts[0];
            $method = $parts[1];

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $method)) {
                    echo $controller->$method();
                    return;
                }
            }
        }
        
        throw new \Exception("Action not found or invalid: " . json_encode($action));
    }

    private function abort($code)
    {
        http_response_code($code);
        echo "<h1>{$code} Not Found</h1>";
        exit;
    }

    private static function isPublicAsset($uri) {
        $ext = pathinfo($uri, PATHINFO_EXTENSION);
        return !empty($ext);
    }
}

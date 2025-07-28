<?php

namespace App\Core;

class Router
{
    protected static $routes = [];
    protected static $guards = [];
    protected static $middlewares = [];
    protected static $initialized = false;

    public static function resolve()
    {
        self::initialize();

        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = trim($url, '/');

        $routeFile = str_contains($url, "api") ? "/routes/route.api.php" : "/routes/route.web.php";
        require_once ROOT_PATH . $routeFile;

        $route = self::findRoute($url);

        if (!$route) {
            self::handleNotFound();
        }

        self::processMiddlewares($route['middlewares'] ?? []);
        self::processGuards($route['guards'] ?? []);
        self::dispatchController($route);
    }

    protected static function initialize()
    {
        if (!self::$initialized) {
            self::$guards = require ROOT_PATH . '/app/config/gards.php';
            self::$middlewares = require ROOT_PATH . '/app/config/middlewares.php';
            self::$initialized = true;
        }
    }

    protected static function findRoute($url)
    {
        foreach (self::$routes as $routePath => $routeConfig) {
            $pattern = self::convertRouteToPattern($routePath);

            if (preg_match($pattern, $url, $matches)) {
                $routeConfig['params'] = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return $routeConfig;
            }
        }
        return null;
    }

    protected static function convertRouteToPattern($routePath)
    {
        $pattern = preg_replace('/\{([a-z]+)\}/', '(?P<$1>[^/]+)', $routePath);
        return "@^" . $pattern . "$@D";
    }

    protected static function processMiddlewares(array $middlewares)
    {
        foreach ($middlewares as $middlewareName) {
            if (isset(self::$middlewares[$middlewareName])) {
                $middleware = self::$middlewares[$middlewareName];
                (new $middleware)();
            }
        }
    }

    protected static function processGuards(array $guards)
    {
        foreach ($guards as $guardName) {
            if (isset(self::$guards[$guardName])) {
                $guard = self::$guards[$guardName];
                (new $guard)();
            }
        }
    }

    protected static function dispatchController(array $route)
    {
        if (!class_exists($route['controller']) || !method_exists($route['controller'], $route['action'])) {
            self::handleNotFound();
        }

        $controller = new $route['controller']();
        $controller->{$route['action']}(...($route['params'] ?? []));
    }

    protected static function handleNotFound()
    {
        // ErrorController::error404();
        http_response_code(404);
        echo "<h1>404 - Page non trouvée</h1>";
        echo "<p>URL : " . htmlspecialchars($_SERVER['REQUEST_URI']) . "</p>";
        exit;
    }

    public static function addRoute($path, $controller, $action, $guards = [], $middlewares = [])
    {
        self::$routes[$path] = [
            'controller' => $controller,
            'action' => $action,
            'guards' => $guards,
            'middlewares' => $middlewares
        ];
    }
}

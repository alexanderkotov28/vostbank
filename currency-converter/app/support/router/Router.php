<?php


namespace App\Support\Router;

use App\Support\Exceptions\NotFoundException;
use App\Support\Http\Request;

class Router
{
    private $routes = [
        'get' => [],
        'post' => [],
        'console' => []
    ];

    private $named_routes = [];

    public function register(string $http_method, string $path, string $class, string $method)
    {
        $this->routes[$http_method][$path] = new Route($class, $method, $http_method, $path);
    }

    public function registerCommand(string $command, string $class, string $method)
    {
        $this->routes['console'][$command] = new Route($class, $method, null, null, $command);
    }

    public function resolve(Request $request): Route
    {
        $route = $this->routes[$request->getMethod()][$request->getUri()] ?? false;
        if (!$route) {
            throw new NotFoundException();
        }
        return $route;
    }

    public function resolveCommand(array $argv)
    {
        return $this->routes['console'][$argv[1]??0] ?? false;
    }

    public static function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'])['path'];

        $route = self::$routes[strtolower($_SERVER['REQUEST_METHOD'])][$path] ?? false;

        if (!$route) {
            http_response_code(404);
            die();
        }

        $class = new $route['class'];
        $response = $class->{$route['method']}(self::getParams());

        return $response;
    }

    private static function getParams()
    {
        $input = file_get_contents('php://input');
        parse_str($input, $result);
        return $result;
    }
}
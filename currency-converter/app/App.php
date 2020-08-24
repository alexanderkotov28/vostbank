<?php

namespace App;

use App\Support\ExceptionHandler;
use App\Support\Http\Request;
use App\Support\Http\Response;
use App\Support\Router\Route;
use App\Support\Router\Router;
use Closure;

class App
{
    private $argv;
    private $router;
    private $request;
    private $response;
    private $exception_handler;

    public function __construct(?array $argv)
    {
        $this->router = new Router();
        if (php_sapi_name() == "cli"){
            $this->argv = $argv;
        } else {
            $this->request = new Request();
            $this->response = new Response();
        }
        $this->exception_handler = new ExceptionHandler($this);
        set_exception_handler($this->exception_handler);
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    public function get(string $path, string $class, string $method)
    {
        $this->router->register('get', $path, $class, $method);
        return $this;
    }

    public function post(string $path, string $class, string $method)
    {
        $this->router->register('post', $path, $class, $method);
        return $this;
    }

    public function console(string $command, string $class, string $method)
    {
        $this->router->registerCommand($command, $class, $method);
        return $this;
    }

    public function run()
    {
        if (php_sapi_name() == "cli"){
            $route = $this->router->resolveCommand($this->argv);
            if ($route){
                $this->process($route);
            }
            exit();
        } else {
            $route = $this->router->resolve($this->request);
            $this->process($route);
            $this->respond();
        }
    }

    public function registerExceptionHandler(string $exception, Closure $closure)
    {
        $this->exception_handler->register($exception, $closure);
    }

    public function process(Route $route)
    {
        $class = $route->getClass();
        $controller = new $class;
        $controller->{$route->getMethod()}($this->request, $this->response);
    }

    public function respond()
    {
        $this->sendHeaders();
        $this->sendBody();
    }

    private function sendHeaders()
    {
        if (!headers_sent()) {
            // Headers
            foreach ($this->response->getHeaders() as $name => $value) {
                header(sprintf('%s: %s', $name, $value));
            }

            // Status
            header(sprintf(
                'HTTP/%s %s %s',
                $this->response->getProtocolVersion(),
                $this->response->getStatusCode(),
                $this->response->getReasonPhrase()
            ), true, $this->response->getStatusCode());
        }
    }

    private function sendBody()
    {
       echo $this->response->getBody();
    }

}
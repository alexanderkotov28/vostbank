<?php

namespace App\Support;

use App\App;
use Closure;

class ExceptionHandler
{
    private $app;
    private $handlers = [];

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function __invoke(\Throwable $exception)
    {
        if (isset($this->handlers[get_class($exception)])) {
            $this->handlers[get_class($exception)]($this->app->getRequest(), $this->app->getResponse());
            $this->app->respond();
        } else {
            $br = php_sapi_name() == "cli" ? PHP_EOL : '<br>';
            // Exception print like default
            echo sprintf('Fatal error: Uncaught %s: %s in %s on line %s %s Stack trace: %s', get_class($exception), $exception->getMessage(), $exception->getFile(), $exception->getLine(), $br, $exception->getTraceAsString());
        }
    }

    public function register(string $exception, Closure $closure)
    {
        $this->handlers[$exception] = $closure;
    }
}
<?php


namespace App\Support\Router;


class Route
{
    private $path;
    private $http_method;
    private $class;
    private $method;

    public function __construct(string $class, string $method, ?string $http_method = null, ?string $path = null, ?string $command = null)
    {
        $this->http_method = $http_method;
        $this->path = $path;
        $this->class = $class;
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}
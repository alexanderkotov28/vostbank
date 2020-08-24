<?php

namespace App\Support\Http;

class Request
{
    private $uri;
    private $method;
    private $params;
    private $headers = [];

    public function __construct()
    {
        $this->uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->handleHeaders();
        $this->handleBody();
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    private function handleHeaders()
    {
        $this->headers = getallheaders();
    }

    private function handleBody()
    {
        $input = file_get_contents('php://input');

        if ($this->getHeaders()['Content-Type'] == 'application/json'){
            $params = json_decode($input, true);
        } else{
            parse_str($input, $params);
        }
        $this->params = $params;
    }

}
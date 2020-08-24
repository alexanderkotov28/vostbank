<?php

namespace App\Support\Http;

class Response
{
    private $status_code = 200;
    private $protocol_version = '1.1';
    private $headers = [];

    const REASONS = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Moved Temporarily',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Large',
        415 => 'Unsupported Media Type',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Time-out',
        505 => 'HTTP Version not supported',
    ];

    private $body;

    public function withStatus(int $status_code)
    {
        $this->status_code = $status_code;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->status_code;
    }

    /**
     * @return string
     */
    public function getProtocolVersion(): string
    {
        return $this->protocol_version;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    public function getReasonPhrase()
    {
        return self::REASONS[$this->status_code] ?? '';
    }

    public function setHeader(string $name, string $value)
    {
        $this->headers[$name] = $value;
    }

    public function json(array $data)
    {
        $this->setHeader('Content-Type', 'application/json');
        $this->body = json_encode($data, JSON_UNESCAPED_UNICODE);
        return $this;
    }

    public function text(string $text)
    {
        $this->setHeader('Content-Type', 'text/plain; charset=UTF-8');
        $this->body = $text;
        return $this;
    }

}
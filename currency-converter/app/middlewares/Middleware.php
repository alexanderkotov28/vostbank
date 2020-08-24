<?php


namespace App\Middlewares;


use App\Support\Http\Request;
use App\Support\Http\Response;

interface Middleware
{
    public function __invoke(Request $request, Response $response);
}
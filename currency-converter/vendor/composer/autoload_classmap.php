<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'App\\App' => $baseDir . '/app/App.php',
    'App\\Controllers\\QuotationController' => $baseDir . '/app/controllers/QuotationController.php',
    'App\\Middlewares\\Accept' => $baseDir . '/app/middlewares/Accept.php',
    'App\\Middlewares\\Middleware' => $baseDir . '/app/middlewares/Middleware.php',
    'App\\Models\\User' => $baseDir . '/app/models/User.php',
    'App\\Services\\Quotation\\JSONQuotationService' => $baseDir . '/app/services/Quotation/JSONQuotationService.php',
    'App\\Services\\Quotation\\QuotationService' => $baseDir . '/app/services/Quotation/QuotationService.php',
    'App\\Services\\Quotation\\QuotationServiceInterface' => $baseDir . '/app/services/Quotation/QuotationServiceInterface.php',
    'App\\Support\\ExceptionHandler' => $baseDir . '/app/support/ExceptionHandler.php',
    'App\\Support\\Exceptions\\NotFoundException' => $baseDir . '/app/support/exceptions/NotFoundException.php',
    'App\\Support\\Http\\Request' => $baseDir . '/app/support/http/Request.php',
    'App\\Support\\Http\\Response' => $baseDir . '/app/support/http/Response.php',
    'App\\Support\\Router\\Route' => $baseDir . '/app/support/router/Route.php',
    'App\\Support\\Router\\Router' => $baseDir . '/app/support/router/Router.php',
);

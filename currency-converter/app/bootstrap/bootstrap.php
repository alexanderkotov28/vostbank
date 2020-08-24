<?php

use App\App;
use App\Support\Exceptions\NotFoundException;
use App\Support\Http\Request;
use App\Support\Http\Response;

require_once __DIR__.'/../../vendor/autoload.php';

$app = new App($argv);

$app->registerExceptionHandler(NotFoundException::class, function (Request $request, Response $response) {
    return $response->withStatus(404);
});

require_once __DIR__ . '/../routes/api.php';
require_once __DIR__ . '/../routes/console.php';

$app->run();
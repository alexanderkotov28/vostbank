<?php

use App\App;
use App\Support\Exceptions\NotFoundException;
use App\Support\Http\Request;
use App\Support\Http\Response;

function dd(...$vars)
{
    foreach ($vars as $var) {
        d($var);
    }
    exit();
}

function d($var)
{
    ob_start();
    var_dump($var);
    $buffer = ob_get_clean();
    echo "<pre>" . htmlentities($buffer) . "</pre>";
}

$autoloader_mapping = require_once __DIR__ . '/../../config/autoload.php';
$autoloader_base_dir = __DIR__ . '/../../';

require_once 'autoload.php';

$app = new App($argv);

$app->registerExceptionHandler(NotFoundException::class, function (Request $request, Response $response) {
    return $response->withStatus(404);
});

require_once __DIR__ . '/../routes/api.php';
require_once __DIR__ . '/../routes/console.php';

$app->run();
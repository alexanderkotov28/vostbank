<?php

use App\Controllers\QuotationController;

$app->post('/', QuotationController::class, 'convert');
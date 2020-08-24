<?php

$autoloader_mapping = require_once __DIR__ . '/../config/autoload.php';
$autoloader_base_dir = __DIR__ . '/../';
require_once "app/bootstrap/autoload.php";

use App\Controllers\QuotationController;
use App\Services\Quotation\JSONQuotationService;
use PHPUnit\Framework\TestCase;

class QuotationControllerTest extends TestCase
{
    private $controller;
    protected $old_data = [];

    protected function setUp(): void
    {
        $this->controller = new QuotationController();
        if (file_exists(JSONQuotationService::FILE_PATH)) {
            $this->old_data['json'] = file_get_contents(JSONQuotationService::FILE_PATH);
            unlink(JSONQuotationService::FILE_PATH);
        } else {
            $this->old_data['json'] = '';
        }
    }

    protected function tearDown(): void
    {
        file_put_contents(JSONQuotationService::FILE_PATH, $this->old_data['json']);
    }

    public function testUpdateQuotations()
    {
        $this->controller->updateQuotations();
        $this->assertFileExists(JSONQuotationService::FILE_PATH);
    }
}
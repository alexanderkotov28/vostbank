<?php

$autoloader_mapping = require_once __DIR__ . '/../config/autoload.php';
$autoloader_base_dir = __DIR__ . '/../';
require_once "app/bootstrap/autoload.php";

use App\Services\Quotation\QuotationService;
use PHPUnit\Framework\TestCase;

class QuotationServiceTest extends TestCase
{
    private $service;

    protected function setUp(): void
    {
        $this->service = new QuotationService();
    }

    public function testConvertByBaseValute()
    {
        $this->assertSame($this->service->converBytBaseValute(10,5,10), 20.0);
    }
}
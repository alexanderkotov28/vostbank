<?php

namespace App\Services\Quotation;

interface QuotationServiceInterface
{
    public function getValue(string $name): ?float;

    public function save(array $quotations);

    public function valuteExists(string $valute_char_code):bool ;
}
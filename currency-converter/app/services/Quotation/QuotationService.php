<?php

namespace App\Services\Quotation;

class QuotationService
{
    private $service;

    const BASE_VALUTE = 'RUB';

    public function __construct(?QuotationServiceInterface $service = null)
    {
        $this->service = is_null($service) ? new JSONQuotationService() : $service;
    }

    public function getValue(string $name): ?float
    {
        return $name == self::BASE_VALUTE ? 1 : $this->service->getValue($name);
    }

    public function save(array $quotations)
    {
        $this->service->save($quotations);
    }

    public function validateRequest(array $params)
    {
        switch (true) {
            case !isset($params['amount']):
                return 'Parameter "amount" is required';
            case !isset($params['from']):
                return 'Parameter "from" is required';
            case !isset($params['to']):
                return 'Parameter "to" is required';
            case ($params['from'] !== self::BASE_VALUTE && !$this->valuteExists($params['from'])):
                return sprintf('Valute "%s" is not available', $params['from']);
            case ($params['to'] !== self::BASE_VALUTE && !$this->valuteExists($params['to'])):
                return sprintf('Valute "%s" is not available', $params['to']);
            case !is_numeric($params['amount']):
                return 'Parameter "amount" must be numeric';
            default:
                return true;
        }
    }

    public function valuteExists(string $valute_char_code): bool
    {
        return $this->service->valuteExists($valute_char_code);
    }

    public function converBytBaseValute($from_base, $to_base, $amount)
    {
        return round($amount * $from_base / $to_base, 4);
    }
}
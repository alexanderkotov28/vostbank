<?php


namespace App\Services\Quotation;


class JSONQuotationService implements QuotationServiceInterface
{
    const FILE_PATH = __DIR__ . '/../../../storage/quotations.json';

    private static $data = false;

    public function getValue(string $name): ?float
    {
        return self::getData()[$name] ?? null;
    }

    protected static function getData()
    {
        if (self::$data === false) {
            $data = file_get_contents(self::FILE_PATH);
            self::$data = $data === false ? [] : json_decode($data, true);
        }
        return self::$data;
    }

    public function save(array $quotations)
    {
        $key_value = [];
        foreach ($quotations as $quotation){
            $key_value[$quotation['char_code']] = $quotation['value'];
        }

        file_put_contents(self::FILE_PATH, json_encode($key_value, JSON_UNESCAPED_UNICODE));
    }

    public function valuteExists(string $valute_char_code): bool
    {
        return in_array($valute_char_code, array_keys(self::getData()));
    }
}
<?php


namespace App\Controllers;


use App\Services\Quotation\JSONQuotationService;
use App\Services\Quotation\QuotationService;
use App\Support\Http\Request;
use App\Support\Http\Response;
use XMLReader;

class QuotationController
{
    public function convert(Request $request, Response $response)
    {
        $service = new QuotationService();
        $params = $request->getParams();

        $validation_result = $service->validateRequest($params);

        if ($validation_result !== true){
            return $response->withStatus(422)->text($validation_result);
        }

        $result = $service->converBytBaseValute($service->getValue($params['from']), $service->getValue($params['to']), $params['amount']);;

        return $response->json(compact('result'));
    }

    public function updateQuotations()
    {
        $reader = new XMLReader();
        $reader->open('http://www.cbr.ru/scripts/XML_daily.asp');

        $quotations = [];

        while ($reader->read()) {
            if ($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'Valute') {
                $element = new \SimpleXMLElement($reader->readOuterXml());

                $quotations[] = [
                    'char_code' => strval($element->CharCode),
                    'value' => round(floatval(str_replace(',', '.', $element->Value)) / intval($element->Nominal), 8)
                ];
            }
        }
        $reader->close();

        $service = new QuotationService();
        $service->save($quotations);
    }

    public function sw()
    {

    }
}
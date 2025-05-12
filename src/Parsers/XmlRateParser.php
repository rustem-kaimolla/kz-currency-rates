<?php

namespace Currency\Parsers;

use Currency\Contracts\RateParserInterface;
use Currency\DTO\CurrencyRateDTO;

class XmlRateParser implements RateParserInterface
{
    public function parse(string $raw): array
    {
        $xml = simplexml_load_string($raw);
        $date = (string)$xml->date;

        $rates = [];
        foreach ($xml->item as $item) {
            $rates[] = new CurrencyRateDTO(
                (string)$item->title,
                (string)$item->fullname,
                (float)str_replace(',', '.', (string)$item->description),
                $date
            );
        }

        return $rates;
    }
}

<?php

namespace Currency\Contracts;

use Currency\DTO\CurrencyRateDTO;

interface RateParserInterface
{
    /**
     * @param string $raw
     * @return CurrencyRateDTO[]
     */
    public function parse(string $raw): array;
}

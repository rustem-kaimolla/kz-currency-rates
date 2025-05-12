<?php

namespace Currency\Filters;

use Currency\DTO\CurrencyRateDTO;

class MajorCurrencySpecification
{
    private array $majors = ['USD', 'EUR', 'RUB'];

    public function isSatisfiedBy(CurrencyRateDTO $rate): bool
    {
        return in_array($rate->code, $this->majors);
    }
}

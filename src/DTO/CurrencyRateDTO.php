<?php

namespace Currency\DTO;

class CurrencyRateDTO
{
    public function __construct(
        public readonly string $code,
        public readonly string $name,
        public readonly float $rate,
        public readonly string $date
    ) {}
}

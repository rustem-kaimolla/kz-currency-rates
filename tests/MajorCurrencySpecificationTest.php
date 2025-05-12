<?php

use PHPUnit\Framework\TestCase;
use Currency\DTO\CurrencyRateDTO;
use Currency\Filters\MajorCurrencySpecification;

class MajorCurrencySpecificationTest extends TestCase
{
    public function test_only_accepts_major_currencies(): void
    {
        $spec = new MajorCurrencySpecification();

        $usd = new CurrencyRateDTO('USD', 'Доллор', 516.0, '12.05.2025');
        $rub = new CurrencyRateDTO('RUB', 'Рубль', 6.2, '12.05.2025');
        $kzt = new CurrencyRateDTO('KZT', 'Тенге', 1.0, '12.05.2025');

        $this->assertTrue($spec->isSatisfiedBy($usd));
        $this->assertTrue($spec->isSatisfiedBy($rub));
        $this->assertFalse($spec->isSatisfiedBy($kzt));
    }
}

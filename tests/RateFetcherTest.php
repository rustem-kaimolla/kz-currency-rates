<?php

use PHPUnit\Framework\TestCase;
use Currency\Services\RateFetcher;
use Currency\Contracts\RateParserInterface;
use Currency\DTO\CurrencyRateDTO;

class RateFetcherTest extends TestCase
{
    public function test_fetches_and_parses_rates_successfully(): void
    {
        $expectedDto = new CurrencyRateDTO('AUD', 'АВСТРАЛИЙСКИЙ ДОЛЛАР', 331.12, '12.05.2025');

        $parserMock = $this->createMock(RateParserInterface::class);
        $parserMock->method('parse')->willReturn([$expectedDto]);

        $fetcher = new RateFetcher(
            'https://nationalbank.kz/rss/get_rates.cfm?fdate=12.05.2025',
            $parserMock,
        );

        $rate = $fetcher->getRate('AUD');

        $this->assertEquals('AUD', $rate->code);
        $this->assertEquals(331.12, $rate->rate);
    }
}

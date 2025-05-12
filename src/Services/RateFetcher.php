<?php

namespace Currency\Services;

use Currency\Contracts\RateParserInterface;
use Currency\DTO\CurrencyRateDTO;
use Currency\Exceptions\RateNotFoundException;

class RateFetcher
{
    public function __construct(
        private readonly string $url,
        private readonly RateParserInterface $parser
    ) {}

    /**
     * @return CurrencyRateDTO[]
     */
    public function getAllRates(): array
    {
        $raw = file_get_contents($this->url);

        return $this->parser->parse($raw);
    }

    /**
     * @throws RateNotFoundException
     */
    public function getRate(string $code): CurrencyRateDTO
    {
        $all = $this->getAllRates();

        foreach ($all as $rate) {
            if ($rate->code === $code) {
                return $rate;
            }
        }

        throw new RateNotFoundException("Rate not found for currency: $code");
    }
}

<?php

namespace Currency\Requests;

class RateRequestBuilder
{
    private string $date;

    public function forDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function build(): string
    {
        return 'https://nationalbank.kz/rss/get_rates.cfm?fdate=' . $this->date;
    }
}

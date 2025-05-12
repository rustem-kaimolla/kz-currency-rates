<?php

use PHPUnit\Framework\TestCase;
use Currency\Requests\RateRequestBuilder;

class RateRequestBuilderTest extends TestCase
{
    public function test_builds_url_correctly(): void
    {
        $url = (new RateRequestBuilder())->forDate('11.05.2025')->build();
        $this->assertStringContainsString('fdate=11.05.2025', $url);
        $this->assertStringStartsWith('https://nationalbank.kz/rss/get_rates.cfm?', $url);
    }
}

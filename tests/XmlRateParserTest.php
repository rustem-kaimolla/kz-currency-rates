<?php

use PHPUnit\Framework\TestCase;
use Currency\Parsers\XmlRateParser;

class XmlRateParserTest extends TestCase
{
    public function test_parses_valid_xml(): void
    {
        $xml = <<<XML
        <rates>
            <generator>Alternate RSS Builder</generator>
            <title>Official exchange rates of National Bank of Republic Kazakhstan</title>
            <link>www.nationalbank.kz</link>
            <description>Official exchange rates of National Bank of Republic Kazakhstan</description>
            <copyright>www.nationalbank.kz</copyright>
            <date>12.05.2025</date>
            <item>
                <fullname>АВСТРАЛИЙСКИЙ ДОЛЛАР</fullname>
                <title>AUD</title>
                <description>331.12</description>
                <quant>1</quant>
                <index/>
                <change>0.00</change>
            </item>
            <item>
                <fullname>АЗЕРБАЙДЖАНСКИЙ МАНАТ</fullname>
                <title>AZN</title>
                <description>304.43</description>
                <quant>1</quant>
                <index/>
                <change>0.00</change>
            </item>
        </rates>
        XML;

        $parser = new XmlRateParser();
        $rates = $parser->parse($xml);

        $this->assertCount(2, $rates);
        $this->assertEquals('AUD', $rates[0]->code);
        $this->assertEquals(331.12, $rates[0]->rate);
        $this->assertEquals('АВСТРАЛИЙСКИЙ ДОЛЛАР', $rates[0]->name);
        $this->assertEquals('12.05.2025', $rates[0]->date);
    }
}
